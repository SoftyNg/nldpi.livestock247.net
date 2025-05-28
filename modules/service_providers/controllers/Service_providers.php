<?php

class Service_providers extends Trongate {

    private $default_limit = 20;
    private $per_page_options = array(10, 20, 50, 100);    
    private $template_admin = 'admin';
    private $template_public = 'public';


    public function upload_attachment(array $config,$userfile): array {

        // Declare all inbound variables
        $destination = $config['destination'] ?? null;
        $target_module = $config['target_module'] ?? segment(1);
        $upload_to_module = $config['upload_to_module'] ?? false;
        $make_rand_name = $config['make_rand_name'] ?? false;

        if (!isset($destination)) {
            die('ERROR: upload requires inclusion of \'destination\' property. Check documentation for details.');
        }

        if (!array_key_exists($userfile, $_FILES)) {
            die('ERROR: The specified userfile key does not exist in the $_FILES array. Check documentation for details.');
        }

        $target_file = $_FILES[$userfile];

        // Initialize the new file name variable (the name of the uploaded file)
        if ($make_rand_name === true) {
            $file_name_without_extension = strtolower(make_rand_str(10));

            // Add file extension onto random file name
            $file_info = return_file_info($target_file['name']);
            $file_extension = $file_info['file_extension'];
            $new_file_name = $file_name_without_extension . $file_extension;
        } else {
            // Get the file name and extension
            $file_info = return_file_info($target_file['name']);
            $file_name = $file_info['file_name'];
            $file_extension = $file_info['file_extension'];

            // Remove dangerous characters from the file name
            $file_name = url_title($file_name);
            $file_name_without_extension = str_replace('-', '_', $file_name);
            $new_file_name = $file_name_without_extension . $file_extension;
        }

        // Set the target destination directory
        if ($upload_to_module === true) {
            $target_destination = '../modules/' . $target_module . '/assets/' . $destination;
        } else {
            // Code here to deal with external URLs (AWS, Google Drive, OneDrive, etc...)
            $target_destination = $destination;
        }

        try {
            // Make sure the destination folder exists
            if (!is_dir($target_destination)) {
                $error_msg = 'Invalid directory';
                if (strlen($target_destination) > 0) {
                    $error_msg .= ': \'' . $target_destination . '\' (string ' . strlen($target_destination) . ')';
                }
                throw new Exception($error_msg);
            }

            // Upload the temp file to the destination
            $new_file_path = $target_destination . '/' . $new_file_name;
            $i = 2;
            while (file_exists($new_file_path)) {
                $new_file_name = $file_name_without_extension . '_' . $i . $file_extension;
                $new_file_path = $target_destination . '/' . $new_file_name;
                $i++;
            }

            if (!move_uploaded_file($target_file['tmp_name'], $new_file_path)) {
                throw new Exception("Failed to move uploaded file to $new_file_path");
            }

            // Create an array to store file information
            $file_info = [];
            $file_info['file_name'] = $new_file_name;
            $file_info['file_path'] = $new_file_path;
            $file_info['file_type'] = $target_file['type'];
            $file_info['file_size'] = $target_file['size'];
            return $file_info;
        } catch (Exception $e) {
            echo "An exception occurred: " . $e->getMessage();
            die();
        }
    }


    function index(){
        $this->register();
    }

    function register(){  
        $data = $this->get_data_from_post();
        $data['title'] = 'Register Livestock Identification Service Provider';
        $data['location'] = 'service_providers/submit_application';
        $data['cancel_url'] = 'digital_registry/index';
        $data['view_file'] = 'register';
        $data['view_module'] = 'service_providers';
        $data['state_options'] = $this->state_options();
        $this->template($this->template_public, $data);
    }

