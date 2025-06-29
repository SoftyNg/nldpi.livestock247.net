<?php

class Digital_services extends Trongate {

    /**
     * Main entry point for the Digital Services module
     */
    function index(): void {
        $data = [];
        $data['title'] = 'Digital Services';
        $data['view_file'] = 'index';
        $data['view_module'] = 'digital_services';

        // Fetch active records from each service category
        $markets      = $this->get_where('livestock_markets', 'status', 1);
        $vets         = $this->get_where('veterinary_professionals', 'status', 1);
        $transporters = $this->get_where('transporters', 'status', 1);
        $keepers      = $this->get_where('livestock_keepers', 'status', 1);
        $health       = $this->get_where('service_providers', 'status', 1); // Corrected from 'livestock_keepers'

        // Assign to view variables (fallback to empty arrays)
        $data['markets']      = $markets ?? [];
        $data['vets']         = $vets ?? [];
        $data['transporters'] = $transporters ?? [];
        $data['keepers']      = $keepers ?? [];
        $data['health']       = $health ?? [];

        // Merge all service arrays and tag them with a type
        $all = array_merge(
            $this->tag_items($markets, 'market'),
            $this->tag_items($vets, 'vet-professional'),
            $this->tag_items($transporters, 'transporter'),
            $this->tag_items($keepers, 'farmerskeepers'),
            $this->tag_items($health, 'service-provider')
        );

        $data['all_services'] = $all;

        // Load the main template
        $this->template('public', $data);
    }

    /**
     * Reusable DB fetch method using prepared binding
     */
    function get_where($table, $column, $value) {
        $sql = "SELECT * FROM $table WHERE $column = :$column";
        $params = [$column => $value];
        return $this->model->query_bind($sql, $params, 'array');
    }

    /**
     * Add a 'type' field to each item in an array
     */
    private function tag_items($items, $type) {
        if (!is_array($items)) {
            return []; // Return empty array on invalid input
        }

        foreach ($items as &$item) {
            $item['type'] = $type;
        }

        return $items;
    }

    /**
     * Fetch services dynamically based on POSTed type and optional keyword
     */
    function fetch_services() {
        $service_type = post('type');
        $keyword = strtolower(trim(post('keyword') ?? ''));
        $data = [];

        // Determine which service to fetch
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
                // Fetch all categories if none matches
                $markets      = $this->tag_items($this->get_where('livestock_markets', 'status', 1), 'market');
                $vets         = $this->tag_items($this->get_where('veterinary_professionals', 'status', 1), 'vet professional');
                $transporters = $this->tag_items($this->get_where('transporters', 'status', 1), 'transporter');
                $keepers      = $this->tag_items($this->get_where('livestock_keepers', 'status', 1), 'farmerskeepers');
                $health       = $this->tag_items($this->get_where('service_providers', 'status', 1), 'service-provider');

                $data['all_services'] = array_merge($markets, $vets, $transporters, $keepers, $health);
                break;
        }

        // 🔍 Optional search filter by keyword
        if ($keyword !== '') {
            $data['all_services'] = array_filter($data['all_services'], function ($item) use ($keyword) {
                return str_contains(strtolower(json_encode($item)), $keyword);
            });
        }

        // Return partial view with results
        $this->view('service_list_partial', $data);
    }

    /**
     * Match raw type name to human-readable label (currently unused)
     */
    private function infer_type($service_type) {
        return match ($service_type) {
            'vetProfessionals' => 'vet-professional',
            'healthServices'   => 'service-provider',
            'markets'          => 'market',
            'farmersKeepers'   => 'farmerskeepers',
            'transporters'     => 'transporter',
            default            => 'unknown'
        };
    }
}
