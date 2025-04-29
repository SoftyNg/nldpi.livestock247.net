<?php

class Admin extends Trongate {



	public function index(): void {

		redirect('admin/dashboard');

	}

	public function dashboard(): void {

		$this->module('trongate_security');
		
        $token = $this->trongate_security->_make_sure_allowed('admin');

		$data['title'] = 'Dashboard';

		$data['view_module'] = 'admin';

		$data['view_file'] = 'dashboard';

		$this->template('admin', $data);

	}



	private function format_nldpi_number($nldpi_number) {

		$formatted_nldpi_number = substr_replace($nldpi_number, '-', 3, 0);

		$formatted_nldpi_number = substr_replace($formatted_nldpi_number, '-', 7, 0);

		return $formatted_nldpi_number;

	}

	public function approve_application(): void {

		$type = segment(3);

		$id = (int)segment(4);

		$submit = post('submit');



		$registration_tables = $this->registration_types_tables();

		$table = array_key_exists($type, $registration_tables) ? $registration_tables[$type] : '';

		$param = [];

		if ($submit && $table) {

			$registration_object = $this->model->get_where($id,$table);

			if ($registration_object) {

				$status = 1; // active

				$param['status'] = $status;

				$param['last_updated'] = time();

				$param['comment'] = "Registration Approved";

				$param['user_type'] = 2;



				// update account

				$param['id'] =  (int)$registration_object->account_id;

				$update_sql = "UPDATE account SET user_type = :user_type, status = :status, last_updated = :last_updated,comment = :comment WHERE id = :id";

				$this->model->query_bind($update_sql, $param);



				// update registration

				$param['id'] =  (int)$id;

				unset($param['comment']);

				unset($param['user_type']);

				$update_sql = "UPDATE $table SET status = :status, last_updated = :last_updated WHERE id = :id";

				$this->model->query_bind($update_sql, $param);





				// send approval email

				$user_obj = $this->get_registration_data_obj($type,$id);

				$this->send_registration_approval_email($user_obj);

				redirect('admin/users/' . $type);

			}

		}

	}

    private function send_registration_approval_email($user_obj){ 

		$data['subject'] = 'NLDPI Registration Approved';

		$data['target_name'] = $user_obj->full_name;

		$data['target_email'] = $user_obj->email;  

		$data['user_obj'] = $user_obj;

		$data['logo_url'] = 'https://nldpi.livestock247.net/images/nldpi-logo-extra.png';

		$data['login_url'] = 'https://nldpi.livestock247.net/users/login';

		$data['contact_email'] = 'nldpi@livestock247.net';

		$data['msg_html'] = $this->view('msg_registration_approval_email',$data,true);

		$msg_plain = str_replace('</p>', '\\n\\n', $data['msg_html']);

		$data['msg_plain'] = strip_tags($msg_plain);



		$this->module('mail');

		$this->mail->send_mail($data);

    }



	public function reject_application(): void {

		$type = segment(3);

		$id = (int)segment(4);

		$submit = post('submit');



		$registration_tables = $this->registration_types_tables();

		$table = array_key_exists($type, $registration_tables) ? $registration_tables[$type] : '';



		$param = [];

		if ($submit && $table) {

			$registration_object = $this->model->get_where($id,$table);

			if ($registration_object) {

				$status = 2; // rejected

				$param['status'] = $status;

				$param['last_updated'] = time();

				$param['comment'] = post('reason',true);



				// update account

				$param['id'] =  (int)$registration_object->account_id;

				$update_sql = "UPDATE account SET status = :status, last_updated = :last_updated,comment = :comment WHERE id = :id";

				$this->model->query_bind($update_sql, $param);



				// update registration

				$param['id'] =  (int)$id;

				unset($param['comment']);

				$update_sql = "UPDATE $table SET status = :status, last_updated = :last_updated WHERE id = :id";

				$this->model->query_bind($update_sql, $param);





				// send rejection email

				$user_obj = $this->get_registration_data_obj($type,$id);

				$this->send_registration_rejection_email($user_obj);

				redirect('admin/users/' . $type);

			}

		}

	}

