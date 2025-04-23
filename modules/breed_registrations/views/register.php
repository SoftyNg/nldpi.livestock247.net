<div class="content-wrapper">
    <div class="container-fluid">
        <div class="animal-form-name mb-5">
            <h5 class="h3 mb-0 ml-4"><?= $headline ?></h5>
            <p class="pl-4 mt-1"></p>
        </div>
     
        <div class="register-animal-form my-4 px-4">
            <?php echo form_open_upload($location);?>
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
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Livestock Type',
                                    'required' => true,
                                    'autocomplete' => 'off'
                                ];
                                echo form_label('Livestock Type');
                                echo form_dropdown('livestock_type', $livestock_type_options, $livestock_type, $attr1);
                            ?>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('livestock_type')) ? validation_errors('livestock_type') : ''); ?></span>
                        </div>
                    </div>   
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Breed Type',
                                    'required' => true,
                                    'autocomplete' => 'off'
                                ];
                                echo form_label('Breed Type');
                                echo form_dropdown('breed_type', $breed_type_options, $breed_type, $attr1);
                            ?>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('breed_type')) ? validation_errors('breed_type') : ''); ?></span>
                        </div>
                    </div>   
                </div>
                <div class="row">              
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Description',
                                    'autocomplete' => 'off'
                                ];
                                echo form_label('Description');
                                echo form_textarea('description', $description,  $attr1);
                            ?>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('description')) ? validation_errors('description') : ''); ?></span>
                        </div>
                    </div>                
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Upload Picture<span class="text-danger"></span></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-upload"></i></span>
                                </div>
                                <?php
                                    $attr1 = [
                                        'class' => 'form-control',
                                        'autocomplete' => 'off',
                                        'accept' => '.jpg, .png, .pdf'
                                    ];
                                    echo form_file_select('picture', $attr1);
                                ?>
                            </div>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('picture')) ? validation_errors('picture') : ''); ?></span>
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
                        echo form_submit('submit', 'Register', $btn_submit_application_attr);
                        ?>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>