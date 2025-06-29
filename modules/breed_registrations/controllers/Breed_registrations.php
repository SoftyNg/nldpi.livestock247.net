<?php
class Breed_registrations extends Trongate {

    private $default_limit = 20;
    private $per_page_options = array(10, 20, 50, 100);    
    private $template_admin = 'admin';
    private $template_public = 'public';


    private function get_data_from_db(int $update_id): ?array {
        $record_obj = $this->model->get_where($update_id, 'breed_registrations');

        if ($record_obj === false) {
            $this->template('error_404');
            die();
        } else {
            $data = (array) $record_obj;
            return $data;        
        }
    }
    private function get_data_from_post(): array {
        $data['name'] = post('name', true);
        $data['livestock_type'] = (int) post('livestock_type', true);
        $data['breed_type'] = (int) post('breed_type', true);
        $data['status'] = (int) post('status', true);
        $data['description'] = post('description');
        $data['additional_note'] = post('additional_note');        
        return $data;
    }

    public function create(): void {
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed('admin');

        $update_id = (int) segment(3);
        $submit = post('submit');

        if (($submit === '') && ($update_id>0)) {
            $data = $this->get_data_from_db($update_id);
        } else {
            $data = $this->get_data_from_post();
        }

        if ($update_id>0) {
            $data['headline'] = 'Update Breed Record';
            $data['cancel_url'] = BASE_URL.'breed_registrations/show/'.$update_id;
        } else {
            $data['headline'] = 'Create New Breed Record';
            $data['cancel_url'] = BASE_URL.'breed_registrations';
        }

       // $data['user_data'] = $this->_get_user_data($this->trongate_security->_make_sure_allowed('admin'));
        $data['title'] = 'Register Breed';
        $data['form_location'] = BASE_URL.'breed_registrations/submit/'.$update_id;
        $data['update_id'] = $update_id;
        $data['view_file'] = 'create';
        $data['view_module'] = 'breed_registrations';
        $data['breed_type_options'] = $this->breed_type_options();
        $data['livestock_type_options'] = $this->livestock_type_options();
        $data['status_options'] = $this->status_type_options();
        $this->template($this->template_admin, $data);
    }
    public function show(): void {
        $this->module('trongate_security');
        $token = $this->trongate_security->_make_sure_allowed();
        $update_id = (int) segment(3);

        if ($update_id === 0) {
            redirect('breed_registrations');
        }

        $data = $this->get_data_from_db($update_id);
        $data['token'] = $token;


        if ($data === false) {
            redirect('breed_registrations');
        } else {
            $data['update_id'] = $update_id;
            $data['headline'] = 'Breed Information';
            $data['view_file'] = 'show';
            $data['title'] = 'Breed Information';
            
            $breed_type_options = $this->breed_type_options();
            $livestock_type_options = $this->livestock_type_options();
            
            $data['breed_type'] = $breed_type_options[$data['breed_type']];
            $data['livestock_type'] = $livestock_type_options[$data['livestock_type']];
            $data['picture_link'] = BASE_URL.'public/breeds/'.$data['picture'];
            $data['status_options'] = $this->status_options();

            $this->template($this->template_admin, $data);
        }
    }

    function breed_type_options(): array{
        return [
            '' => 'Select Breed Type',
            1 => 'Local',
            2 => 'Exotic'
        ];
    }

    function livestock_type_options(): array{
        return [
            '' => 'Select Livestock Type',
            1 => 'Cattle',
            2 => 'Goat',
            3 => 'Sheep',
            4 => 'Poultry',
            5 => 'Fish',
            6 => 'Pig',
            7 => 'Camel',
            8 => 'Other'
        ];
    }


    function breed_options(): array{
        return [
            '' => 'Select Breed',
            1 => 'Sokoto gudali',
            2 => 'Bororo',
            3 => 'White fulani',
            4 => 'Bokolo',
            5 => 'Bunaji',
        ];
    }


    
    function sex_options(): array{
        
        return [
            '' => 'Select Sex',
            1 => 'Male',
            2 => 'Female',
        ];
    }


    function livestock_purpose_options(): array{
        return [
            '' => 'Select Livestock Purpose',
            1 => 'Dairy',
            2 => 'Meat',
        ];
    }

    function weight_options(): array{
        return [
            '' => 'Select Weight Range',
            1 => '6 - 30kg',
            2 => '51 - 80kg',
            3 => '91 - 120kg'
        ];
    }

    function  age_range_options(): array{
        return [
            '' => 'Select Age Range',
            1 => '0 - 6months',
            2 => '6 - 12months',
            3 => '1 - 3years'
        ];
    }