    function dashboard(): void{
        $this->module('trongate_security');
        $token = $this->trongate_security->_make_sure_allowed('service providers');
        $_SESSION['last_page'] = 'service_providers/dashboard';

          // Fetch user and token data
          //$tokenObj = $this->trongate_tokens->_fetch_token_obj($token);
          //$data['user_data'] = $this->_get_user_data($token);


        $data['title'] = 'Dashboard';
        $data['view_file'] = 'dashboard';
        $data['view_module'] = 'service_providers';

        $sql= "SELECT * FROM animal_registrations  WHERE status IS NULL";
        $livestock_list = $this->model->query($sql, 'object');
        $data['livestock_list'] = $livestock_list;
        $this->template($this->template_admin, $data);
    }

    function number_banks(): void{
        $data['title'] = 'Number of Banks';
        $data['view_file'] = '_number_bank_request';
        $data['view_module'] = 'service_providers';
        $this->template($this->template_admin, $data);
    }

    function livestock_registry(): void{
        $data['title'] = 'Livestock Registry';
        $data['view_file'] = 'livestock_registry';
        $data['view_module'] = 'service_providers';
        $data['total_registered_breed'] = 0;
        $data['total_registered_local_breed'] = 0;
        $data['total_registered_exotic_breed'] = 0;

        $sql= "SELECT * FROM animal_registrations  WHERE status IS NULL";
        $livestock_list = $this->model->query($sql, 'object');
        $data['livestock_list'] = $livestock_list;
        $this->template($this->template_admin, $data);
        
    }

    function register_new_animal(): void{
        $data['title'] = 'Register new Animal';
        $data['view_file'] = '_register_new_animal';
        $data['view_module'] = 'service_providers';
        $this->template($this->template_admin, $data);
        
    }
    

    //display success modal on request successfully submitted
    public function number_bank_request_success(){
        $data['view_module'] = 'Service_providers';
        $data['view_file'] = '_number_bank_request_success';
        $data['title'] = 'Number bank request';            
        $this->template($this->template_admin, $data);

     }

    

















    function check_password(){
        $password = post('password', true);
        $confirm_password = post('confirm_password', true);
        if ($password !== $confirm_password) {
            $error_msg ='The passwords do not match';
            return $error_msg;
        }
        return true;
    }
    function check_email(){
        $email = post('email', true);
        $res = $this->model->get_one_where('email',$email,'account');
        if ($res) {
            $error_msg ='This email is already registered. Please log in or reset your password if you’ve forgotten it.';
            return $error_msg;
        }
        return true;
    }
    function check_phone_number(){
        $phone_number = array_key_exists('phone_number', $_POST) ? $_POST['phone_number'] : '';
        if (!preg_match('/^\d{11,14}$/', $phone_number)) {
            $error_msg = 'Please enter a valid phone number.';
            return $error_msg;
        }
        return true;
    }
    function check_reg_number(){
        $reg_number = post('reg_number', true);
        $res = $this->model->get_one_where('reg_number',$reg_number,'service_providers');
        if ($res) {
            $error_msg ='This registration number is already registered.';
            return $error_msg;
        }
        return true;
    }
    function _init_document_settings() { 
        $document_settings['destination'] = 'files';
        $document_settings['upload_to_module'] = false;
        $document_settings['make_rand_name'] = true;
        return $document_settings;
    }

    function _make_sure_got_destination_folders($document_settings) {

        $destination = $document_settings['destination'];
        $target_dir = APPPATH.'public/'.$destination;
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
    }


