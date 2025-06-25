<h1><?= $headline ?></h1>
<?= validation_errors() ?>
<div class="card">
    <div class="card-heading">
        Animal_registration Details
    </div>
    <div class="card-body">
        <?php
        echo form_open($form_location);
        echo form_label('nldpi_number');
        echo form_input('nldpi_number', $nldpi_number, array("placeholder" => "Enter nldpi number'"));
        echo form_label('id_number');
        echo form_input('id_number', $id_number, array("placeholder" => "Enter identification number from number bank"));
        echo form_label('name');
        echo form_input('name', $name, array("placeholder" => "Enter name"));
        echo form_label('breed');
        $breed= array(
            ''  => 'Select types of animal',
            'sokoto gudali'  => 'Sokoto gudali',
            'bororo'  => 'Bororo',
            'white fulani'    => 'White fulani',
            'bokolo'    => 'Bokolo',
            'bunaji'    => 'Bunaji'
        );
        echo form_dropdown('breed', $breed, '');
        echo form_label('sex');
        echo '<div>';
        echo form_radio('sex', 'male', false) . ' Male ';
        echo form_radio('sex', 'female', false) . ' Female ';
        echo '</div>';
        echo form_label('owner_number');
        echo form_input('owner_number', $owner_number, array("placeholder" => "Enter owner's number"));
        echo form_label('weight');
        $weight = array(
            ''  => 'Select weight range',
            '6 - 30kg'  => '6 - 30kg',
            '51 - 80kg'  => '51 - 80kg',
            '91 - 120kg'    => '91 - 120kg',
        );
        echo form_dropdown('weight', $weight, '');
        echo form_label('approx_age');
        $approx_age = array(
            ''  => 'Select age range',
            '0 - 6 months'  => '0 - 6 months',
            '6 - 12 months'  => '6 - 12 months',
            '1 - 3 years'    => '1 - 3 years',
        );
        echo form_dropdown('approx_age', $approx_age, '');
        echo form_label('colour');
        echo form_input('colour', $colour, array("placeholder" => "Enter colour"));
        echo form_label('type_of_animal');
        $type_of_animal= array(
            ''  => 'Select types of animal',
            'goat'  => 'Goat',
            'ram'  => 'Ram',
            'cow' => 'Cow'
        );
        echo form_dropdown('type_of_animal', $type_of_animal, '');
        echo form_label('date_created');
        $attr = array("class"=>"datetime-picker", "autocomplete"=>"off", "placeholder"=>"Select reg date");
        echo form_input('date_created', $reg_date, $attr);
        echo form_label('reg_point');
        $reg_point = array(
            ''  => 'Select registration point',
            'market'  => 'Market',
            "owner's premises"  => "Owner's premises",
            'ranch'    => 'Ranch',
        );
        echo form_dropdown('reg_point', $reg_point, '');
        echo form_label('reg_by');
        //will service provider will be fetch from the database
        echo form_input('reg_by', $reg_by, array("placeholder" => "Enter service provider's number"));
        echo form_submit('submit', 'Submit');
        echo anchor($cancel_url, 'Cancel', array('class' => 'button alt'));
        echo form_close();
        ?>
    </div>
</div>