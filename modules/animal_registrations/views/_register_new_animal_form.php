<?php  require_once ("_navigation.php"); ?>
<!--<div class="baseline mb-4 p-4">
    <div class="base-only">
        <a href="">Profile</a>
    </div>
</div>-->
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid pt-5">
        <div class="animal-form-name mb-5">
            <h1 class="h3 mb-0 ml-4">Register New Animal</h1>
        </div>
        <div class="register-animal-form my-4 px-4">

            <?php 
            
                echo form_open('animal_registrations/add_animal_registration');
            ?>
                  
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Owner's NLDPI Number</label>
                            <input type="text" class="form-control" name="nldpi_number" placeholder="Enter NLDPI number">
                            <?php  echo (!empty(validation_errors('nldpi_number')) ? validation_errors('nldpi_number') : ''); ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Identification Number</label>
                            <select name="id_number" class="form-control">
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
                            
                            <?php 
                                /* $select ="<select name='id_number' class='form-control' >";
                                $select .= "<option value='none'>Select-Gender</option>";
                                foreach ($animal_identification_numbers as $animal_identification_number){
                                
                                    $select .= "<option value=".$animal_identification_number->id.">".$animal_identification_number->id_number."</option>";
                                    */
                            
                            ?>

                            <?php 
                                /*  }
                                $select .= "</select>";
                                echo $select;*/
                            ?>
                            <?php  echo (!empty(validation_errors('id_number')) ? validation_errors('id_number') : ''); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Types of Animal</label>
                            <select name="type_of_animal" class="form-control">
                                <option value=""> Select type of animal</option>
                                <option value="goat"> Goat </option>
                                <option  value="ram">Ram</option>
                                <option  value="cow">Cow</option>
                            </select>
                            <?php  echo (!empty(validation_errors('type_of_animal')) ? validation_errors('type_of_animal') : ''); ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Breed</label>
                            <select name="breed" class="form-control">
                                <option value=""> Select type of breed</option>
                                <option value="sokoto gudali"> Sokoto gudali </option>
                                <option  value="bororo">Bororo</option>
                                <option value='white fulani'> White Fulani </option>
                                <option value='bokolo'> Bokolo </option>
                                <option value='bunaji'> bunaji</option>
                            </select>
                            <!-- use jquery to populate  breed when type of animal is selected e.g cow when types_of_animal_breed table is created -->
                            <?php  echo (!empty(validation_errors('breed')) ? validation_errors('breed') : ''); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Sex</label>
                            <select name="sex" class="form-control">
                                <option value=""> Select sex of the animal</option>
                                <option value="male"> Male </option>
                                <option  value="female">Female</option>
                            </select>
                            <?php echo (!empty(validation_errors('sex')) ? validation_errors('sex') : ''); ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Animal weight</label>
                            <select name="weight" class="form-control">
                                <option value=""> Select weight range</option>
                                <option value="6 - 30kg"> 6 - 30kg </option>
                                <option  value="51 - 80kg">51 - 80kg</option>
                                <option  value="91 - 120kg">91 - 120kg</option>
                            </select>
                            <?php  echo (!empty(validation_errors('weight')) ? validation_errors('weight') : ''); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Age Range</label>
                            <select name="approx_age" class="form-control">
                                <option value=""> Select age range</option>
                                <option value="0 - 6months"> 0 - 6months </option>
                                <option  value="6 - 12months">6 - 12months</option>
                                <option  value="1 - 3years">1 - 3years</option>
                            </select>
                            <?php  echo (!empty(validation_errors('approx_age')) ? validation_errors('approx_age') : ''); ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Colour</label>

                            <input type="text" class="form-control" name="colour" placeholder="Enter colour">
                            <?php  echo (!empty(validation_errors('colour')) ? validation_errors('colour') : ''); ?>
                        </div>
                    </div>
                </div>
                <div class="row last-form-input">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Registration point</label>
                            <select name="reg_point" class="form-control">
                                <option value=""> Select registration point</option>
                                <option value="market"> Market </option>
                                <option  value="owner premises">Owner's premises</option>
                                <option  value="ranch">Ranch</option>
                            </select>
                            <?php  echo (!empty(validation_errors('reg_point')) ? validation_errors('reg_point') : ''); ?>
                        </div>
                    </div>                    
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Registered By</label>
                            <input type="text" class="form-control" name="reg_by" value="<?= $nldpi_number ?>" readonly placeholder="Registered by who">
                            <?php  echo (!empty(validation_errors('reg_by')) ? validation_errors('reg_by') : ''); ?>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="mt-4 register-animal-span">
                    <div class="save-and-continue-span">
                        <button type="submit" name="submit" value="Submit" class="btn btn-nldpi-green shadow-sm save-and-continue">Save and continue later</button>
                    </div>
                    <div class="back-and-next-span">
                        <button type="button" onclick="goBack()" class="btn btn-outline-dark shadow-sm mr-2">Back</button>
                        <button type="button" class="btn btn-nldpi-green shadow-sm btn-next">Next</button>
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