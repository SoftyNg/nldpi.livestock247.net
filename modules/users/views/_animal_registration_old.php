<div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                  <?php require_once ("_navigation.php"); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h3>Animal Registration List</h3>
                <a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm add-animal-registration" data-toggle="modal" data-target="#animalRegistrationModal"><i class="fas fa-plus fa-sm text-white-50" ></i> Add new animal registration</a>
            </div>
            <?php
                if(isset($_SESSION['success'])){
                        echo "<div class=' alert alert-success alert-dismissable mt-2' style='text-align:center;font-size:small'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>"
                                .$_SESSION['success'].
                            "</div>";
                }

                if(isset($_SESSION['failure'])){
                        echo "<div class=' alert alert-danger alert-dismissable mt-2' style='text-align:center;font-size:small'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>"
                                .$_SESSION['failure'].
                            "</div>";
                }
               ?>
            <!-- ADD ANIMAL REGISTRATION MODAL -->
            <div class="modal fade" id="animalRegistrationModal" tabindex="-1" role="dialog" aria-labelledby="animalRegistrationModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary" id="animalRegistrationModalLabel">Add new animal registration</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    
                        <?php      
                            /*echo form_open($form_location);
                            echo form_label('nldpi_number');
                            echo form_input('nldpi_number', $nldpi_number, array("placeholder" => "Enter nldpi number'"));
                            echo form_label('id_number');
                            echo form_input('id_number', $id_number, array("placeholder" => "Enter identification number from number bank"));
                            echo form_label('name');
                            echo form_input('name', $name, array("placeholder" => "Enter name"));
                            echo form_label('breed');
                            $breed= array(
                                ''  => 'Select types of animal',
                                'sokoto gudali'  => 'Sokoto gudali',
                                'bororo'  => 'Bororo',
                                'white fulani'    => 'White fulani',
                                'bokolo'    => 'Bokolo',
                                'bunaji'    => 'Bunaji'
                            );
                            echo form_dropdown('breed', $breed, '');
                            echo form_label('sex');
                            echo '<div>';
                            echo form_radio('sex', 'male', false) . ' Male ';
                            echo form_radio('sex', 'female', false) . ' Female ';
                            echo '</div>';
                            echo form_label('owner_number');
                            echo form_input('owner_number', $owner_number, array("placeholder" => "Enter owner's number"));
                            echo form_label('weight');
                            $weight = array(
                                ''  => 'Select weight range',
                                '6 - 30kg'  => '31 - 50kg',
                                '51 - 80kg'  => '51 - 80kg',
                                '91 - 120kg'    => '91 - 120kg',
                            );
                            echo form_dropdown('weight', $weight, '');
                            echo form_label('approx_age');
                            $approx_age = array(
                                ''  => 'Select age range',
                                '0 - 6 months'  => '0 - 6 months',
                                '6 - 12 months'  => '6 - 12 months',
                                '1 - 3 years'    => '1 - 3 years',
                            );
                            echo form_dropdown('approx_age', $approx_age, '');
                            echo form_label('colour');
                            echo form_input('colour', $colour, array("placeholder" => "Enter colour"));
                            echo form_label('type_of_animal');
                            $type_of_animal= array(
                                ''  => 'Select types of animal',
                                'goat'  => 'Goat',
                                'ram'  => 'Ram',
                                'cow' => 'Cow'
                            );
                            echo form_dropdown('type_of_animal', $type_of_animal, '');
                            echo form_label('reg_date');
                            $attr = array("class"=>"datetime-picker", "autocomplete"=>"off", "placeholder"=>"Select reg date");
                            echo form_input('reg_date', $reg_date, $attr);
                            echo form_label('reg_point');
                            $reg_point = array(
                                ''  => 'Select registration point',
                                'market'  => 'Market',
                                'owners premises'  => 'Owners premises',
                                'ranch'    => 'Ranch',
                            );
                            echo form_dropdown('reg_point', $reg_point, '');
                            echo form_label('reg_by');
                            //will service provider will be fetch from the database
                            echo form_input('reg_by', $reg_by, array("placeholder" => "Enter service provider's number"));
                            echo form_submit('submit', 'Submit');
                            echo anchor($cancel_url, 'Cancel', array('class' => 'button alt'));
                            echo form_close();*/
                        ?>
                    
                        <form action="add_animal_registration" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>NLDPI Number</label>
                                    <input type="text" class="form-control" name="nldpi_number"  placeholder="Enter nldpi number" required>
                                    <?php  echo (!empty(validation_errors('nldpi_numbe')) ? validation_errors('nldpi_numbe') : ''); ?>
                                </div>
                                <div class="form-group">
                                    <label>Identification Number</label>
                                    <select name="id_number" class="form-control" required>
                                        <option value=""> Select animal identification number</option>
                                        <option value="1425678333"> 1425678333 </option>
                                        <option value="1421178333">1421178333</option>
                                        <option value='1425678322'> 1425678322 </option>
                                        <option value='1425678381'> 1425678381</option>
                                        <option value='1425678671'> 1425678671</option>
                                    </select>
                                    
                                    <?php 
                                       /* $select ="<select name='id_number' class='form-control' >";
                                        $select .= "<option value='none'>Select-Gender</option>";
                                        foreach ($animal_identification_numbers as $animal_identification_number){
                                     
                                            $select .= "<option value=".$animal_identification_number->id.">".$animal_identification_number->id_number."</option>";
                                          
                                    
                                    ?>

                                    <?php 
                                        /*  }
                                        $select .= "</select>";
                                        echo $select;*/
                                    ?>
                                    <?php  echo (!empty(validation_errors('id_number')) ? validation_errors('id_number') : ''); ?>
                                </div>
                                <div class="form-group">
                                    <label>Owner's Name</label>
                                    <input type="text" class="form-control" name="name"   placeholder="Enter name" required>
                                    <?php  echo (!empty(validation_errors('name')) ? validation_errors('name') : ''); ?>
                                </div>
                                <div class="form-group">
                                    <label>Owner's Phone Number</label>
                                    <input type="text" class="form-control" name="owner_number"  placeholder="Enter owner number" required>
                                    <?php  echo (!empty(validation_errors('owner_number')) ? validation_errors('owner_number') : ''); ?>
                                </div>
                                <div class="form-group">
                                    <label>Types of Animal</label>
                                    <select name="type_of_animal" class="form-control" required>
                                        <option value=""> Select type of animal</option>
                                        <option value="goat"> Goat </option>
                                        <option  value="Ram">Ram</option>
                                        <option  value="Cow">Cow</option>
                                    </select>
                                    <?php  echo (!empty(validation_errors('type_of_animal')) ? validation_errors('type_of_breed') : ''); ?>
                                </div>
                                <div class="form-group">
                                    <label>Breed</label>
                                    <select name="breed" class="form-control" required>
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
                                <div class="form-group">
                                    <label>Sex</label>
                                    <select name="sex" class="form-control" required>
                                        <option value=""> Select sex of the animal</option>
                                        <option value="male"> Male </option>
                                        <option  value="female">Female</option>
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
                                    </select>
                                    <?php  echo (!empty(validation_errors('weight')) ? validation_errors('weight') : ''); ?>
                                </div>
                                <div class="form-group">
                                    <label>Age Range</label>
                                    <select name="approx_age" class="form-control" required>
                                        <option value=""> Select age range</option>
                                        <option value="0 - 6months"> 0 - 6months </option>
                                        <option  value="6 - 12months">6 - 12months</option>
                                        <option  value="1 - 3years">1 - 3years</option>
                                    </select>
                                    <?php  echo (!empty(validation_errors('approx_age')) ? validation_errors('approx_age') : ''); ?>
                                </div>
                                <div class="form-group">
                                    <label>Registration point</label>
                                    <select name="reg_point" class="form-control" required>
                                        <option value=""> Select registration point</option>
                                        <option value="market"> Market </option>
                                        <option  value="owner's premises">Owner's premises</option>
                                        <option  value="ranch">Ranch</option>
                                    </select>
                                    <?php  echo (!empty(validation_errors('reg_point')) ? validation_errors('reg_point') : ''); ?>
                                </div>
                                <div class="form-group">
                                    <label>Registered By</label>
                                    <input type="text" class="form-control" name="reg_by"  placeholder="Registered by who" required>
                                    <!--<select name="reg_by" class="form-control">
                                        <option value=""> Select register by</option>
                                        <option value="vet doctor"> Vet doctor </option>
                                        <option  value="animal scientist">Animal scientist</option>
                                    </select>-->
                                    <?php  echo (!empty(validation_errors('reg_by')) ? validation_errors('reg_by') : ''); ?>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>   



            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- DataTales Example -->
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">Animal registration list</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>NLPDI Number</th>
                                            <th>Identification Number</th>
                                            <th>Name</th>
                                            <th>Type Of Animal</th>
                                            <th>Breed</th>
                                            <th>Sex</th>
                                            <th>Owner's Number</th>
                                            <th>Weight</th>
                                            <th>Age Range</th>
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
                                                    <td><?= $animal_registration->name; ?></td>
                                                    <td><?= $animal_registration->type_of_animal; ?></td>
                                                    <td><?= $animal_registration->breed; ?></td>
                                                    <td><?= $animal_registration->sex; ?></td>
                                                    <td><?= $animal_registration->owner_number; ?></td>
                                                    <td><?= $animal_registration->weight; ?></td>
                                                    <td><?= $animal_registration->approx_age; ?></td>
                                                    <td><?= $animal_registration->reg_point; ?></td>
                                                    <td><?= $animal_registration->reg_by; ?></td>
                                                    <td>
                                                        
                                                        <a href="" class="btn btn-warning btn-sm edit-animal-registration" id="<?= $animal_registration->id ?>" data-toggle="modal" title="Edit" data-target="#<?= $animal_registration->id ?>editAnimalRegistration" ><i class="fa fa-edit fa-sm"></i></a>
                                                        <a href="" class="btn btn-danger btn-sm delete-animal-registration" id-data="<?= $animal_registration->id ?>" data-toggle="modal" title="Delete" data-target="#<?= $animal_registration->id ?>deleteAnimalRegistration" ><i class="fa fa-trash fa-sm"></i></a>
                                                    
                                                        <!-- EDIT BUTCHERY MODAL -->
                                                        <div class="modal fade" role="dialog" id="<?= isset($animal_registration->id)? $animal_registration->id : ''  ?>editAnimalRegistration">
                                                            <?php

                                                                $form_location_edit_animal_registration = BASE_URL . 'users/update_animal_registration';
                                                                $form_location_delete_animal_registration = BASE_URL . 'users/delete_animal_registration';

                                                               $result = Modules::run('users/get_animal_registration',$animal_registration->id)[0];
                                            
                                                            ?>
                                                            <div class="modal-dialog">

                                                                <!-- Modal CONTENT-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" ><span class="text-primary">Identification Number</span> <br> <?= ucwords(strtolower($result->id_number)) ?></h4>
                                                                        <a  class="close" data-dismiss="modal">&times;</a>
                                                                    </div>
                                                                    <form action="<?= $form_location_edit_animal_registration ?>" method="POST">
                                                                    <input type="hidden" name="id" value="<?= $result->id ?>">
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label>NLDPI Number</label>
                                                                                <input type="text" class="form-control" name="nldpi_number" value="<?= $result->nldpi_number ?>"  placeholder="Enter nldpi number" required>
                                                                                <?php  echo (!empty(validation_errors('nldpi_numbe')) ? validation_errors('nldpi_numbe') : ''); ?>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Identification Number (id number)</label>
                                                                                <select name="id_number" class="form-control" required>

                                                                                    <?php if($result->id_number =="" || $result->id_number  ===NULL): ?>
                                                                                        <option value="none">Select-Gender</option>
                                                                                        <option value="1425678333"> 1425678333 </option>
                                                                                        <option value="1421178333">1421178333</option>
                                                                                        <option value='1425678322'> 1425678322 </option>
                                                                                    <?php elseif($result->id_number==="1425678333"): ?>
                                                                                        <option value="<?= $result->id_number ?>" selected><?= $result->id_number ?></option>
                                                                                        <option value="1421178333">1421178333</option>
                                                                                        <option value='1425678322'> 1425678322 </option>

                                                                                    <?php elseif($result->id_number==="1421178333"): ?>
                                                                                        <option value="1425678333"> 1425678333 </option>
                                                                                        <option value="<?= $result->id_number ?>" selected><?= $result->id_number ?></option>
                                                                                        <option value='1425678322'> 1425678322 </option>
                                                                                    <?php elseif($result->id_number==="1421178333"): ?>
                                                                                        <option value="1425678333"> 1425678333 </option>
                                                                                        <option value="1421178333">1421178333</option>
                                                                                        <option value="<?= $result->id_number ?>" selected><?= $result->id_number ?></option>
                                                                                    <?php endif ?>
                                                                                </select>
                                                                                
                                                                                <?php 
                                                                                  /*  $select ="<select name='id_number' class='form-control' >";
                                                                                    $select .= "<option value='none'>Select-Gender</option>";
                                                                                    foreach ($animal_identification_numbers as $animal_identification_number){
                                                                                        if($animal_identification_number->id ==  $result->id_number){
                                                                                            $select .= "<option value=".$animal_identification_number->id." selected>".$animal_identification_number->id_number."</option>";
                                                                                        }else{
                                                                                            $select .= "<option value=".$animal_identification_number->id.">".$animal_identification_number->id_number."</option>";
                                                                                        }*/
                                                                               
                                                                                ?>

                                                                                <?php 
                                                                                  /*  }
                                                                                    $select .= "</select>";
                                                                                    echo $select;*/
                                                                                ?>

                                                                                <?php  echo (!empty(validation_errors('id_number')) ? validation_errors('id_number') : ''); ?>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Owner's Name</label>
                                                                                <input type="text" class="form-control" name="name" value="<?= $result->name ?>"  placeholder="Enter name" required>
                                                                                <?php  echo (!empty(validation_errors('name')) ? validation_errors('name') : ''); ?>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Owner's Phone Number</label>
                                                                                <input type="text" class="form-control" name="owner_number" value="<?= $result->owner_number ?>"  placeholder="Enter owner's phone number" required>
                                                                                <?php  echo (!empty(validation_errors('owner_number')) ? validation_errors('owner_number') : ''); ?>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Types of Animal</label>
                                                                                <select name="type_of_animal" class="form-control" required>
                                                                        
                                                                                    <?php if($result->type_of_animal =="" || $result->type_of_animal  ===NULL): ?>
                                                                                        <option value=""> Select types of animal</option>
                                                                                        <option value="goat"> Goat </option>
                                                                                        <option  value="Ram">Ram</option>
                                                                                        <option  value="Cow">Cow</option>
                                                                                    <?php elseif($result->type_of_animal==="goat"): ?>
                                                                                        <option value="<?= $result->type_of_animal ?>" selected><?= $result->type_of_animal ?></option>
                                                                                        <option  value="Ram">Ram</option>
                                                                                        <option  value="Cow">Cow</option>
                                                                                    <?php elseif($result->type_of_animal==="ram"): ?>
                                                                                        <option value="<?= $result->type_of_animal ?>" selected><?= $result->type_of_animal ?></option>
                                                                                        <option value="goat"> Goat </option>
                                                                                        <option  value="Cow">Cow</option>
                                                                                    <?php elseif($result->type_of_animal==="cow"): ?>
                                                                                        <option value="<?= $result->type_of_animal ?>" selected><?= $result->type_of_animal ?></option>
                                                                                        <option value="goat"> Goat </option>
                                                                                        <option  value="Ram">Ram</option>
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
                                                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Save</button>
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
                                                                            <button class="btn btn-warning" type="button" data-dismiss="modal">Cancel</button>
                                                                            <button type="submit" class="btn btn-primary" >Delete</button>
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

        </div>
                <!-- /.container-fluid -->

    </div>



    