    private function send_registration_rejection_email($user_obj){ 

		$data['subject'] = 'NLDPI Registration Rejected';

		$data['target_name'] = $user_obj->full_name;

		$data['target_email'] = $user_obj->email;  

		$data['user_obj'] = $user_obj;

		$data['logo_url'] = 'https://nldpi.livestock247.net/images/nldpi-logo-extra.png';

		$data['login_url'] = 'https://nldpi.livestock247.net/users/login';

		$data['contact_email'] = 'nldpi@livestock247.net';

		$data['msg_html'] = $this->view('msg_registration_rejection_email',$data,true);

		$msg_plain = str_replace('</p>', '\\n\\n', $data['msg_html']);

		$data['msg_plain'] = strip_tags($msg_plain);



		$this->module('mail');

		$this->mail->send_mail($data);

    }



	public function users(): void {

		$active_link = segment(3);

		$id = (int)segment(4);

		$registration_types = $this->registration_types_list();

		$registration_headline = $this->registration_headline();

		$active_link = array_key_exists($active_link, $registration_types) ? $active_link : 'service-provider';



		if ($id > 0) {

			$data['title'] = 'View User Registration';

			$data['view_module'] = 'admin';

			$data['view_file'] = $this->get_registration_approval_page($active_link);

			$data['approve_url'] = BASE_URL . 'admin/approve_application/' . $active_link . '/' . $id;

			$data['reject_url'] = BASE_URL . 'admin/reject_application/' . $active_link . '/' . $id;

			$data['registration_headline'] = $registration_headline[$active_link];

			$data['record_obj'] = $this->get_registration_data_obj($active_link,$id);

		} else {

			$data['title'] = 'User Registrations';

			$data['view_module'] = 'admin';

			$data['view_file'] = 'users';

			$data['active_link'] = $active_link;

			$data['registration_types_menus'] = $this->registration_types_tab_menus($active_link,$registration_types);

			$data['registration_type'] = $registration_types[$active_link];

			$data['registration_data'] = $this->get_registration_data($active_link);

		}

		$this->template('admin', $data);

	}



	private function registration_types_tab_menus($active_link, array $registration_types): array {

		$registration_types_count = $this->registration_types_count();

		foreach ($registration_types as $key => $value) {

			$data[] = [

				'title' => $value,

				'count' => array_key_exists($key, $registration_types_count) ? $registration_types_count[$key] : 0,

				'id' => $key,

				'active' => $active_link === $key

			];

		}

        return $data;

	}

	private function registration_types_tables(): array {

		return [

            'service-provider' => 'service_providers',

            'veterinary-professional' => 'veterinary_professionals',

            'livestock-keeper' => 'livestock_keepers',

            'livestock-transporter' => 'transporters'

        ];

	}

	private function registration_headline(): array {

		return [

            'service-provider' => 'Livestock Identification Service Provider',

            'veterinary-professional' => 'Veterinary Professional',

            'livestock-keeper' => 'Livestock Farmer / Keeper',

            'livestock-transporter' => 'Livestock Transporter'

        ];

	}

	private function registration_types_list(): array {

		return [

            'service-provider' => 'Livestock Identification Service Providers',

            'veterinary-professional' => 'Veterinary Professionals',

            'livestock-keeper' => 'Livestock Farmers / Keepers',

            'livestock-transporter' => 'Livestock Transporters'

        ];

	}

    public function count_service_providers(){

		echo $this->model->count_rows('status', 1, 'service_providers');

	}

	
    public function count_animals(){

		echo $this->model->count_rows('status', 0, 'animal_registrations');

	}



	private function registration_types_count(): array {

		return [

            'service-provider' => $this->model->count_rows('status', 0, 'service_providers'),

            'veterinary-professional' => $this->model->count_rows('status', 0, 'veterinary_professionals'),

            'livestock-keeper' => $this->model->count_rows('status', 0, 'livestock_keepers'),

            'livestock-transporter' => $this->model->count_rows('status', 0, 'transporters')

        ];

	}



