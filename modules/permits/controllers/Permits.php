<?php
class Permits extends Trongate {

	function index(): void{

       $this->loading();
    }
    function loading(){
        $data = [
            'title' => 'Loading Permits',
            'view_file' => 'loading',
            'view_module' => 'permits'
        ];
        $this->template('admin', $data);
    }
    function offloading(){
        $data = [
            'title' => 'Off Loading Permits',
            'view_file' => 'off_loading',
            'view_module' => 'permits'
        ];
        $this->template('admin', $data);
    }
    function show($account_type = 'farmer'): void{
        $data = [
            'view_file' => 'serviceproviders',
            'view_module' => 'permits'
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
        
        $this->template('admin', $data);
    }

}