    function reg_point_options(): array{
        return [
            '' => 'Select Registration Point',
            1 => 'Ranch',
            2 => 'Farm',
            3 => 'Market',
            4 => 'Owner\'s Premises'
        ];
    }

    
    function status_type_options() {
        return [
            0 => 'Inactive',
            1 => 'Active'
        ];
    }
    function status_options() {
        return [
            0 => '<span class="badge badge-danger" style="padding:0.33rem">Inactive</span>',
            1 => '<span class="badge badge-success" style="padding:0.33rem">Active</span>'
        ];
    }

    function check_name(){
        $name = post('name', true);
        $update_id = (int) segment(3);
        $params['name'] = $name;
        $params['id'] = $update_id;

        $sql='SELECT name from breed_registrations WHERE name = :name and id <> :id';
        $res = $this->model->query_bind($sql,$params,'object');
        if ($res) {
            $error_msg ='This name is already registered.';
            return $error_msg;
        }
        return true;
    }
    function _init_document_settings() { 
        $document_settings['destination'] = 'breeds';
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

    function submit(): void{
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed();
        $submit = post('submit', true);
        if ($submit) {

            $this->validation->set_rules('name', 'name', 'required|min_length[2]|max_length[200]|callback_check_name');
            $this->validation->set_rules('livestock_type', 'livestock type', 'required|integer');
            $this->validation->set_rules('breed_type', 'breed type', 'required|integer');
            $this->validation->set_rules('description', 'description', 'required|max_length[255]');

            $result = $this->validation->run();
            if ($result === true ) { 
                $update_id = (int) segment(3);
                $data = $this->get_data_from_post();

                if ($_FILES['picture']['name']) {
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
                        $data['picture'] = $file_name;
                    } catch (Exception $e) {
                        $error_msg = $e->getMessage();
                        set_flashdata($flash_msg);
                        $this->register();
                        return;
                    }
                }


                if ($update_id>0) {
                    //update an existing record
                    $this->model->update($update_id, $data, 'breed_registrations');
                    $flash_msg = 'The record was successfully updated';
                } else {
                    //insert the new record
                    $data['status'] = 0;
                    $data['date_created'] = time();
                    $update_id = $this->model->insert($data, 'breed_registrations');
                    $flash_msg = 'The record was successfully created';
                }

                set_flashdata($flash_msg);
                redirect('breed_registrations/show/'.$update_id);
            }else{
                $this->create();
            }
        }
        
    }

    function index(): void{
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed('admin');


        $sql= "SELECT * FROM breed_registrations";
        $breed_list = $this->model->query($sql, 'object');
        $total_registered_breed  = $this->model->count('breed_registrations');
        $total_registered_local_breed = $this->model->count_where('breed_type', 1, '=', 'breed_registrations');
        $total_registered_exotic_breed = $this->model->count_where('breed_type', 2, '=', 'breed_registrations');
        //$data['user_data'] = $this->_get_user_data($this->trongate_security->_make_sure_allowed('admin'));
        $data['title'] = 'Breed Dashboard';
        $data['total_registered_breed'] = $total_registered_breed;
        $data['total_registered_local_breed'] = $total_registered_local_breed;
        $data['total_registered_exotic_breed'] = $total_registered_exotic_breed;
        $data['view_file'] = 'index';
        $data['view_module'] = 'breed_registrations';
        $data['breed_list'] = $breed_list;
        $data['breed_type_options'] = $this->breed_type_options();
        $data['livestock_type_options'] = $this->livestock_type_options();
        $data['status_options'] = $this->status_options();
    
        $this->template($this->template_admin, $data);
    }


    function register_breed(): void{
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed('admin');
        $_SESSION['last_page'] = 'breed_registrations/register_breed';
    
        $data = [
            'user_data' => $this->_get_user_data($this->trongate_security->_make_sure_allowed('admin')),
            'title' => 'Register Breed',
            'view_file' => '_register_new_breed_form',
            'view_module' => 'breed_registrations'
        ];
        $this->template($this->template_admin, $data);
    }

    function add_breed(){
        
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed('admin');
        $submit = post('submit', true);

        if ($submit === 'Submit') {

           $this->validation->set_rules('name', 'name', 'required');
            $this->validation->set_rules('type_of_animal', 'type of animal', 'required');
            $this->validation->set_rules('breed_type', 'breed type', 'required');
            $this->validation->set_rules('description', 'description', 'required|min_length[20]|max_length[255]');
            $result = $this->validation->run();

            if ($result === true) {
                       
                    //insert the new record
                    $data = $this->_get_data_from_breed_registration();
                    $data['user_id'] = $_SESSION['user_id'];
                    $res = $this->model->get_one_where('name',$data['name'],'breed_registrations');
                    if($res == false){
                        $this->model->insert($data, 'breed_registrations');

                        $_SESSION['success'] = 'You have successfully register a new breed';
                    }else{
                        $_SESSION['failure'] = 'There is another breed of animal having this identification number, in our record';
                    }  

                    redirect('breed_registrations'); 
                
            }else{
                redirect('breed_registrations/register_breed');
            }
        } else {
            //form submission error
            redirect('breed_registrations/register_breed');
        }



    }




