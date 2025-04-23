<?php
class Transporter_registrations extends Trongate {

    private $default_limit = 20;
    private $per_page_options = array(10, 20, 50, 100);    
    private $acceptable_file_types = ['jpg', 'jpeg', 'png', 'pdf'];
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
            $data['headline'] = 'Update Transporter_registration Record';
            $data['cancel_url'] = BASE_URL.'transporter_registrations/show/'.$update_id;
        } else {
            $data['headline'] = 'Create New Transporter_registration Record';
            $data['cancel_url'] = BASE_URL.'transporter_registrations/manage';
        }

        $data['form_location'] = BASE_URL.'transporter_registrations/submit/'.$update_id;
        $data['view_file'] = 'create';
        $this->template('admin', $data);
    }

    /**
     * Display a webpage to manage records.
     *
     * @return void
     */
    public function manage(): void {
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed();

        if (segment(4) !== '') {
            $data['headline'] = 'Search Results';
            $searchphrase = trim($_GET['searchphrase']);
            $params['company_name'] = '%'.$searchphrase.'%';
            $params['registration_number'] = '%'.$searchphrase.'%';
            $params['phone_number'] = '%'.$searchphrase.'%';
            $params['emal'] = '%'.$searchphrase.'%';
            $params['no_of_vehicle_in_fleet'] = '%'.$searchphrase.'%';
            $params['cac_certificate'] = '%'.$searchphrase.'%';
            $params['trans_licence'] = '%'.$searchphrase.'%';
            $params['insur_certificate'] = '%'.$searchphrase.'%';
            $params['tax_id'] = '%'.$searchphrase.'%';
            $params['vehicle_reg'] = '%'.$searchphrase.'%';
            $params['vehicle_type'] = '%'.$searchphrase.'%';
            $params['carrying_cap'] = '%'.$searchphrase.'%';
            $params['vehicle_photo'] = '%'.$searchphrase.'%';
            $params['password'] = '%'.$searchphrase.'%';
            $sql = 'select * from transporter_registrations
            WHERE company_name LIKE :company_name
            OR registration_number LIKE :registration_number
            OR phone_number LIKE :phone_number
            OR emal LIKE :emal
            OR no_of_vehicle_in_fleet LIKE :no_of_vehicle_in_fleet
            OR cac_certificate LIKE :cac_certificate
            OR trans_licence LIKE :trans_licence
            OR insur_certificate LIKE :insur_certificate
            OR tax_id LIKE :tax_id
            OR vehicle_reg LIKE :vehicle_reg
            OR vehicle_type LIKE :vehicle_type
            OR carrying_cap LIKE :carrying_cap
            OR vehicle_photo LIKE :vehicle_photo
            OR password LIKE :password
            ORDER BY id desc';
            $all_rows = $this->model->query_bind($sql, $params, 'object');
        } else {
            $data['headline'] = 'Manage Transporter_registrations';
            $all_rows = $this->model->get('id desc');
        }

        $pagination_data['total_rows'] = count($all_rows);
        $pagination_data['page_num_segment'] = 3;
        $pagination_data['limit'] = $this->get_limit();
        $pagination_data['pagination_root'] = 'transporter_registrations/manage';
        $pagination_data['record_name_plural'] = 'transporter_registrations';
        $pagination_data['include_showing_statement'] = true;
        $data['pagination_data'] = $pagination_data;

        $data['rows'] = $this->reduce_rows($all_rows);
        $data['selected_per_page'] = $this->get_selected_per_page();
        $data['per_page_options'] = $this->per_page_options;
        $data['view_module'] = 'transporter_registrations';
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
            redirect('transporter_registrations/manage');
        }

        $data = $this->get_data_from_db($update_id);
        $data['token'] = $token;

        if ($data === false) {
            redirect('transporter_registrations/manage');
        } else {
            $data['update_id'] = $update_id;
            $data['headline'] = 'Transporter_registration Information';
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

            $this->validation->set_rules('company_name', 'company_name', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('registration_number', 'registration_number', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('phone_number', 'phone_number', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('emal', 'emal', 'min_length[7]|max_length[255]|valid_email');
            $this->validation->set_rules('operating_state', 'operating_state', 'required|min_length[2]');
            $this->validation->set_rules('no_of_vehicle_in_fleet', 'no_of_vehicle_in_fleet', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('cac_certificate', 'cac_certificate', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('trans_licence', 'trans_licence', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('insur_certificate', 'insur_certificate', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('tax_id', 'tax_id', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('vehicle_reg', 'vehicle_reg', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('vehicle_type', 'vehicle_type', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('carrying_cap', 'carrying_cap', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('vehicle_photo', 'vehicle_photo', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('password', 'password', 'required|min_length[2]|max_length[255]');

            $result = $this->validation->run();

            if ($result === true) {

                $update_id = (int) segment(3);
                $data = $this->get_data_from_post();
                
                if ($update_id>0) {
                    //update an existing record
                    $this->model->update($update_id, $data, 'transporter_registrations');
                    $flash_msg = 'The record was successfully updated';
                } else {
                    //insert the new record
                    $update_id = $this->model->insert($data, 'transporter_registrations');
                    $flash_msg = 'The record was successfully created';
                }

                set_flashdata($flash_msg);
                redirect('transporter_registrations/show/'.$update_id);

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
            $params['module'] = 'transporter_registrations';
            $this->model->query_bind($sql, $params);

            //delete the record
            $this->model->delete($params['update_id'], 'transporter_registrations');

            //set the flashdata
            $flash_msg = 'The record was successfully deleted';
            set_flashdata($flash_msg);

            //redirect to the manage page
            redirect('transporter_registrations/manage');
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
        redirect('transporter_registrations/manage');
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
        $record_obj = $this->model->get_where($update_id, 'transporter_registrations');

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
    private function get_data_from_post(): array {
        $data['company_name'] = post('company_name', true);
        $data['registration_number'] = post('registration_number', true);
        $data['phone_number'] = post('phone_number', true);
        $data['emal'] = post('emal', true);
        $data['operating_state'] = post('operating_state', true);
        $data['no_of_vehicle_in_fleet'] = post('no_of_vehicle_in_fleet', true);
        $data['cac_certificate'] = post('cac_certificate', true);
        $data['trans_licence'] = post('trans_licence', true);
        $data['insur_certificate'] = post('insur_certificate', true);
        $data['tax_id'] = post('tax_id', true);
        $data['vehicle_reg'] = post('vehicle_reg', true);
        $data['vehicle_type'] = post('vehicle_type', true);
        $data['carrying_cap'] = post('carrying_cap', true);
        $data['vehicle_photo'] = post('vehicle_photo', true);
        $data['password'] = post('password', true);        
        return $data;
    }


    function register_transporter(): void{
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed('member area');
        $_SESSION['last_page'] = 'tranporter_registrations/register_transporter';
    
        $data = [
            'user_data' => $this->_get_user_data($this->trongate_security->_make_sure_allowed('member area')),
            'title' => 'Register Livestock Transporter',
            'view_file' => '_register_new_transporter_about_form',
            'view_module' => 'transporter_registrations'
        ];
        $this->template('admin', $data);
    }


    function transporter_document(): void{
        if(isset($_SESSION['transporter_id']) && !empty($_SESSION['transporter_id'])){
            $this->module('trongate_security');
            $this->trongate_security->_make_sure_allowed('member area');
            $_SESSION['last_page'] = 'tranporter_registrations/transporter_document';
        
            $data = [
                'user_data' => $this->_get_user_data($this->trongate_security->_make_sure_allowed('member area')),
                'title' => 'Register Livestock Transporter',
                'view_file' => '_register_new_transporter_document_form',
                'view_module' => 'transporter_registrations'
            ];
            $this->template('admin_nldpi', $data);
        }else{
            redirect('transporter_registrations/register_transporter');
        }

    }


    function transporter_vehicle_registration(): void{
        if(isset($_SESSION['transporter_upload_id']) && !empty($_SESSION['transporter_upload_id'])){
            $this->module('trongate_security');
            $this->trongate_security->_make_sure_allowed('member area');
            $_SESSION['last_page'] = 'tranporter_registrations/transporter_vehicle_registration';
        
            $data = [
                'user_data' => $this->_get_user_data($this->trongate_security->_make_sure_allowed('member area')),
                'title' => 'Register Livestock Transporter',
                'view_file' => '_register_new_transporter_vehicle_registration_form',
                'view_module' => 'transporter_registrations'
            ];
            $this->template('admin_nldpi', $data);
        }else{
            redirect('transporter_registrations/transporter_document');
        }
    }

    function create_password(): void{
        if(isset($_SESSION['transporter_vehicle_id']) && !empty($_SESSION['transporter_vehicle_id'])){
            $this->module('trongate_security');
            $this->trongate_security->_make_sure_allowed('member area');
            $_SESSION['last_page'] = 'tranporter_registrations/create_password';
        
            $data = [
                'user_data' => $this->_get_user_data($this->trongate_security->_make_sure_allowed('member area')),
                'title' => 'Register Livestock Transporter',
                'view_file' => '_register_new_transporter_create_password_form',
                'view_module' => 'transporter_registrations'
            ];
            $this->template('admin_nldpi', $data);
        }else{
            redirect('transporter_registrations/transporter_vehicle_registration');
        }
    }

    function add_transporter_registration(){
        
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed('member area');
        $submit = post('submit', true);

        if ($submit === 'Submit') {

           $this->validation->set_rules('company_name', 'company name', 'required');
            $this->validation->set_rules('registration_number', 'registration number', 'required');
            $this->validation->set_rules('phone_number', 'phone number', 'required');
            $this->validation->set_rules('email', 'email address', 'required');
            $this->validation->set_rules('operating_state', 'operating state', 'required');
            $this->validation->set_rules('no_of_vehicle_in_fleet', 'number of vehicle in fleet', 'required');
            $result = $this->validation->run();

            if ($result === true) {
                       
                    //insert the new record
                    $data = $this->_get_data_from_transporter_about();
                    $res = $this->model->get_one_where('company_name',$data['company_name'],'transporter_registrations');
                    if($res == false){
                        $this->model->insert($data, 'transporter_registrations');

                        $sql= "SELECT LAST_INSERT_ID() as id from transporter_registrations";
                        $transporter_registration = $this->model->query($sql, 'object');
                        $_SESSION['transporter_id'] = $transporter_registration[0]->id;

                        $_SESSION['success'] = 'You have successfully register a new transporter';
                        
                    }else{
                        $_SESSION['failure'] = 'There is another transporter having with this information in our record';
                    } 
                    redirect('transporter_registrations/transporter_document');
                
            }else{
                redirect('transporter_registrations/register_transporter');
            }
        } else {
            //form submission error
            redirect('transporter_registrations/register_transporter');
        }



    }


    function upload_transporter_document_registration(){
      
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed('member area');
        $submit = post('submit', true);

        if ($submit === 'Submit' && isset($_SESSION['transporter_id']) && !empty($_SESSION['transporter_id'])) {
            /*$file_type = mime_content_type($_FILES['cac_certficate']['temp_name']);*/

            $validation_str = 'allowed_types['.implode(',', $this->acceptable_file_types ).']';
            $validation_str .= '|max_size[2000]';
           
            $this->validation->set_rules('cac_certificat', 'cac certificat',$validation_str);
            $this->validation->set_rules('trans_certificate', 'transport certificate', $validation_str);
            $this->validation->set_rules('insur_certificate', 'insurance certificate', $validation_str);
            $this->validation->set_rules('tax_id', 'tax certificate', $validation_str);

            $result = $this->validation->run();
            if ($result === true) {
                       
                $data = $this->_get_data_from_transporter_document();
                /*$data['destination'] = 'transporter_document/upload/'.$data['id'];
                $data['upload_to_module'] = false;
                $uploaded_data = $this->upload_file($data);*/
                    //insert the new record
                   /* 
                    $res = $this->model->get_one_where('id',$data['id'],'transporter_registrations');
                    if($res == true){
                        $file_cac_name = basename($data["cac_certificate"]);
                        $temp_cac = explode(".", $data["cac_certificate"]);
                        $file_cac_name = round(microtime(true)).'.'.end($temp_cac);

                        $file_trans_name = basename($data["trans_certificate"]);
                        $temp_trans = explode(".", $data["trans_certificate"]);
                        $file_trans_name = round(microtime(true)).'.'.end($temp_trans);


                        $file_insur_name = basename($data["insur_certificate"]);
                        $temp_insur = explode(".", $data["insur_certificate"]);
                        $file_insur_name = round(microtime(true)).'.'.end($temp_insur);


                        $file_tax_name = basename($data["tax_id"]);
                        $temp_tax = explode(".",$data["tax_id"]);
                        $file_tax_name = round(microtime(true)).'.'.end($temp_tax);*/

                        $data_update['cac_certificate'] =  $file_cac_name;
                        $data_update['trans_licence'] =  $file_trans_name;
                        $data_update['insur_certificate'] =  $file_insur_name;
                        $data_update['tax_id'] =  $file_tax_name;
                        $transporter_id = $data['id'];

                        /*$update_sql = "UPDATE transporter_registrations SET cac_certificate = : cac_certificate,
                        trans_certificate = :trans_certificate, insur_certificate = :insur_certificate,
                        tax_id = :tax_id WHERE id =:id";*/
                       $transporter_upload = $this->model->update($transporter_id,  $data_update, 'transporter_registrations');
                        //$transporter_upload = $this->model->query_bind($update_sql,$data_update);

                        if($transporter_upload == true){

                            $uploadDir = "transporter_document/".$data['id'];
                            /*$file_cac_name = basename($data["cac_certificate"]);
                            $temp_cac = explode(".",  $data["cac_certificate"]);
                            $file_cac_name = round(microtime(true)).'.'.end($temp_cac);
                            $targetFilePath_cac = $uploadDir . $file_cac_name;
                            $fileType_cac = end($temp_cac);
                            //pathinfo($targetFilePath_cac, PATHINFO_EXTENSION);

                            $file_trans_name = basename($data['trans_certificate']);
                            $temp_trans = explode(".",  $data['trans_certificate']);
                            $file_trans_name = round(microtime(true)).'.'.end($temp_trans);
                            $targetFilePath_trans = $uploadDir . $file_trans_name;
                            $fileType_trans = end($temp_trans) ;
                        
                            
                            $file_insur_name = basename($data['insur_certificate']);
                            $temp_insur = explode(".", $data['insur_certificate']);
                            $file_insur_name = round(microtime(true)).'.'.end($temp_insur);
                            $targetFilePath_insur = $uploadDir . $file_insur_name;
                            $fileType_insur = end($temp_insur) ;


                            $file_tax_name = basename($data['tax_id']);
                            $temp_tax = explode(".", $data['tax_id']);
                            $file_tax_name = round(microtime(true)).'.'.end($temp_tax);
                            $targetFilePath_tax = $uploadDir . $file_tax_name;
                            $fileType_tax = end($temp_tax) ;


                            $data['cac_certificate'] = post('cac_certificate', true);
                            $data['trans_certificate'] = post('trans_certificate', true);
                            $data['insur_certificate'] = post('insur_certificate', true);
                            $data['tax_id'] = post('tax_id', true);

                            
                            $maxFileSize = 10 * 1024 * 1024;
                            $allowedTypes = array('jpg', 'jpeg', 'png','pdf');
                            if (!in_array($fileType_cac, $allowedTypes) && 
                                !in_array($fileType_trans, $allowedTypes) && 
                                !in_array($fileType_insur, $allowedTypes) && 
                                !in_array($fileType_tax, $allowedTypes)) {
                                $_SESSION["upload_error"] = "Sorry, only JPG, JPEG, PNG, PDF files are allowed to upload.";
                                redirect('transporter_registrations/transporter_document');
                            } else {*/

                               

                               /* if(isset($data['id']) && !empty($data['id'])){
                                    $cac_cert = $transporter_result->cac_certificate;
                                    $trans_cert = $transporter_result->trans_certificate;
                                    $insur_cert = $transporter_result->insur_certificate;
                                    $tax_id= $transporter_result->tax_id;
                                    $data_document['file_cac'] = $cac_cert;
                                    $data_document['file_trans'] = $trans_cert;
                                    $data_document['file_insur'] = $insur_cert;
                                    $data_document['file_tax'] = $tax_id;
                                    unlink( $uploadDir.$data_document);

                                    $config["destination"] = $targetFilePath_cac;
                                    $config["destination"] = $targetFilePath_trans;
                                    $config["destination"] = $targetFilePath_insur;
                                    $config["destination"] = $targetFilePath_tax;
                                    $config["make_rand_name"] =true;

                                    $_SESSION["successMessage"]= "Document successfully updated.";
                                    redirect('transporter_registrations/transporter_vehicle_registration');
                                }else{*/
                                    
                                    /*$config["destination"] = $uploadDir;
                                    $config["make_rand_name"] =true;
                            
                                        $file_info = $this->upload_file($config);*/
                                    $_SESSION['transporter_upload_id'] = $_SESSION['transporter_id'];
            
                                    $_SESSION['success'] = 'You have successfully uploaded transporter document';
                                    unset($_SESSION['transporter_id']);
                        
                                    redirect('transporter_registrations/transporter_vehicle_registration');
                                    
                               /* } 
                            }*/

                        }else{
                            $_SESSION['failure'] = 'Kindly contact the administrator, fail to upload document';
                        } 
                        
                   /* }else{
                        $_SESSION['failure'] = 'Kindly contact the administrator, fail to upload document';
                    } */

                    redirect('transporter_registrations/transporter_document');
                
            }else{
                redirect('transporter_registrations/transporter_document');
            }
        } else {
            //form submission error
            redirect('transporter_registrations/transporter_document');
                
        }

    }


    function add_transporter_vehicle_registration(){
        
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed('member area');
        $submit = post('submit', true);

        if ($submit === 'Submit' && isset($_SESSION['transporter_upload_id']) && !empty($_SESSION['transporter_upload_id'])) {

           /* $this->validation_helper->set_rules('name', 'name', 'required');
            $this->validation_helper->set_rules('type_of_animal', 'type of animal', 'required');
            extract($picture_settings);
            $validation_str = 'allowed_types[gif,jpg,jpeg,png]|max_size['.$max_file_size.']|max_width['.$max_width.']|max_height['.$max_height.']';
            $this->validation_helper->set_rules('picture', 'item picture', $validation_str);

            $result = $this->validation_helper->run();
           
            if (!$this->validation_helper->run()) {*/
                       
                    //insert the new record
                    $data = $this->_get_data_from_transporter_vehicle_registration();
                    $res = $this->model->get_one_where('id',$data['id'],'transporter_registrations');
                    if($res == true){
                        $transporter_id = $data['id'];
                        $transporter_vehicle_registration =  $this->model->update($transporter_id,  $data, 'transporter_registrations');
                        if($transporter_vehicle_registration == true){

                            $_SESSION['transporter_vehicle_id'] = $_SESSION['transporter_upload_id'];
                
                            $_SESSION['success'] = 'You have successfully uploaded transporter document';
                            unset($_SESSION['transporter_upload_id']);
                            $_SESSION["successMessage"]= "Document successfully updated.";
                            redirect('transporter_registrations/create_password');

                        }else{
                            $_SESSION['failure'] = 'Kindly contact the administrator, fail to upload document';
                        } 
                    }else{
                        $_SESSION['failure'] = 'Oops transporter vehicle registration failed';
                    } 
                    redirect('transporter_registrations/transporter_vehicle_registration');
                
           /* }else{
                $this->transporter_vehicle_registration();
            }*/
        } else {
            //form submission error
            $this->transporter_vehicle_registration();
        }



    }



    function add_password(){
        
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed('member area');
        $submit = post('submit', true);

        if ($submit === 'Submit') {

           /* $this->validation_helper->set_rules('password', 'name', 'required');
            $this->validation_helper->set_rules('confirm_password', 'confirm password', 'required|matches[password]');
           
            if (!$this->validation_helper->run()) {*/
                       
                    //insert the new record
                    $data = $this->_get_data_from_transporter_password();
                    $res = $this->model->get_one_where('id',$data['id'],'transporter_registrations');
                    if($res == true){
                        $trongateUserData = [
                            'code' => make_rand_str(32),
                            'user_level_id' =>  2
                        ];
                        $trongateUserId = $this->model->insert($trongateUserData, 'trongate_users');
                        $data['trongate_user_id'] = $trongateUserId;

                        //$transporter_id = $data['id'];

                       /* $sql= "SELECT * FROM transporter_registrations  WHERE status IS NULL AND id ='$transporter_id'";
                        $transporter_registration = $this->model->query($sql, 'object');*/
                        /*$data['email'] = $transporter_registration[0]->email;
                        $data['user_type'] = 'member';*/
                        $user_id = $this->model->insert($data, 'account');
                        $data_update['user_id'] = $user_id;
                        $data_update['password'] = $data['password'];
                        $transporter_password =  $this->model->update($transporter_id,  $data_update, 'transporter_registrations');

                        unset($_SESSION['transporter_vehicle_id']);

                        $_SESSION['success'] = 'You have successfully register a new transporter';
                        
                    }else{
                        $_SESSION['failure'] = 'There is another transporter having this information in our record';
                    } 
                    redirect('transporter_registrations/create_password');
                
           /* }else{
                $this->transporter_document();
            }*/
        } else {
            //form submission error
            $this->register_transporter();
        }



    }



    function _get_data_from_transporter_about(): array {
        $data['company_name'] = post('company_name', true);
        $data['registration_number'] = post('registration_number', true);
        $data['phone_number'] = post('phone_number', true);
        $data['email'] = post('email', true);
        $data['operating_state'] = post('operating_state', true); 
        $data['no_of_vehicle_in_fleet'] = post('no_of_vehicle_in_fleet', true);
        return $data;
    }



    function _get_data_from_transporter_document(): array {
        $data['id'] = post('id', true);
        $data['cac_certificate'] = post('cac_certificate', true);
        $data['trans_certificate'] = post('trans_certificate', true);
        $data['insur_certificate'] = post('insur_certificate', true);
        $data['tax_id'] = post('tax_id', true);
        return $data;
    }


    function _get_data_from_transporter_vehicle_registration(): array {
        $data['id'] = post('id', true);
        $data['vehicle_reg'] = post('vehicle_reg', true);
        $data['vehicle_type'] = post('vehicle_type', true);
        $data['carrying_cap'] = post('carrying_cap', true);
        $data['vehicle_photo'] = post('vehicle_photo', true);
        return $data;
    }

    function _get_data_from_transporter_password(): array {
        return [
            'password' => $this->_hash_string(post('password')),
            'id' => post('id', true)
        ];
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


    function _hash_string(string $str): string{
        $hashed_string =password_hash($str, PASSWORD_BCRYPT,array('cost'=> 11));
        return $hashed_string;
    
     }


     function _init_profile_picture_settings() 
     {
         return [
             'max_file_size' => 10000,
             'max_width' => 5000,
             'max_height' => 5000,
             'resized_max_width' => 450,
             'resized_max_height' => 450,
             'destination' => 'profile_pics',
             'target_column_name' => 'picture',
             'thumbnail_dir' => 'profile_pics_thumbnails',
             'thumbnail_max_width' => 120,
             'thumbnail_max_height' => 120,
             'upload_to_module' => false,
             'make_rand_name' => false
         ];
     }
     
    
    /**
     * Upload a file.
     *
     * @param array $data The data for the uploaded file.
     *
     * @return array|null The information of the uploaded file.
     */
    public function upload_file(array $data): ?array {
        return $this->upload($data);
    }


}