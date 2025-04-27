<?php



class Number_bank extends Trongate {



    public function index(): void {

		redirect('number_bank/dashboard');

	}

	public function dashboard(): void {

		$data['title'] = 'Dashboard';

		$data['view_module'] = 'number_bank';

		$data['view_file'] = 'dashboard';

		$this->template('admin', $data);

	}

    public function number_bank(): void {

		$data['title'] = 'Number Bank Request';

		$data['view_module'] = 'number_bank';

		$data['view_file'] = 'dashboard';

		$this->template('admin', $data);

	}

    public function number_bank_request(){

                

        $data['user_data'] = $_SESSION['user_data'];

        

            $data['view_module'] = 'Serviceprovidersregisters';

            $data['view_file'] = '_number_bank_request';

            $data['title'] = 'Number bank request';

            $this->template('admin', $data);

    

        }



        //fetch number bank request for a service provider
		public function fetch_all_number_bank_request($nldpi_number){

            $params['nldpi_number'] = $nldpi_number;
            $sql = 'SELECT * FROM number_bank_request_allocation WHERE nldpi_number = :nldpi_number';            
            $rows = $this->model->query_bind($sql, $params, 'object');       
    
            return $rows;

         }  


         
         public function number_bank_request_submit(){
            // Retrieve form data
  $data['nldpi_number'] = post('nldpi_number', true);  // 'true' for stripping tags (XSS prevention)
  $data['qty'] = post('qty', true);  
  $data['type_of_tag'] = post('type_of_tag', true); 
  $data['request_date'] = time();
  
  // Insert the data into the database
  $this->model->insert($data, 'number_bank_request_allocation');
    // Set flashdata to trigger modal
    set_flashdata('show_modal', true);

    // Redirect to reload the page and show modal
    redirect('service_providers/number_bank_request_success');
       }

          
       public function assigned_number_bank(){
        $assigned = post('assigned_qty', true);
        $quantity = post('qty', true);
   

        if($quantity >= $assigned){
        // Retrieve form data
$data['nldpi_number'] = post('nldpi_number', true);  
$data['assigned'] = $assigned;
$data['qty'] = $quantity - $assigned;  
$data['type_of_tag'] = post('type_of_tag', true); 
$data['assigned_from'] = post('assigned_from', true); 
$data['assigned_to'] = post('assigned_to', true); 
$data['prof_assigned_to'] = post('prof_assigned_to', true); 
$data['request_date'] = time();

$id = post('assigned', true);
$_SESSION['qty_allocated'] = post('qty', true);
$_SESSION['vet_prof'] = post('prof_assigned_to', true);  


// Update the data into the database
$this->model->update($id, $data, 'number_bank_request_allocation');


// Redirect to reload the page and show modal
redirect('service_providers/number_bank_allocate_success');

        }else{
            echo 'You do not have that much';
        }
   }




       public function _get_pending_requests(){ 
        $params['status'] = 'Pending'; 
        $sql = 'SELECT 
            number_bank_request_allocation.*, 
            service_providers.company_name           
        FROM 
            number_bank_request_allocation 
        JOIN 
            service_providers ON number_bank_request_allocation.nldpi_number = service_providers.nldpi_number 
        WHERE 
            number_bank_request_allocation.status = :status';
    
        $rows = $this->model->query_bind($sql, $params, 'object');
         
        return $rows;

     }

     public function _get_approved_requests(){ 
        $params['status'] = 'Approved'; 
        $sql = "SELECT * FROM number_bank_request_allocation WHERE status = :status";
        $rows = $this->model->query_bind($sql, $params, 'object');
         
        return $rows;

     }

       public function _get_all_requests(){  

        $rows = $this->model->get('id', 'number_bank_request_allocation');  
       
        return $rows;

     }

     public function _get_all_service_providers(){  

      $rows = $this->model->get('id', 'service_providers');  
     
      return $rows;

   }

   public function get_number_bank_details(){
    $data['view_module'] = 'number_bank';
     $data['view_file'] = '_number_bank_details';
     $data['title'] = 'Number Bank Details';
     $data['number_bank_user']= $this->_fetch_number_bank_details();
     
     $this->template('admin', $data);
 }

 public function _get_total_approved_for_user(){
    $params['id'] = segment(3);

    $sql = 'SELECT SUM(qty) AS total_amount 
            FROM number_bank_request_allocation 
            WHERE status IN ("Approved") 
            AND id = :id';

    $rows = $this->model->query_bind($sql, $params, 'object');

    $total = (!empty($rows) && isset($rows[0]->total_amount)) ? $rows[0]->total_amount : 0;

    echo $total;
  
 }

