<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <?php
                $attr1 = [
                    'class' => 'form-control',
                    'placeholder' => 'Enter Company Name',
                    'required' => true,
                    'autocomplete' => 'off'
                ];
                echo form_label('Company Name');
                echo form_input('company_name', $company_name,  $attr1);
            ?>
            <span class="text-danger"><?php  echo (!empty(validation_errors('company_name')) ? validation_errors('company_name') : ''); ?></span>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <?php
                $attr1 = [
                    'class' => 'form-control',
                    'placeholder' => 'Enter Phone Number',
                    'required' => true,
                    'autocomplete' => 'off'
                ];
                echo form_label('Contact Phone Number');
                echo form_input('phone_number', $phone_number,  $attr1);
            ?>
            <span class="text-danger"><?php  echo (!empty(validation_errors('phone_number')) ? validation_errors('phone_number') : ''); ?></span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <?php
                $attr1 = [
                    'class' => 'form-control',
                    'placeholder' => 'Enter Email Address',
                    'required' => true,
                    'autocomplete' => 'off'
                ];
                echo form_label('Email Address');
                echo form_email('email', $email,  $attr1);
            ?>
            <span class="text-danger"><?php  echo (!empty(validation_errors('email')) ? validation_errors('email') : ''); ?></span>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <?php
                $attr1 = [
                    'class' => 'form-control',
                    'placeholder' => 'Enter Registration Number',
                    'required' => true,
                    'autocomplete' => 'off'
                ];
                echo form_label('Registration Number');
                echo form_input('reg_number', $reg_number,  $attr1);
            ?>
            <span class="text-danger"><?php  echo (!empty(validation_errors('reg_number')) ? validation_errors('reg_number') : ''); ?></span>
        </div>
    </div>  
</div>
<div class="row">       
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <?php
                $attr1 = [
                    'class' => 'form-control',
                    'placeholder' => 'Enter Livestock License Number',
                    'required' => true,
                    'autocomplete' => 'off'
                ];
                echo form_label('Trade Livestock License Number');
                echo form_input('trade_license_number', $trade_license_number,  $attr1);
            ?>
            <span class="text-danger"><?php  echo (!empty(validation_errors('trade_license_number')) ? validation_errors('trade_license_number') : ''); ?></span>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <?php
                $attr1 = [
                    'class' => 'form-control',
                    'placeholder' => 'Enter Number Of Vehicles',
                    'required' => true,
                    'autocomplete' => 'off'
                ];
                echo form_label('Number Of Vehicles In Fleet');
                echo form_number('no_vehicle_in_fleet', $no_vehicle_in_fleet,  $attr1);
            ?>
            <span class="text-danger"><?php  echo (!empty(validation_errors('no_vehicle_in_fleet')) ? validation_errors('no_vehicle_in_fleet') : ''); ?></span>
        </div>
    </div>
</div>
<div class="row">

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <?php
                $attr1 = [
                    'class' => 'form-control',
                    'placeholder' => 'Enter States',
                    'required' => true,
                    'autocomplete' => 'off',
                    'rows' => 3
                ];
                echo form_label('Operating States');
                echo form_textarea('operating_states', $operating_states, $attr1);
            ?>
            <span class="text-danger"><?php  echo (!empty(validation_errors('operating_states')) ? validation_errors('operating_states') : ''); ?></span>
        </div>
    </div>
</div>
