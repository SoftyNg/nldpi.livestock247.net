<?php
class Veterinary_professionals extends Trongate {

    private $default_limit = 20;
    private $per_page_options = array(10, 20, 50, 100);    
    private $template_admin = 'admin';
    private $template_public = 'public';

    
    function index(){
        $this->register();
    }

    function register(): void{
        $data = $this->get_data_from_post();

        $data['title'] = 'Register Veterinary Professional';
        $data['location'] = 'veterinary_professionals/submit_application';
        $data['cancel_url'] = 'digital_registry/index';
        $data['view_file'] = 'register';
        $data['view_module'] = 'veterinary_professionals';
        $data['professional_body_options'] = $this->professional_body_options();
        $this->template($this->template_public, $data);
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
        $res = $this->model->get_one_where('reg_number',$reg_number,'veterinary_professionals');
        if ($res) {
            $error_msg ='This registration number is already registered.';
            return $error_msg;
        }
        return true;
    }
    function professional_body_options(): array{
        return [
            '' => 'Select Professional Body',
            1 => 'Veterinary Council of Nigeria (VCN)',
            2 => 'Nigerian Veterinary Medical Association (NVMA)',
            3 => 'National Veterinary Quarantine Services (NVQS)',
            4 => 'National Veterinary Research Institute (NVRI)'
        ];
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
        // json($_FILES,true);
        if ($submit === 'Submit Application') {

            $this->validation->set_rules('firstname', 'firstname', 'required|min_length[2]|max_length[200]');
            $this->validation->set_rules('lastname', 'lastname', 'required|min_length[2]|max_length[200]');
            $this->validation->set_rules('phone_number', 'phone number', 'required|callback_check_phone_number');
            $this->validation->set_rules('email', 'email', 'required|max_length[255]|valid_email|callback_check_email');
            $this->validation->set_rules('professional_body', 'professional body', 'required|integer');
            $this->validation->set_rules('reg_number', 'registration number', 'required|min_length[2]|max_length[50]|callback_check_reg_number');
            $this->validation->set_rules('password', 'password', 'required|min_length[3]|max_length[255]');
            $this->validation->set_rules('confirm_password', 'confirm password', 'required|callback_check_password');
            $this->validation->set_rules('reg_certificate', 'registration certificate', 'allowed_types[jpg,png,pdf]|max_size[2048]');

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
                    $result = $this->upload_file($config);
                    $file_name = $result['file_name'];
                    $data['reg_certificate'] = $file_name;
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
                $data['nldpi_number'] = NLDPI_NUMBER + $trongate_user_id;
                $data['status'] = 0;
                $data['date_created'] = time();
                $this->model->insert($data, 'veterinary_professionals');
                $_SESSION['success'] ='Your credentials are under review. You will receive a notification via email once the verification process is complete.';
                

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
        $data['target_name'] = $user_obj->firstname . ' ' . $user_obj->lastname;
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
        $data['firstname'] = post('firstname', true);
        $data['lastname'] = post('lastname', true);
        $data['email'] = post('email', true);
        $data['professional_body'] = post('professional_body', true);
        $data['reg_number'] = post('reg_number', true);
        $data['reg_certificate'] = post('reg_certificate', true);
        $data['password'] = post('password',true);         
        $data['phone_number'] = array_key_exists('phone_number', $_POST) ? $_POST['phone_number'] : '';
        return $data;
    }


    function _hash_string(string $str): string{
        $hashed_string =password_hash($str, PASSWORD_BCRYPT,array('cost'=> 11));
        return $hashed_string;
    
    }

    function dashboard(): void{
        $data['title'] = 'Dashboard';
        $data['view_file'] = 'dashboard';
        $data['view_module'] = 'veterinary_professionals';

        $sql= "SELECT * FROM animal_registrations  WHERE status IS NULL";
        $livestock_list = $this->model->query($sql, 'object');
        $data['livestock_list'] = $livestock_list;
        $this->template($this->template_admin, $data);
    }

    function transport_permit(): void{
        $data['title'] = 'Transport Permit';
        $data['view_file'] = 'transport_permit';
        $data['view_module'] = 'veterinary_professionals';

        $sql= "SELECT * FROM animal_registrations  WHERE status IS NULL";
        $livestock_list = $this->model->query($sql, 'object');
        $data['livestock_list'] = $livestock_list;
        $this->template($this->template_admin, $data);
    }

    function livestock_registry(): void{
        $data['title'] = 'Livestock Registry';
        $data['view_file'] = 'livestock_registry';
        $data['view_module'] = 'veterinary_professionals';
        $data['total_registered_breed'] = 0;
        $data['total_registered_local_breed'] = 0;
        $data['total_registered_exotic_breed'] = 0;

        $sql= "SELECT * FROM animal_registrations  WHERE status IS NULL";
        $livestock_list = $this->model->query($sql, 'object');
        $data['livestock_list'] = $livestock_list;
        $this->template($this->template_admin, $data);
        
    }


























































    function listing(): void{
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed('member area');
        $_SESSION['last_page'] = 'veterinary_professionals';
        
        $sql = 'SELECT t.id as id, a.firstname, a.lastname, a.user_type, a.access, a.email, a.picture, a.status, t.reg_number, t.nldpi_number, t.reg_date
        FROM veterinary_professionals t
        INNER JOIN account a ON a.id = t.user_id WHERE a.access="0" AND a.status ="pending"';
        $list_of_registered_vet_professionals = $this->model->query($sql, 'object');

        $sql = 'SELECT COUNT(*)  as vet_professionals_total FROM veterinary_professionals t
        INNER JOIN account a ON a.id = t.user_id WHERE  a.access="0" AND  a.status ="pending"';
        $vet_professionals_total = $this->model->query($sql, 'object');

        $sql= "SELECT id, firstname, lastname, email, user_type, access FROM account ORDER BY id DESC";
        $users = $this->model->query($sql, 'object');
        $data = [
            'user_data' =>  $this->_get_user_data($this->trongate_security->_make_sure_allowed('member area')),
            'vet_professionals_total' => $vet_professionals_total[0]->vet_professionals_total,
            'title' => 'List Of Registered Vet Professionals',
            'list_of_registered_vet_professionals' =>$list_of_registered_vet_professionals,
            'view_file' => 'index',
            'view_module' => 'veterinary_professionals'
        ];
        $this->template($this->template_admin, $data);
    }

   


    
    



    function approval($vet_professional_id): void{

        $vet_professional = $this->model->get_where($vet_professional_id,'veterinary_professionals');

        if($vet_professional){

            $this->module('trongate_security');
            $this->trongate_security->_make_sure_allowed('member area');
            /*$_SESSION['last_page'] = 'veterinary_professionals/approval';*/
             $vet_account_id = $vet_professional->user_id;
             $vet_account = $this->model->get_where($vet_account_id,'account');

             if($vet_account){
                $data = [
                    'title' => 'Approve Veterinary Professional',
                    'user_data' =>  $this->_get_user_data($this->trongate_security->_make_sure_allowed('member area')),
                    'vet_professional' => $vet_professional,
                    'veterinary_status' => $vet_account->status,
                    'view_file' => '_approval_for_veterinary_professional',
                    'view_module' => 'veterinary_professionals'
                ]; 
             }else{
                $data = [
                    'title' => 'Approve Veterinary Professional',
                    'user_data' =>  $this->_get_user_data($this->trongate_security->_make_sure_allowed('member area')),
                    'vet_professional' => $vet_professional,
                    'view_file' => '_approval_for_veterinary_professional',
                    'view_module' => 'veterinary_professionals'
                ];                
             }

            $this->template('admin_nldpi', $data);
        }else{
            load('error_404');
            die(); 
        }

    }



    function approve_vet_professional_registration(): void{
        $data = $this->_get_data_approve_from_veterinary_professional();
        $vet_professional = $this->model->get_one_where('id',$data['id'],'veterinary_professionals');
        if($vet_professional == true){
            $this->module('trongate_security');
            $this->trongate_security->_make_sure_allowed('member area');
            $_SESSION['last_page'] = 'veterinary_professionals';

            $nldpi_number = $this->_generate_nldpi_number();

            $data['nldpi_number'] = $nldpi_number['nldpi_number'];

            $update_vet_professtional_sql = "UPDATE  veterinary_professionals SET nldpi_number = :nldpi_number
            WHERE id =:id";
           $this->model->query_bind($update_vet_professtional_sql,$data);

            $vet_account_id = $vet_professional->user_id;

            $data_update['id'] = $vet_account_id;
            $data_update['status'] ="approved";
            $data_update['access'] ="2";
            $update_account_sql = "UPDATE account SET access = :access, status = :status
             WHERE id =:id";
            $this->model->query_bind($update_account_sql,$data_update);

            /***** SEND ACCEPTANCE MESSAGE TO THE VET APPLICANT HERE */
            redirect('veterinary_professionals');

        }else{
            load('error_404');
            die(); 
        }

    }


    function reject_vet_professional_registration(): void{
        $data = $this->_get_data_reject_from_veterinary_professional();
        $vet_professional = $this->model->get_one_where('id',$data['id'],'veterinary_professionals');
        if($vet_professional == true){
            $this->module('trongate_security');
            $this->trongate_security->_make_sure_allowed('member area');
            $_SESSION['last_page'] = 'veterinary_professionals';
            $vet_account_id = $vet_professional->user_id;
            $data_update['reason'] = $data['reason'];
            $data_update['id'] = $vet_account_id;
            $data_update['status'] ="reject";
            $data_update['access'] =NULL;
            $update_sql = "UPDATE account SET reason = :reason, status = :status, access = :access
             WHERE id =:id";
            $this->model->query_bind($update_sql,$data_update);

            /***** SEND REJECTION MESSAGE TO THE VET APPLICANT HERE */
            redirect('veterinary_professionals');
        }else{
            load('error_404');
            die(); 
        }

    }


    function  _get_data_approve_from_veterinary_professional(): array {
        $data['id'] = post('id', true);    
        return $data;
    }

    function  _get_data_reject_from_veterinary_professional(): array {
        $data['id'] = post('id', true); 
        $data['reason'] = post('reason', true);  
        return $data;
    }
    


  
function _get_data_from_veterinary_professional_for_update(): array {
    $data['id'] = post('id', true);
    $data['firstname'] = post('firstname', true);
    $data['lastname'] = post('lastname', true);
    $data['email'] = post('email', true);
    $data['breed'] = post('breed', true);
    $data['phone_Number'] = post('phone_number', true);
    $data['professional_body'] = post('professional_body', true);
    $data['reg_number'] = post('reg_number', true);
    $data['reg_certificate'] = post('reg_certificate', true); 
    return $data;
}

function get_veterinary_prefessional($registration_id){  
$sql= "SELECT * FROM animal_registrations WHERE id='$animal_registration_id'";
$animal_registration = $this->model->query($sql, 'object');

return $animal_registration;
}





//Update vet professtional status
/*function set_vet_professtional_status(){

    $this->module('trongate_security');
    $this->trongate_security->_make_sure_allowed('member area');
    
    $_SESSION['last_page'] = 'veterinary_professionals';   
    $data = $this->_get_data_vet_professtional_status();
    if( $data['status'] == 'active'){
      
        $data['access'] = '2';

        $update_sql = "UPDATE account SET status = :status, 
        access = :access  WHERE id =:id";
        $update_vet_professtionals  = $this->model->query_bind($update_sql,$data);
        if($update_vet_professtionals){
            return json_encode(['success'=>'success','message'=>'You have successfully set status of the vet doctor to '.$data['status']]);
        }else{
            return json_encode(['failure'=>'failure','message'=>'Oops something went wrong']);
        }       
    

    }
    if( $data['status'] == 'reject'){
        $data['access'] = '0';
        $update_sql = "UPDATE account SET status = :status, 
        access = :access  WHERE id =:id";
        $update_vet_professtionals  = $this->model->query_bind($update_sql,$data);
        if($update_vet_professtionals){
            return json_encode(['success'=>'success','message'=>'You have successfully set status of the vet doctor to '.$data['status']]);
        }else{
            return json_encode(['failure'=>'failure','message'=>'Oops something went wrong']);
        }       
    
    }

    if( $data['status'] == 'pending'){
        $data['access'] = '0';
        $update_sql = "UPDATE account SET status = :status, 
        access = :access  WHERE id =:id";
        $update_vet_professtionals  = $this->model->query_bind($update_sql,$data);
        if($update_vet_professtionals){
            return json_encode(['success'=>'success','message'=>'You have successfully set status of the vet doctor to '.$data['status']]);
        }else{
            return json_encode(['failure'=>'failure','message'=>'Oops something went wrong']);
        }       
    

    }
    
    if( $data['status'] == 'delete'){
        $data['access'] = '0';
        $update_sql = "UPDATE account SET status = :status, 
        access = :access  WHERE id =:id";
        $update_vet_professtionals  = $this->model->query_bind($update_sql,$data);
        if($update_vet_professtionals){
            echo "yes";
            echo json_encode(['success'=>'success','message'=>'You have successfully set status of the vet doctor to '.$data['status']]);
        }else{
            echo "no";
            echo json_encode(['failure'=>'failure','message'=>'Oops something went wrong']);
        }       
    
    }

}*/



/**
 * Get data from the POST request.
 *
 * @return array Data from the POST request.
 */
private function _get_data_vet_professtional_status(): array {
    $data['id'] = post('id', true);
    $data['status'] = post('status', true);
    return $data;
}

private function _generate_nldpi_number() {
    
    $data['nldpi_number'] = 'NLDPI'.substr(str_shuffle("0123456789"),0,3);
    return $data;
}


    
  // Fetch user data based on token
  private function _get_user_data($token) {

    $params = ['token' => $token];
    $sql = 'SELECT a.id, t.user_id, a.firstname, a.lastname, a.user_type, a.access, a.email, a.picture, t.token
            FROM trongate_tokens t
            INNER JOIN account a ON a.trongate_user_id = t.user_id
            WHERE t.token = :token';
    return $this->model->query_bind($sql, $params, 'object');
  
}



    /**
     * Display a webpage with a form for creating or updating a record.
     */
    public function create(): void {
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed();

        $update_id = (int) segment(3);
        $submit = post('submit');

        if (($submit === '') && ($update_id>0)) {
            $data = $this->get_data_from_db($update_id);
        } else {
            $data = $this->get_data_from_post();
        }

        if ($update_id>0) {
            $data['headline'] = 'Update Animal_registration Record';
            $data['cancel_url'] = BASE_URL.'animal_registrations/show/'.$update_id;
        } else {
            $data['headline'] = 'Create New Animal_registration Record';
            $data['cancel_url'] = BASE_URL.'animal_registrations/manage';
        }

        $data['form_location'] = BASE_URL.'animal_registrations/submit/'.$update_id;
        $data['view_file'] = 'create';
        $this->template('admin', $data);
    }

    /**
     * Display a webpage to manage records.F
     *
     * @return void
     */
    public function manage(): void {
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed();

        if (segment(4) !== '') {
            $data['headline'] = 'Search Results';
            $searchphrase = trim($_GET['searchphrase']);
            $params['nldpi_number'] = '%'.$searchphrase.'%';
            $params['id_number'] = '%'.$searchphrase.'%';
            $params['breed'] = '%'.$searchphrase.'%';
            $params['sex'] = '%'.$searchphrase.'%';
            $params['weight'] = '%'.$searchphrase.'%';
            $params['approx_age'] = '%'.$searchphrase.'%';
            $params['colour'] = '%'.$searchphrase.'%';
            $params['type_of_animal'] = '%'.$searchphrase.'%';
            $params['reg_point'] = '%'.$searchphrase.'%';
            $params['reg_by'] = '%'.$searchphrase.'%';
            $sql = 'select * from animal_registrations
            WHERE nldpi_number LIKE :nldpi_number
            OR id_number LIKE :id_number
            OR breed LIKE :breed
            OR sex LIKE :sex
            OR weight LIKE :weight
            OR approx_age LIKE :approx_age
            OR colour LIKE :colour
            OR type_of_animal LIKE :type_of_animal
            OR reg_point LIKE :reg_point
            OR reg_by LIKE :reg_by
            ORDER BY id desc';
            $all_rows = $this->model->query_bind($sql, $params, 'object');
        } else {
            $data['headline'] = 'Manage Animal_registrations';
            $all_rows = $this->model->get('id desc');
        }

        $pagination_data['total_rows'] = count($all_rows);
        $pagination_data['page_num_segment'] = 3;
        $pagination_data['limit'] = $this->get_limit();
        $pagination_data['pagination_root'] = 'animal_registrations/manage';
        $pagination_data['record_name_plural'] = 'animal_registrations';
        $pagination_data['include_showing_statement'] = true;
        $data['pagination_data'] = $pagination_data;

        $data['rows'] = $this->reduce_rows($all_rows);
        $data['selected_per_page'] = $this->get_selected_per_page();
        $data['per_page_options'] = $this->per_page_options;
        $data['view_module'] = 'animal_registrations';
        $data['view_file'] = 'manage';
        $this->template('admin', $data);
    }

    /**
     * Display a webpage showing information for an individual record.
     *
     * @return void
     */
    public function show(): void {
        $this->module('trongate_security');
        $token = $this->trongate_security->_make_sure_allowed();
        $update_id = (int) segment(3);

        if ($update_id === 0) {
            redirect('animal_registrations/manage');
        }

        $data = $this->get_data_from_db($update_id);
        $data['token'] = $token;

        if ($data === false) {
            redirect('animal_registrations/manage');
        } else {
            $data['update_id'] = $update_id;
            $data['headline'] = 'Animal_registration Information';
            $data['view_file'] = 'show';
            $this->template('admin', $data);
        }
    }

    /**
     * Handle submitted record data.
     *
     * @return void
     */
    public function submit(): void {
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed();

        $submit = post('submit', true);

        if ($submit === 'Submit') {

            $this->validation->set_rules('nldpi_number', 'nldpi_number', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('id_number', 'id_number', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('breed', 'breed', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('sex', 'sex', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('weight', 'weight', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('approx_age', 'approx_age', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('colour', 'colour', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('type_of_animal', 'type_of_animal', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('reg_date', 'reg_date', 'required|valid_datetimepicker_us');
            $this->validation->set_rules('reg_point', 'reg_point', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('reg_by', 'reg_by', 'required|min_length[2]|max_length[255]');

            $result = $this->validation->run();

            if ($result === true) {

                $update_id = (int) segment(3);
                $data = $this->get_data_from_post();
                $data['reg_date'] = str_replace(' at ', '', $data['reg_date']);
                $data['reg_date'] = date('Y-m-d H:i', strtotime($data['reg_date']));
                
                if ($update_id>0) {
                    //update an existing record
                    $this->model->update($update_id, $data, 'animal_registrations');
                    $flash_msg = 'The record was successfully updated';
                } else {
                    //insert the new record
                    $update_id = $this->model->insert($data, 'animal_registrations');
                    $flash_msg = 'The record was successfully created';
                }

                set_flashdata($flash_msg);
                redirect('animal_registrations/show/'.$update_id);

            } else {
                //form submission error
                $this->create();
            }

        }

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
            $params['module'] = 'animal_registrations';
            $this->model->query_bind($sql, $params);

            //delete the record
            $this->model->delete($params['update_id'], 'animal_registrations');

            //set the flashdata
            $flash_msg = 'The record was successfully deleted';
            set_flashdata($flash_msg);

            //redirect to the manage page
            redirect('animal_registrations/manage');
        }
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
        redirect('animal_registrations/manage');
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
        $record_obj = $this->model->get_where($update_id, 'animal_registrations');

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
    //     $data['nldpi_number'] = post('nldpi_number', true);
    //     $data['id_number'] = post('id_number', true);
    //     $data['breed'] = post('breed', true);
    //     $data['sex'] = post('sex', true);
    //     $data['weight'] = post('weight', true);
    //     $data['approx_age'] = post('approx_age', true);
    //     $data['colour'] = post('colour', true);
    //     $data['type_of_animal'] = post('type_of_animal', true);
    //     $data['reg_date'] = post('reg_date', true);
    //     $data['reg_point'] = post('reg_point', true);
    //     $data['reg_by'] = post('reg_by', true);        
    //     return $data;
    // }




     function _init_profile_picture_settings() 
{
    return [
        'max_file_size' => 10000,
        'max_width' => 5000,
        'max_height' => 5000,
        'resized_max_width' => 450,
        'resized_max_height' => 450,
        'destination' => 'documents',
        'target_column_name' => 'reg_certificate',
        /*'thumbnail_dir' => 'profile_pics_thumbnails',
        'thumbnail_max_width' => 120,
        'thumbnail_max_height' => 120,*/
        'upload_to_module' => false,
        'make_rand_name' => false
    ];
}

function _ensure_destination_folders($picture_settings) 
{
    $destination = $picture_settings['destination'];
    $target_dir = $picture_settings['upload_to_module'] ? 
        APPPATH . 'modules/assets/' . $destination :
        APPPATH . 'public/' . $destination;

    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

}

}