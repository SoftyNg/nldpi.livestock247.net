<h1><?= out($headline) ?></h1>
<?php
flashdata();
echo '<p>'.anchor('animal_registrations/create', 'Create New Animal_registration Record', array("class" => "button"));
if(strtolower(ENV) === 'dev') {
    echo anchor('api/explorer/animal_registrations', 'API Explorer', array("class" => "button alt"));
}
echo '</p>';
echo Pagination::display($pagination_data);
if (count($rows)>0) { ?>
    <table id="results-tbl">
        <thead>
            <tr>
                <th colspan="14">
                    <div>
                        <div><?php
                        echo form_open('animal_registrations/manage/1/', array("method" => "get"));
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
                <th>id_number</th>
                <th>name</th>
                <th>breed</th>
                <th>sex</th>
                <th>owner_number</th>
                <th>weight</th>
                <th>approx_age</th>
                <th>colour</th>
                <th>type_of_animal</th>
                <th>reg_date</th>
                <th>reg_point</th>
                <th>reg_by</th>
                <th style="width: 20px;">Action</th>            
            </tr>
        </thead>
        <tbody>
            <?php 
            $attr['class'] = 'button alt';
            foreach($rows as $row) { ?>
            <tr>
                <td><?= out($row->nldpi_number) ?></td>
                <td><?= out($row->id_number) ?></td>
                <td><?= out($row->name) ?></td>
                <td><?= out($row->breed) ?></td>
                <td><?= out($row->sex) ?></td>
                <td><?= out($row->owner_number) ?></td>
                <td><?= out($row->weight) ?></td>
                <td><?= out($row->approx_age) ?></td>
                <td><?= out($row->colour) ?></td>
                <td><?= out($row->type_of_animal) ?></td>
                <td><?= date('l jS F Y \a\t H:i',  strtotime($row->reg_date)) ?></td>
                <td><?= out($row->reg_point) ?></td>
                <td><?= out($row->reg_by) ?></td>
                <td><?= anchor('animal_registrations/show/'.$row->id, 'View', $attr) ?></td>        
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