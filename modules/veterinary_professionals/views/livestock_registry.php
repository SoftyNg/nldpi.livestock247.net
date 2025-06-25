<?php  require_once ("_navigation.php"); ?>

<div class="baseline mb-4 p-4">
    <div class="base-left">
        <div class="dashboard-name">
            <h1 class="h3 mb-0">Livestock Registry</h1>
        </div>
    </div>
    <div class="base-right mt-2">
        <a href="<?= BASE_URL."veterinary_professionals/livestock_registration" ?>" class="d-sm-inline-block btn  btn-success shadow-sm">Register New Livestock</a>
    </div>
</div>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->

    <div class="row">
        <!-- Total Registered Livestock -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="no-gutters align-items-center">
                        <div class="animal-registered-container">
                            <span>Livestock Registered</span>
                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>
                        </div>
                       
                         <div class="h2 mb-0 font-weight-bold text-gray-800 mt-2 count"><?= number_format($total_registered_livestock) ?></div>
                 
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Registered Cow -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="no-gutters align-items-center">
                        <div class="animal-registered-container">
                            <span>Cow</span>
                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>
                        </div>
                       
                         <div class="h2 mb-0 font-weight-bold text-gray-800 mt-2 count"><?= number_format($total_registered_cow) ?></div>
                 
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Registered Sheep -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="no-gutters align-items-center">
                        <div class="animal-registered-container">
                            <span>Sheep</span>
                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>
                        </div>
                       
                         <div class="h2 mb-0 font-weight-bold text-gray-800 mt-2 count"><?= number_format($total_registered_ram) ?></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Registered Goat -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="no-gutters align-items-center">
                        <div class="animal-registered-container">
                            <span>Goat</span>
                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>
                        </div>
                       
                         <div class="h2 mb-0 font-weight-bold text-gray-800 mt-2 count"><?= number_format($total_registered_goat) ?></div>
                    </div>
                </div>
            </div>
        </div>        
    </div>    
    <div class="row">
        <div class="offset-md-1 col-md-10">
            <?php if(isset($_SESSION['success'])): ?>
                <div id="overlay_success">  
                    <div class=' alert alert-success alert-dismissable mt-2' style='text-align:center;'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
                            <?= $_SESSION["success"] ?>
                    </div>

                </div>

                <?php unset($_SESSION["success"]); ?>

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
    <div class="row">

        <!-- Table Area -->
        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <h5 class="m-0 font-weight-bold font">Registered Livestock</h5>
                        <p class="mt-2">Keep track of registered Livestock</p>
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
                                    <th>NLPDI Number</th>
                                    <th>Identification Number</th>
                                    <th>Type</th>
                                    <th>Purpose</th>
                                    <th>Breed</th>
                                    <th>Sex</th>
                                    <th>Weight</th>
                                    <th>Age Range</th>
                                    <th>Colour</th>
                                    <th>Registration Point</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php foreach ($livestock_list as $animal_registration) { ?>
                                        <tr>
                                            <td><?= $animal_registration->nldpi_number; ?></td>
                                            <td><?= $animal_registration->animal_id; ?></td>
                                            <td><?= ucfirst($livestock_type_options[$animal_registration->livestock_type]); ?></td>
                                            <td><?= ucfirst($livestock_purpose_options[$animal_registration->livestock_purpose]); ?></td>
                                            <td><?= ucfirst($breed_options[$animal_registration->breed_id]); ?></td>
                                            <td><?= ucfirst($sex_options[$animal_registration->sex]); ?></td>
                                            <td><?= $weight_options[$animal_registration->weight]; ?></td>
                                            <td><?= ucfirst($age_range_options[$animal_registration->approx_age]); ?></td>
                                            <td><?= ucfirst($animal_registration->colour)?></td>
                                            <td><?= ucfirst($reg_point_options[$animal_registration->reg_point]); ?></td>
                                            <td>
                                                
                                                <a href="" class="btn btn-outline-dark btn-sm edit-animal-registration" id="<?= $animal_registration->id ?>" data-toggle="modal" title="Edit" data-target="#<?= $animal_registration->id ?>editAnimalRegistration" ><i class="fa fa-edit fa-sm"></i></a>
                                                <a href="" class="btn btn-outline-danger btn-sm delete-animal-registration" id-data="<?= $animal_registration->id ?>" data-toggle="modal" title="Delete" data-target="#<?= $animal_registration->id ?>deleteAnimalRegistration" ><i class="fa fa-trash fa-sm"></i></a>
                                            
                                                <!-- EDIT LIVESTOCK MODAL -->
                                                <div class="modal fade" role="dialog" id="<?= isset($animal_registration->id)? $animal_registration->id : ''  ?>editAnimalRegistration">
                                                    <?php

                                                        $form_location_edit_animal_registration = BASE_URL . 'veterinary_professionals/update_livestock_registration';
                                                        $form_location_delete_animal_registration = BASE_URL . 'veterinary_professionals/delete_livestock_registration';

                                                    $result = Modules::run('veterinary_professionals/get_livestock_registration',$animal_registration->id)[0];
                                    
                                                    ?>
                                                    <div class="modal-dialog">

                                                        <!-- Modal CONTENT-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" ><span class="text-nldpi-color">Identification Number</span> <br> <?= ucwords(strtolower($result->animal_id)) ?></h4>
                                                                <a  class="close" data-dismiss="modal">&times;</a>
                                                            </div>
                                                            <form action="<?= $form_location_edit_animal_registration ?>" method="POST">
                                                            <input type="hidden" name="id" value="<?= $result->id ?>">
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label>Identification Number (id number)</label>
                                                                        <input type="text" class="form-control" name="animal_id" readonly value="<?= $result->animal_id ?>"  placeholder="Enter animal Identification number" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>NLDPI Number</label>
                                                                        <input type="text" class="form-control" name="nldpi_number" readonly value="<?= $result->nldpi_number ?>"  placeholder="Enter nldpi number" required>
                                                                    </div>
                                                                        <div class="form-group">
                                                                        <label>Livestock Type</label>
                                                                        <select name="livestock_type" class="form-control" required>
                                                    
                                                                            <?php foreach($livestock_type_options as $key => $value): ?>
                                                                                <option value="<?= $key ?>"  <?=  $result->livestock_type == $key?  'selected': ''; ?>> <?= $value ?> </option>
                                                                            <?php endforeach ?>
                                                                           
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Breed</label>
                                                                        <select name="breed" class="form-control" required>
                                                                            <?php foreach($breed_options as $key => $value): ?>
                                                                                <option value="<?= $key ?>"  <?=  $result->breed_id == $key?  'selected': ''; ?>> <?= $value ?> </option>
                                                                            <?php endforeach ?>
                                                                        </select>
                                                                    </div>                                                                    
                                                                    <div class="form-group">
                                                                        <label>Sex</label>
                                                                        <select name="sex" class="form-control" required>
                                                                        <?php foreach($sex_options as $key => $value): ?>
                                                                                <option value="<?= $key ?>"  <?=  $result->sex == $key?  'selected': ''; ?>> <?= $value ?> </option>
                                                                            <?php endforeach ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Animal weight</label>
                                                                        <select name="weight" class="form-control" required>
                                                                        <?php foreach($weight_options as $key => $value): ?>
                                                                                <option value="<?= $key ?>"  <?=  $result->weight == $key?  'selected': ''; ?>> <?= $value ?> </option>
                                                                            <?php endforeach ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Age Range</label>
                                                                        <select name="approx_age" class="form-control" required>
                                                                            <?php foreach($age_range_options as $key => $value): ?>
                                                                                <option value="<?= $key ?>"  <?=  $result->approx_age == $key?  'selected': ''; ?>> <?= $value ?> </option>
                                                                            <?php endforeach ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Colour</label>

                                                                        <input type="text" class="form-control" name="colour" value="<?= $result->colour ?>" placeholder="Enter colour">
                                                                        <?php  echo (!empty(validation_errors('colour')) ? validation_errors('colour') : ''); ?>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Registration point</label>
                                                                        <select name="reg_point" class="form-control" required>
                                                                        <?php foreach($reg_point_options as $key => $value): ?>
                                                                                <option value="<?= $key ?>"  <?=  $result->reg_point == $key?  'selected': ''; ?>> <?= $value ?> </option>
                                                                            <?php endforeach ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Livestock purpose</label>
                                                                        <select name="livestock_purpose" class="form-control" required>
                                                                        <?php foreach($livestock_purpose_options as $key => $value): ?>
                                                                                <option value="<?= $key ?>"  <?=  $result->livestock_purpose == $key?  'selected': ''; ?>> <?= $value ?> </option>
                                                                            <?php endforeach ?>
                                                                        </select>
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



                                                <!-- DELETE DELETE MODAL-->
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
