<div class="row mt-3">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="form-group">
            <label><strong>Password</strong></label>
            <p>Create a secure password to use with your email address for logging into this portal and managing your account.</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <?php
                $attr1 = [
                    'class' => 'form-control',
                    'placeholder' => 'Enter Password',
                    'required' => true,
                    'autocomplete' => 'off'
                ];
                echo form_label('Password');
                echo form_password('password', '',  $attr1);
            ?>
            <span class="text-danger"><?php  echo (!empty(validation_errors('password')) ? validation_errors('password') : ''); ?></span>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <?php
                $attr1 = [
                    'class' => 'form-control',
                    'placeholder' => 'Enter Confirm Password',
                    'required' => true,
                    'autocomplete' => 'off'
                ];
                echo form_label('Confirm Password');
                echo form_password('confirm_password', '',  $attr1);
            ?>
            <span class="text-danger"><?php  echo (!empty(validation_errors('confirm_password')) ? validation_errors('confirm_password') : ''); ?></span>
        </div>
    </div>
</div>