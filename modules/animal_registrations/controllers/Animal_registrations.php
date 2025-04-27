<?php
class Animal_registrations extends Trongate {

    private $default_limit = 20;
    private $per_page_options = array(10, 20, 50, 100);    
    private $template_admin = 'admin';
    private $template_public = 'public';



    function index(): void{
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed('member area');


        
        $sql= "SELECT * FROM animal_registrations  WHERE status IS NULL";
        $animal_registrations = $this->model->query($sql, 'object');
        $_SESSION['last_page'] = 'animal_registrations';

        $sql = "SELECT COUNT(*) as total_animals FROM animal_registrations  WHERE status IS NULL";
        $total_animals = $this->model->query($sql, 'object');
        $sql = "SELECT COUNT(*) as total_cow FROM animal_registrations  WHERE status IS NULL AND livestock_type ='cow'";
        $total_cow= $this->model->query($sql, 'object');
        $sql = "SELECT COUNT(*) as total_goat FROM animal_registrations  WHERE status IS NULL AND livestock_type  ='goat'";
        $total_goat= $this->model->query($sql, 'object');

        $sql = "SELECT COUNT(*) as total_ram FROM animal_registrations  WHERE status IS NULL AND livestock_type  ='ram'";
        $total_ram= $this->model->query($sql, 'object');
        
       
        $data = [
           // 'user_data' => $this->_get_user_data($this->trongate_security->_make_sure_allowed('member area')),
            'animal_registration_list' =>  $animal_registrations,
            'title' => 'Dashboard',
            'total_animals' => $total_animals[0]->total_animals,
            'total_cow' => $total_cow[0]->total_cow,
            'total_goat' => $total_goat[0]->total_goat,
            'total_ram' => $total_ram[0]->total_ram,
            'view_file' => '_index',
            'view_module' => 'animal_registrations'
        ];
        $this->template($this->template_admin, $data);
    }


    function register_animal(): void{
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed('member area');
        $_SESSION['last_page'] = 'animal_registrations/register_animal';
    
        $sql= "SELECT * FROM veterinary_professionals  WHERE status IS NULL";
        $vetinary_professional = $this->model->query($sql, 'object');

        $data = [
            'user_data' => $this->_get_user_data($this->trongate_security->_make_sure_allowed('member area')),
            'title' => 'Register Animal',
            'nldpi_number' => $vetinary_professional[0]->nldpi_number,
            'view_file' => '_register_new_animal_form',
            'view_module' => 'animal_registrations'
        ];
        $this->template('admin_nldpi', $data);
    }

    function add_animal_record(): void{
        
        $this->module('trongate_security');
       // $this->trongate_security->_make_sure_allowed('member area');
        $submit = post('submit', true);
       
        if ($submit === 'Submit') {
/* 
           $this->validation->set_rules('nldpi_number', 'nldpi number', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('id_number', 'id number', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('breed', 'breed', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('sex', 'sex', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('weight', 'weight', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('approx_age', 'approx age', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('colour', 'colour', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('type_of_animal', 'type of animal', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('reg_point', 'reg point', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('reg_by', 'reg by', 'required|min_length[2]|max_length[255]');
            $result = $this->validation->run(); */
            //if ($result === true ) { 
                $data = $this->_get_data_from_animal_registration();
                $data['reg_date'] = date("Y-m-d H:i:s");
                //$data['vet_professional_id'] = $_SESSION['user_id'];
               
                //insert the new record
    
          
                //$res = $this->model->get_one_where('id',$data['id_number'],'animal_registrations');
                //if($res == false){
                    $this->model->insert($data, 'animal_registrations');
    
                    $_SESSION['success'] = 'You have successfully register a new animal';
                
            /*     }else{
                    $_SESSION['failure'] = 'There is another animal having this identification number, in our record';
    
                }  */
                redirect('service_providers/register_new_animal');
                
          /*  }else{

            redirect('service_providers/register_new_animal');
            
           } */


        } else {
            //form submission error
             redirect('service_providers/register_new_animal');
        }



    }

    function _get_data_from_animal_registration(): array {
        $data['nldpi_number'] = post('nldpi_number', true);
        //$data['id'] = post('id_number', true);
        $data['breed'] = post('breed', true);
        $data['sex'] = post('sex', true);
        $data['weight'] = post('weight', true);
        $data['approx_age'] = post('approx_age', true);
        $data['colour'] = post('colour', true);
        $data['livestock_type'] = post('livestock_type', true);
        $data['reg_point'] = post('reg_point', true);
        $data['animal_id'] = post('animal_id', true);  
        $data['owner_id'] = post('owner_id', true);       
        return $data;
    }

      
    function _get_data_from_animal_registration_for_update(): array {
        $data['id'] = post('id', true);
        $data['nldpi_number'] = post('nldpi_number', true);
        $data['id_number'] = post('id_number', true);
        $data['breed'] = post('breed', true);
        $data['sex'] = post('sex', true);
        $data['weight'] = post('weight', true);
        $data['approx_age'] = post('approx_age', true);
        $data['colour'] = post('colour', true);
        $data['type_of_animal'] = post('type_of_animal', true);
        $data['reg_point'] = post('reg_point', true);
        $data['reg_by'] = post('reg_by', true);        
        return $data;
    }

function get_animal_registration($animal_registration_id){  
    $sql= "SELECT * FROM animal_registrations WHERE id='$animal_registration_id'";
    $animal_registration = $this->model->query($sql, 'object');
    
    return $animal_registration;
}

//Update butchery
function update_animal_registration(){

    $this->module('trongate_security');
    $this->trongate_security->_make_sure_allowed('member area');
    
    $_SESSION['last_page'] = 'animal_registrations';   
    $data = $this->_get_data_from_animal_registration_for_update();
    $data['updated_date'] = date("Y-m-d H:i:s");
    $update_sql = "UPDATE animal_registrations SET nldpi_number = :nldpi_number,
    id_number = :id_number, colour =:colour, type_of_animal = :type_of_animal, 
    breed = :breed, sex = :sex, weight =:weight, approx_age = :approx_age, updated_date = :updated_date,
    reg_point = :reg_point, reg_by =:reg_by  WHERE id =:id";
    $this->model->query_bind($update_sql,$data);
    $_SESSION['success']= 'You have successfully updated animal with an identification number '.$data['id_number'];
    redirect('animal_registrations');

}

function delete_animal_registration(){
    
    $this->module('trongate_security');
    $this->trongate_security->_make_sure_allowed('member area');
    
    $_SESSION['last_page'] = 'animal_registrations';   
    $data['id'] =   post('id', true);
    $data['status'] = 'delete';
    $update_sql = "UPDATE animal_registrations SET status = :status WHERE id =:id";
    $this->model->query_bind($update_sql,$data);
    $_SESSION['success']= 'Identification number successfully deleted';
    redirect('animal_registrations');
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
    private function get_data_from_post(): array {
        $data['nldpi_number'] = post('nldpi_number', true);
        $data['id_number'] = post('id_number', true);
        $data['breed'] = post('breed', true);
        $data['sex'] = post('sex', true);
        $data['weight'] = post('weight', true);
        $data['approx_age'] = post('approx_age', true);
        $data['colour'] = post('colour', true);
        $data['type_of_animal'] = post('type_of_animal', true);
        $data['reg_date'] = post('reg_date', true);
        $data['reg_point'] = post('reg_point', true);
        $data['reg_by'] = post('reg_by', true);        
        return $data;
    }



}