<h1><?= out($headline) ?></h1>
<?php
flashdata();
echo '<p>'.anchor('transporter_registrations/create', 'Create New Transporter_registration Record', array("class" => "button"));
if(strtolower(ENV) === 'dev') {
    echo anchor('api/explorer/transporter_registrations', 'API Explorer', array("class" => "button alt"));
}
echo '</p>';
echo Pagination::display($pagination_data);
if (count($rows)>0) { ?>
    <table id="results-tbl">
        <thead>
            <tr>
                <th colspan="15">
                    <div>
                        <div><?php
                        echo form_open('transporter_registrations/manage/1/', array("method" => "get"));
                        echo form_search('searchphrase', '', array("placeholder" => "Search records..."));
                        echo form_submit('submit', 'Search', array("class" => "alt"));
                        echo form_close();
                        ?></div>
                        <div>Records Per Page: <?php
                        $dropdown_attr['onchange'] = 'setPerPage()';
                        echo form_dropdown('per_page', $per_page_options, $selected_per_page, $dropdown_attr); 
                        ?></div>

                    </div>                    
                </th>
            </tr>
            <tr>
                <th>company_name</th>
                <th>registration_number</th>
                <th>phone_number</th>
                <th>emal</th>
                <th>no_of_vehicle_in_fleet</th>
                <th>cac_certificate</th>
                <th>trans_licence</th>
                <th>insur_certificate</th>
                <th>tax_id</th>
                <th>vehicle_reg_number</th>
                <th>vehicle_type</th>
                <th>carrying_cap</th>
                <th>vehicle_photo</th>
                <th>password</th>
                <th style="width: 20px;">Action</th>            
            </tr>
        </thead>
        <tbody>
            <?php 
            $attr['class'] = 'button alt';
            foreach($rows as $row) { ?>
            <tr>
                <td><?= out($row->company_name) ?></td>
                <td><?= out($row->registration_number) ?></td>
                <td><?= out($row->phone_number) ?></td>
                <td><?= out($row->emal) ?></td>
                <td><?= out($row->no_of_vehicle_in_fleet) ?></td>
                <td><?= out($row->cac_certificate) ?></td>
                <td><?= out($row->trans_licence) ?></td>
                <td><?= out($row->insur_certificate) ?></td>
                <td><?= out($row->tax_id) ?></td>
                <td><?= out($row->vehicle_reg_number) ?></td>
                <td><?= out($row->vehicle_type) ?></td>
                <td><?= out($row->carrying_cap) ?></td>
                <td><?= out($row->vehicle_photo) ?></td>
                <td><?= out($row->password) ?></td>
                <td><?= anchor('transporter_registrations/show/'.$row->id, 'View', $attr) ?></td>        
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php 
    if(count($rows)>9) {
        unset($pagination_data['include_showing_statement']);
        echo Pagination::display($pagination_data);
    }
}
?>