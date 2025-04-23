<!-- Begin Page Content -->

<div class="container-fluid">

        <div class="animal-form-name mb-5 mt-5">

            <h1 class="h3 mb-0 ml-4">Register New Livestock</h1>

        </div>

        <div class="register-animal-form my-4 px-4">

        <?php 

            

            echo form_open('breed_registrations/add_breed');

        ?>

                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <div class="form-group">

                            <label>Identification Number (from allocated Number Bank)</label>

                            <input type="number" class="form-control" id="" 
                            name="number" placeholder="Livestock Identification Number">


                            <?php  echo (!empty(validation_errors('name')) ? validation_errors('name') : ''); ?>

                        </div>

                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <div class="form-group">

                            <label>Species </label>

                            <select name="type_of_animal" class="form-control">

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

                            <select name="breed_type" class="form-control">

                                <option value=""> Select breed type</option>

                                <option value="local"> Local </option>

                                <option value="exotic">Exotic</option>

                            </select>

                            <?php  echo (!empty(validation_errors('breed_type')) ? validation_errors('breed_type') : ''); ?>

                        </div>

                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <div class="form-group">

                        <label>Sex </label>

<select name="type_of_animal" class="form-control">

    <option value=""> Select</option>

    <option value="goat"> Goat </option>

    <option  value="ram">Ram</option>


</select>

<?php  echo (!empty(validation_errors('type_of_animal')) ? validation_errors('type_of_animal') : ''); ?>

                        </div>

                    </div>

                </div>





                <div class="row ">

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <div class="form-group">

                           
                        <label>Age(Months)</label>

<select name="breed_type" class="form-control">

    <option value=""> Select range</option>

    <option value="local"> Local </option>

    <option value="exotic">Exotic</option>

</select>

<?php  echo (!empty(validation_errors('breed_type')) ? validation_errors('breed_type') : ''); ?>

                        </div>

                    </div>


                    
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <div class="form-group">

                           
                        <label>Weight Range (Kb/lsb)</label>

<select name="breed_type" class="form-control">

    <option value=""> Select range</option>

    <option value="local"> Local </option>

    <option value="exotic">Exotic</option>

</select>

<?php  echo (!empty(validation_errors('breed_type')) ? validation_errors('breed_type') : ''); ?>

                        </div>

                    </div>

                </div>

                

                
                <div class="row last-form-input">

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <div class="form-group">

                           
                        <label>Location</label>

<select name="breed_type" class="form-control">

    <option value=""> Market/Farm</option>

    <option value="local"> Local </option>

    <option value="exotic">Exotic</option>

</select>

<?php  echo (!empty(validation_errors('breed_type')) ? validation_errors('breed_type') : ''); ?>

                        </div>

                    </div>


                    
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <div class="form-group">

                           
                        <label>Owner Id</label>
                        <input type="" class="form-control" id="typeInput" 
                        name="owner_id" placeholder="Owner NLDPI ID">


<?php  echo (!empty(validation_errors('breed_type')) ? validation_errors('breed_type') : ''); ?>

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