    function submit_application(): void{
        $submit = post('submit', true);
        if ($submit === 'Submit Application') {
           
            $this->validation->set_rules('company_name', 'Company Name', 'required|min_length[2]|max_length[200]');
            $this->validation->set_rules('phone_number', 'phone number', 'required|callback_check_phone_number');
            $this->validation->set_rules('email', 'email', 'required|max_length[255]|valid_email|callback_check_email');
            $this->validation->set_rules('reg_number', 'registration number', 'required|min_length[2]|max_length[50]|callback_check_reg_number');
            $this->validation->set_rules('password', 'password', 'required|min_length[3]|max_length[255]');
            $this->validation->set_rules('confirm_password', 'confirm password', 'required|callback_check_password');

            $result = $this->validation->run();
            if ($result === true ) { 
                $data = $this->get_data_from_post();
                $document_settings = $this->_init_document_settings();
                extract($document_settings);
                $this->_make_sure_got_destination_folders($document_settings);
    
                // Configure the upload
                $config['destination'] = $destination; 
                $config['upload_to_module'] = $upload_to_module;  
                $config['make_rand_name'] = $make_rand_name;
    
                try {

                    $file_fields = ['company_logo', 'reg_certificate','vet_reg_certificate'];
                    foreach ($file_fields as $field) {
                        if (!empty($_FILES[$field]['name'])) {
                            $result = $this->upload_attachment($config,$field);
                            $file_name = $result['file_name'];
                            $data[$field] = $file_name;
                        }
                    }
                } catch (Exception $e) {
                    $error_msg = $e->getMessage();
                    set_flashdata($flash_msg);
                    $this->register();
                    return;
                }

    
                $trongate_user_data = [
                    'code' => make_rand_str(32),
                    'user_level_id' =>  2
                ];
                $trongate_user_id = $this->model->insert($trongate_user_data, 'trongate_users');
                $account_data['email'] = $data['email'];
                $account_data['password'] =  $this->_hash_string($data['password']);
                $account_data['user_id'] = $trongate_user_id;
                $account_data['status'] = 0;
                $account_data['date_created'] = time();
                
                $account_id = $this->model->insert($account_data, 'account');

                unset($data['password']);
                unset($data['confirm_password']);
                unset($data['email']);

                $data['reg_date'] = date('Y-m-d');
                $data['account_id'] = $account_id;
                $data['type_of_service'] = 1;
                $data['nldpi_number'] = NLDPI_NUMBER + $trongate_user_id;
                $data['status'] = 0;
                $data['date_created'] = time();
                $this->model->insert($data, 'service_providers');

                // send registration email
                $aObj = (object) $account_data;
                $uObj = (object) $data;
                $this->send_registration_confirm_email($aObj,$uObj);
                redirect('digital_registry/index');
            }else{
            
                $this->register();
            
            }
        }
    }

    private function send_registration_confirm_email($account_obj,$user_obj){ 
        $data['subject'] = 'NLDPI Registration';
        $data['target_name'] = $user_obj->company_name;
        $data['target_email'] = $account_obj->email;  
        $data['user_obj'] = $user_obj;
        $data['account_obj'] = $account_obj;
        $data['logo_url'] = 'https://nldpi.livestock247.net/images/nldpi-logo-extra.png';
        $data['msg_html'] = $this->view('msg_registration_email',$data,true);
        $msg_plain = str_replace('</p>', '\\n\\n', $data['msg_html']);
        $data['msg_plain'] = strip_tags($msg_plain);

        $this->module('mail');
        $this->mail->send_mail($data);
    }

    private function get_data_from_post(): array {

        $data['company_name'] = post('company_name', true);
        $data['phone_number'] = array_key_exists('phone_number', $_POST) ? $_POST['phone_number'] : '';
        $data['email'] = post('email', true);
        $data['reg_number'] = post('reg_number', true);
        $data['capitalization'] = (float) post('capitalization');
        $data['year_in_operation'] = (int) post('year_in_operation');
        $data['address'] = post('address', true);
        $data['website'] = post('website', true); 
        $data['state'] = (int) post('state');


        $data['team_name_1'] = post('team_name_1', true);
        $data['team_email_1'] = post('team_email_1', true);
        $data['team_position_1'] = post('team_position_1', true);
        $data['team_name_2'] = post('team_name_2', true);
        $data['team_email_2'] = post('team_email_2', true);
        $data['team_position_2'] = post('team_position_2', true);


        $data['vet_name'] = post('vet_name', true);
        $data['vet_email'] = post('vet_email', true);
        $data['vet_position'] = post('vet_position', true);
        $data['vet_reg_number'] = post('vet_reg_number', true);

        $data['password'] = post('password',true);         
        return $data;
    }





