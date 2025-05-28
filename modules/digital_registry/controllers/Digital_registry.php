<?php

class Digital_registry extends Trongate {



    function example(): void{

        echo "<h1>Example</h1>";

    }

    function page(){

        if(from_trongate_mx() ===true){

            http_response_code(200);

            redirect('digital_registry/index');

            die();

        }

    }

	function index(): void{

        // $_SESSION['success'] = 'test';

        $data = [

            'title' => 'Digital Registry',

            'view_file' => 'index',

            'view_module' => 'digital_registry'

        ];

        $this->template('public', $data);

    }

    function service_providers_registry() {
      $sql = "SELECT * FROM service_providers ORDER BY company_name ASC";
    $data['service_providers'] = $this->model->query($sql, 'object');

    // Merge with view metadata
    $data['title'] = 'Service Providers Registry';
    $data['view_file'] = 'service_providers_registry';
    $data['view_module'] = 'digital_registry';
    $this->template('public', $data);
}


function ajax_service_providers_registry() {
    $search = $_GET['search'] ?? '';
    $page = (int)($_GET['page'] ?? 1);
    $per_page = 5;
    $offset = ($page - 1) * $per_page;

    $params = [];
    $where_clause = '';

    if (!empty($search)) {
        $where_clause = " WHERE company_name LIKE ?";
        $params[] = '%' . $search . '%';
    }

    // Query to get paginated records
    $sql = "SELECT * FROM service_providers $where_clause ORDER BY company_name ASC LIMIT $offset, $per_page";

    // Query to count total matching records
    $count_sql = "SELECT COUNT(*) as total FROM service_providers $where_clause";

    $data['service_providers'] = $this->model->query($sql, 'object', $params);
    $count_result = $this->model->query($count_sql, 'object', $params);

    $total_records = $count_result[0]->total ?? 0;

    $data['total_pages'] = ceil($total_records / $per_page);
    $data['current_page'] = $page;
    $data['search'] = $search;

    $this->view('partials/registry_list', $data);
}



    	public function dashboard(): void {
		

        $this->module('trongate_security');
		
        $token = $this->trongate_security->_make_sure_allowed('admin');

		$_SESSION['last_page'] = 'digital_registry/dashboard';        

		$data['title'] = 'Dashboard';

		$data['view_module'] = 'digital_registry';

		$data['view_file'] = 'dashboard';

		$this->template('admin', $data);

	}

    	public function id_service_providers(): void {
		

        $this->module('trongate_security');
		
        $token = $this->trongate_security->_make_sure_allowed('admin');

		$_SESSION['last_page'] = 'digital_registry/id_service_providers';        

		$data['title'] = 'Dashboard';

		$data['view_module'] = 'digital_registry';

		$data['view_file'] = 'id_service_providers';

		$this->template('admin', $data);

	}

    	public function veterinary_service(): void {
		

        $this->module('trongate_security');
		
        $token = $this->trongate_security->_make_sure_allowed('admin');

		$_SESSION['last_page'] = 'digital_registry/veterinary_service';        

		$data['title'] = 'Dashboard';

		$data['view_module'] = 'digital_registry';

		$data['view_file'] = 'veterinary_service';

		$this->template('admin', $data);

	}




    function show($account_type = 'farmer'): void{

        $data = [

            'view_file' => 'serviceproviders',

            'view_module' => 'digital_registry'

        ];

        switch ($account_type) {

            case 'farmer':

                $data['view_file'] = 'farmer';

                break;

            case 'business':

                $data['view_file'] = 'business';

                break;

            case 'regulator':

                $data['view_file'] = 'regulator';

                break;

            default:

                $data['view_file'] = 'serviceproviders';

                break;

        }

        

        $this->template('public', $data);

    }



}