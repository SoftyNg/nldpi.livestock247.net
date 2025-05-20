<?php



class Market_registry extends Trongate {

    private $default_limit = 20;
    private $per_page_options = array(10, 20, 50, 100);    
    private $template_admin = 'admin';
    private $template_public = 'public';



    public function index(): void {

		redirect('market_registry/dashboard');

	}

	public function dashboard(): void {
		

        $this->module('trongate_security');
		
        $token = $this->trongate_security->_make_sure_allowed('admin');

		$_SESSION['last_page'] = 'market_registry/dashboard';        

		$data['title'] = 'Dashboard';

		$data['view_module'] = 'market_registry';

		$data['view_file'] = 'dashboard';

		$this->template('admin', $data);

	}

	public function createMarket(): void {
		

        $this->module('trongate_security');
		
        $token = $this->trongate_security->_make_sure_allowed('admin');

		$_SESSION['last_page'] = 'market_registry/createMarket';        

		$data['title'] = 'Register new Market';

		$data['view_module'] = 'market_registry';

		$data['view_file'] = 'create_market';

		$data['form_location'] = BASE_URL.'market_registry/submit_market/';

		$this->template('admin', $data);

	}

	public function submit_market(){
		$submit = post('submit', true);
        if ($submit) {

            $this->validation->set_rules('name', 'name', 'required|min_length[2]|max_length[200]|callback_check_name');
          
            $result = $this->validation->run();
            if ($result === true ) { 
                $update_id = (int) segment(3);
                $data = $this->get_data_from_post();
			
                    //insert the new record
                  
                     $this->model->insert($data, 'livestock_markets');
                    $flash_msg = 'The record was successfully created';
                

                set_flashdata($flash_msg);
                redirect('market_registry/createMarket');
            }else{
                $this->createMarket();
            }
        }
		

	}


   private function get_data_from_post(): array {
    $data['nldpi_number'] = $this->generateUniqueNldpiNumber();
    $data['name'] = post('name', true);
    $data['state'] =  post('state', true);
    $data['lga'] = post('lga', true);
    $data['address'] =  post('address', true);
    $data['lon'] = post('longitude');
    $data['lat'] = post('latitude'); 
    $operating_days = post('operating_days'); 
    $data['operating_days'] = implode(',', $operating_days); 
    $livestocks = post('livestock_types');
    $data['types_of_livestock_traded'] = implode(',', $livestocks);      
    $major_breeds =  post('major_breeds');
    $data['major_breeds_found'] = implode(',', $major_breeds);
    $data['ownership_type'] = post('ownership');
    $data['market_leader'] = post('market_leader');
    $data['phone'] = post('phone');  
    $data['email'] = post('email');  
    $data['website'] = post('website');         
    return $data;
}


    private function generateUniqueNldpiNumber(): int {
    while (true) {
        $random = rand(1000, 9999);
        $nldpi_number = NLDPI_NUMBER + 44 + $random;

        $params['nldpi_number'] = $nldpi_number;
        $sql = "SELECT * FROM livestock_markets WHERE nldpi_number = :nldpi_number";
        $result = $this->model->query_bind($sql,$params,'object');

        if (count($result) == 0) {
            return $nldpi_number;
        }
    }
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

    public function generateRandomFourDigitNumber() {
    return rand(1000, 9999); // Ensures it's always a 4-digit number
    }

    
    public function get_state_data($state_name) {
        // sanitize input
        $state_name = urldecode($state_name);

        $sql = "SELECT * FROM livestock_markets WHERE state = :state_name";
        $params = ['state_name' => $state_name];
        $markets = $this->model->query_bind($sql, $params, 'object');

    if (!empty($markets)) {
        echo json_encode([
            'success' => true,
            'state' => $state_name,
            'data' => $markets
        ]);
    } else {
        echo json_encode(['success' => false]);
    }
    }

    public function todayMarket($today){
   $params = [
        'pattern2' => "{$today}s%",             // Match exact (e.g. only 'Monday')
        'pattern1' => "$today%",            // Starts with day
        'pattern3' => "%,$today",            // Ends with day
        'pattern4' => "%,{$today}s%",           // In the middle
    ];
  
    $sql = "
        SELECT state 
        FROM livestock_markets 
        WHERE 
            operating_days = :pattern1
            OR operating_days LIKE :pattern2
            OR operating_days LIKE :pattern3
            OR operating_days LIKE :pattern4
    ";

    $results = $this->model->query_bind($sql, $params, 'array');
    

    $states = array_column($results, 'state');

    return $states;    

    }

}