	private function get_registration_data_obj($active_link,$id): object {

		switch ($active_link) {

			case 'service-provider':

				return $this->service_provider_record($id);

				break;

			case 'veterinary-professional':

				return $this->veterinary_professional_record($id);

				break;

			case 'livestock-keeper':

				return $this->livestock_keeper_record($id);

				break;

			case 'livestock-transporter':

				return $this->livestock_transporter_record($id);

				break;

			default:

				return $this->service_provider_record($id);

				break;

		}

	}

	private function get_registration_data($active_link): array {

		switch ($active_link) {

			case 'service-provider':

				return $this->get_service_providers();

				break;

			case 'veterinary-professional':

				return $this->get_veterinary_professionals();

				break;

			case 'livestock-keeper':

				return $this->get_livestock_keepers();

				break;

			case 'livestock-transporter':

				return $this->get_livestock_transporters();

				break;

			default:

				return $this->get_service_providers();

				break;

		}

	}

	private function get_registration_approval_page($active_link): string {

		switch ($active_link) {

			case 'service-provider':

				return 'service_provider_page';

				break;

			case 'veterinary-professional':

				return 'veterinary_professional_page';

				break;

			case 'livestock-keeper':

				return 'livestock_keeper_page';

				break;

			case 'livestock-transporter':

				return 'livestock_transporter_page';

				break;

			default:

				return 'service_provider_page';

				break;

		}

	}



	private function get_service_providers(): array {

		$params['status'] = 0;

        $sql = 'SELECT sp.id, a.date_created,a.email, sp.company_name,sp.reg_number, sp.account_id

				FROM service_providers sp 

				INNER JOIN account a on sp.account_id = a.id where a.status = :status';

        $rows = $this->model->query_bind($sql,$params,'object');

		$data =[];

		foreach ($rows as $row) {

			$data[] = [

				'registration_date' => date('Y-m-d', $row->date_created),

				'full_name' => strtoupper($row->company_name),

				'registration_number' => $row->reg_number,

				'email' => $row->email,

				'id' => $row->id

			];

		}



		return $data;



	}



	private function get_veterinary_professionals(): array {



		$params['status'] = 0;

        $sql = 'SELECT sp.id, a.date_created,a.email, sp.firstname , sp.lastname,sp.reg_number, sp.account_id

				FROM veterinary_professionals sp 

				INNER JOIN account a on sp.account_id = a.id where a.status = :status';

        $rows = $this->model->query_bind($sql,$params,'object');

		$data =[];

		foreach ($rows as $row) {

			$data[] = [

				'registration_date' => date('Y-m-d', $row->date_created),

				'full_name' => strtoupper($row->firstname . ' ' . $row->lastname),

				'registration_number' => $row->reg_number,

				'email' => $row->email,

				'id' => $row->id

			];

		}



		return $data;

	}



	private function get_livestock_keepers(): array {

		$params['status'] = 0;

        $sql = 'SELECT sp.id, a.date_created,a.email, sp.name , sp.phone_number,sp.account_id

				FROM livestock_keepers sp 

				INNER JOIN account a on sp.account_id = a.id where a.status = :status';

        $rows = $this->model->query_bind($sql,$params,'object');

		$data =[];

		foreach ($rows as $row) {

			$data[] = [

				'registration_date' => date('Y-m-d', $row->date_created),

				'full_name' => strtoupper($row->name),

				'registration_number' => $row->phone_number,

				'email' => $row->email,

				'id' => $row->id

			];

		}



		return $data;

	}

	private function get_livestock_transporters(): array {

		$params['status'] = 0;

        $sql = 'SELECT sp.id, a.date_created,a.email, sp.company_name,sp.reg_number, sp.account_id

				FROM transporters sp 

				INNER JOIN account a on sp.account_id = a.id where a.status = :status';

        $rows = $this->model->query_bind($sql,$params,'object');

		$data =[];

		foreach ($rows as $row) {

			$data[] = [

				'registration_date' => date('Y-m-d', $row->date_created),

				'full_name' => strtoupper($row->company_name),

				'registration_number' => $row->reg_number,

				'email' => $row->email,

				'id' => $row->id

			];

		}



		return $data;



	}











