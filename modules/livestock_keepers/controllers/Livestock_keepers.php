<?php
class Livestock_keepers extends Trongate {


    private $default_limit = 20;
    private $per_page_options = array(10, 20, 50, 100);    
    private $template_admin = 'admin';
    private $template_public = 'public';

    function index(){
        $this->register();
    }

    function register(){  
        $data = $this->get_data_from_post();
        $data['title'] = 'Register Livestock Farmer/Keeper';
        $data['location'] = 'livestock_keepers/submit_application';
        $data['cancel_url'] = 'digital_registry/index';
        $data['view_file'] = 'register';
        $data['view_module'] = 'livestock_keepers';
        $data['state_options'] = $this->state_options();
        $data['type_options'] = $this->type_options();
        $this->template($this->template_public, $data);
    }



    function submit_application(){
        $submit = post('submit', true);
        if ($submit === 'Submit Application') {
           
            $this->validation->set_rules('name', 'Name', 'required|min_length[2]|max_length[200]');
            $this->validation->set_rules('phone_number', 'phone number', 'required|callback_check_phone_number');
            $this->validation->set_rules('email', 'email', 'required|max_length[255]|valid_email|callback_check_email');
            $this->validation->set_rules('password', 'password', 'required|min_length[3]|max_length[255]');
            $this->validation->set_rules('confirm_password', 'confirm password', 'required|callback_check_password');

            $result = $this->validation->run();
            if ($result === true ) { 
                $data = $this->get_data_from_post();
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
                $this->model->insert($data, 'livestock_keepers');

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
        $data['target_name'] = $user_obj->name;
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

        $data['name'] = post('name', true);
        $data['phone_number'] = array_key_exists('phone_number', $_POST) ? $_POST['phone_number'] : '';
        $data['email'] = post('email', true);
        $data['type'] = (int) post('type');
        $data['address'] = post('address', true);
        $data['state'] = (int) post('state');

        $data['password'] = post('password',true);         
        return $data;
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

    function _hash_string(string $str): string{
        $hashed_string =password_hash($str, PASSWORD_BCRYPT,array('cost'=> 11));
        return $hashed_string;
    
    }

    function type_options(): array{
        $types = array(
            1 => 'Rancher',
            2 => 'Farmer'
        );

        $type_options = array('');
        foreach ($types as $key => $value) {
            $type_options[$key] = $value;
        }

        return $type_options;
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







    function dashboard(): void{
        $data['title'] = 'Dashboard';
        $data['view_file'] = 'dashboard';
        $data['view_module'] = 'livestock_keepers';

        $sql= "SELECT * FROM animal_registrations  WHERE status IS NULL";
        $livestock_list = $this->model->query($sql, 'object');
        $data['livestock_list'] = $livestock_list;
        $this->template($this->template_admin, $data);
    }

    function livestock_registry(): void{
        $data['title'] = 'Livestock Registry';
        $data['view_file'] = 'livestock_registry';
        $data['view_module'] = 'livestock_keepers';
        $data['total_registered_breed'] = 0;
        $data['total_registered_local_breed'] = 0;
        $data['total_registered_exotic_breed'] = 0;

        $sql= "SELECT * FROM animal_registrations  WHERE status IS NULL";
        $livestock_list = $this->model->query($sql, 'object');
        $data['livestock_list'] = $livestock_list;
        $this->template($this->template_admin, $data);
        
    }

}