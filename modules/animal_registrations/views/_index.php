<?php  require_once ("_navigation.php"); ?>



<div class="baseline mb-4 p-4">
    <div class="base-left">
        <div class="dashboard-name">
            <h1 class="h3 mb-0">Animal Registery</h1>
        </div>
    </div>
    <div class="base-right">
        <a href="<?= BASE_URL."animal_registrations/register_animal" ?>" class="d-none d-sm-inline-block btn  btn-nldpi-green shadow-sm">Register New Animal</a>
    </div>
</div>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="no-gutters align-items-center">
                        <div class="animal-registered-container">
                            <span>Animals Registered</span>
                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>
                        </div>
                       
                         <div class="h2 mb-0 font-weight-bold text-gray-800 mt-2 count"><?= number_format($total_animals) ?></div>
                 
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="no-gutters align-items-center">
                        <div class="animal-registered-container">
                            <span>Cow</span>
                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>
                        </div>
                       
                         <div class="h2 mb-0 font-weight-bold text-gray-800 mt-2 count"><?= number_format($total_cow) ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="no-gutters align-items-center">
                        <div class="animal-registered-container">
                            <span>Goat</span>
                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>
                        </div>
                       
                         <div class="h2 mb-0 font-weight-bold text-gray-800 mt-2 count"><?= number_format($total_goat) ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="no-gutters align-items-center">
                        <div class="animal-registered-container">
                            <span>Sheep</span>
                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>
                        </div>
                       
                         <div class="h2 mb-0 font-weight-bold text-gray-800 mt-2 count"><?= number_format($total_ram) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="offset-md-1 col-md-10">
            <?php  if(isset($_SESSION['success'])): ?>
                <div id="overlay_success">  
                    <div class=' alert alert-danger alert-dismissable mt-2' style='text-align:center;'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                            <?= $_SESSION["success"] ?>
                    </div>

                </div>

                <?php unset($_SESSION["failure"]); ?>

                <?php endif    ?>   

                <?php  if(isset($_SESSION['failure'])): ?>
                        <div id="overlay_failure"> 
                            <div class=' alert alert-danger alert-dismissable mt-2' style='text-align:center;'>
                                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                                    <?= $_SESSION["failure"] ?>
                            </div>
                        </div>
                            <?php unset($_SESSION["failure"]); ?>

            <?php endif    ?> 
        </div>
    </div>
    <!-- Content Row -->
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
    <div class="row">

        <!-- Table Area -->
        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <h5 class="m-0 font-weight-bold font">Registered Animals</h5>
                        <p class="mt-2">Keep track of registered animals</p>
                    </div>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <!--<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>-->
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable"  width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NLPDI Number</th>
                                    <th>Identification Number</th>
                                    <th>Type Of Animal</th>
                                    <th>Breed</th>
                                    <th>Sex</th>
                                    <th>Weight</th>
                                    <th>Age Range</th>
                                    <th>Colour</th>
                                    <th>Registration Point</th>
                                    <th>Register By</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php foreach ($animal_registration_list as $animal_registration) { ?>
                                        <tr>
                                            <td><?= $animal_registration->nldpi_number; ?></td>
                                            <td><?= $animal_registration->id_number; ?></td>
                                            <td><?= $animal_registration->type_of_animal; ?></td>
                                            <td><?= $animal_registration->breed; ?></td>
                                            <td><?= $animal_registration->sex; ?></td>
                                            <td><?= $animal_registration->weight; ?></td>
                                            <td><?= $animal_registration->approx_age; ?></td>
                                            <td><?= $animal_registration->colour?></td>
                                            <td><?= $animal_registration->reg_point; ?></td>
                                            <td><?= $animal_registration->reg_by; ?></td>
                                            <td>
                                                
                                                <a href="" class="btn btn-outline-dark btn-sm edit-animal-registration" id="<?= $animal_registration->id ?>" data-toggle="modal" title="Edit" data-target="#<?= $animal_registration->id ?>editAnimalRegistration" ><i class="fa fa-edit fa-sm"></i></a>
                                                <a href="" class="btn btn-outline-danger btn-sm delete-animal-registration" id-data="<?= $animal_registration->id ?>" data-toggle="modal" title="Delete" data-target="#<?= $animal_registration->id ?>deleteAnimalRegistration" ><i class="fa fa-trash fa-sm"></i></a>
                                            
                                                <!-- EDIT BUTCHERY MODAL -->
                                                <div class="modal fade" role="dialog" id="<?= isset($animal_registration->id)? $animal_registration->id : ''  ?>editAnimalRegistration">
                                                    <?php

                                                        $form_location_edit_animal_registration = BASE_URL . 'Animal_registrations/update_animal_registration';
                                                        $form_location_delete_animal_registration = BASE_URL . 'Animal_registrations/delete_animal_registration';

                                                    $result = Modules::run('Animal_registrations/get_animal_registration',$animal_registration->id)[0];
                                    
                                                    ?>
                                                    <div class="modal-dialog">

                                                        <!-- Modal CONTENT-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" ><span class="text-nldpi-color">Identification Number</span> <br> <?= ucwords(strtolower($result->id_number)) ?></h4>
                                                                <a  class="close" data-dismiss="modal">&times;</a>
                                                            </div>
                                                            <form action="<?= $form_location_edit_animal_registration ?>" method="POST">
                                                            <input type="hidden" name="id" value="<?= $result->id ?>">
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label>NLDPI Number</label>
                                                                        <input type="text" class="form-control" name="nldpi_number" readonly value="<?= $result->nldpi_number ?>"  placeholder="Enter nldpi number" required>
                                                                        <?php  echo (!empty(validation_errors('nldpi_numbe')) ? validation_errors('nldpi_numbe') : ''); ?>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Identification Number (id number)</label>
                                                                        <input type="text" class="form-control" name="id_number" readonly value="<?= $result->id_number ?>"  placeholder="Enter animal Identification number" required>
                                                                        <?php  echo (!empty(validation_errors('id_number')) ? validation_errors('id_number') : ''); ?>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Types of Animal</label>
                                                                        <select name="type_of_animal" class="form-control" required>
                                                                
                                                                            <?php if($result->type_of_animal =="" || $result->type_of_animal  ===NULL): ?>
                                                                                <option value=""> Select types of animal</option>
                                                                                <option value="goat"> Goat </option>
                                                                                <option  value="ram">Ram</option>
                                                                                <option  value="cow">Cow</option>
                                                                            <?php elseif($result->type_of_animal==="goat"): ?>
                                                                                <option value="<?= $result->type_of_animal ?>" selected><?= $result->type_of_animal ?></option>
                                                                                <option  value="ram">Ram</option>
                                                                                <option  value="cow">Cow</option>
                                                                            <?php elseif($result->type_of_animal==="ram"): ?>
                                                                                <option value="<?= $result->type_of_animal ?>" selected><?= $result->type_of_animal ?></option>
                                                                                <option value="goat"> Goat </option>
                                                                                <option  value="cow">Cow</option>
                                                                            <?php elseif($result->type_of_animal==="cow"): ?>
                                                                                <option value="<?= $result->type_of_animal ?>" selected><?= $result->type_of_animal ?></option>
                                                                                <option value="goat"> Goat </option>
                                                                                <option  value="ram">Ram</option>
                                                                            <?php endif ?>
                                                                        </select>
                                                                        <?php  echo (!empty(validation_errors('type_of_animal')) ? validation_errors('type_of_breed') : ''); ?>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Breed</label>
                                                                        <select name="breed" class="form-control" required>
                                                                            <?php if($result->breed =="" || $result->breed  ===NULL): ?>
                                                                                <option value=""> Select type of animal</option>
                                                                                <option value="sokoto gudali"> Sokoto gudali </option>
                                                                                <option  value="bororo">Bororo</option>
                                                                                <option value='white fulani'> White Fulani </option>
                                                                                <option value='bokolo'> Bokolo </option>
                                                                                <option value='bunaji'> bunaji</option>
                                                                            <?php elseif($result->breed==="sokoto gudali"): ?>
                                                                                <option value="<?= $result->breed ?>" selected><?= $result->breed ?></option>
                                                                                <option  value="bororo">Bororo</option>
                                                                                <option value='white fulani'> White Fulani </option>
                                                                                <option value='bokolo'> Bokolo </option>
                                                                                <option value='bunaji'> bunaji</option>

                                                                            <?php elseif($result->breed==="bororo"): ?>
                                                                                <option value="<?= $result->breed ?>" selected><?= $result->breed ?></option>
                                                                                <option value="sokoto gudali"> Sokoto gudali </option>
                                                                                <option value='white fulani'> White Fulani </option>
                                                                                <option value='bokolo'> Bokolo </option>
                                                                                <option value='bunaji'> bunaji</option>
                                                                            <?php elseif($result->breed==="white fulani"): ?>
                                                                                <option value="<?= $result->breed ?>" selected><?= $result->breed ?></option>
                                                                                <option value="sokoto gudali"> Sokoto gudali </option>
                                                                                <option  value="bororo">Bororo</option>
                                                                                <option value='bokolo'> Bokolo </option>
                                                                                <option value='bunaji'> bunaji</option>
                                                                            <?php elseif($result->breed==="bokolo"): ?>
                                                                                <option value="<?= $result->breed ?>" selected><?= $result->breed ?></option>
                                                                                <option value="sokoto gudali"> Sokoto gudali </option>
                                                                                <option  value="bororo">Bororo</option>
                                                                                <option value='white fulani'> White Fulani </option>
                                                                                <option value='bunaji'> bunaji</option>
                                                                            <?php elseif($result->breed==="bunaji"): ?>
                                                                                <option value="<?= $result->breed ?>" selected><?= $result->breed ?></option>
                                                                                <option value="sokoto gudali"> Sokoto gudali </option>
                                                                                <option  value="bororo">Bororo</option>
                                                                                <option value='white fulani'> White Fulani </option>
                                                                                <option value='bokolo'> Bokolo </option>
                                                                            <?php endif ?>

                                                                        </select>
                                                                        <!-- use jquery to populate  breed when type of animal is selected e.g cow when types_of_animal_breed table is created -->

                                                                        <?php  echo (!empty(validation_errors('breed')) ? validation_errors('breed') : ''); ?>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Sex</label>
                                                                        <select name="sex" class="form-control" required>
                                                                            <?php if($result->sex =="" || $result->sex  ===NULL): ?>
                                                                                <option value=""> Select sex of the animal</option>
                                                                                <option value="male"> Male </option>
                                                                                <option  value="female">Female</option>
                                                                            <?php elseif($result->sex==="male"): ?>
                                                                                <option value="<?= $result->sex ?>" selected><?= $result->sex ?></option>
                                                                                <option  value="female">Female</option>
                                                                            <?php elseif($result->sex==="female"): ?>
                                                                                <option value="<?= $result->sex ?>" selected><?= $result->sex ?></option>
                                                                                <option value="male"> Male </option>
                                                                            <?php endif ?>
                                                                        </select>
                                                                        <?php  echo (!empty(validation_errors('sex')) ? validation_errors('sex') : ''); ?>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Animal weight</label>
                                                                        <select name="weight" class="form-control" required>
                                                                            <option value=""> Select weight range</option>
                                                                            <option value="6 - 30kg"> 6 - 30kg </option>
                                                                            <option  value="51 - 80kg">51 - 80kg</option>
                                                                            <option  value="91 - 120kg">91 - 120kg</option>

                                                                            <?php if($result->sex =="" || $result->sex  ===NULL): ?>
                                                                                <option value=""> Select weight range</option>
                                                                                <option value="6 - 30kg"> 6 - 30kg </option>
                                                                                <option  value="51 - 80kg">51 - 80kg</option>
                                                                                <option  value="91 - 120kg">91 - 120kg</option>
                                                                            <?php elseif($result->sex==="male"): ?>
                                                                                <option value="<?= $result->sex ?>" selected><?= $result->sex ?></option>
                                                                                <option  value="51 - 80kg">51 - 80kg</option>
                                                                                <option  value="91 - 120kg">91 - 120kg</option>
                                                                            <?php elseif($result->sex==="female"): ?>
                                                                                <option value="<?= $result->sex ?>" selected><?= $result->sex ?></option>
                                                                                <option value="6 - 30kg"> 6 - 30kg </option>
                                                                                <option  value="91 - 120kg">91 - 120kg</option>
                                                                            <?php elseif($result->sex==="female"): ?>
                                                                                <option value="<?= $result->sex ?>" selected><?= $result->sex ?></option>
                                                                                <option value="6 - 30kg"> 6 - 30kg </option>
                                                                                <option  value="51 - 80kg">51 - 51kg</option>
                                                                            <?php endif ?>
                                                                        </select>
                                                                        <?php  echo (!empty(validation_errors('weight')) ? validation_errors('weight') : ''); ?>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Age Range</label>
                                                                        <select name="approx_age" class="form-control" required>
                                                                            <?php if($result->approx_age =="" || $result->approx_age  ===NULL): ?>
                                                                                <option value=""> Select age range</option>
                                                                                <option value="0 - 6months"> 0 - 6months </option>
                                                                                <option  value="6 - 12months">6 - 12months</option>
                                                                                <option  value="1 - 3years">1 - 3years</option>
                                                                            <?php elseif($result->approx_age==="0 - 6months"): ?>
                                                                                <option value="<?= $result->approx_age ?>" selected><?= $result->approx_age?></option>
                                                                                <option  value="6 - 12months">6 - 12months</option>
                                                                                <option  value="1 - 3years">1 - 3years</option>
                                                                            <?php elseif($result->approx_age==="6 - 12months"): ?>
                                                                                <option value="<?= $result->approx_age ?>" selected><?= $result->approx_age ?></option>
                                                                                <option value="0 - 6months"> 0 - 6months </option>
                                                                                <option  value="1 - 3years">1 - 3years</option>
                                                                            <?php elseif($result->approx_age==="1 - 3years"): ?>
                                                                                <option value="<?= $result->approx_age ?>" selected><?= $result->approx_age ?></option>
                                                                                <option value="0 - 6months"> 0 - 6months </option>
                                                                                <option  value="6 - 12months">6 - 12months</option>
                                                                            <?php endif ?>
                                                                        </select>
                                                                        <?php  echo (!empty(validation_errors('approx_age')) ? validation_errors('approx_age') : ''); ?>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Colour</label>

                                                                        <input type="text" class="form-control" name="colour" value="<?= $result->colour ?>" placeholder="Enter colour">
                                                                        <?php  echo (!empty(validation_errors('colour')) ? validation_errors('colour') : ''); ?>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Registration point</label>
                                                                        <select name="reg_point" class="form-control" required>
                                                                            <?php if($result->reg_point =="" || $result->reg_point  ===NULL): ?>
                                                                                <option value=""> Select registration point</option>
                                                                                <option value="market"> Market </option>
                                                                                <option  value="owner's premises">Owner's premises</option>
                                                                                <option  value="ranch">Ranch</option>
                                                                            <?php elseif($result->reg_point==="market"): ?>
                                                                                <option value="<?= $result->reg_point ?>" selected><?= $result->reg_point?></option>
                                                                                <option  value="owner's premises">Owner's premises</option>
                                                                                <option  value="ranch">Ranch</option>
                                                                            <?php elseif($result->reg_point==="owner's premises"): ?>
                                                                                <option value="<?= $result->reg_point ?>" selected><?= $result->reg_point?></option>
                                                                                <option value="market"> Market </option>
                                                                                <option  value="ranch">Ranch</option>
                                                                            <?php elseif($result->reg_point==="ranch"): ?>
                                                                                <option value="<?= $result->reg_point ?>" selected><?= $result->reg_point?></option>
                                                                                <option value="market"> Market </option>
                                                                                <option  value="owner's premises">Owner's premises</option>
                                                                            
                                                                            <?php endif ?>
                                                                        </select>
                                                                        <?php  echo (!empty(validation_errors('reg_point')) ? validation_errors('reg_point') : ''); ?>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Registered By</label>
                                                                        <input type="text" class="form-control" name="reg_by" value="<?= $result->reg_by ?>"  placeholder="Registered by who" required>
                                                                        <?php  echo (!empty(validation_errors('reg_by')) ? validation_errors('reg_by') : ''); ?>
                                                                    </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-nldpi-green shadow-sm">Save</button>
                                                                    </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>



                                                <!-- DELETE BUTCHERY MODAL-->
                                                <div class="modal fade" id="<?= isset($animal_registration->id)? $animal_registration->id : ''  ?>deleteAnimalRegistration" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <form action="<?= $form_location_delete_animal_registration ?>" method="POST">
                                                            <input type="hidden" value="<?= isset($animal_registration->id)? $animal_registration->id : ''  ?>" name="id">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteAnimalRegistrationModalLabel">Are you sure you want to delete identification number <?= $animal_registration->id_number ?>?</h5>
                                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">Click on delete button to remove <?= ucwords(strtolower($animal_registration->id_number)) ?> animal identification from list.</div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-outline-dark" type="button" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-nldpi-green shadow-sm" >Delete</button>
                                                                </div>
                                                            </div>
                                                        </form>    
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div> 
                </div>              
            </div>
        </div>

    </div>



    <div class="row">

        <!-- Table Area -->
        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <h5 class="m-0 font-weight-bold font">Allocated ID Numbers</h5>
                        <p class="mt-2">Keep track of your allocated ID numbers</p>
                    </div>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable"  width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Bank ID</th>
                                    <th>Types Of Tag</th>
                                    <th>Range</th>
                                    <th>Available</th>
                                    <th>Allocation Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div> 
                </div>              
            </div>
        </div>

    </div>


</div>
<!-- /.container-fluid -->
<script>
    /*  $(document).ready(function() {
       // $(".modal").modal('hide');
       $(".modal").modal('hide');

        $('.add-animal-registration').click(function () {
      
            $(this).parent().find('#animalRegistrationModal').modal('toggle'); 
            
        });


        $('.edit-animal-registration').click(function () {
        
            var id= $(this).attr('id');
      
            $(this).parent().find('#'+id+'editAnimalRegistration').modal('toggle'); 
            
        });

        $('.delete-animal-registration').click(function () {
            
            var id= $(this).attr('id-data');
      
            $(this).parent().find('#'+id+'deleteAnimalRegistration').modal('toggle'); 
            
        }); 
      
      });*/

    // json to get state and local government to fill state and local goverment dropdown

</script>