	private function service_provider_record($id): object {

		$sql = 'SELECT a.email,a.comment, sp.* 

				FROM service_providers sp 

				INNER JOIN account a on sp.account_id = a.id 

				WHERE sp.id = :id';

		$params['id'] = (int)$id;

		$rows = $this->model->query_bind($sql, $params, 'object');

		if(!$rows){

			$this->template('error_404');

            die();

		}

		$record = $rows[0];

		$record->reg_certificate_link = BASE_URL.'public/files/'.$record->reg_certificate;

		$record->company_logo_link = BASE_URL.'public/files/'.$record->company_logo;

		$record->vet_reg_certificate_link = BASE_URL.'public/files/'.$record->vet_reg_certificate;



		$record->full_name = strtoupper($record->company_name);

		$record->nldpi_number = $this->format_nldpi_number($record->nldpi_number);



		$this->module('service_providers');

		$state_options = $this->service_providers->state_options();

		$record->state = $state_options[$record->state];

		return $record;

	}



	private function veterinary_professional_record($id): object {

		$sql = 'SELECT a.email,a.comment, sp.*  

				FROM veterinary_professionals sp 

				INNER JOIN account a on sp.account_id = a.id 

				WHERE sp.id = :id';

		$params['id'] = (int)$id;

		$rows = $this->model->query_bind($sql, $params, 'object');

		if(!$rows){

			$this->template('error_404');

            die();

		}

		$record = $rows[0];

		$record->reg_certificate_link = BASE_URL.'public/files/'.$record->reg_certificate;

		$record->full_name = strtoupper($record->firstname . ' ' . $record->lastname);

		$record->nldpi_number = $this->format_nldpi_number($record->nldpi_number);



		$this->module('veterinary_professionals');

		$professional_body_options = $this->veterinary_professionals->professional_body_options();

		$record->professional_body = $professional_body_options[$record->professional_body];

		return $record;

	}



	private function livestock_keeper_record($id): object {

		$sql = 'SELECT a.email,a.comment, sp.* 

				FROM livestock_keepers sp 

				INNER JOIN account a on sp.account_id = a.id 

				WHERE sp.id = :id';

		$params['id'] = (int)$id;

		$rows = $this->model->query_bind($sql, $params, 'object');

		if(!$rows){

			$this->template('error_404');

			die();

		}

		$record = $rows[0];

		$record->full_name = strtoupper($record->name);

		$record->nldpi_number = $this->format_nldpi_number($record->nldpi_number);



		$this->module('livestock_keepers');

		$state_options = $this->livestock_keepers->state_options();

		$record->state = $state_options[$record->state];

		$type_options = $this->livestock_keepers->type_options();

		$record->type = $type_options[$record->type];

		return $record;

	}



	private function livestock_transporter_record($id): object {

		$sql = 'SELECT a.email,a.comment, sp.* 

				FROM transporters sp 

				INNER JOIN account a on sp.account_id = a.id 

				WHERE sp.id = :id';

		$params['id'] = (int)$id;

		$rows = $this->model->query_bind($sql, $params, 'object');

		if(!$rows){

			$this->template('error_404');

			die();

		}

		$record = $rows[0];

		$record->reg_certificate_link = BASE_URL.'public/files/'.$record->reg_certificate;

		$record->transport_certificate_link = BASE_URL.'public/files/'.$record->transport_certificate;

		$record->tax_certificate_link = BASE_URL.'public/files/'.$record->tax_certificate;

		$record->insurance_certificate_link = BASE_URL.'public/files/'.$record->insurance_certificate;



		$record->full_name = strtoupper($record->company_name);

		$record->nldpi_number = $this->format_nldpi_number($record->nldpi_number);

		return $record;

	}


	 // Access control for the Admin
function _make_sure_allowed() {

    $this->module('trongate_tokens');

    $token = $this->trongate_tokens->_attempt_get_valid_token();
 
    if (!$token) {

        redirect('users/login');

    }
	
    return $token;
  }







   

}