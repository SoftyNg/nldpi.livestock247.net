<?php
class Livestock_markets extends Trongate {

    private $default_limit = 20;
    private $per_page_options = array(10, 20, 50, 100);    

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
            $data['headline'] = 'Update Livestock_market Record';
            $data['cancel_url'] = BASE_URL.'livestock_markets/show/'.$update_id;
        } else {
            $data['headline'] = 'Create New Livestock_market Record';
            $data['cancel_url'] = BASE_URL.'livestock_markets/manage';
        }

        $data['form_location'] = BASE_URL.'livestock_markets/submit/'.$update_id;
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
            $params['nldpi_number'] = '%'.$searchphrase.'%';
            $params['name'] = '%'.$searchphrase.'%';
            $params['state'] = '%'.$searchphrase.'%';
            $params['lga'] = '%'.$searchphrase.'%';
            $params['address'] = '%'.$searchphrase.'%';
            $params['operating_days'] = '%'.$searchphrase.'%';
            $params['types_of_livestock_traded'] = '%'.$searchphrase.'%';
            $params['major_breeds_found'] = '%'.$searchphrase.'%';
            $params['lon'] = '%'.$searchphrase.'%';
            $params['lat'] = '%'.$searchphrase.'%';
            $params['status'] = '%'.$searchphrase.'%';
            $params['ownership_type'] = '%'.$searchphrase.'%';
            $params['market_leadership_details'] = '%'.$searchphrase.'%';
            $params['email'] = '%'.$searchphrase.'%';
            $params['phone'] = '%'.$searchphrase.'%';
            $params['website'] = '%'.$searchphrase.'%';
            $sql = 'select * from livestock_markets
            WHERE nldpi_number LIKE :nldpi_number
            OR name LIKE :name
            OR state LIKE :state
            OR lga LIKE :lga
            OR address LIKE :address
            OR operating_days LIKE :operating_days
            OR types_of_livestock_traded LIKE :types_of_livestock_traded
            OR major_breeds_found LIKE :major_breeds_found
            OR lon LIKE :lon
            OR lat LIKE :lat
            OR status LIKE :status
            OR ownership_type LIKE :ownership_type
            OR market_leadership_details LIKE :market_leadership_details
            OR email LIKE :email
            OR phone LIKE :phone
            OR website LIKE :website
            ORDER BY id desc';
            $all_rows = $this->model->query_bind($sql, $params, 'object');
        } else {
            $data['headline'] = 'Manage Livestock_markets';
            $all_rows = $this->model->get('id desc');
        }

        $pagination_data['total_rows'] = count($all_rows);
        $pagination_data['page_num_segment'] = 3;
        $pagination_data['limit'] = $this->get_limit();
        $pagination_data['pagination_root'] = 'livestock_markets/manage';
        $pagination_data['record_name_plural'] = 'livestock_markets';
        $pagination_data['include_showing_statement'] = true;
        $data['pagination_data'] = $pagination_data;

        $data['rows'] = $this->reduce_rows($all_rows);
        $data['selected_per_page'] = $this->get_selected_per_page();
        $data['per_page_options'] = $this->per_page_options;
        $data['view_module'] = 'livestock_markets';
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
            redirect('livestock_markets/manage');
        }

        $data = $this->get_data_from_db($update_id);
        $data['token'] = $token;

        if ($data === false) {
            redirect('livestock_markets/manage');
        } else {
            $data['update_id'] = $update_id;
            $data['headline'] = 'Livestock_market Information';
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
            $this->validation->set_rules('name', 'name', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('state', 'state', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('lga', 'lga', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('address', 'address', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('operating_days', 'operating_days', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('types_of_livestock_traded', 'types_of_livestock_traded', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('major_breeds_found', 'major_breeds_found', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('lon', 'lon', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('lat', 'lat', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('status', 'status', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('ownership_type', 'ownership_type', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('market_leadership_details', 'market_leadership_details', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('email', 'email', 'required|min_length[7]|max_length[255]|valid_email');
            $this->validation->set_rules('phone', 'phone', 'required|min_length[2]|max_length[255]');
            $this->validation->set_rules('website', 'website', 'required|min_length[2]|max_length[255]');

            $result = $this->validation->run();

            if ($result === true) {

                $update_id = (int) segment(3);
                $data = $this->get_data_from_post();
                
                if ($update_id>0) {
                    //update an existing record
                    $this->model->update($update_id, $data, 'livestock_markets');
                    $flash_msg = 'The record was successfully updated';
                } else {
                    //insert the new record
                    $update_id = $this->model->insert($data, 'livestock_markets');
                    $flash_msg = 'The record was successfully created';
                }

                set_flashdata($flash_msg);
                redirect('livestock_markets/show/'.$update_id);

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
            $params['module'] = 'livestock_markets';
            $this->model->query_bind($sql, $params);

            //delete the record
            $this->model->delete($params['update_id'], 'livestock_markets');

            //set the flashdata
            $flash_msg = 'The record was successfully deleted';
            set_flashdata($flash_msg);

            //redirect to the manage page
            redirect('livestock_markets/manage');
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
        redirect('livestock_markets/manage');
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
        $record_obj = $this->model->get_where($update_id, 'livestock_markets');

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
        $data['name'] = post('name', true);
        $data['state'] = post('state', true);
        $data['lga'] = post('lga', true);
        $data['address'] = post('address', true);
        $data['operating_days'] = post('operating_days', true);
        $data['types_of_livestock_traded'] = post('types_of_livestock_traded', true);
        $data['major_breeds_found'] = post('major_breeds_found', true);
        $data['lon'] = post('lon', true);
        $data['lat'] = post('lat', true);
        $data['status'] = post('status', true);
        $data['ownership_type'] = post('ownership_type', true);
        $data['market_leadership_details'] = post('market_leadership_details', true);
        $data['email'] = post('email', true);
        $data['phone'] = post('phone', true);
        $data['website'] = post('website', true);        
        return $data;
    }

}