    function _hash_string(string $str): string{
        $hashed_string =password_hash($str, PASSWORD_BCRYPT,array('cost'=> 11));
        return $hashed_string;
    
    }

    function state_options(): array{
        $states = array(
            1 => 'Abia',
            2 => 'Adamawa',
            3 => 'Akwa Ibom',
            4 => 'Anambra',
            5 => 'Bauchi',
            6 => 'Bayelsa',
            7 => 'Benue',
            8 => 'Borno',
            9 => 'Cross River',
            10 => 'Delta',
            11 => 'Ebonyi',
            12 => 'Edo',
            13 => 'Ekiti',
            14 => 'Enugu',
            15 => 'Gombe',
            16 => 'Imo',
            17 => 'Jigawa',
            18 => 'Kaduna',
            19 => 'Kano',
            20 => 'Katsina',
            21 => 'Kebbi',
            22 => 'Kogi',
            23 => 'Kwara',
            24 => 'Lagos',
            25 => 'Nasarawa',
            26 => 'Niger',
            27 => 'Ogun',
            28 => 'Ondo',
            29 => 'Osun',
            30 => 'Oyo',
            31 => 'Plateau',
            32 => 'Rivers',
            33 => 'Sokoto',
            34 => 'Taraba',
            35 => 'Yobe',
            36 => 'Zamfara',
            37 => 'Federal Capital Territory'
        );

        $state_options = array('');
        foreach ($states as $key => $value) {
            $state_options[$key] = $value;
        }

        return $state_options;
    }


    function number_bank_allocate_success(){
        $data['view_module'] = 'Service_providers';
        $data['view_file'] = '_number_bank_allocate_success';
        $data['title'] = 'Number bank Allocate';            
        $this->template($this->template_admin, $data);

    }



    function _get_number_list($nldpiNumber) {
        $params['nldpi_number'] = $nldpiNumber;
            $sql = 'SELECT * FROM number_bank_request_allocation WHERE 
            status="Approved" AND nldpi_number = :nldpi_number';            
            $rows = $this->model->query_bind($sql, $params, 'object');
       
        foreach ($rows as $row) {
            $options[0] = 'none selected';
            $options[$row->id] = $row->id;
        }
        return $options;
    }


    function _get_breed_list() {
        $params['status'] = 1;
            $sql = 'SELECT * FROM breed_registrations WHERE status= :status';            
            $rows = $this->model->query_bind($sql, $params, 'object');
       
        foreach ($rows as $row) {
            $options[0] = 'none selected';
            $options[$row->name] = $row->name;
        }
        return $options;
    }

    function _get_vet_professional_list() {
        $params['status'] = 1;
            $sql = 'SELECT * FROM veterinary_professionals WHERE status= :status';            
            $rows = $this->model->query_bind($sql, $params, 'object');
       
        foreach ($rows as $row) {
            $options[0] = 'none selected';
            $options[$row->nldpi_number] = $row->nldpi_number;
        }
        return $options;
    }













    function save_form_data() {
        
        $post_data = [
            'name' => post('name'),
            'email' => post('email'),
            'year_in_operation' => post('year_in_operation'),
            'reg_number' => post('reg_number'),
            'address' => post('address'),
            'phone_number' => post('phone_number'),
            'website' => post('website'),
            'state' => post('state')
        ];

            // Handle file uploads
        $upload_data = $this->_upload_temp_files();

        if (isset($upload_data['error'])) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => $upload_data['error']]);
        return;
        }

        // Merge file paths with form data
        $post_data = array_merge($post_data, $upload_data);

        // Store in session
        $_SESSION['form_data'] = $post_data;

        echo json_encode(['status' => 'success', 'message' => 'Progress saved']);
    }



        // Helper function to handle temporary file uploads
