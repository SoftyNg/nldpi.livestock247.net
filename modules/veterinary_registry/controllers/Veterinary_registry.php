<?php



class Veterinary_registry extends Trongate {




    public function index(): void {

		redirect('veterinary_registry/dashboard');

	}


	public function dashboard(): void {

        $this->module('trongate_security');

        $this->trongate_security->_make_sure_allowed('admin');

        $_SESSION['last_page'] = 'veterinary_professionals';
        
        $sql = 'SELECT t.id as id, a.firstname, a.lastname, t.date_created, a.user_type, a.email, a.picture, a.status, t.reg_number, t.nldpi_number, t.reg_date
        FROM veterinary_professionals t
        INNER JOIN account a ON a.id = t.account_id';
        $list_of_registered_vet_professionals = $this->model->query($sql, 'object');

        $sql = 'SELECT COUNT(*)  as vet_professionals_total FROM veterinary_professionals t
        INNER JOIN account a ON a.id = t.account_id';
        $vet_professionals_total = $this->model->query($sql, 'object');

       $sql = 'SELECT COUNT(*)  as vet_professionals_approved FROM veterinary_professionals t
        INNER JOIN account a ON a.id = t.account_id WHERE    a.status ="1"';
        $vet_professionals_approved = $this->model->query($sql, 'object');

       $sql = 'SELECT COUNT(*)  as vet_professionals_pending FROM veterinary_professionals t
        INNER JOIN account a ON a.id = t.account_id WHERE a.status ="0"';
        $vet_professionals_pending = $this->model->query($sql, 'object');

        $sql = 'SELECT COUNT(*)  as vet_professionals_rejected FROM veterinary_professionals t
        INNER JOIN account a ON a.id = t.account_id WHERE  a.status ="2"';
        $vet_professionals_rejected = $this->model->query($sql, 'object');

        $data = [
            'user_data' =>  $this->_get_user_data($this->trongate_security->_make_sure_allowed('admin')),
            'vet_professionals_total' => $vet_professionals_total[0]->vet_professionals_total,
            'vet_professionals_approved' => $vet_professionals_approved[0]->vet_professionals_approved,
            'vet_professionals_pending' => $vet_professionals_pending[0]->vet_professionals_pending,
            'vet_professionals_rejected' => $vet_professionals_rejected[0]->vet_professionals_rejected,
            'title' => 'Veterinary Professional Registry',
            'list_of_registered_vet_professionals' =>$list_of_registered_vet_professionals,
            'view_file' => 'dashboard',
            'view_module' => 'veterinary_registry'
        ];
        $this->template('admin', $data);

	}



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

	// Fetch user data based on token
	private function _get_user_data($token) {

		$params = ['token' => $token];

		$sql = 'SELECT a.id, vp.nldpi_number, vp.reg_number, vp.firstname, vp.lastname, vp.id as vet_professional_id, t.user_id, a.user_type, a.email, a.picture, t.token

				FROM trongate_tokens t INNER JOIN account a ON a.user_id = t.user_id INNER JOIN veterinary_professionals as vp  ON vp.account_id = a.id

				WHERE t.token = :token';

		return $this->model->query_bind($sql, $params, 'object');

	}


}