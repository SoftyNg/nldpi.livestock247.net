<h1><?= $headline ?></h1>
<?= validation_errors() ?>
<div class="card">
    <div class="card-heading">
        Livestock_market Details
    </div>
    <div class="card-body">
        <?php
        echo form_open($form_location);
        echo form_label('nldpi_number');
        echo form_input('nldpi_number', $nldpi_number, array("placeholder" => "Enter nldpi number"));
        echo form_label('name');
        echo form_input('name', $name, array("placeholder" => "Enter name"));
        echo form_label('state');
        $state= array(
            ''  => 'Select state',
        );
        echo form_dropdown('state', $state, '', array("id" =>"state"));
        echo form_label('lga');
        $lga= array(
            ''  => 'Select local government',
        );
        echo form_dropdown('lga', $lga, '', array("id" =>"localG"));
        echo form_label('address');
        echo form_input('address', $address, array("placeholder" => "Enter address"));
        echo form_label('operating_days');
        echo form_input('operating_days', $operating_days, array("placeholder" => "Enter operating days"));
        echo form_label('types_of_livestock_traded');
        echo form_input('types_of_livestock_traded', $types_of_livestock_traded, array("placeholder" => "Enter types of livestock traded"));
        echo form_label('major_breeds_found');
        echo form_input('major_breeds_found', $major_breeds_found, array("placeholder" => "Enter major breeds found"));
        echo form_label('lon');
        echo form_input('lon', $lon, array("placeholder" => "Enter lon"));
        echo form_label('lat');
        echo form_input('lat', $lat, array("placeholder" => "Enter lat"));
        echo form_label('status');
        echo form_input('status', $status, array("placeholder" => "Enter status"));
        echo form_label('ownership_type');
        echo form_input('ownership_type', $ownership_type, array("placeholder" => "Enter ownership type"));
        echo form_label('market_leadership_details');
        echo form_input('market_leadership_details', $market_leadership_details, array("placeholder" => "Enter market leadership details"));
        echo form_label('email');
        echo form_email('email', $email, array("placeholder" => "Enter email"));
        echo form_label('phone');
        echo form_input('phone', $phone, array("placeholder" => "Enter phone"));
        echo form_label('website');
        echo form_input('website', $website, array("placeholder" => "Enter website"));
        echo form_submit('submit', 'Submit');
        echo anchor($cancel_url, 'Cancel', array('class' => 'button alt'));
        echo form_close();
        ?>
    </div>
</div>