 public function _get_total_used_for_user(){
    $params['id'] = segment(3);

    $sql = 'SELECT SUM(used) AS total_amount 
            FROM number_bank_request_allocation 
            WHERE id = :id';

    $rows = $this->model->query_bind($sql, $params, 'object');

    $total = (!empty($rows) && isset($rows[0]->total_amount)) ? $rows[0]->total_amount : 0;

    echo $total;
  
 }

 public function _get_all_total_approved() {  
    $sql = 'SELECT SUM(qty) AS total_amount FROM number_bank_request_allocation WHERE status IN ("Approved")';
    $rows = $this->model->query($sql, 'object'); 
    
    $total = (!empty($rows) && isset($rows[0]->total_amount)) ? $rows[0]->total_amount : 0;

    echo $total;
}


public function _get_total_used() {  
    $sql = 'SELECT SUM(used) AS total_amount FROM number_bank_request_allocation'; 

    $rows = $this->model->query($sql, 'object'); // <- this line was missing

    $total = (!empty($rows) && isset($rows[0]->total_amount)) ? $rows[0]->total_amount : 0;

    echo $total;
}

 public function _fetch_number_bank_details(){
            
  $params['id'] = segment(3);    
  $sql = '
  SELECT 
      number_bank_request_allocation.*, 
      service_providers.*,
      account.email
  FROM 
      number_bank_request_allocation 
  JOIN 
      service_providers ON number_bank_request_allocation.nldpi_number = service_providers.nldpi_number 
  JOIN 
      account ON service_providers.account_id = account.id
  WHERE 
      number_bank_request_allocation.id = :id
';
         
  $rows = $this->model->query_bind($sql, $params, 'object');       
  return $rows;
   }



   public function _fetch_highestvalue() {
    $sql = 'SELECT MAX(number_to) AS highest_value FROM number_bank_request_allocation'; 

    $result = $this->model->query($sql, 'object');

    if (!empty($result)) {
        return $result[0]->highest_value;
    } else {
        return 0;
    }
}

public function approve_number_bank(){
    $params = [
        'id' => segment(3),
        'status' => 'Approved',
        'qty' => post('qty', true),
        'number_from' => post('from', true),
        'number_to' => post('to', true),
        'allocation_date' => time()
    ];
    
    $_SESSION['qty'] = $params['qty'];
    $_SESSION['id_provider'] = post('name', true);
   
   
  $update_sql = "UPDATE number_bank_request_allocation SET qty = :qty, 
  status = :status, number_from = :number_from, 
  number_to = :number_to, allocation_date = :allocation_date
  WHERE id = :id";
  $this->model->query_bind($update_sql, $params);		

  redirect('number_bank/number_bank_approval_view');      

 }

 
 public function number_bank_approval_view(): void {
		
    $data['view_module'] = 'number_bank';
    $data['view_file'] = '_number_bank_view';
    $data['title'] = 'Number bank Success';
    $this->template('admin', $data);
}


function _countNumberBank($nldpinumber) {
    $params = [
        'nldpinumber' => $nldpinumber,
        'status' => 'approved'
    ];
    
    $sql = "SELECT *
            FROM number_bank_request_allocation 
            WHERE nldpi_number = :nldpinumber 
            AND status = :status";
    
    $result = $this->model->query_bind($sql, $params, 'object');
    return $result;

}


public function get_number_availability() {
    $id = (int)($_GET['assigned'] ?? 0);
    $params = ['id' => $id];

    $sql = "SELECT qty, type_of_tag FROM number_bank_request_allocation WHERE id = :id";

    $row = $this->model->query_bind($sql, $params,'array');
       
    if ($row) {
        $available = (int)($row[0]['qty'] ?? 0);
        $tag = $row[0]['type_of_tag'];

    // Return 2 targets (availability and hidden input)
    echo '
    <span id="availability-placeholder">' . number_format($available) . ' Available</span>
    <input type="hidden" id="type-of-tag" name="type_of_tag" value="' . htmlspecialchars($tag) . '" />
    <input type="hidden" id="qty" name="qty" value=" '.  $available  . '" />
';
} else {
echo '
    <span id="availability-placeholder">N/A</span>
    <input type="hidden" id="type-of-tag" name="type_of_tag" value="" />
';
}

}

public function total_allocated_ids(){

    $sql = "SELECT SUM(assigned) as total_allocated FROM number_bank_request_allocation";
    $row = $this->model->query($sql, 'array');
   

    if ($row && isset($row[0]['total_allocated'])) {
        return (int)$row[0]['total_allocated'];
    }

    return 0; // Return 0 if no result

}
   







}