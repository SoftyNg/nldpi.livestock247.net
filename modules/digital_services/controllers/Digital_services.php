<?php
class Digital_services extends Trongate {

	function index(): void{

        $data = [
            'title' => 'Digital Services',
            'view_file' => 'index',
            'view_module' => 'digital_services'
        ];
        $this->template('public', $data);
    }

    function show($account_type = 'farmer'): void{
        $data = [
            'view_file' => 'serviceproviders',
            'view_module' => 'digital_services'
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