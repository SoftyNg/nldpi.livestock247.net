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