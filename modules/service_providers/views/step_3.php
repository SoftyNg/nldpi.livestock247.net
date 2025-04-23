<div class="row mt-3">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="form-group">
            <label><strong>Veterinary Professional</strong></label>
            <p>A veterinary professional is required on your management team. Please verify their details below.</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <?php
                $attr1 = [
                    'class' => 'form-control',
                    'placeholder' => 'Enter Name',
                    'required' => true,
                    'autocomplete' => 'off'
                ];
                echo form_label('Name');
                echo form_input('vet_name', $vet_name,  $attr1);
            ?>
            <span class="text-danger"><?php  echo (!empty(validation_errors('vet_name')) ? validation_errors('vet_name') : ''); ?></span>
        </div>
    </div>
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
                echo form_input('vet_email', $vet_email,  $attr1);
            ?>
            <span class="text-danger"><?php  echo (!empty(validation_errors('vet_email')) ? validation_errors('vet_email') : ''); ?></span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <?php
                $attr1 = [
                    'class' => 'form-control',
                    'placeholder' => 'Enter Position',
                    'required' => true,
                    'autocomplete' => 'off'
                ];
                echo form_label('Position');
                echo form_input('vet_position', $vet_position,  $attr1);
            ?>
            <span class="text-danger"><?php  echo (!empty(validation_errors('vet_position')) ? validation_errors('vet_position') : ''); ?></span>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <?php
                $attr1 = [
                    'class' => 'form-control',
                    'placeholder' => 'Enter Registration Number',
                    'autocomplete' => 'off'
                ];
                echo form_label('Registration Number');
                echo form_input('vet_reg_number', $vet_reg_number,  $attr1);
            ?>
            <span class="text-danger"><?php  echo (!empty(validation_errors('vet_reg_number')) ? validation_errors('vet_reg_number') : ''); ?></span>
        </div>
    </div>               
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label>Upload Registration Certificate<span class="text-danger">*</span></label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-upload"></i></span>
                </div>
                <?php
                    $attr1 = [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Registration Number',
                        'autocomplete' => 'off',
                        'required' => true,
                        'accept' => '.jpg, .png, .pdf'
                    ];
                    echo form_file_select('vet_reg_certificate', $attr1);
                ?>
            </div>
            <span class="text-danger"><?php  echo (!empty(validation_errors('vet_reg_certificate')) ? validation_errors('vet_reg_certificate') : ''); ?></span>
        </div>

    </div> 
</div>