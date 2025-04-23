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

                    'placeholder' => 'Enter  CAC Registration Number',

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

            <?php

                $attr1 = [

                    'class' => 'form-control',

                    'placeholder' => 'Enter Capitalization',

                    'required' => true,

                    'autocomplete' => 'off'

                ];

                echo form_label('Capitalization');

                echo form_number('capitalization', $capitalization,  $attr1);

            ?>

            <span class="text-danger"><?php  echo (!empty(validation_errors('capitalization')) ? validation_errors('capitalization') : ''); ?></span>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

        <div class="form-group">

            <?php

                $attr1 = [

                    'class' => 'form-control',

                    'placeholder' => 'Enter Years In Operation',

                    'required' => true,

                    'autocomplete' => 'off'

                ];

                echo form_label('Years In Operation');

                echo form_number('year_in_operation', $year_in_operation,  $attr1);

            ?>

            <span class="text-danger"><?php  echo (!empty(validation_errors('year_in_operation')) ? validation_errors('year_in_operation') : ''); ?></span>

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

<div class="row">

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

        <div class="form-group">

            <?php

                $attr1 = [

                    'class' => 'form-control',

                    'placeholder' => 'Enter Website',

                    'required' => true,

                    'autocomplete' => 'off'

                ];

                echo form_label('Website');

                echo form_input('website', $website,  $attr1);

            ?>

            <span class="text-danger"><?php  echo (!empty(validation_errors('website')) ? validation_errors('website') : ''); ?></span>

        </div>

    </div>

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

            <label>Upload Company Logo<span class="text-danger">*</span></label>

            <div class="input-group mb-3">

                <div class="input-group-prepend">

                    <span class="input-group-text"><i class="fa fa-upload"></i></span>

                </div>

                <?php

                    $attr1 = [

                        'class' => 'form-control',

                        'placeholder' => 'Enter Company Logo',

                        'autocomplete' => 'off',

                        'required' => true,

                        'accept' => '.jpg, .png, .pdf'

                    ];

                    echo form_file_select('company_logo', $attr1);

                ?>

            </div>

            <span class="text-danger"><?php  echo (!empty(validation_errors('company_logo')) ? validation_errors('company_logo') : ''); ?></span>

        </div>



    </div> 

</div>

