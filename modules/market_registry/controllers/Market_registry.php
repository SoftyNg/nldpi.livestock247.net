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
        

		$data['title'] = 'Dashboard';

		$data['view_module'] = 'market_registry';

		$data['view_file'] = 'dashboard';

		$this->template('admin', $data);

	}

}