    function _get_data_from_breed_registration(): array {
        $data['name'] = post('name', true);
        $data['type_of_animal'] = post('type_of_animal', true);
        $data['breed_type'] = post('breed_type', true);
        $data['description'] = post('description', true);
        $data['additional_note'] = post('additional_note', true);       
        return $data;
    }

      
    function _get_data_from_breed_registration_for_update(): array {
        $data['id'] = post('id', true);
        $data['name'] = post('name', true);
        $data['type_of_animal'] = post('type_of_animal', true);
        $data['breed_type'] = post('breed_type', true);
        $data['description'] = post('description', true);
        $data['additional_note'] = post('additional_note', true);         
        return $data;
    }

function get_breed_registration($breed_registration_id){  
    $sql= "SELECT * FROM breed_registrations WHERE id='$breed_registration_id'";
    $breed_registration = $this->model->query($sql, 'object');
    
    return $breed_registration;
}

//Update butchery
function update_breed_registration(){
    $this->module('trongate_security');
    $this->trongate_security->_make_sure_allowed('veterinary professional');
    
    $_SESSION['last_page'] = 'breed_registrations';   
    $data = $this->_get_data_from_breed_registration_for_update();
    $update_sql = "UPDATE breed_registrations SET  name = :name,
    type_of_animal = :type_of_animal, 
    breed_type = :breed_type, description = :description, additional_note = :additional_note WHERE id =:id";
    $this->model->query_bind($update_sql,$data);
    $_SESSION['success']= 'You have successfully updated breed with an identification number '.$data['id_number'];
    redirect('breed_registrations');

}

function delete_breed_registration(){
    
    $this->module('trongate_security');
    $this->trongate_security->_make_sure_allowed('veterinary professional');
    
    $_SESSION['last_page'] = 'breed_registrations';   
    $data['id'] =   post('id', true);
    $data['status'] = 'delete';
    $update_sql = "UPDATE breed_registrations SET status = :status WHERE id =:id";
    $this->model->query_bind($update_sql,$data);
    $_SESSION['success']= 'Breed successfully deleted';
    redirect('breed_registrations');
}

    
  // Fetch user data based on token
  private function _get_user_data($token) {

    $params = ['token' => $token];
    $sql = 'SELECT a.id, t.user_id, a.firstname, a.user_type, a.lastname, a.email, a.picture, t.token
            FROM trongate_tokens t
            INNER JOIN account a ON a.user_id = t.user_id
            WHERE t.token = :token';
    return $this->model->query_bind($sql, $params, 'object');
  
}


    /**
     * Display a webpage with a form for creating or updating a record.
     */


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
            $params['name'] = '%'.$searchphrase.'%';
            $params['type_of_animal'] = '%'.$searchphrase.'%';
            $sql = 'select * from breed_registrations
            WHERE name LIKE :name
            OR type_of_animal LIKE :type_of_animal
            ORDER BY id desc';
            $all_rows = $this->model->query_bind($sql, $params, 'object');
        } else {
            $data['headline'] = 'Manage Breed_registrations';
            $all_rows = $this->model->get('id desc');
        }

        $pagination_data['total_rows'] = count($all_rows);
        $pagination_data['page_num_segment'] = 3;
        $pagination_data['limit'] = $this->get_limit();
        $pagination_data['pagination_root'] = 'breed_registrations/manage';
        $pagination_data['record_name_plural'] = 'breed_registrations';
        $pagination_data['include_showing_statement'] = true;
        $data['pagination_data'] = $pagination_data;

        $data['rows'] = $this->reduce_rows($all_rows);
        $data['selected_per_page'] = $this->get_selected_per_page();
        $data['per_page_options'] = $this->per_page_options;
        $data['view_module'] = 'breed_registrations';
        $data['view_file'] = 'manage';
        $this->template('admin', $data);
    }

    /**
     * Display a webpage showing information for an individual record.
     *
     * @return void
     */

    /**
     * Handle submitted record data.
     *
     * @return void
     */
    

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
            $params['module'] = 'breed_registrations';
            $this->model->query_bind($sql, $params);

            //delete the record
            $this->model->delete($params['update_id'], 'breed_registrations');

            //set the flashdata
            $flash_msg = 'The record was successfully deleted';
            set_flashdata($flash_msg);

            //redirect to the manage page
            redirect('breed_registrations/manage');
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
        redirect('breed_registrations/manage');
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



}