<!-- Begin Page Content -->

<div class="container-fluid">
<?php $email = $_SESSION['email'];
    $user_data =  Modules::run('service_providers/_fetch_all_data_for_user', $email); 
   foreach ($user_data as $user) :
   $name = $user->company_name;
   $nldpiNumber = $user->nldpi_number;      
 endforeach; ?>

        <div class="animal-form-name mb-5 mt-5">

            <h1 class="h3 mb-0 ml-4">Register New Livestock</h1>

        </div>

        <div class="register-animal-form my-4 px-4">

        <?php 

            

            echo form_open('animal_registrations/add_animal_record');

        ?>

                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <div class="form-group">

                            <label>Identification Number (from allocated Number Bank)</label>

                            <input type="" class="form-control" id="" 
                            name="animal_id" placeholder="Livestock Identification Number">


                            <?php  echo (!empty(validation_errors('name')) ? validation_errors('name') : ''); ?>

                        </div>

                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <div class="form-group">

                            <label>Species </label>

                            <select name="livestock_type" class="form-control" required>

                                <option value=""> Select</option>

                                <option value="goat"> Goat </option>

                                <option  value="ram">Ram</option>

                                <option  value="cow">Cow</option>

                            </select>

                            <?php  echo (!empty(validation_errors('type_of_animal')) ? validation_errors('type_of_animal') : ''); ?>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <div class="form-group">

                            <label>Breed Type</label>

                            <?php
$breed_list = Modules::run('service_providers/_get_breed_list');

$attr['id'] = 'breed_type';
$attr['class'] = 'form-control';
$attr['required'] = 1;

$none['None selected'] = ' ';

echo form_dropdown('breed', $breed_list, '', $attr);
?> 

                            <?php  echo (!empty(validation_errors('breed_type')) ? validation_errors('breed_type') : ''); ?>

                        </div>

                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <div class="form-group">

                        <label>Sex </label>

<select name="sex" class="form-control" required>

    <option value=""> Select</option>

    <option value="Male"> Male </option>

    <option  value="Female"> Female</option>


</select>

<?php  echo (!empty(validation_errors('type_of_animal')) ? validation_errors('type_of_animal') : ''); ?>

                        </div>

                    </div>

                </div>





                <div class="row ">

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <div class="form-group">

                           
                        <label>Age(Months)</label>

<select name="approx_age" class="form-control" required>

    <option value=""> Select range</option>

    <option value="0 - 2 months"> 0 - 2 months </option>

    <option value="3 - 5 months"> 3 - 5 months</option>

    <option value="6 - 8 months"> 6 - 8 months</option>

</select>

<?php  echo (!empty(validation_errors('age')) ? validation_errors('age') : ''); ?>

                        </div>

                    </div>


                    
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <div class="form-group">

                           
                        <label>Weight Range (Kb/lsb)</label>

<select name="weight" class="form-control" required>

    <option value=""> Select range</option>

    <option value="0 - 3 lsb "> 0 -3 lsb </option>

    <option value="3 - 5 lsb"> 3 - 5 lsb</option>

    <option value="6 - 8 lsb"> 6 - 8 lsb</option>

</select>

<?php  echo (!empty(validation_errors('weight')) ? validation_errors('weight') : ''); ?>

                        </div>

                    </div>

                </div>

                

                
                <div class="row last-form-input">

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <div class="form-group">

                           
                        <label>Location</label>

<select name="reg_point" class="form-control" required>

    <option value=""> Market/Farm</option>

    <option value="Market"> Market </option>

    <option value="Farm">Farm</option>

</select>

<?php  echo (!empty(validation_errors('location')) ? validation_errors('location') : ''); ?>

                        </div>

                    </div>


                    
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <div class="form-group">

                           
                        <label>Owner Id</label>
                        <input type="" class="form-control" id="typeInput" 
                        name="owner_id" placeholder="Owner NLDPI ID" required>
                        <input type="hidden" class="form-control" id="typeInput" 
                        name="nldpi_number" value="<?= $nldpiNumber; ?>" placeholder="Owner NLDPI ID" >


<?php  echo (!empty(validation_errors('owner_id')) ? validation_errors('owner_id') : ''); ?>

                        </div>

                    </div>

                </div>

                <hr>

                <div class="mt-4 breed-span">



                    <div class="back-and-next-span">

                        <button type="button" onclick="goBack()" class="btn btn-white btn-back mr-2">Back</button>

                        <button type="submit" name="submit" value="Submit" class="btn btn-nldpi-green shadow-sm btn-next">Register Breed</button>

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