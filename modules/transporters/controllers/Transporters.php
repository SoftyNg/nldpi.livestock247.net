<?php
class Transporters extends Trongate {

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
        $data['title'] = 'Register Livestock Transporter';
        $data['location'] = 'transporters/submit_application';
        $data['cancel_url'] = 'digital_registry/index';
        $data['view_file'] = 'register';
        $data['view_module'] = 'transporters';
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
        $res = $this->model->get_one_where('reg_number',$reg_number,'transporters');
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

                    $file_fields = [ 'reg_certificate','transport_certificate','tax_certificate','insurance_certificate'];
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
                $data['nldpi_number'] = NLDPI_NUMBER + $trongate_user_id;
                $data['status'] = 0;
                $data['date_created'] = time();
                $this->model->insert($data, 'transporters');

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
        $data['trade_license_number'] = post('trade_license_number', true);
        $data['no_vehicle_in_fleet'] = post('no_vehicle_in_fleet', true);
        $data['operating_states'] = post('operating_states');
        $data['password'] = post('password', true);        
        return $data;
    }


    function _hash_string(string $str): string{
        $hashed_string =password_hash($str, PASSWORD_BCRYPT,array('cost'=> 11));
        return $hashed_string;
    
    }


}