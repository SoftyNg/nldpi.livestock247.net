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

        $data['markets'] = $markets;
        $data['vets'] = $vets;
        $data['transporters'] = $transporters;
        $data['keepers'] = $keepers;
        $data['health'] = $health;

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
        foreach ($items as &$item) {
            $item['type'] = $type;
        }
        return $items;
    }






    function fetch_services()
    {
        $service_type = post('type'); // Get AJAX POST type

        switch ($service_type) {
            case 'vetProfessionals':
            case 'vet-professionals':
                $data['all_services'] = $this->tag_items(
                    $this->model->query('SELECT * FROM veterinary_professionals WHERE status = 1'),
                    'vet-professional'
                );
                break;

            case 'healthServices':
            case 'health-services':
                $data['all_services'] = $this->tag_items(
                    $this->model->query('SELECT * FROM service_providers WHERE status = 1'),
                    'service-provider'
                );
                break;

            case 'markets':
                $data['all_services'] = $this->tag_items(
                    $this->model->query('SELECT * FROM livestock_markets WHERE status = 1'),
                    'market'
                );
                break;

            case 'farmersKeepers':
            case 'farmerskeepers':
                $data['all_services'] = $this->tag_items(
                    $this->model->query('SELECT * FROM livestock_keepers WHERE status = 1'),
                    'farmerskeepers'
                );
                break;

            case 'transporters':
                $data['all_services'] = $this->tag_items(
                    $this->model->query('SELECT * FROM transporters WHERE status = 1'),
                    'transporter'
                );
                break;

            default:
                // Default to all merged & tagged services
                $vets = $this->model->query('SELECT * FROM veterinary_professionals WHERE status = 1');
                $health = $this->model->query('SELECT * FROM service_providers WHERE status = 1');
                $markets = $this->model->query('SELECT * FROM livestock_markets WHERE status = 1');
                $keepers = $this->model->query('SELECT * FROM livestock_keepers WHERE status = 1');
                $transporters = $this->model->query('SELECT * FROM transporters WHERE status = 1');

               $data['all_services'] = array_merge(
    $this->model->query('SELECT * FROM veterinary_professionals WHERE status = 1') ?? [],
    $this->model->query('SELECT * FROM service_providers WHERE status = 1') ?? [],
    $this->model->query('SELECT * FROM livestock_markets WHERE status = 1') ?? [],
    $this->model->query('SELECT * FROM livestock_keepers WHERE status = 1') ?? [],
    $this->model->query('SELECT * FROM transporters WHERE status = 1') ?? []
);

                break;
        }

       load('digital_services/service_list_partial', $data);
    }

    function test_partial()
{
    $data['all_services'] = ['egg','knife']; // dummy array
    load('digital_services/service_partials', $data);
}
}
