<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label>Upload CAC Registration Certificate<span class="text-danger">*</span></label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-upload"></i></span>
                </div>
                <?php
                    $attr1 = [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Registration Certificate',
                        'autocomplete' => 'off',
                        'required' => true,
                        'accept' => '.jpg, .png, .pdf'
                    ];
                    echo form_file_select('reg_certificate', $attr1);
                ?>
            </div>
            <span class="text-danger"><?php  echo (!empty(validation_errors('reg_certificate')) ? validation_errors('reg_certificate') : ''); ?></span>
        </div>
    </div>  
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label>Upload Transportation License<span class="text-danger">*</span></label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-upload"></i></span>
                </div>
                <?php
                    $attr1 = [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Transportation License',
                        'autocomplete' => 'off',
                        'required' => true,
                        'accept' => '.jpg, .png, .pdf'
                    ];
                    echo form_file_select('transport_certificate', $attr1);
                ?>
            </div>
            <span class="text-danger"><?php  echo (!empty(validation_errors('transport_certificate')) ? validation_errors('transport_certificate') : ''); ?></span>
        </div>
    </div>  
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label>Upload Insurance Certificate<span class="text-danger">*</span></label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-upload"></i></span>
                </div>
                <?php
                    $attr1 = [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Insurance Certificate',
                        'autocomplete' => 'off',
                        'required' => true,
                        'accept' => '.jpg, .png, .pdf'
                    ];
                    echo form_file_select('insurance_certificate', $attr1);
                ?>
            </div>
            <span class="text-danger"><?php  echo (!empty(validation_errors('insurance_certificate')) ? validation_errors('insurance_certificate') : ''); ?></span>
        </div>
    </div>  
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <label>Upload Tax Certificate<span class="text-danger">*</span></label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-upload"></i></span>
                </div>
                <?php
                    $attr1 = [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Tax Certificate',
                        'autocomplete' => 'off',
                        'required' => true,
                        'accept' => '.jpg, .png, .pdf'
                    ];
                    echo form_file_select('tax_certificate', $attr1);
                ?>
            </div>
            <span class="text-danger"><?php  echo (!empty(validation_errors('tax_certificate')) ? validation_errors('tax_certificate') : ''); ?></span>
        </div>
    </div>  
</div>