<?php  require_once ("_navigation.php"); ?>
<div class="baseline mb-4 p-4">

    <div class="base-left">

        <div class="dashboard-name">

            <h1 class="h3 mb-0">Register New Livestock</h1>

        </div>

    </div>

</div>
<div class="container-fluid pt-3" style="background-color:#F5FCF9;">
        <div class="register-animal-form my-4 px-4" style="background-color:#F5FCF9;">
        <?php
            if(isset($_SESSION['success'])){
                    echo "<div class=' alert alert-success alert-dismissable mt-2' style='text-align:center;'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>"
                            .$_SESSION['success'].
                        "</div>";
                        unset($_SESSION["success"]); 
            }

            if(isset($_SESSION['failure'])){
                    echo "<div class=' alert alert-danger alert-dismissable mt-2' style='text-align:center;'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>"
                            .$_SESSION['failure'].
                        "</div>";
                        unset($_SESSION["failure"]); 
            }
        ?> 
            <?php 
            
                echo form_open('veterinary_professionals/add_livestock_registration');
            ?>
                  
                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Identification Number (Chip Number)<span class="text-danger">*</span></label>
                            <select name="animal_id" class="form-control">
                                <option value=""> Select animal identification number</option>
                                <option value="1234561">1234561 </option>
                                <option value="1324575">1324575</option>
                                <option value='2316789'>2316789 </option>
                                <option value='4793248'>4793248</option>
                                <option value='9143578'>9143578</option>
                                <option value='6945289'>6945289</option>
                                <option value='1903724'>1903724</option>
                                <option value='8146932'>8146932</option>
                                <option value='8176932'>8176932</option>
                                <option value='1901124'>1901124</option>
                                <option value='9122932'>9122932</option>
                                <option value='7764932'>7764932</option>
                            </select>

                            <span class="text-danger"><?php  echo (!empty(validation_errors('animal_id')) ? validation_errors('animal_id') : ''); ?></span>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Colour</label>

                            <input type="text" class="form-control" name="colour" placeholder="Enter colour">
                            <span class="text-danger"><?php  echo (!empty(validation_errors('colour')) ? validation_errors('colour') : ''); ?></span>
                        </div>
                    </div>   

                </div>

                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Types of Livestock<span class="text-danger">*</span></label>
                            <select name="livestock_type" class="form-control">
                                <?php foreach($livestock_type_options as $key => $value): ?>
                                    <option value="<?= $key ?>"> <?= $value ?> </option>
                                <?php endforeach ?>
                            </select>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('type_of_animal')) ? validation_errors('type_of_animal') : ''); ?></span>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Breed<span class="text-danger">*</span></label>
                            <select name="breed" class="form-control">
                                <?php foreach($breed_options as $key => $value): ?>
                                    <option value="<?= $key ?>"> <?= $value ?> </option>
                                <?php endforeach ?>
                            </select>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('breed')) ? validation_errors('breed') : ''); ?></span>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Sex<span class="text-danger">*</span></label>
                            <select name="sex" class="form-control">
                                <?php foreach($sex_options as $key => $value): ?>
                                    <option value="<?= $key ?>"> <?= $value ?> </option>
                                <?php endforeach ?>
                            </select>
                            <span class="text-danger"><?php echo (!empty(validation_errors('sex')) ? validation_errors('sex') : ''); ?></span>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Weight Range(Kb/lsb)<span class="text-danger">*</span></label>
                            <select name="weight" class="form-control">
                                <?php foreach($weight_options as $key => $value): ?>
                                    <option value="<?= $key ?>"> <?= $value ?> </option>
                                <?php endforeach ?>
                            </select>
                            <span class="text-danger"> <?php  echo (!empty(validation_errors('weight')) ? validation_errors('weight') : ''); ?></span>
                        </div>
                    </div>                     

                </div>

                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Age Range<span class="text-danger">*</span></label>
                            <select name="approx_age" class="form-control">
                                <?php foreach($age_range_options as $key => $value): ?>
                                    <option value="<?= $key ?>"> <?= $value ?> </option>
                                <?php endforeach ?>
                            </select>
                            <span class="text-danger"> <?php  echo (!empty(validation_errors('approx_age')) ? validation_errors('approx_age') : ''); ?></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Registration point<span class="text-danger">*</span></label>
                            <select name="reg_point" class="form-control">
                                <?php foreach($reg_point_options as $key => $value): ?>
                                    <option value="<?= $key ?>"> <?= $value ?> </option>
                                <?php endforeach ?>
                            </select>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('reg_point')) ? validation_errors('reg_point') : ''); ?></span>
                        </div>
                    </div>                      

                </div>

                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Livestock Purpose<span class="text-danger">*</span></label>
                            <select name="livestock_purpose" class="form-control">
                                <?php foreach($livestock_purpose_options as $key => $value): ?>
                                    <option value="<?= $key ?>"> <?= $value ?> </option>
                                <?php endforeach ?>
                            </select>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('livestock_purpose')) ? validation_errors('livestock_purpose') : ''); ?></span>
                        </div>
                    </div> 
                 
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Owner's NLDPI Number<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nldpi_number" placeholder="Enter NLDPI number">
                            <span class="text-danger"><?php  echo (!empty(validation_errors('nldpi_number')) ? validation_errors('nldpi_number') : ''); ?></span>
                        </div>
                    </div> 
                                     
                </div>                
                <input type="hidden" class="form-control" name="reg_by" value="<?= $vet_professional_id ?>" readonly placeholder="Registered by who">
                <hr>
                <div class="mt-4 register-animal-span">
                    <div class="save-and-continue-span">
                        <button type="submit" name="submit" value="Submit" class="btn btn-success shadow-sm">Submit Registration</button>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>

</div>


<script>

    function goBack(){
        window.history.back();
    }
</script>
<!-- /.container-fluid -->