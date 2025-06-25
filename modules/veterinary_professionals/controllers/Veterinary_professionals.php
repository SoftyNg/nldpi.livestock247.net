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


        $data['title'] = 'Register Veterinary Professional';
            $data['location'] = 'veterinary_professionals/submit_application';
            $data['cancel_url'] = BASE_URL.'digital_registry';
            $data['view_file'] = '_register';
            $data['view_module'] = 'veterinary_professionals';
            $data['professional_body_options'] = $this->professional_body_options();
            $this->template($this->template_public , $data);
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
        if ($submit === 'Submit Application') {
        
            $this->validation->set_rules('firstname', 'firstname', 'required|min_length[2]|max_length[200]');
            
            $this->validation->set_rules('lastname', 'lastname', 'required|min_length[2]|max_length[200]');

            $this->validation->set_rules('phone_number', 'phone number', 'required|callback_check_phone_number');

            $this->validation->set_rules('email', 'email', 'required|max_length[255]|callback_check_email');

            $this->validation->set_rules('professional_body', 'professional body', 'required|integer');

            $this->validation->set_rules('reg_number', 'registration number', 'required|min_length[2]|max_length[50]|callback_check_reg_number');

            $this->validation->set_rules('password', 'password', 'required|min_length[3]|max_length[255]');

            $this->validation->set_rules('confirm_password', 'confirm password', 'required|callback_check_password');

            $this->validation->set_rules('reg_certificate', 'registration certificate', 'allowed_types[jpg,png,pdf]|max_size[2048]');

            $result = $this->validation->run();

            if ($result === true ) { 
                
                $data = $this->_get_data_from_veterinary_professional();
                
            
                    $trongateUserData = [

                        'code' => make_rand_str(32),

                        'user_level_id' =>  3

                    ];

                    $trongate_user_id= $this->model->insert($trongateUserData, 'trongate_users');

                    $account_data['email'] = $data['email'];

                    $account_data['password'] = $this->_hash_string($data['password']);

                    $account_data['date_created'] = time();
                    
                    $account_data['status'] = 0;

                    $account_data['user_type'] = 3;

                    $account_data['user_id'] = $trongate_user_id;

        
        
                    $account_id = $this->model->insert($account_data, 'account');

                    unset($data['password']);

                    unset($data['confirm_password']);

                    unset($data['email']);
                    
                    unset($account_data['password']);

                    $data['reg_date'] = date("Y-m-d");

                    $data['account_id'] = $account_id;

                    $reg_certificate = $_FILES['reg_certificate'];

                    $data['reg_certificate'] = $reg_certificate['name'];

                    $data['nldpi_number'] = NLDPI_NUMBER + $trongate_user_id;

                    $data['status'] = 0;

                    $data['date_created'] = time();

                    $vet_professional_id = $this->model->insert($data, 'veterinary_professionals');

                    $document_settings = $this->_init_document_settings();

                    extract($document_settings);

                    $this->_make_sure_got_destination_folders($document_settings);
        
                    // Configure the upload
                    $config['destination'] = $destination; 

                    $config['upload_to_module'] = $upload_to_module;  

                    $config['make_rand_name'] = $make_rand_name;
        
                    try {

                         $this->upload_file($config);

                         $file_name = $result['file_name'];

                         $data['reg_certificate'] = $file_name;

                    } catch (Exception $e) {

                        $error_msg = $e->getMessage();

                        set_flashdata($error_msg);

                      /* $this->register();

                       return;*/

                       redirect('veterinary_professionals/register');
                       
                    }

                    $_SESSION['success'] ='Your credentials are being reviewed. Once verification is complete you will be notified via your provided email';
                    
                    // send registration email

                    $aObj = (object) $account_data;

                    $uObj = (object) $data;

                    $this->send_registration_confirm_email($aObj,$uObj);
           
                    redirect('digital_registry');

                
           }else{
        
            redirect('veterinary_professionals/register');
            
           }
        
        
        } else {

            //form submission error

            redirect('veterinary_professionals/register');
        }
        
        
    }

    
    private function send_registration_confirm_email($account_obj,$user_obj){ 
        $data['subject'] = 'NLDPI Registration';
        $data['target_name'] = $user_obj->firstname . ' ' . $user_obj->lastname;
        $data['target_email'] = $account_obj->email;  
        $data['user_obj'] = $user_obj;
        $data['account_obj'] = $account_obj;
        $data['logo_url'] = 'http://localhost/nldpi/images/nldpi-logo-extra.png';
        $data['msg_html'] = $this->view('msg_registration_email',$data,true);
        $msg_plain = str_replace('</p>', '\\n\\n', $data['msg_html']);
        $data['msg_plain'] = strip_tags($msg_plain);

        $this->module('mail');
        $this->mail->send_mail($data);
    }

    private function send_approval_email($account_obj,$user_obj){ 
        $data['subject'] = 'NLDPI Registration';
        $data['target_name'] = $user_obj->firstname . ' ' . $user_obj->lastname;
        $data['target_email'] = $account_obj->email;  
        $data['user_obj'] = $user_obj;
        $data['account_obj'] = $account_obj;
        $data['logo_url'] = 'http://localhost/nldpi/images/nldpi-logo-extra.png';
        $data['msg_html'] = $this->view('msg_approval_email',$data,true);
        $msg_plain = str_replace('</p>', '\\n\\n', $data['msg_html']);
        $data['msg_plain'] = strip_tags($msg_plain);

        $this->module('mail');
        $this->mail->send_mail($data);
    } 
    

    private function send_rejection_email($account_obj,$user_obj){ 
        $data['subject'] = 'NLDPI Registration';
        $data['target_name'] = $user_obj->firstname . ' ' . $user_obj->lastname;
        $data['target_email'] = $account_obj->email;  
        $data['user_obj'] = $user_obj;
        $data['account_obj'] = $account_obj;
        $data['logo_url'] = 'http://localhost/nldpi/images/nldpi-logo-extra.png';
        $data['msg_html'] = $this->view('msg_rejection_email',$data,true);
        $msg_plain = str_replace('</p>', '\\n\\n', $data['msg_html']);
        $data['msg_plain'] = strip_tags($msg_plain);

        $this->module('mail');
        $this->mail->send_mail($data);
    }      




    function dashboard(): void{

        $this->module('trongate_security');

        $this->module('breed_registrations');

       

        if (post('submit', true) == "Lookup") {
            
            $search = post('search_livestock', true);

            $sql = "SELECT * FROM animal_registrations  WHERE animal_id ='$search'";

            $found_livestock = $this->model->query($sql, 'object');

            if ($found_livestock) {

                $data['user_data'] = $this->_get_user_data($this->trongate_security->_make_sure_allowed('veterinary professional'));
               
                $user = $this->_get_user_data($this->trongate_security->_make_sure_allowed('veterinary professional'));

                $vet_professional_id = $user[0]->vet_professional_id;
                
                $data['sex_options'] =  $this->breed_registrations->sex_options();
                
                $data['breed_options'] =  $this->breed_registrations->breed_options();
                
                $data['livestock_type_options'] =  $this->breed_registrations->livestock_type_options();
                
                $data['weight_options'] =  $this->breed_registrations->weight_options();
                
                $data['reg_point_options'] =  $this->breed_registrations->reg_point_options(); 

                $data['age_range_options'] =  $this->breed_registrations->age_range_options();

                $data['livestock_purpose_options'] =  $this->breed_registrations->livestock_purpose_options();

                $data['vaccination_type_options'] =  $this->vaccination_type_options();

                $data['deworming_type_options'] =  $this->deworming_type_options();

                $data['process_type_options'] =  $this->process_type_options();

                $livestock_owner = $this->model->get_where($found_livestock[0]->owner_id,'livestock_keepers');

                $data['livestock_owner'] = $livestock_owner;
 

                $data['livestock_owner_details'] = $this->model->get_where($livestock_owner->account_id,'account');

              
                $data['found_livestock'] =  $found_livestock[0];

                $_SESSION['found_livestock'] =  $found_livestock[0];

                $animal_reg_id = $found_livestock[0]->id;

                $data['found'] = 'success';

                $data['title'] = 'Dashboard';

                $data['view_file'] = 'dashboard';

                $sql= "SELECT COUNT(*) as count FROM vaccinations  WHERE reg_by='$vet_professional_id' AND animal_reg_id='$animal_reg_id'";

                $vaccination_result  = $this->model->query($sql, 'object');

                $vaccination_count  = $vaccination_result[0]->count ;


                $sql= "SELECT COUNT(*) as count FROM deworms  WHERE reg_by='$vet_professional_id' AND animal_reg_id='$animal_reg_id'";

                $deworming_result  = $this->model->query($sql, 'object');

                $deworming_count  = $deworming_result[0]->count;


                
                $sql= "SELECT COUNT(*) as count FROM diagnosis  WHERE  reg_by='$vet_professional_id' AND animal_reg_id='$animal_reg_id'";

                $diagnosis_result  = $this->model->query($sql, 'object');

                $diagnosis_count  = $diagnosis_result[0]->count;


                $sql= "SELECT COUNT(*) as count FROM treatments  WHERE  reg_by='$vet_professional_id' AND animal_reg_id='$animal_reg_id'";

                $medication_result  = $this->model->query($sql, 'object');

                $medication_count  = $medication_result[0]->count;


                $sql= "SELECT * FROM vaccinations  WHERE reg_by='$vet_professional_id' AND animal_reg_id='$animal_reg_id' ORDER BY id DESC";

                $vaccination_records = $this->model->query($sql, 'object');


                $data['vaccination_count'] = $vaccination_count;

                $data['deworming_count'] = $deworming_count;

                $data['diagnosis_count'] = $diagnosis_count;

                
                $data['medication_count'] = $medication_count;

                $data['vaccination_records'] = $vaccination_records;

                $this->template($this->template_admin, $data);

            }else{

                $token = $this->trongate_security->_make_sure_allowed('veterinary professional');

                $user = $this->_get_user_data($this->trongate_security->_make_sure_allowed('veterinary professional'));
    
                $account_id = $user[0]->id;
            
                $data['user_data'] = $this->_get_user_data($this->trongate_security->_make_sure_allowed('veterinary professional'));
    
                $data['name'] = ucwords($user[0]->firstname);
    
                $data['nldpi_number'] = $user[0]->nldpi_number;
    
                $data['reg_number'] = $user[0]->reg_number;
    
                $vet_professional_id = $user[0]->vet_professional_id;
    
                $data['message'] = 'No livestock record found ';

                $data['title'] = 'Dashboard';
    
                $data['view_file'] = 'dashboard';
    
                $data['breed_options'] =  $this->breed_registrations->breed_options();
    
                $data['livestock_type_options'] =  $this->breed_registrations->livestock_type_options();
    
                $data['view_module'] = 'veterinary_professionals';
    
                $total_registered_livestock  = $this->model->count_where('reg_by', $vet_professional_id , '=', 'animal_registrations');
    
                $total_livestock_treated = $this->model->count_where('reg_by', $vet_professional_id, '=', 'treatments');

    
                $sql= "SELECT * FROM livestock_activities  ORDER BY id DESC";

                $livestock_list = $this->model->query($sql, 'object');

                $data['total_registered_livestock'] = $total_registered_livestock;

                $data['total_livestock_treated'] = $total_livestock_treated;

                $data['livestock_list'] = $livestock_list;

                $this->template($this->template_admin, $data);
            }
        }else{

            $token = $this->trongate_security->_make_sure_allowed('veterinary professional');

            $user = $this->_get_user_data($this->trongate_security->_make_sure_allowed('veterinary professional'));

            $account_id = $user[0]->id;
        
            $data['user_data'] = $this->_get_user_data($this->trongate_security->_make_sure_allowed('veterinary professional'));

            $data['name'] = ucwords($user[0]->firstname);

            $data['nldpi_number'] = $user[0]->nldpi_number;

            $data['reg_number'] = $user[0]->reg_number;

            $vet_professional_id = $user[0]->vet_professional_id;



            $data['title'] = 'Dashboard';

            $data['view_file'] = 'dashboard';

            $data['breed_options'] =  $this->breed_registrations->breed_options();

            $data['livestock_type_options'] =  $this->breed_registrations->livestock_type_options();

            $data['view_module'] = 'veterinary_professionals';


            $total_registered_livestock  = $this->model->count_where('reg_by', $vet_professional_id , '=', 'animal_registrations');

            $total_livestock_treated = $this->model->count_where('reg_by', $vet_professional_id, '=', 'treatments');

    
            $sql= "SELECT * FROM livestock_activities ORDER BY id DESC";

            $livestock_list = $this->model->query($sql, 'object');


            $data['total_registered_livestock'] = $total_registered_livestock;

            $data['total_livestock_treated'] = $total_livestock_treated;

            $data['livestock_list'] = $livestock_list;

            $this->template($this->template_admin, $data);
        }
    }



    
    function vaccination_type_options(): array{
        return [
            '' => 'Select Vaccination Type',
            1 => 'Foot and Mouth Disease (FMD) Vaccine',
            2 => 'Anthrax Spore Vaccine',
            3 => 'Haemorrhagic Septicaemia (HS) Vaccine',
        ];
    }

    function deworming_type_options(): array{
        return [
            '' => 'Select Deworming Type',
            1 => 'Ivermentin',
            2 => 'Benzimidazoles',
            3 => 'macrocyclic',
            4 => 'Lactones',
            5 => 'Imidazothiazoles',
        ];
    }


    function disease_type_options(): array{
        return [
            '' => 'Select Illness Type',
            1 => 'Anthrax',
            2 => 'Brucellosis',
            3 => 'Leptospirosis',
            4 => 'Foot and Mouth Disease (FMD)',
            5 => 'Bluetongue',
            6 => 'Avian Influenza',
            7 => 'Q Fever',
            8 => 'Lumps Skin Disease ()',
        ];
    }

    


    function process_type_options(): array{
        return [
            '' => 'Select Process Stage',
            1 => 'In-progress',
            2 => 'Completed',
        ];
    }


    function submit_vaccination_record(): void{
        

        $this->module('trongate_security');
        $token = $this->trongate_security->_make_sure_allowed('veterinary professional');
        $submit = post('submit', true);
       
        if ($submit === 'Record') {

       
            $data = $this->_get_data_for_vaccination();

            $data['date_created'] = time();
            
            //insert the new record

            $this->model->insert($data, 'vaccinations');


            $data_livestock_activity['animal_reg_id'] = $data['animal_reg_id'];

            $vaccination_options = $this->vaccination_type_options();

            $process_options = $this->process_type_options();

            $data_livestock_activity['service'] = $vaccination_options[$data['vaccine']];

            $data_livestock_activity['status'] = $process_options[$data['status']];

            $data_livestock_activity['date_created'] = time();

            $this->model->insert($data_livestock_activity, 'livestock_activities');


            $_SESSION['success'] = 'You have successfully recorded vaccination '.strtolower($vaccination_options[$data['vaccine']]). ' process '.strtolower($process_options[$data['status']]).' for the livestock';
        
           
            redirect('veterinary_professionals/dashboard');

        } else {
            //form submission error
             redirect('veterinary_professionals/dashboard');
        }

    }


    function submit_deworming_record(): void{
        
        $this->module('trongate_security');
        $token = $this->trongate_security->_make_sure_allowed('veterinary professional');
        $submit = post('submit', true);
       
        if ($submit === 'Record') {

       
            $data = $this->_get_data_for_deworming();

            $data['date_created'] = time();
            
            //insert the new record

            $this->model->insert($data, 'deworms');


            $data_livestock_activity['animal_reg_id'] = $data['animal_reg_id'];

            $deworming_options = $this->deworming_type_options();

            $process_options = $this->process_type_options();

            $data_livestock_activity['service'] = $deworming_options[$data['deworming_type']];

            $data_livestock_activity['status'] = $process_options[$data['status']];

            $data_livestock_activity['date_created'] = time();

            $this->model->insert($data_livestock_activity, 'livestock_activities');

            $_SESSION['success'] = 'You have successfully recorded deworming '.strtolower($deworming_options[$data['deworming_type']]). ' process '.strtolower($process_options[$data['status']]).' for the livestock';
        
           
            redirect('veterinary_professionals/dashboard');

        } else {
            //form submission error
             redirect('veterinary_professionals/dashboard');
        }

    }



    
    function submit_medical_diagnosis_record(): void{
        
        $this->module('trongate_security');
        $token = $this->trongate_security->_make_sure_allowed('veterinary professional');
        $submit = post('submit', true);
       
        if ($submit === 'Record') {

       
            $data = $this->_get_data_for_medical_diagnosis();


            $data['date_created'] = time();
            $data['status'] = 2;
            
            //insert the new record

            $this->model->insert($data, 'diagnosis');


            $data_livestock_activity['animal_reg_id'] = $data['animal_reg_id'];

            $disease_options = $this->disease_type_options();

            $process_options = $this->process_type_options();

            $data_livestock_activity['service'] = $disease_options[$data['disease_type']];

            $data_livestock_activity['status'] = $process_options[$data['status']];

            $data_livestock_activity['date_created'] = time();

            $this->model->insert($data_livestock_activity, 'livestock_activities');

            $_SESSION['success'] = 'You have successfully recorded mediacal diagnosis '.strtolower($disease_options[$data['disease_type']]). ' process '.strtolower($process_options[$data['status']]).' for the livestock';
        
           
            redirect('veterinary_professionals/dashboard');

        } else {
            //form submission error
             redirect('veterinary_professionals/dashboard');
        }

    }



    function submit_medical_treatment_record(): void{
        
        $this->module('trongate_security');
        $token = $this->trongate_security->_make_sure_allowed('veterinary professional');
        $submit = post('submit', true);
       
        if ($submit === 'Record') {

       
            $data = $this->_get_data_for_medical_treatment();

            $diagnosis  = $this->model->get_where($data['diagnosis_id'], 'diagnosis');

            $disease = $diagnosis->disease_type;

            $data['date_created'] = time();
            
            //insert the new record

            $this->model->insert($data, 'treatments');


            $data_livestock_activity['animal_reg_id'] = $data['animal_reg_id'];

            $disease_options = $this->disease_type_options();

            $process_options = $this->process_type_options();

            $data_livestock_activity['service'] = $disease_options[$disease].' treatment';

            $data_livestock_activity['status'] = $process_options[$data['status']];

            $data_livestock_activity['date_created'] = time();

            $this->model->insert($data_livestock_activity, 'livestock_activities');

            $_SESSION['success'] = 'You have successfully recorded medical treatment '.strtolower($disease_options[$disease]). ' process '.strtolower($process_options[$data['status']]).' for the livestock';
        
           
            redirect('veterinary_professionals/dashboard');

        } else {
            //form submission error
             redirect('veterinary_professionals/dashboard');
        }

    }



    function get_animal_registration_details($animal_reg_id){  

        $sql= "SELECT * FROM animal_registrations WHERE id='$animal_reg_id'";

        $livestock = $this->model->query($sql, 'object');

        $breed_options=  $this->breed_registrations->breed_options();
        $livestock_type_options=  $this->breed_registrations->livestock_type_options();
        
        $data['animal_id'] = $livestock[0]->animal_id ;

        $data['type'] = $livestock_type_options[$livestock[0]->livestock_type].' ('.$breed_options[$livestock[0]->breed_id].')';

        return $data;
    }


    function _get_data_for_vaccination(): array {
        $data['animal_reg_id'] = post('id', true);
        $data['reg_by'] = post('reg_by', true);
        $data['vaccine'] = post('vaccination_type', true);
        $data['date_administered'] = post('date_administered', true);
        $data['next_due_date'] = post('next_due_date', true);
        $data['status'] = post('process_stage', true);
        return $data;
    }

    function _get_data_for_deworming(): array {
        $data['animal_reg_id'] = post('id', true);
        $data['reg_by'] = post('reg_by', true);
        $data['deworming_type'] = post('deworming_type', true);
        $data['date_administered'] = post('date_administered', true);
        $data['next_due_date'] = post('next_due_date', true);
        $data['status'] = post('process_stage', true);
        return $data;
    }


    function _get_data_for_medical_diagnosis(): array {
        $data['animal_reg_id'] = post('id', true);
        $data['reg_by'] = post('reg_by', true);
        $data['disease_type'] = post('disease_type', true);
        $data['diagnosis_date'] = post('diagnosis_date', true);
        $data['note'] = post('diagnosis_note', true);
        return $data;
    }



    
    function _get_data_for_medical_treatment(): array {
        $data['animal_reg_id'] = post('id', true);
        $data['reg_by'] = post('reg_by', true);
        $data['diagnosis_id'] = post('diagnosis_id', true);
        $data['date_administered'] = post('date_administered', true);
        $data['next_due_date'] = post('next_due_date', true);
        $data['note'] = post('treatment_note', true);
        $data['status'] = post('process_stage', true);
        return $data;
    }




    function vaccination(): void{

		$this->module('trongate_security');

        $user = $this->_get_user_data($this->trongate_security->_make_sure_allowed('veterinary professional'));

        $vet_professional_id = $user[0]->vet_professional_id;

        $data['vaccination_type_options'] =  $this->vaccination_type_options();

        $data['process_type_options'] =  $this->process_type_options();

        $data['found_livestock'] = $_SESSION['found_livestock'];

        $found_livestock = $_SESSION['found_livestock'];

        $animal_reg_id = $found_livestock->id;
        

        $sql= "SELECT * FROM vaccinations  WHERE reg_by='$vet_professional_id' AND animal_reg_id='$animal_reg_id' ORDER BY id DESC";

        $vaccination_records = $this->model->query($sql, 'object');

        $data['vaccination_records'] = $vaccination_records;

		$this->view('_view_vaccination', $data);

	}


    function get_disease_type($diagnosis_id){  

        $sql= "SELECT disease_type FROM diagnosis WHERE id='$diagnosis_id'";

        $diagnosis= $this->model->query($sql, 'object');
        
        $disease = $diagnosis[0]->disease_type;

        return $disease;
    }




    function get_user_veterinary_professionals($vet_professional_id){  

        $sql= "SELECT * FROM veterinary_professionals WHERE id='$vet_professional_id'";

        $vet_professional = $this->model->query($sql, 'object');

        $data['provider'] = 'DR. '.strtoupper(substr($vet_professional[0]->lastname,0,1)).'. '.ucwords($vet_professional[0]->firstname) ;

        return $data;
    }

	function deworming_schedule(): void {

        $this->module('trongate_security');

	    $user = $this->_get_user_data($this->trongate_security->_make_sure_allowed('veterinary professional'));

        $vet_professional_id = $user[0]->vet_professional_id;

        $data['deworming_type_options'] =  $this->deworming_type_options();

        $data['process_type_options'] =  $this->process_type_options();

        $data['found_livestock'] = $_SESSION['found_livestock'];

        $found_livestock = $_SESSION['found_livestock'];

        $animal_reg_id = $found_livestock->id;

        $sql= "SELECT * FROM deworms  WHERE  reg_by='$vet_professional_id' AND animal_reg_id='$animal_reg_id' ORDER BY id DESC";

        $deworming_schedule_records = $this->model->query($sql, 'object');

        $data['deworming_schedule_records'] = $deworming_schedule_records;

		$this->view('_view_deworming_schedule', $data);

	}

	function medical_diagnosis(): void {

        $this->module('trongate_security');

        $this->module('breed_registrations');

	    $user = $this->_get_user_data($this->trongate_security->_make_sure_allowed('veterinary professional'));

        $vet_professional_id = $user[0]->vet_professional_id;

        $data['disease_type_options'] =  $this->disease_type_options();

        $data['process_type_options'] =  $this->process_type_options();

        
        $data['found_livestock'] = $_SESSION['found_livestock'];

        $found_livestock = $_SESSION['found_livestock'];

        $animal_reg_id = $found_livestock->id;


        $sql= "SELECT * FROM diagnosis  WHERE reg_by='$vet_professional_id' AND animal_reg_id='$animal_reg_id' ORDER BY id DESC";

        $medical_history_records = $this->model->query($sql, 'object');

        $data['medical_history_records'] = $medical_history_records ;
        
		$this->view('_view_medical_diagnosis', $data);
	}


	function medications(): void {

        $this->module('trongate_security');

        $this->module('breed_registrations');

	    $user = $this->_get_user_data($this->trongate_security->_make_sure_allowed('veterinary professional'));

        $vet_professional_id = $user[0]->vet_professional_id;

        $data['disease_type_options'] =  $this->disease_type_options();

        $data['process_type_options'] =  $this->process_type_options();

        $data['found_livestock'] = $_SESSION['found_livestock'];

        $found_livestock = $_SESSION['found_livestock'];

        $animal_reg_id = $found_livestock->id;

        $sql= "SELECT * FROM treatments  WHERE reg_by='$vet_professional_id' AND animal_reg_id='$animal_reg_id' ORDER BY id DESC";

        $medical_treatment_records = $this->model->query($sql, 'object');

        $data['found_livestock'] = $_SESSION['found_livestock'];

        $data['medical_treatment_records'] = $medical_treatment_records ;

		$this->view('_view_medications', $data);
	}



    function get_diagnosed_diseases($animal_reg_id){

        $sql= "SELECT id, disease_type FROM diagnosis WHERE animal_reg_id='$animal_reg_id'";

        $results = $this->model->query($sql, 'object');

        return  $results;
        
    }



    function transport_permit(): void{

        $this->module('trongate_security');

        $this->module('breed_registrations');

        $token = $this->trongate_security->_make_sure_allowed('veterinary professional');

        $sql= "SELECT * FROM breed_registrations  WHERE status ='0'";

        $livestock_list = $this->model->query($sql, 'object');

        $data['livestock_list'] = $livestock_list;
    
        $data['user_data'] = $this->_get_user_data($this->trongate_security->_make_sure_allowed('veterinary professional'));

        $data['title'] = 'Transport Permit';

        $data['view_file'] = 'transport_permit';

        $data['breed_options'] =  $this->breed_registrations->breed_options();

        $data['livestock_type_options'] =  $this->breed_registrations->livestock_type_options();

        $data['view_module'] = 'veterinary_professionals';

        $this->template($this->template_admin, $data);
    }

    function livestock_registry(): void{

        $this->module('trongate_security');

        $this->module('breed_registrations');

        $total_registered_livestock  = $this->model->count('animal_registrations');

        $total_registered_cow = $this->model->count_where('livestock_type', 1, '=', 'animal_registrations');

        $total_registered_goat = $this->model->count_where('livestock_type', 2, '=', 'animal_registrations');

        $total_registered_ram = $this->model->count_where('livestock_type', 3, '=', 'animal_registrations');

        
        $sql= "SELECT * FROM animal_registrations  WHERE status='1'";
        $livestock_list = $this->model->query($sql, 'object');
        $data['user_data'] = $this->_get_user_data($this->trongate_security->_make_sure_allowed('veterinary professional'));
        $data['title'] = 'Livestock Registry';
        $data['view_file'] = 'livestock_registry';
        $data['view_module'] = 'veterinary_professionals';
        
        $data['total_registered_livestock'] = $total_registered_livestock;

        $data['total_registered_cow'] = $total_registered_cow;
        $data['total_registered_ram'] = $total_registered_ram;
        $data['total_registered_goat'] = $total_registered_goat;
        $data['sex_options'] =  $this->breed_registrations->sex_options();
        $data['breed_options'] =  $this->breed_registrations->breed_options();
        $data['livestock_type_options'] =  $this->breed_registrations->livestock_type_options();
        $data['weight_options'] =  $this->breed_registrations->weight_options();
        $data['reg_point_options'] =  $this->breed_registrations->reg_point_options();
        $data['age_range_options'] =  $this->breed_registrations->age_range_options();
        $data['livestock_purpose_options'] =  $this->breed_registrations->livestock_purpose_options();
        $data['livestock_list'] = $livestock_list;
        $this->template($this->template_admin, $data);
        
    }    



   /* function listing(): void{
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed('member area');
        $_SESSION['last_page'] = 'veterinary_professionals';
        
        $sql = 'SELECT t.id as id, a.firstname, a.lastname, a.access, a.email, a.picture, a.status, t.date_created, t.reg_number, t.nldpi_number, t.reg_date
        FROM veterinary_professionals t
        INNER JOIN account a ON a.id = t.user_id WHERE a.access="0" AND a.status ="pending"';
        $list_of_registered_vet_professionals = $this->model->query($sql, 'object');

        $sql = 'SELECT COUNT(*)  as vet_professionals_total FROM veterinary_professionals t
        INNER JOIN account a ON a.id = t.user_id WHERE  a.access="0" AND  a.status ="pending"';
        $vet_professionals_total = $this->model->query($sql, 'object');

        $sql= "SELECT id, firstname, lastname, email, access FROM account ORDER BY id DESC";
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
    }*/
    

    
    function approval($vet_professional_id): void{

        $vet_professional = $this->model->get_where($vet_professional_id,'veterinary_professionals');

        if($vet_professional){

            $this->module('trongate_security');
            $token = $this->trongate_security->_make_sure_allowed('admin');
             $vet_account_id = $vet_professional->account_id;
             $vet_account = $this->model->get_where($vet_account_id,'account');


		    $professional_body_options = $this->veterinary_professionals->professional_body_options();

             if($vet_account){
                $data = [
                    'title' => 'Approve Veterinary Professional',
                    'user_data' =>  $this->_get_user_data($this->trongate_security->_make_sure_allowed('admin')),
                    'vet_professional' => $vet_professional,
                    'professional_body_options' => $professional_body_options,
                    'veterinary_status' => $vet_account->access,
                    'view_file' => '_approval_for_veterinary_professional',
                    'view_module' => 'veterinary_professionals'
                ]; 
             }else{
                $data = [
                    'title' => 'Approve Veterinary Professional',
                    'user_data' =>  $this->_get_user_data($this->trongate_security->_make_sure_allowed('admin')),
                    'vet_professional' => $vet_professional,
                    'view_file' => '_approval_for_veterinary_professional',
                    'view_module' => 'veterinary_professionals'
                ];                
             }

            $this->template($this->template_admin, $data);
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
            $token = $this->trongate_security->_make_sure_allowed('admin');
            $_SESSION['last_page'] = 'veterinary_professionals';

            $vet_account_id = $vet_professional->account_id;

            $data_update['id'] = $vet_account_id;
            $data_update['status'] ="approved";
            $data_update['access'] ="2";
            $update_account_sql = "UPDATE account SET access = :access, status = :status
             WHERE id =:id";
            $this->model->query_bind($update_account_sql,$data_update);
            $sql= "SELECT email FROM account WHERE id=$vet_account_id";
            $vet_professional_account = $this->model->query($sql, 'object');

            // send approval email
            $aObj = (object) $vet_professional_account;
            $uObj = (object) $vet_professional;
            $this->send_approval_email($aObj,$uObj);

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
            $token = $this->trongate_security->_make_sure_allowed('admin');
            $_SESSION['last_page'] = 'veterinary_professionals';
            $vet_account_id = $vet_professional->user_id;
            $data_update['reason'] = $data['reason'];
            $data_update['id'] = $vet_account_id;
            $data_update['status'] ="rejected";
            $data_update['access'] =NULL;
            $update_sql = "UPDATE account SET reason = :reason, status = :status, access = :access
             WHERE id =:id";
            $this->model->query_bind($update_sql,$data_update);
            $sql= "SELECT email FROM account WHERE id=$vet_account_id";
            $vet_professional_account = $this->model->query($sql, 'object');

            // send rejection email
            $aObj = (object) $vet_professional_account;
            $uObj = (object) $vet_professional;
            $this->send_rejection_email($aObj,$uObj);

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



    function _get_data_from_veterinary_professional(): array {
        $data['firstname'] = post('firstname', true);
        $data['lastname'] = post('lastname', true);
        $data['password'] = post('password', true);
        $data['email'] = post('email', true);
        $data['phone_Number'] = post('phone_number', true);
        $data['professional_body'] = post('professional_body', true);
        $data['reg_number'] = post('reg_number', true);
        $data['reg_certificate'] = post('reg_certificate', true); 
        return $data;
    }   



    function _get_data_from_veterinary_professional_for_update(): array {
    $data['id'] = post('id', true);
    $data['firstname'] = post('firstname', true);
    $data['lastname'] = post('lastname', true);
    $data['email'] = post('email', true);
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












    function livestock_registration(): void{
        $this->module('trongate_security');
        $this->module('breed_registrations');
        $token = $this->trongate_security->_make_sure_allowed('veterinary professional');
        $_SESSION['last_page'] = 'livestock_registration';
    
        $sql= "SELECT id FROM veterinary_professionals  WHERE status ='0'";
        $veterinary_professional = $this->model->query($sql, 'object');
        $data = [
            'user_data' => $this->_get_user_data($this->trongate_security->_make_sure_allowed('veterinary professional')),
            'title' => 'Register Livestock',
            'vet_professional_id' => $veterinary_professional[0]->id,
            'sex_options' =>  $this->breed_registrations->sex_options(),
            'breed_options' =>  $this->breed_registrations->breed_options(),
            'livestock_type_options' =>  $this->breed_registrations->livestock_type_options(),
            'weight_options' =>  $this->breed_registrations->weight_options(),
            'reg_point_options' =>  $this->breed_registrations->reg_point_options(),
            'age_range_options' =>  $this->breed_registrations->age_range_options(),
            'livestock_purpose_options' =>  $this->breed_registrations->livestock_purpose_options(),
            'view_file' => '_register_livestock',
            'view_module' => 'veterinary_professionals'
        ];
        $this->template($this->template_admin, $data);
    }

    function add_livestock_registration(): void{
        
        $this->module('trongate_security');
        $token = $this->trongate_security->_make_sure_allowed('veterinary professional');
        $submit = post('submit', true);
       
        if ($submit === 'Submit') {

            $this->validation->set_rules('animal_id', 'animal id', 'required|min_length[2]|max_length[255]');

            $this->validation->set_rules('nldpi_number', 'nldpi number', 'required');

            $this->validation->set_rules('breed', 'breed', 'required');
            
            $this->validation->set_rules('sex', 'sex', 'required');

            $this->validation->set_rules('weight', 'weight', 'required');

            $this->validation->set_rules('approx_age', 'approx age', 'required');

            $this->validation->set_rules('colour', 'colour', 'required');

            $this->validation->set_rules('livestock_type', 'livestock type', 'required');

            $this->validation->set_rules('reg_point', 'reg point', 'required');

            $this->validation->set_rules('livestock_purpose', 'livestock purpose', 'required');

            $this->validation->set_rules('reg_by', 'reg by', 'required');

            $result = $this->validation->run();

            if ($result === true ) { 
                $data = $this->_get_data_from_livestock_registration();

                $data['reg_date'] = date('Y-m-d');

                $owner = $this->model->get_one_where('nldpi_number',$data['nldpi_number'],'livestock_keepers');
                
                if($owner == false){
                    
                    $_SESSION['failure'] = 'livestock keeper with nldpi number '.$data['nldpi_number'].' does not exist';
                }

                $data['owner_id'] = $owner->id;

                $data['date_created'] = time();

                $data['status'] = 1;
               
                //insert the new record
                $res = $this->model->get_one_where('animal_id',$data['animal_id'],'animal_registrations');
                if($res == false){
                  
                    $animal_registration_id = $this->model->insert($data, 'animal_registrations');

                    $data_livestock_activity['date_created'] = time();

                    $data_livestock_activity['animal_reg_id'] = $animal_registration_id;

                    $data_livestock_activity['service'] = 'Registration';

                    $data_livestock_activity['status'] = 'Completed' ;

                    $this->model->insert($data_livestock_activity, 'livestock_activities');
    
                    $_SESSION['success'] = 'You have successfully register livestock with an identification number';
                
                }else{
                    $_SESSION['failure'] = 'There is another livestock having this identity, in our record';
    
                } 
                redirect('veterinary_professionals/livestock_registration');
                
           }else{

            redirect('veterinary_professionals/livestock_registration');
            
           }


        } else {
            //form submission error
             redirect('veterinary_professionals/livestock_registration');
        }



    }

    function _get_data_from_livestock_registration(): array {
        $data['animal_id'] = post('animal_id', true);
        $data['nldpi_number'] = post('nldpi_number', true);
        $data['breed_id'] = post('breed', true);
        $data['sex'] = post('sex', true);
        $data['weight'] = post('weight', true);
        $data['approx_age'] = post('approx_age', true);
        $data['colour'] = post('colour', true);
        $data['livestock_type'] = post('livestock_type', true);
        $data['reg_point'] = post('reg_point', true);
        $data['livestock_purpose'] = post('livestock_purpose', true);
        $data['reg_by'] = post('reg_by', true);        
        return $data;
    }

      
    function _get_data_from_livestock_registration_for_update(): array {
        $data['id'] = post('id', true);
        $data['animal_id'] = post('animal_id', true);
        $data['nldpi_number'] = post('nldpi_number', true);
        $data['breed_id'] = post('breed', true);
        $data['sex'] = post('sex', true);
        $data['weight'] = post('weight', true);
        $data['approx_age'] = post('approx_age', true);
        $data['colour'] = post('colour', true);
        $data['livestock_type'] = post('livestock_type', true);
        $data['reg_point'] = post('reg_point', true);
        $data['livestock_purpose'] = post('livestock_purpose', true);       
        return $data;
    }

function get_livestock_registration($animal_registration_id){  
    $sql= "SELECT * FROM animal_registrations WHERE id='$animal_registration_id'";
    $animal_registration = $this->model->query($sql, 'object');
    
    return $animal_registration;
}

//Update livestock
function update_livestock_registration(){

    $this->module('trongate_security');
    $token = $this->trongate_security->_make_sure_allowed('veterinary professional');
    
    $_SESSION['last_page'] = 'animal_registrations';   
    $data = $this->_get_data_from_livestock_registration_for_update();
    $data['last_updated'] = time();
    $update_sql = "UPDATE animal_registrations SET nldpi_number = :nldpi_number,
    animal_id = :animal_id, colour =:colour, livestock_type = :livestock_type, 
    breed_id = :breed_id, sex = :sex, weight =:weight, approx_age = :approx_age, livestock_purpose = :livestock_purpose, last_updated = :last_updated,
    reg_point = :reg_point  WHERE id =:id";
    $this->model->query_bind($update_sql,$data);
    $_SESSION['success']= 'You have successfully updated livestock with an identification number '.$data['animal_id'];
    redirect('veterinary_professionals/livestock_registry');

}

function delete_livestock_registration(){
    
    $this->module('trongate_security');
    $token = $this->trongate_security->_make_sure_allowed('veterinary professional');
    
    $_SESSION['last_page'] = 'animal_registrations';   
    $data['id'] =   post('id', true);
    $data['status'] = 'delete';
    $update_sql = "UPDATE animal_registrations SET status = :status WHERE id =:id";
    $this->model->query_bind($update_sql,$data);
    $_SESSION['success']= 'Livestock Identity successfully deleted';
    redirect('veterinary_professionals/livestock_registry');
}



    /**
     * Get data from the POST request.
     *
     * @return array Data from the POST request.
     */
    private function get_data_from_post(): array {
        $data['nldpi_number'] = post('nldpi_number', true);
        $data['animal_id'] = post('animal_id', true);
        $data['breed_id'] = post('breed_id', true);
        $data['name'] = post('name', true);
        $data['sex'] = post('sex', true);
        $data['weight'] = post('weight', true);
        $data['approx_age'] = post('approx_age', true);
        $data['colour'] = post('colour', true);
        $data['livestock_type'] = post('livestock_type', true);
        $data['livestock_purpose'] = post('livestock_purpose', true);
        $data['reg_date'] = post('reg_date', true);
        $data['reg_point'] = post('reg_point', true);
        $data['reg_by'] = post('reg_by', true);       
        $data['date_created'] = post('date-created', true);
        $data['last_updated'] = post('last_updated', true);
        return $data;
    }

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

        $sql = 'SELECT a.id, vp.nldpi_number, vp.reg_number, vp.firstname, vp.lastname, vp.id as vet_professional_id, t.user_id, a.user_type, a.email, a.picture, t.token

                FROM trongate_tokens t INNER JOIN account a ON a.user_id = t.user_id INNER JOIN veterinary_professionals as vp  ON vp.account_id = a.id

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
            $params['animal_id'] = '%'.$searchphrase.'%';
            $params['name'] = '%'.$searchphrase.'%';
            $params['breed_id'] = '%'.$searchphrase.'%';
            $params['sex'] = '%'.$searchphrase.'%';
            $params['weight'] = '%'.$searchphrase.'%';
            $params['approx_age'] = '%'.$searchphrase.'%';
            $params['colour'] = '%'.$searchphrase.'%';
            $params['livestock_type'] = '%'.$searchphrase.'%';
            $params['livestock_purpose'] = '%'.$searchphrase.'%';
            $params['reg_point'] = '%'.$searchphrase.'%';
            $params['reg_by'] = '%'.$searchphrase.'%';
            $params['date_created'] = '%'.$searchphrase.'%';
            $params['last_updated'] = '%'.$searchphrase.'%';
            $sql = 'select * from animal_registrations
            WHERE nldpi_number LIKE :nldpi_number
            OR animal_id LIKE :animal_id
            OR name LIKE :name
            OR breed LIKE :breed
            OR sex LIKE :sex
            OR weight LIKE :weight
            OR approx_age LIKE :approx_age
            OR colour LIKE :colour
            OR livestock_type LIKE :livestock_type
            OR livestock_purpose LIKE :livestock_purpose
            OR reg_point LIKE :reg_point
            OR reg_by LIKE :reg_by
            OR date_created LIKE :date_created
            OR date_updated LIKE :date_updated
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
            $this->validation->set_rules('animal_id', 'animal_idired|min_length[2]|max_length[255]');
            $this->validation->set_rules('sex', 'sex', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('weight', 'weight', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('approx_age', 'approx_age', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('colour', 'colour', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('livestock_type', 'livestock_type', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('reg_date', 'reg_date', 'required|valid_datetimepicker_us');
            $this->validation->set_rules('reg_point', 'reg_point', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('livestock_purpose', 'livestock_purpose', 'required|valid_datetimepicker_us');
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



    function _hash_string(string $str): string{
        $hashed_string =password_hash($str, PASSWORD_BCRYPT,array('cost'=> 11));
        return $hashed_string;
    
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