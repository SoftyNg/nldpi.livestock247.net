<div class="content-wrapper">
    <div class="container-fluid">
        <div class="animal-form-name mb-5">
            <h5 class="h3 mb-0 ml-4">Livestock Farmer/Keeper</h5>
            <p class="pl-4 mt-1">Apply to Become a Verified Livestock Farmer/Keeper</p>
        </div>
     
        <div class="register-animal-form my-4 px-4">
            <?php echo form_open($location);?>
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
                                echo form_input('name', $name,  $attr1);
                            ?>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('name')) ? validation_errors('name') : ''); ?></span>
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
                                echo form_label('Phone Number');
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
                                echo form_input('email', $email,  $attr1);
                            ?>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('email')) ? validation_errors('email') : ''); ?></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Type',
                                    'required' => true,
                                    'autocomplete' => 'off'
                                ];
                                echo form_label('Type');
                                echo form_dropdown('type', $type_options, $type, $attr1);
                            ?>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('type')) ? validation_errors('type') : ''); ?></span>
                        </div>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter State',
                                    'required' => true,
                                    'autocomplete' => 'off'
                                ];
                                echo form_label('State');
                                echo form_dropdown('state', $state_options, $state, $attr1);
                            ?>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('state')) ? validation_errors('state') : ''); ?></span>
                        </div>
                    </div> 
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Address',
                                    'required' => true,
                                    'autocomplete' => 'off'
                                ];
                                echo form_label('Address');
                                echo form_input('address', $address,  $attr1);
                            ?>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('address')) ? validation_errors('address') : ''); ?></span>
                        </div>
                    </div>               
                </div>

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
                <hr>
                <div class="form-footer d-flex justify-content-between"> 
                    <div>
                        <?php
                        $btn_cancel_attr = [
                            'class' => 'btn btn-outline-dark'
                        ];
                        echo anchor($cancel_url, 'Cancel', $btn_cancel_attr);
                        ?>
                    </div>
                    <div id="step1Buttons" class="step-buttons d-flex flex-row"> 
                        <?php
                        $btn_submit_application_attr = [
                            'class' => 'btn btn-success'
                        ];
                        echo form_submit('submit', 'Submit Application', $btn_submit_application_attr);
                        ?>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<style>
    .validation-error-alert {
        display: block;
    }
</style>