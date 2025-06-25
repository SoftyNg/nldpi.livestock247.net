

<?php  
    require_once ("_navigation.php"); 

    if(isset($found) && $found =='success'):
 ?>

        <div class="baseline-container">

            <div class="baseline">

                <div class="base-left">

                    <div class="dashboard-name">

                        <a href="<?= BASE_URL . 'veterinary_professionals/dashboard'?>"><i class="fa fa-arrow-left"></i> Back to User Registrations</a>
                        
                        <h1 class="h3 mb-0">Livestock Profile</h1>

                    </div>
                </div>

                <div class="base-right d-flex justify-content-between">

                    <a href="" class="btn bg-white shadow-sm edit-animal-registration" id="<?= $found_livestock->id ?>" data-toggle="modal" title="Edit" data-target=".editAnimalRegistration">Edit</a>
                
                </div>

                <!-- EDIT LIVESTOCK MODAL -->
                <div class="modal fade editAnimalRegistration" role="dialog" id="<?= isset($found_livestock->id)? $found_livestock->id : ''  ?>editAnimalRegistration">
                    
                    <?php

                        $form_location_edit_livestock = BASE_URL . 'veterinary_professionals/update_livestock_registration';

                    ?>
                    <div class="modal-dialog">

                        <!-- Modal CONTENT-->
                        
                        <div class="modal-content">

                            <div class="modal-header">

                                <h4 class="modal-title" ><span class="text-nldpi-color">Identification Number</span> <br> <?= ucwords(strtolower($found_livestock->animal_id)) ?></h4>

                                <a  class="close" data-dismiss="modal">&times;</a>

                            </div>

                            <form action="<?= $form_location_edit_livestock ?>" method="POST">

                            <input type="hidden" name="id" value="<?= $found_livestock->id ?>">

                                <div class="modal-body">

                                    <div class="form-group">

                                        <label>Identification Number (id number)</label>

                                        <input type="text" class="form-control" name="animal_id" readonly value="<?= $found_livestock->animal_id ?>"  placeholder="Enter animal Identification number" required>

                                    </div>

                                    <div class="form-group">

                                        <label>NLDPI Number</label>

                                        <input type="text" class="form-control" name="nldpi_number" readonly value="<?= $found_livestock->nldpi_number ?>"  placeholder="Enter nldpi number" required>

                                    </div>

                                    <div class="form-group">

                                        <label>Livestock Type</label>

                                        <select name="livestock_type" class="form-control" required>
                            
                                                <?php foreach($livestock_type_options as $key => $value): ?>

                                                    <option value="<?= $key ?>"  <?=  $found_livestock->livestock_type == $key?  'selected': ''; ?>> <?= $value ?> </option>

                                                <?php endforeach ?>
                                            
                                        </select>

                                    </div>

                                    <div class="form-group">

                                        <label>Breed</label>

                                        <select name="breed" class="form-control" required>

                                            <?php foreach($breed_options as $key => $value): ?>

                                                <option value="<?= $key ?>"  <?=  $found_livestock->breed_id == $key?  'selected': ''; ?>> <?= $value ?> </option>

                                            <?php endforeach ?>

                                        </select>

                                    </div>  

                                    <div class="form-group">

                                        <label>Sex</label>

                                        <select name="sex" class="form-control" required>

                                        <?php foreach($sex_options as $key => $value): ?>

                                                <option value="<?= $key ?>"  <?=  $found_livestock->sex == $key?  'selected': ''; ?>> <?= $value ?> </option>

                                            <?php endforeach ?>

                                        </select>

                                    </div>
                                    <div class="form-group">

                                        <label>Animal weight</label>

                                        <select name="weight" class="form-control" required>

                                        <?php foreach($weight_options as $key => $value): ?>
                                            
                                                <option value="<?= $key ?>"  <?=  $found_livestock->weight == $key?  'selected': ''; ?>> <?= $value ?> </option>

                                            <?php endforeach ?>

                                        </select>

                                    </div>

                                    <div class="form-group">

                                        <label>Age Range</label>

                                        <select name="approx_age" class="form-control" required>

                                            <?php foreach($age_range_options as $key => $value): ?>

                                                <option value="<?= $key ?>"  <?=  $found_livestock->approx_age == $key?  'selected': ''; ?>> <?= $value ?> </option>

                                            <?php endforeach ?>

                                        </select>

                                    </div>

                                    <div class="form-group">

                                        <label>Colour</label>

                                        <input type="text" class="form-control" name="colour" value="<?= $found_livestock->colour ?>" placeholder="Enter colour">

                                        <?php  echo (!empty(validation_errors('colour')) ? validation_errors('colour') : ''); ?>

                                    </div>

                                    <div class="form-group">

                                        <label>Registration point</label>

                                        <select name="reg_point" class="form-control" required>

                                            <?php foreach($reg_point_options as $key => $value): ?>

                                                <option value="<?= $key ?>"  <?=  $found_livestock->reg_point == $key?  'selected': ''; ?>> <?= $value ?> </option>

                                            <?php endforeach ?>

                                        </select>

                                    </div>

                                    <div class="form-group">

                                        <label>Livestock purpose</label>

                                        <select name="livestock_purpose" class="form-control" required>

                                            <?php foreach($livestock_purpose_options as $key => $value): ?>

                                                <option value="<?= $key ?>"  <?=  $found_livestock->livestock_purpose == $key?  'selected': ''; ?>> <?= $value ?> </option>

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
                
            </div>

        </div>

        <!-- End of Topbar -->


        <!-- Begin Page Content -->
        <div class="container-fluid">

            <div class="row">

                <div class="col-xl-12 col-md-12 col-sm-12 mt-5">

                    <div class="card shadow p-4">

                        <div class="service-span">

                            <div>

                                <div class="div-content">

                                    <h5>ID: <?= $found_livestock->animal_id ?></h5>

                                </div>
                                
                            </div>

                        </div>

                        <hr>

                        <div class="service-span">

                            <div>
                                <div class="div-content">

                                    <div>Registration:</div>

                                    <h5><?= date('d F, Y',$found_livestock->date_created); ?></h5>

                                </div>

                                <div class="div-content">

                                    <div>Last Updated:</div>

                                    <h5><?= date('d F, Y',$found_livestock->last_updated);?></h5>

                                </div> 

                            </div>

                        </div>

                        <hr>

                        <div class="service-span">

                            <h5>Basic Information</h5>

                            <div>

                                <div class="div-content">

                                    <div>Species:</div>

                                    <h5><?= $livestock_type_options[$found_livestock->livestock_type]; ?></h5>

                                </div>

                                <div class="div-content">

                                    <div>Breed:</div>

                                    <h5><?= $breed_options[$found_livestock->breed_id]; ?></h5>

                                </div>

                            </div>

                        </div>

                        <div class="service-span">

                            <div>

                                <div class="div-content">

                                    <div>Weight:</div>

                                    <h5><?= $weight_options[$found_livestock->weight]; ?></h5>

                                </div>

                                <div class="div-content">

                                    <div>Age:</div>

                                    <h5><?= $age_range_options[$found_livestock->approx_age]; ?></h5>

                                </div>

                            </div>

                        </div>

                        <div class="service-span">

                            <div>

                                <div class="div-content">

                                    <div>Sex:</div>

                                    <h5><?= $sex_options[$found_livestock->sex]; ?></h5>

                                </div>

                                <div class="div-content">

                                    <div>Point of Registration:</div>

                                    <h5><?= $reg_point_options[$found_livestock->reg_point]; ?></h5>

                                </div>

                            </div>

                        </div>

                        <div class="service-span">

                            <div>

                                <div class="div-content">

                                    <div>Livestock purpose:</div>

                                    <h5><?= $livestock_purpose_options[$found_livestock->livestock_purpose]; ?></h5>

                                </div>

                            </div>

                        </div>


                        <hr>

                        <div class="service-span">

                            <h5>OWner's Information</h5>

                            <div>

                                <div class="div-content">

                                    <div>Name:</div>
                                
                                    <h5><?= $livestock_owner->name; ?></h5>

                                </div>

                                <div class="div-content">

                                    <div>Email:</div>

                                    <h5><?= $livestock_owner_details->email; ?></h5>

                                </div>

                            </div>

                            <div>

                                <div class="div-content">

                                    <div>Phone Number:</div>

                                    <h5><?= $livestock_owner->phone_number; ?></h5>

                                </div>

                                <div class="div-content">

                                    <div>Address:</div>

                                    <h5><?= $livestock_owner->address; ?></h5>

                                </div>

                            </div>

                        </div>   

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-xl-12 col-md-12 col-sm-12">

                    <div class="card shadow mb-4 mt-5">

                        <!-- Tabs Navigation -->
                        
                        <ul class="nav nav-tabs w-100 mt-3 ml-4" id="myTab" role="tablist">
                        

                            <li class="nav-item" role="presentation">

                            <a hx-get="<?=BASE_URL?>veterinary_professionals/vaccination" hx-target="#myTabContent" class="nav-link-tab" id="vaccination" data-bs-toggle="tab" 

                            data-bs-target="#home" type="button" role="tab" aria-controls="home" 

                            aria-selected="true">Vaccination

                            <span class="not-found-placeholder"><?= (isset($vaccination_count) && !empty($vaccination_count)) ? $vaccination_count : 0 ?></span></a>

                            </li>

                            <li class="nav-item" role="presentation">

                            <a hx-get="<?=BASE_URL?>veterinary_professionals/deworming_schedule" hx-target="#myTabContent" class="nav-link-tab" id="deworming" data-bs-toggle="tab" 

                            data-bs-target="#profile" type="button" role="tab" aria-controls="profile" 

                            aria-selected="false">Deworming Schedule

                            <span class="not-found-placeholder"><?= (isset($deworming_count) && !empty($deworming_count)) ? $deworming_count : 0  ?></span></a>

                            </li>

                            <li class="nav-item" role="presentation">

                            <a hx-get="<?=BASE_URL?>veterinary_professionals/medical_diagnosis" hx-target="#myTabContent" class="nav-link-tab" id="medical-history" data-bs-toggle="tab" data-bs-target="#contact" 

                            type="button" role="tab" aria-controls="contact" aria-selected="false">

                            Medical History

                            <span class="not-found-placeholder"><?= (isset($diagnosis_count) && !empty($diagnosis_count)) ? $diagnosis_count : 0  ?></span></a>

                            </li>

                            <li class="nav-item" role="presentation">

                            <a hx-get="<?=BASE_URL?>veterinary_professionals/medications" hx-target="#myTabContent" class="nav-link-tab" id="medication" data-bs-toggle="tab" 

                            data-bs-target="#settings" type="button" role="tab" aria-controls="settings" 

                            aria-selected="false">Medications

                            <span class="not-found-placeholder"><?= (isset($medication_count) && !empty($medication_count)) ? $medication_count : 0 ?></span></a>

                            </li>

                        </ul>
                        <!-- Tabs Content -->

                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                <!-- Begin Page Content -->

                                    <!-- DataTales Example -->

                                    <div class="card shadow mb-4 mt-5">

                                        <div class="card-header py-3">

                                            <div class="header-content">

                                                <h6 class="m-0 font-weight-bold">Vaccination Records</h6>

                                                <button type="button" class="btn btn-vaccination" data-toggle="modal" title="Vaccination" data-target=".vaccination">New Vaccination</button>
                                        
                                            </div>

                                            <!-- Vaccination Modal -->
                                            <div class="modal fade vaccination" role="dialog" aria-labelledby="VaccinationModalLabel" aria-hidden="true">

                                                <div class="modal-dialog" role="document">

                                                    <?php  echo form_open('veterinary_professionals/submit_vaccination_record'); ?>

                                                        <input type="hidden" value="<?= isset($found_livestock->id)? $found_livestock->id : ''  ?>" name="id">

                                                        <input type="hidden" value="<?= isset($found_livestock->reg_by)? $found_livestock->reg_by : ''  ?>" name="reg_by">

                                                        <div class="modal-content">

                                                            <div class="modal-header">

                                                                <h5 class="modal-title" id="vaccinationModalLabel">Record Vaccination</h5>

                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">

                                                                    <span aria-hidden="true">×</span>

                                                                </button>

                                                            </div>

                                                            <div class="modal-body">

                                                                <div class="form-group">

                                                                    <label>Vaccination Type</label>

                                                                    <select name="vaccination_type" class="form-control" required>
                                                        
                                                                        <?php foreach($vaccination_type_options as $key => $value): ?>

                                                                            <option value="<?= $key ?>"> <?= $value ?> </option>

                                                                        <?php endforeach ?>
                                                                    
                                                                    </select>

                                                                </div>

                                                                <div class="form-group">

                                                                    <label>Date Administered</label>

                                                                    <input type="date" class="form-control" name="date_administered"  required>

                                                                </div>  
                                                                
                                                                <div class="form-group">

                                                                    <label>Next Due Date</label>

                                                                    <input type="date" class="form-control" name="next_due_date"  required>

                                                                </div>
                                                                
                                                                
                                                                <div class="form-group">

                                                                    <label>Process Stage</label>

                                                                    <select name="process_stage" class="form-control" required>
                                                        
                                                                        <?php foreach($process_type_options as $key => $value): ?>

                                                                            <option value="<?= $key ?>"> <?= $value ?> </option>

                                                                        <?php endforeach ?>
                                                                    
                                                                    </select>

                                                                </div>

                                                                
                                                            </div>

                                                            <div class="modal-footer btn-group">

                                                                <?php

                                                                    $attr_close = array(

                                                                        "class" => "btn btn-outline-dark",

                                                                        "data-dismiss" => "modal"

                                                                    );

                                                                    echo form_button('close', 'Cancel', $attr_close);

                                                                    echo form_submit('submit', 'Record', array("class" => 'btn btn-vaccination shadow-sm'));

                                                                ?>

                                                            </div>

                                                        </div>

                                                    <?php echo form_close();?>   

                                                </div>

                                            </div> 

                                        </div>

                                        <div class="card-body">

                                            <div class="table-responsive">

                                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                                    <thead>

                                                        <tr>

                                                            <th>Date</th>

                                                            <th>Vaccine</th>

                                                            <th>Provider</th>

                                                            <th>Next Due Date</th>

                                                        </tr>

                                                    </thead>

                                                    <tbody>


                                                        <?php foreach ($vaccination_records as $record) { ?>

                                                            <?php $veterinary_professional = Modules::run('veterinary_professionals/get_user_veterinary_professionals',$record->reg_by); ?>

                                                            <tr>
                                                                <td><?= date('d F, Y',strtotime($record->date_administered)); ?></td>

                                                                <td><?= $vaccination_type_options[$record->vaccine]; ?></td>

                                                                <td><?= $veterinary_professional['provider']; ?> </td>

                                                                <td><?= date('d F, Y',strtotime($record->next_due_date)); ?></td>


                                                            </tr>

                                                        <?php

                                                        }

                                                        ?>

                                                    </tbody>

                                                </table>

                                            </div>

                                        </div>

                                    </div>

                                <!-- /.container-fluid -->

                            </div>

                        </div>

                    </div>

                </div>

            </div> 

        </div>   


    <?php else:?>  

        <div class="baseline mb-4 p-4">

            <div class="base-left">
                
                <div class="dashboard-name">

                    <h1 class="h3 mb-0">Welcome, <?= 'Dr. '.$name ?> </h1>

                </div>

                <div class="company-group mt-2">

                    <div class="company1"> <?= $reg_number ?>  | <?= $nldpi_number ?> |</div>

                    <div class="badge">

                        <div class="text">Verified Provider</div>

                    </div>

                </div>

            </div>

        </div>

        <div class="container-fluid" style="background-color:#F5FCF9;">

            <div class="row">

                <!-- Total Registered Livestock -->
                
                <div class="col-xl-6 col-md-6 mb-4">

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

                <!-- Helath Records Updated -->

                <div class="col-xl-6 col-md-6 mb-4">

                    <div class="card shadow h-100 py-2">

                        <div class="card-body">

                            <div class="no-gutters align-items-center">

                                <div class="animal-registered-container">

                                    <span>Health Records Updated</span>

                                    <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>

                                </div>
                            
                                <div class="h2 mb-0 font-weight-bold text-gray-800 mt-2 count"><?= number_format($total_livestock_treated) ?></div>
                        
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <h5 class="mb-0 quick-action mb-2">Quick Actions</h5>

            <div class="row">

                <div class="col-xl-6 col-md-6 mb-4">

                    <div class="card shadow h-100 py-2">
                        
                        <div class="card-body">

                            <div class="no-gutters align-items-center">

                                <a class="text-and-action nav-link" href="<?= BASE_URL."veterinary_professionals/transport_permit" ?>" title="Create transport permit">

                                    <img class="text-and-action-child" alt="" src="<?= THEME_DIR?>img/permit.svg">

                                    <div class="company-and-quote">

                                        <div class="company">Create Transport Permit</div>

                                        <div class="quote">Create Loading/offloading permit for Livestock transportation</div>

                                    </div>

                                </a>  
                        
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-xl-6 col-md-6 mb-4">

                    <div class="card shadow h-100 py-2">

                        <div class="card-body">

                            <div class="no-gutters align-items-center">

                                <a class="text-and-action nav-link" href="<?= BASE_URL."veterinary_professionals/livestock_registry" ?>" title="Register new livestock">

                                    <img class="text-and-action-child" alt="" src="<?= THEME_DIR?>img/new_livestock.svg">

                                    <div class="company-and-quote">

                                    <div class="company">Register New Livestock</div>

                                        <div class="quote">Register an Livestock into the general database</div>

                                    </div>

                                </a>
                        
                            </div>

                        </div>

                    </div>

                </div>

            </div> 

            <div class="row">

                <div class="col-md-12">

                    <form action="<?=BASE_URL?>veterinary_professionals/dashboard" method="POST">

                        <div class="lookup">

                            <div class="lookup-span-label">

                                <h6 class="m-0 font-weight-bold">Livestock lookup</h6>

                                <p class="mt-1">Enter Livestock ID to view the health records</p>

                            </div>

                            <div class="lookup-span-search">

                                <div class="has-search">

                                    <span class="fa fa-search  form-control-feedback"></span>

                                    <input type="text" class="form-control"  name="search_livestock" placeholder="Search by livestock ID" >

                                </div>

                                <input type="submit" name="submit" value="Lookup" class="btn btn-lookup " >

                            

                            </div>

                        </div>
                        
                        <div class="text-danger"><?= isset($message) && !empty($message) ? $message : '' ?></div>
                    
                    </form>

                </div>
            
            </div>

            <div class="row">

                <div class="offset-md-1 col-md-10">

                    <?php  if(isset($_SESSION['success'])): ?>
                        
                            <div class=' alert alert-success alert-dismissable mt-2' style='text-align:center;'>

                                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>

                                    <?= $_SESSION["success"] ?>
                            </div>

                            <?php unset($_SESSION["success"]); ?>

                        <?php endif    ?>  

                </div>

            </div>

            <div class="row">

                <!-- Table Area -->

                <div class="col-xl-12 col-md-12 col-sm-12 mt-3">

                    <div class="card shadow mb-4">

                        <!-- Card Header - Dropdown -->

                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                            <div>

                                <h6 class="m-0 font-weight-bold">Recent Activities</h6>

                                <p class="mt-2">Keep track of recent activities</p>

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

                                <table class="table table-bordered dataTable" width="100%" cellspacing="0">

                                    <thead>

                                    <tr>

                                        <th>Date</th>

                                        <th>Livestock ID</th>

                                        <th>Livestock Type</th>

                                        <th>Service</th>

                                        <th>Status</th>

                                    </tr>

                                    </thead>

                                    <tbody>

                                        <?php foreach ($livestock_list as $livestock) { ?>

                                            <?php $animal_registration_details = Modules::run('veterinary_professionals/get_animal_registration_details',$livestock->animal_reg_id); ?>

                                            <tr>
                                                <td><?= date('d F, Y',$livestock->date_created); ?></td>

                                                <td><?= $animal_registration_details['animal_id']; ?></td>

                                                <td><?= $animal_registration_details['type']; ?> </td>

                                                <td><?= $livestock->service; ?></td>

                                                <td><?= $livestock->status; ?></td>

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


    <?php endif?>


<style>

    a {

        color: #16192c;

        text-decoration: none;

        background-color: transparent;

    }

    a:hover {

        color: #00ad56;

    }

    .company {

        align-self: stretch;

        position: relative;

        line-height: 120%;

        font-weight: 600;

    }



    .company1 {

        position: relative;

        line-height: 130%;

    }



    .text {

        position: relative;

        line-height: 18px;

        font-weight: 500;

    }



    .badge {

        border-radius: 16px;

        background-color: #f5fffa;

        border: 1px solid #d6ffea;

        display: flex;

        flex-direction: row;

        align-items: center;

        justify-content: flex-start;

        padding: 2px 8px;

        mix-blend-mode: multiply;

        text-align: center;

        font-size: 12px;

        color: #00ad56;

    }



    .company-group {

        display: flex;

        flex-direction: row;

        align-items: flex-start;

        justify-content: flex-start;

        gap: 8px;

        font-size: 16px;

        color: #475467;

    }



    .company-parent {

        width: 100%;

        position: relative;

        border-bottom: 1px solid #eaecf0;

        box-sizing: border-box;

        display: flex;

        flex-direction: column;

        align-items: flex-start;

        justify-content: center;

        padding: 24px 32px;

        gap: 8px;

        text-align: left;

        font-size: 24px;

        color: #101828;

        font-family: Nunito;

    }



    .frame-icon {

        width: 100%;

        position: relative;

        border-radius: 114.84px;

        height: 58px;

        overflow: hidden;

        flex-shrink: 0;

    }



    .text-and-action-child {

        width: 58px;

        position: relative;

        border-radius: 114.84px;

        height: 58px;

        overflow: hidden;

        flex-shrink: 0;

    }



    .company {

        align-self: stretch;

        position: relative;

        line-height: 120%;

        text-transform: capitalize;

        font-weight: 600;

    }



    .quote {

        align-self: stretch;

        position: relative;

        font-size: 16px;

        line-height: 130%;

        color: #475467;

    }



    .company-and-quote {

        flex: 1;

        display: flex;

        flex-direction: column;

        align-items: flex-start;

        justify-content: flex-start;

        gap: 4px;

    }



    .text-and-action {

        flex: 1;

        border-radius: 8px;

        background-color: #fff;

        /*border: 1px solid #eaecf0;*/

        display: flex;

        flex-direction: row;

        align-items: center;

        justify-content: flex-start;

        padding: 16px;

        gap: 18px;

    }



    .company2 {

        align-self: stretch;

        position: relative;

        line-height: 120%;

        font-weight: 600;

    }



    .text-and-action-parent {

        width: 100%;

        position: relative;

        display: flex;

        flex-direction: row;

        align-items: center;

        justify-content: flex-start;

        gap: 24px;

        text-align: left;

        font-size: 18px;

        color: #16192c;

        font-family: Nunito;

    }

    .quick-action{
        color: #101828 !important;
    }


    .lookup {
        margin-top:16px;
        margin-bottom:16px;
        padding: 20px;
        display:grid;
        grid-template-columns: 350px 3fr;
        background-color: #ffffff;
        border-radius:3px;
    }

    .loopkup > .lookup-span-lable{

        margin-right:16px;
    }

    .lookup > .lookup-span-lable > h6{
        color: #101828 !important;
      
    }

    .lookup > .lookup-span-search > .has-search{
        display:inline-block
       
    }

    .lookup > .lookup-span-search > button{
       display:inline-block
       
    }



    .has-search{
       padding:0;
    }



    .nav-link-tab {

color: grey !important;  /* Green text for all links */

display: flex;

justify-content: space-between;  /* Push text and number to opposite ends */

align-items: center;

width: 100%;  /* Ensure proper space distribution */

}



.nav-link-tab.active {

color: #00ad56 !important;

text-decoration: underline;  /* Underline the active link */

}



.nav-item {

margin-right: 15px;  /* Add space between links */

}



.found-placeholder {

color: #00ad56;

border: 1px solid #00ad56;  /* Circle background */

border-radius: 50%;  /* Make it circular */

width: 24px;  /* Set fixed size for the circle */

height: 24px;

display: flex;

justify-content: center;

align-items: center;

font-size: 0.9em;

margin-left: 10px;  /* Space between text and number circle */

}

.not-found-placeholder {
    color: grey;

    border: 1px solid grey;  /* Circle background */

    background-color: #d2d2d2;

    border-radius: 50%;  /* Make it circular */

    width: 24px;  /* Set fixed size for the circle */

    height: 24px;

    display: flex;

    justify-content: center;

    align-items: center;

    font-size: 0.9em;

    margin-left: 10px;  /* Space between text and number circle */

}


.nav-link-tab.active{
    border-bottom: 1px solid #00ad56;
}

.header-content{
    display: flex;
    justify-content:space-between;
} 

.btn-lookup, .btn-vaccination{
    background-color:#00ad56;
    color: #ffffff;
}


.btn-lookup:hover, .btn-vaccination:hover{
    color: #ffffff;
}


@media (max-width: 992px) {
    .lookup {
        grid-template-columns: 1fr;

    }

    .has-search > input[type=text]{
        margin-bottom: 5px;
    }
 
}

  

</style>

<script>
    

$(document).ready(function() {

    $('#vaccination').toggleClass('active');

    $('#vaccination').children('.not-found-placeholder').toggleClass('found-placeholder');

    $('#vaccination').children('.found-placeholder').removeClass('not-found-placeholder');

    $('#deworming').removeClass('active')

    $('#deworming').children('.found-placeholder').toggleClass('not-found-placeholder');

    $('#deworming').children('.not-found-placeholder').removeClass('found-placeholder');

    $('#medical-history').removeClass('active');

    $('#medical-history').children('.found-placeholder').toggleClass('not-found-placeholder');
    
    $('#medical-history').children('.not-found-placeholder').removeClass('found-placeholder');


    $('#medication').removeClass('active');

    $('#medication').children('.found-placeholder').toggleClass('not-found-placeholder');

    $('#medication').children('.not-found-placeholder').removeClass('found-placeholder');


    $('#vaccination').on('click', function(e){

        e.preventDefault();

        $('#deworming').removeClass('active');

        $('#deworming').children('.found-placeholder').toggleClass('not-found-placeholder');

        $('#deworming').children('.not-found-placeholder').removeClass('found-placeholder');

        
        $('#medical-history').removeClass('active');

        $('#medical-history').children('.found-placeholder').toggleClass('not-found-placeholder');
        
        $('#medical-history').children('.not-found-placeholder').removeClass('found-placeholder');


        $('#medication').removeClass('active');

        $('#medication').children('.found-placeholder').toggleClass('not-found-placeholder');

        $('#medication').children('.not-found-placeholder').removeClass('found-placeholder');


        $(this).toggleClass('active');

        $(this).children('.not-found-placeholder').toggleClass('found-placeholder');

        $(this).children('.found-placeholder').removeClass('not-found-placeholder');


    });


    $('#deworming').on('click', function(e){

        e.preventDefault();

        $('#vaccination').removeClass('active');

        $('#vaccination').children('.found-placeholder').toggleClass('not-found-placeholder');

        $('#vaccination').children('.not-found-placeholder').removeClass('found-placeholder');

        $('#medical-history').removeClass('active');

        $('#medical-history').children('.found-placeholder').toggleClass('not-found-placeholder');
        
        $('#medical-history').children('.not-found-placeholder').removeClass('found-placeholder');


        $('#medication').removeClass('active');

        $('#medication').children('.found-placeholder').toggleClass('not-found-placeholder');

        $('#medication').children('.not-found-placeholder').removeClass('found-placeholder');


        $(this).toggleClass('active');

        $(this).children('.not-found-placeholder').toggleClass('found-placeholder');

        $(this).children('.found-placeholder').removeClass('not-found-placeholder');


    });



    $('#medical-history').on('click', function(e){

        e.preventDefault();

        $('#vaccination').removeClass('active');

        $('#vaccination').children('.found-placeholder').toggleClass('not-found-placeholder');
        
        $('#vaccination').children('.not-found-placeholder').removeClass('found-placeholder');

        $('#deworming').removeClass('active')

        $('#deworming').children('.found-placeholder').toggleClass('not-found-placeholder');

        $('#deworming').children('.not-found-placeholder').removeClass('found-placeholder');

        $('#medication').removeClass('active')

        $('#medication').children('.found-placeholder').toggleClass('not-found-placeholder');

        $('#medication').children('.not-found-placeholder').removeClass('found-placeholder');


        $(this).toggleClass('active');

        $(this).children('.not-found-placeholder').toggleClass('found-placeholder');

        $(this).children('.found-placeholder').removeClass('not-found-placeholder');


    });


    $('#medication').on('click', function(e){

        e.preventDefault();

        $('#vaccination').removeClass('active');

        $('#vaccination').children('.found-placeholder').toggleClass('not-found-placeholder');

        $('#vaccination').children('.not-found-placeholder').removeClass('found-placeholder');

        $('#deworming').removeClass('active');

        $('#deworming').children('.found-placeholder').toggleClass('not-found-placeholder');

        $('#deworming').children('.not-found-placeholder').removeClass('found-placeholder');

        $('#medical-history').removeClass('active');

        $('#medical-history').children('.found-placeholder').toggleClass('not-found-placeholder');
        
        $('#medical-history').children('.not-found-placeholder').removeClass('found-placeholder');


        $(this).toggleClass('active');

        $(this).children('.not-found-placeholder').toggleClass('found-placeholder');

        $(this).children('.found-placeholder').removeClass('not-found-placeholder');

    });


    $(".modal").modal('hide');



    $('.btn-vaccination').click(function () {

        $(this).parent().find('.vaccination').modal('toggle'); 

    });


    
    $('.btn-deworming-schedule').click(function () {

        $(this).parent().find('.deworming-schedule').modal('toggle'); 

    });


        
    $('.btn-medical-history').click(function () {

        $(this).parent().find('.medical-history').modal('toggle'); 

    });


    $('.btn-medication').click(function () {

        $(this).parent().find('.medical-treatment').modal('toggle'); 

     });


});

</script>
    
