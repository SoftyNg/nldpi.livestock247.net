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
    $page = isset($_GET['page']) ? max((int)$_GET['page'], 1) : 1;
    $per_page = 5;
    $offset = ($page - 1) * $per_page;

    $where_clause = '';
    
    if (!empty($search)) {
        // Escape the string to prevent SQL injection
        $escaped_search = addslashes($search); 
        $where_clause = "WHERE company_name LIKE '%$escaped_search%'";
    }

    $sql = "SELECT sp.*, a.email 
        FROM service_providers sp
        JOIN account a ON sp.account_id = a.id
        $where_clause
        ORDER BY sp.company_name ASC
        LIMIT $offset, $per_page";

// For counting total matching records (no need for join here, just count service_providers)
$count_sql = "SELECT COUNT(*) as total FROM service_providers sp $where_clause";
    try {
        $data['service_providers'] = $this->model->query($sql, 'object');
        $count_result = $this->model->query($count_sql, 'object');
    } catch (PDOException $e) {
        die("SQL Error: " . $e->getMessage() . "<br>SQL: $sql");
    }

    $total_records = $count_result[0]->total ?? 0;
    $data['total_pages'] = ceil($total_records / $per_page);
    $data['current_page'] = $page;
    
    $data['search'] = $search;

    $this->view('partials/registry_list', $data);
}



function ajax_vet_professionals_registry() {
    $search = $_GET['search'] ?? '';
    $page = isset($_GET['page']) ? max((int)$_GET['page'], 1) : 1;
    $per_page = 5;
    $offset = ($page - 1) * $per_page;

    $where_clause = '';
    
    if (!empty($search)) {
        // Escape the string to prevent SQL injection
        $escaped_search = addslashes($search); 
        $where_clause = "WHERE company_name LIKE '%$escaped_search%'";
    }

    $sql = "SELECT v.*, a.email 
        FROM veterinary_professionals v
        JOIN account a ON v.account_id = a.id
        $where_clause
        ORDER BY v.firstname ASC
        LIMIT $offset, $per_page";

// For counting total matching records (no need for join here, just count service_providers)
$count_sql = "SELECT COUNT(*) as total FROM veterinary_professionals v $where_clause";
    try {
        $data['veterinary_professionals'] = $this->model->query($sql, 'object');
        $count_result = $this->model->query($count_sql, 'object');
    } catch (PDOException $e) {
        die("SQL Error: " . $e->getMessage() . "<br>SQL: $sql");
    }

    $total_records = $count_result[0]->total ?? 0;
    $data['total_pages'] = ceil($total_records / $per_page);
    $data['current_page'] = $page;
    
    $data['search'] = $search;

    $this->view('partials/vet_list', $data);
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

    	public function veterinary_service_public(): void {
		       

		$data['title'] = 'Vet Public view';

		$data['view_module'] = 'digital_registry';

		$data['view_file'] = 'veterinary_service_public';

		$this->template('public', $data);

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




        
   public function countAllVet() {
        $sql = "SELECT COUNT('id') AS count FROM veterinary_professionals";
        $rows = $this->model->query($sql, 'object');

        if (!empty($rows)) {
            return $rows[0]->count;
        } else {
            return 0;
        }
    }

    public function countApprovedVet() {
    $sql = "SELECT COUNT(id) AS count FROM veterinary_professionals WHERE status = 1";
    $rows = $this->model->query($sql, 'object');

    if (!empty($rows)) {
        return $rows[0]->count;
    } else {
        return 0;
    }
}

public function countPendingVet() {
    $sql = "SELECT COUNT(id) AS count FROM veterinary_professionals WHERE status = 0";
    $rows = $this->model->query($sql, 'object');

    if (!empty($rows)) {
        return $rows[0]->count;
    } else {
        return 0;
    }
}

public function getApprovedVets() {
    $sql = "SELECT * FROM veterinary_professionals WHERE status = 1";
    $rows = $this->model->query($sql, 'object'); // fetch as associative array
     //json($rows); die();
    return $rows;
}





}