private function _upload_temp_files() {
    $upload_dir = APPPATH . 'uploads/temp/'; // Temporary upload directory

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $allowed_types = ['image/jpeg', 'image/png', 'application/pdf', 'application/msword', 
                      'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

    $uploaded_files = [];

    foreach ($_FILES as $key => $file) {
        if ($file['error'] === UPLOAD_ERR_OK) {
            $file_type = mime_content_type($file['tmp_name']);
            $file_size = $file['size'];

            if (!in_array($file_type, $allowed_types)) {
                return ['error' => "Invalid file type for $key."];
            }

            if ($file_size > 5 * 1024 * 1024) {
                return ['error' => "$key exceeds the 5MB size limit."];
            }

            $file_name = time() . '_' . basename($file['name']);
            $file_path = $upload_dir . $file_name;

            if (move_uploaded_file($file['tmp_name'], $file_path)) {
                $uploaded_files[$key] = $file_name; // Store only filename
            } else {
                return ['error' => "Failed to upload $key."];
            }
        }
    }

    return $uploaded_files;
}




    
function load_form_data() {
    $post_data = file_get_contents('php://input');
    $data = json_decode($post_data, true);

    if ($data) {
        // Save to database, session, or temporary storage
        $_SESSION['signup_progress'] = $data; // Example: Save in session

        $response = ['status' => 'success', 'message' => 'Progress saved!'];
    } else {
        $response = ['status' => 'error', 'message' => 'Failed to save progress.'];
    }

    // Return JSON response
    echo json_encode($response);
}
        

    function submit_idsp_form() {

        $data = $this->_get_data_from_post();
    
            $params = ['email' => $data['company_email']];

            $rows = $this->model->query_bind('SELECT * FROM account WHERE 
            email = :email', $params, 'object');


            if (!empty($rows)) {
                $this->setFlashAndRedirect('This email has already been used to create an account, try login in or create a new account',
                 'id_service_providers_view');                
              
            } else {
                  // Insert data into database
                $trongateUserData = [
                    'code' => make_rand_str(32),
                    'user_level_id' =>  2
                ];
        
                $trongateUserId = $this->model->insert($trongateUserData, 'trongate_users');
                $data['trongate_user_id'] = $trongateUserId;
                $accountData =[
                    'email' => $data['company_email'],
                    'password' => $data['password'],
                    'trongate_user_id' => $data['trongate_user_id']
                ];

                unset($data['password']);
                unset($data['trongate_user_id']);
                
             
                $this->model->insert($data, 'service_providers_register');
                  
               $this->sendRegistrationEmailAndInsert($accountData);               

               // Redirect to the next step
               redirect('serviceprovidersregisters/registration_success');
            }
       
    }

    private function sendRegistrationEmailAndInsert(array $data): void {
        $targetUrl = 'https://meat247.com/user/';
        //$this->_send_registration_confirm_email($data, $targetUrl);
        $this->model->insert($data, 'account');
    }

    
    function _send_registration_confirm_email($user_obj, $target_url){ 
        $data['subject'] = 'Meat247 Registration';
        $data['target_name'] = $user_obj['full_name'];
        $data['user_obj'] = $user_obj;
        $data['target_url'] = $target_url;
        $data['target_email'] = $user_obj['email'];  
        $data['msg_html'] = $this->view('_msg_registration_confirm_email',$data,true);
        $msg_plain = str_replace('</p>', '\\n\\n', $data['msg_html']);
        $data['msg_plain'] = strip_tags($msg_plain);
        $this->module('mailman');
        $this->mailman->_send_my_email($data);
    }

    private function setFlashAndRedirect(string $message, string $redirectMethod): void {
        set_flashdata($message);
        $this->$redirectMethod();
    }


    private function _get_data_from_post() {
        // Retrieve form inputs using Trongate's post() function
        $data = [];
        $data['company_name'] = post('company_name', true);
        $data['company_email'] = post('company_email', true);
        $data['year_in_operation'] = post('year_in_operation', true);
        $data['reg_number'] = post('reg_number', true);
        $data['address'] = post('address', true);
        $data['phone_number'] = post('phone_number', true);
        $data['website'] = post('website', true);
        $data['state'] = post('state', true);

        $data['team_member1_name'] = post('team_member1_name', true);
        $data['team_member1_email'] = post('team_member1_email', true);
        $data['team_member1_position'] = post('team_member1_position', true);
        
        $data['team_member2_name'] = post('team_member2_name', true);
        $data['team_member2_email'] = post('team_member2_email', true);
        $data['team_member2_position'] = post('team_member2_position', true);
    
        // Veterinary Professional
        $data['vet_name'] = post('vet_name', true);
        $data['vet_email'] = post('vet_email', true);
        $data['vet_vcn_number'] = post('vet_vcn_number', true);
        $data['vet_position'] = post('vet_position', true);
        $data['vet_certification'] = post('vet_certification', true);
        $data['reg_date'] = time();
        
        // Password Fields    
        $password = post('password', true);
        
        $data['password'] = password_hash($password, PASSWORD_BCRYPT);
       
        // Handle file uploads (without validation)
        $upload_path = 'public/uploads/';
        $file_fields = ['company_logo', 'capitalization', 'cac_certificate','vcn_certificate'];
          
        
        foreach ($file_fields as $field) {
            if (!empty($_FILES[$field]['name'])) {
                $new_filename = time() . '_' . $_FILES[$field]['name'];
                move_uploaded_file($_FILES[$field]['tmp_name'], $upload_path . $new_filename);
                $data[$field] = $upload_path . $new_filename;
            }
        }

        return $data;
    }
    

    /**
     * Handle submitted request for deletion.
     *
     * @return void
     */
    public function submit_delete(): void {
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed();

        $submit = post('submit');
        $params['update_id'] = (int) segment(3);

        if (($submit === 'Yes - Delete Now') && ($params['update_id']>0)) {
            //delete all of the comments associated with this record
            $sql = 'delete from trongate_comments where target_table = :module and update_id = :update_id';
            $params['module'] = 'serviceprovidersregisters';
            $this->model->query_bind($sql, $params);

            //delete the record
            $this->model->delete($params['update_id'], 'serviceprovidersregisters');

            //set the flashdata
            $flash_msg = 'The record was successfully deleted';
            set_flashdata($flash_msg);

            //redirect to the manage page
            redirect('serviceprovidersregisters/manage');
        }
    }
   
   
    // Access control for service providers
function _make_sure_allowed() {
    $this->module('trongate_tokens');
    $token = $this->trongate_tokens->_attempt_get_valid_token();
 
    if (!$token) {
        redirect('users/login');
    }
    return $token;
  }



    /**
     * Set the number of items per page.
     *
     * @param int $selected_index Selected index for items per page.
     *
     * @return void
     */
    public function set_per_page(int $selected_index): void {
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed();

        if (!is_numeric($selected_index)) {
            $selected_index = $this->per_page_options[1];
        }

        $_SESSION['selected_per_page'] = $selected_index;
        redirect('serviceprovidersregisters/manage');
    }

    /**
     * Get the selected number of items per page.
     *
     * @return int Selected items per page.
     */
    private function get_selected_per_page(): int {
        $selected_per_page = (isset($_SESSION['selected_per_page'])) ? $_SESSION['selected_per_page'] : 1;
        return $selected_per_page;
    }

    /**
     * Reduce fetched table rows based on offset and limit.
     *
     * @param array $all_rows All rows to be reduced.
     *
     * @return array Reduced rows.
     */
    private function reduce_rows(array $all_rows): array {
        $rows = [];
        $start_index = $this->get_offset();
        $limit = $this->get_limit();
        $end_index = $start_index + $limit;

        $count = -1;
        foreach ($all_rows as $row) {
            $count++;
            if (($count>=$start_index) && ($count<$end_index)) {
                $rows[] = $row;
            }
        }

        return $rows;
    }

    /**
     * Get the limit for pagination.
     *
     * @return int Limit for pagination.
     */
    private function get_limit(): int {
        if (isset($_SESSION['selected_per_page'])) {
            $limit = $this->per_page_options[$_SESSION['selected_per_page']];
        } else {
            $limit = $this->default_limit;
        }

        return $limit;
    }

    /**
     * Get the offset for pagination.
     *
     * @return int Offset for pagination.
     */
    private function get_offset(): int {
        $page_num = (int) segment(3);

        if ($page_num>1) {
            $offset = ($page_num-1)*$this->get_limit();
        } else {
            $offset = 0;
        }

        return $offset;
    }

    /**
     * Get data from the database for a specific update_id.
     *
     * @param int $update_id The ID of the record to retrieve.
     *
     * @return array|null An array of data or null if the record doesn't exist.
     */
    private function get_data_from_db(int $update_id): ?array {
        $record_obj = $this->model->get_where($update_id, 'serviceprovidersregisters');

        if ($record_obj === false) {
            $this->template('error_404');
            die();
        } else {
            $data = (array) $record_obj;
            return $data;        
        }
    }

    /**
     * Get data from the POST request.
     *
     * @return array Data from the POST request.
     */
    // private function get_data_from_post(): array {
    //     $data['ndlpi_number'] = post('ndlpi_number', true);        
    //     return $data;
    // }   

public function register_new_animal_success(){
    $data['view_module'] = 'Service_providers';
    $data['view_file'] = '_animal_reg_success';
    $data['title'] = 'Number bank request';            
    $this->template($this->template_admin, $data);


}

  public function _fetch_all_data_for_user($email) {	
    $params['email'] = $email;
    $sql = 'SELECT sp.*, a.*
FROM service_providers sp
JOIN account a ON sp.account_id = a.id
WHERE a.email = :email;';		
    $rows = $this->model->query_bind($sql, $params, 'object');
   return $rows;       
}

    
   public function countAll() {
        $sql = "SELECT COUNT('id') AS count FROM service_providers";
        $rows = $this->model->query($sql, 'object');

        if (!empty($rows)) {
            return $rows[0]->count;
        } else {
            return 0;
        }
    }

    public function countApproved() {
    $sql = "SELECT COUNT(id) AS count FROM service_providers WHERE status = 1";
    $rows = $this->model->query($sql, 'object');

    if (!empty($rows)) {
        return $rows[0]->count;
    } else {
        return 0;
    }
}

public function countPending() {
    $sql = "SELECT COUNT(id) AS count FROM service_providers WHERE status = 0";
    $rows = $this->model->query($sql, 'object');

    if (!empty($rows)) {
        return $rows[0]->count;
    } else {
        return 0;
    }
}


public function getApprovedServiceProviders() {
    $sql = "SELECT * FROM service_providers WHERE status = 1";
    $rows = $this->model->query($sql, 'object'); // fetch as associative array
     //json($rows); die();
    return $rows;
}





    
        public function number_bank_request(){
                 
            // $data['user_data'] = $_SESSION['user_data'];
         
             $data['view_module'] = 'Serviceprovidersregisters';
             $data['view_file'] = '_number_bank_request';
             $data['title'] = 'Number bank request';
             $this->template('admin', $data);
     
         }



    public function registration_success(){
        $data = $this->_get_data_from_post();
        $data['view_module'] = 'Serviceprovidersregisters';
		$data['view_file'] = 'registration_success';
		$data['title'] = 'Successfully Register';
		$this->template('nldpi', $data);

    }

    public function login(){        
        $data['view_module'] = 'Serviceprovidersregisters';
        
		$data['view_file'] = '_login';
		$data['title'] = 'Login';
		$this->template('nldpi', $data);

    }


    // Logs out the user
    public function logout() {
        // Destroy all session data
        session_unset(); // Unset all session variables
        session_destroy();
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }
    
        // Provide feedback if needed
        set_flashdata('success', 'You have been successfully logged out.');
    
        // Redirect the user back to the login page
        redirect('user_auth/login');
    }




}