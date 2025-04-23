<h1><?= $headline ?></h1>
<?= validation_errors() ?>
<div class="card">
    <div class="card-heading">
        Transporter_registration Details
    </div>
    <div class="card-body">
        <?php
        echo form_open($form_location);
        echo form_label('company_name');
        echo form_input('company_name', $company_name, array("placeholder" => "Enter company_name"));
        echo form_label('registration_number');
        echo form_input('registration_number', $registration_number, array("placeholder" => "Enter registration_number"));
        echo form_label('phone_number');
        echo form_input('phone_number', $phone_number, array("placeholder" => "Enter phone_number"));
        echo form_label('emal <span>(optional)</span>');
        echo form_email('emal', $emal, array("placeholder" => "Enter emal"));
        echo form_label('operating_state');
        echo form_textarea('operating_state', $operating_state, array("placeholder" => "Enter operating_state"));
        echo form_label('no_of_vehicle_in_fleet');
        echo form_input('no_of_vehicle_in_fleet', $no_of_vehicle_in_fleet, array("placeholder" => "Enter no_of_vehicle_in_fleet"));
        echo form_label('cac_certificate');
        echo form_input('cac_certificate', $cac_certificate, array("placeholder" => "Enter cac_certificate"));
        echo form_label('trans_licence');
        echo form_input('trans_licence', $trans_licence, array("placeholder" => "Enter trans_licence"));
        echo form_label('insur_certificate');
        echo form_input('insur_certificate', $insur_certificate, array("placeholder" => "Enter insur_certificate"));
        echo form_label('tax_id');
        echo form_input('tax_id', $tax_id, array("placeholder" => "Enter tax_id"));
        echo form_label('vehicle_reg_number');
        echo form_input('vehicle_reg_number', $vehicle_reg_number, array("placeholder" => "Enter vehicle_reg_number"));
        echo form_label('vehicle_type');
        echo form_input('vehicle_type', $vehicle_type, array("placeholder" => "Enter vehicle_type"));
        echo form_label('carrying_cap');
        echo form_input('carrying_cap', $carrying_cap, array("placeholder" => "Enter carrying_cap"));
        echo form_label('vehicle_photo');
        echo form_input('vehicle_photo', $vehicle_photo, array("placeholder" => "Enter vehicle_photo"));
        echo form_label('password');
        echo form_input('password', $password, array("placeholder" => "Enter password"));
        echo form_submit('submit', 'Submit');
        echo anchor($cancel_url, 'Cancel', array('class' => 'button alt'));
        echo form_close();
        ?>
    </div>
</div>