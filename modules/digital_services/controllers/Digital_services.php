<?php

class Digital_services extends Trongate {

    function index(): void {
        $data = [];
        $data['title'] = 'Digital Services';
        $data['view_file'] = 'index';
        $data['view_module'] = 'digital_services';

        // Fetch individual services with status = 1
        $markets = $this->get_where('livestock_markets', 'status', 1);
        $vets = $this->get_where('veterinary_professionals', 'status', 1);
        $transporters =  $this->get_where('transporters', 'status', 1);
        $keepers =  $this->get_where('livestock_keepers', 'status', 1);
        $health =  $this->get_where('service_providers', 'status', 1);  // fixed from 'livestock_keepers'

        $data['markets'] = $markets ?? [];
        $data['vets'] = $vets ?? [];
        $data['transporters'] = $transporters ?? [];
        $data['keepers'] = $keepers ?? [];
        $data['health'] = $health ?? [];
       

        // Merge and tag for default display
        $all = array_merge(
            $this->tag_items($markets, 'market'),
            $this->tag_items($vets, 'vet-professional'),
            $this->tag_items($transporters, 'transporter'),
            $this->tag_items($keepers, 'farmerskeepers'),
            $this->tag_items($health, 'service-provider')
        );

        $data['all_services'] = $all;

        $this->template('public', $data);
    }

    function get_where($table, $column, $value)
    {
        $sql = "SELECT * FROM $table WHERE $column = :$column";
        $params = [$column => $value];
        return $this->model->query_bind($sql, $params, 'array');
    }

    private function tag_items($items, $type) {
         if (!is_array($items)) {
        return []; // return empty array instead of error
    }

    foreach ($items as &$item) {
        $item['type'] = $type;
    }

    return $items;
    }


function fetch_services()
{
    $service_type = post('type');
    $keyword = strtolower(trim(post('keyword') ?? ''));
    $data = [];

    switch ($service_type) {
        case 'vetProfessionals':
        case 'vet-professionals':
            $vets = $this->get_where('veterinary_professionals', 'status', 1);
            $data['all_services'] = $this->tag_items($vets, 'vet professional');
            break;

        case 'healthServices':
        case 'health-services':
            $health = $this->get_where('service_providers', 'status', 1);
            $data['all_services'] = $this->tag_items($health, 'service-provider');
            break;

        case 'markets':
            $markets = $this->get_where('livestock_markets', 'status', 1);
            $data['all_services'] = $this->tag_items($markets, 'market');
            break;

        case 'farmersKeepers':
        case 'farmerskeepers':
            $keepers = $this->get_where('livestock_keepers', 'status', 1);
            $data['all_services'] = $this->tag_items($keepers, 'farmerskeepers');
            break;

        case 'transporters':
            $transporters = $this->get_where('transporters', 'status', 1);
            $data['all_services'] = $this->tag_items($transporters, 'transporter');
            break;

        default:
            $markets      = $this->tag_items($this->get_where('livestock_markets', 'status', 1), 'market');
            $vets         = $this->tag_items($this->get_where('veterinary_professionals', 'status', 1), 'vet professional');
            $transporters = $this->tag_items($this->get_where('transporters', 'status', 1), 'transporter');
            $keepers      = $this->tag_items($this->get_where('livestock_keepers', 'status', 1), 'farmerskeepers');
            $health       = $this->tag_items($this->get_where('service_providers', 'status', 1), 'service-provider');

            $data['all_services'] = array_merge($markets, $vets, $transporters, $keepers, $health);
            break;
    }

    // ✅ Apply search filter if keyword is present
    if ($keyword !== '') {
        $data['all_services'] = array_filter($data['all_services'], function ($item) use ($keyword) {
            return str_contains(strtolower(json_encode($item)), $keyword);
        });
    }

    $this->view('service_list_partial', $data);
}


private function infer_type($service_type)
{
    return match ($service_type) {
        'vetProfessionals' => 'vet-professional',
        'healthServices' => 'service-provider',
        'markets' => 'market',
        'farmersKeepers' => 'farmerskeepers',
        'transporters' => 'transporter',
        default => 'unknown'
    };
}
}
