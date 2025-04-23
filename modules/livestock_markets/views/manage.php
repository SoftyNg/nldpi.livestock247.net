<h1><?= out($headline) ?></h1>
<?php
flashdata();
echo '<p>'.anchor('livestock_markets/create', 'Create New Livestock_market Record', array("class" => "button"));
if(strtolower(ENV) === 'dev') {
    echo anchor('api/explorer/livestock_markets', 'API Explorer', array("class" => "button alt"));
}
echo '</p>';
echo Pagination::display($pagination_data);
if (count($rows)>0) { ?>
    <table id="results-tbl">
        <thead>
            <tr>
                <th colspan="17">
                    <div>
                        <div><?php
                        echo form_open('livestock_markets/manage/1/', array("method" => "get"));
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
                <th>nldpi_number</th>
                <th>name</th>
                <th>state</th>
                <th>lga</th>
                <th>address</th>
                <th>operating_days</th>
                <th>types_of_livestock_traded</th>
                <th>major_breeds_found</th>
                <th>lon</th>
                <th>lat</th>
                <th>status</th>
                <th>ownership_type</th>
                <th>market_leadership_details</th>
                <th>email</th>
                <th>phone</th>
                <th>website</th>
                <th style="width: 20px;">Action</th>            
            </tr>
        </thead>
        <tbody>
            <?php 
            $attr['class'] = 'button alt';
            foreach($rows as $row) { ?>
            <tr>
                <td><?= out($row->nldpi_number) ?></td>
                <td><?= out($row->name) ?></td>
                <td><?= out($row->state) ?></td>
                <td><?= out($row->lga) ?></td>
                <td><?= out($row->address) ?></td>
                <td><?= out($row->operating_days) ?></td>
                <td><?= out($row->types_of_livestock_traded) ?></td>
                <td><?= out($row->major_breeds_found) ?></td>
                <td><?= out($row->lon) ?></td>
                <td><?= out($row->lat) ?></td>
                <td><?= out($row->status) ?></td>
                <td><?= out($row->ownership_type) ?></td>
                <td><?= out($row->market_leadership_details) ?></td>
                <td><?= out($row->email) ?></td>
                <td><?= out($row->phone) ?></td>
                <td><?= out($row->website) ?></td>
                <td><?= anchor('livestock_markets/show/'.$row->id, 'View', $attr) ?></td>        
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