

<div class="container-fluid" style="background-color:#F5FCF9;">
<?php $email = $_SESSION['email'];
    $user_data =  Modules::run('service_providers/_fetch_all_data_for_user', $email); 
   foreach ($user_data as $user) :
   $name = $user->company_name;
   $nldpiNumber = $user->nldpi_number;      
 endforeach; ?>
    <div class="company-parent">

        <div class="company">Welcome back</div>

        <div class="company-group">

            <div class="company1"><?= $name;?> | ID: ET-042 |</div>

            <div class="badge">

                <div class="text">Verified Provider</div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-xl-4 col-md-6 mb-4">

            <div class="card shadow h-100 py-2">

                <div class="card-body">

                    <div class="no-gutters align-items-center">

                        <a class="nav-link" href="<?= BASE_URL."service_providers/number_banks" ?>">

                            <div class="animal-registered-container">

                                <span>Active Number Banks</span>

                                <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>

                            </div>

                            <div class="h5 mb-0 font-weight-bold text-gray-800 mt-2">0</div>

                        </a>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-4 col-md-6 mb-4">

            <div class="card shadow h-100 py-2">

                <div class="card-body">

                    <div class="no-gutters align-items-center">

                        <div class="animal-registered-container">

                            <span>Available ID</span>

                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>

                        </div>

                        

                            <div class="h5 mb-0 font-weight-bold text-gray-800 mt-2">0</div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-4 col-md-6 mb-4">

            <div class="card shadow h-100 py-2">

                <div class="card-body">

                    <div class="no-gutters align-items-center">

                        <div class="animal-registered-container">

                            <span>Registered Livestocks</span>

                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>

                        </div>

                        

                            <div class="h5 mb-0 font-weight-bold text-gray-800 mt-2">0</div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <h5 class="mb-0">Quick Actions</h5>

    <div class="text-and-action-parent">

        <a class="text-and-action nav-link" href="<?= BASE_URL."service_providers/number_banks" ?>">

            <img class="text-and-action-child" alt="" src="<?= THEME_DIR?>img/number.svg">

            

            <div class="company-and-quote">

             <div class="company">
                    Request Number Bank
                </div>


                    <div class="quote">Request a number bank for ID and tracking devices</div>

            </div>

        </a>    

        <a class="text-and-action nav-link" href="<?= BASE_URL."service_providers/number_banks" ?>">

            <img class="text-and-action-child" alt="" src="<?= THEME_DIR?>img/network.svg">

            

            <div class="company-and-quote">

                    <div class="company">Allocate Livestock ID</div>

                    <div class="quote">Allocate Livestock Id’s from your available bank to a professional</div>

            </div>

        </a>

        <a class="text-and-action nav-link" href="<?= BASE_URL."service_providers/livestock_registry" ?>">

            <img class="text-and-action-child" alt="" src="<?= THEME_DIR?>img/note.svg">

            <div class="company-and-quote">

                    <div class="company2">Livestock Registration</div>

                    <div class="quote">Register livestock into the general database</div>

            </div>

        </a>

    </div>



    <div class="row">



        <!-- Table Area -->

        <div class="col-xl-12 col-md-12 col-sm-12 mt-3">

            <div class="card shadow mb-4">

                <!-- Card Header - Dropdown -->

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                    <div>

                        <h6 class="m-0 font-weight-bold">Registered Livestocks</h6>

                        <p class="mt-2">Keep track of registered livestocks</p>

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

                                            <th>Date Registered</th>

                                            <th>Livestock ID</th>

                                            <th>Livestock Type</th>

                                            <th>Breed</th>

                                            <th>Registration Location</th>

                                            <th>Actions</th>

                                        </tr>

                                        </thead>

                                        <tbody>

                                                <?php 
                                                 $livestock_list =  Modules::run('service_providers/_fetch_animals_for_user', $nldpiNumber); 
                                                 foreach ($livestock_list as $livestock) { ?>

                                                    <tr>

                                                        <td><?= $livestock->reg_date; ?></td>

                                                        <td><?= $livestock->animal_id; ?></td>

                                                        <td><?= $livestock->livestock_type; ?></td>

                                                        <td><?= $livestock->breed; ?></td>

                                                        <td><?= $livestock->reg_point; ?></td>

                                                        <td>

                                                            <a href="" class="btn btn-outline-dark btn-sm edit-breed-registration" id="<?= $livestock->id ?>" data-toggle="modal" title="Edit" data-target="#<?= $livestock->id ?>editBreedRegistration" ><i class="fa fa-edit fa-sm"></i></a>

                                                            <a href="" class="btn btn-outline-danger btn-sm delete-breed-registration" id-data="<?= $livestock->id ?>" data-toggle="modal" title="Delete" data-target="#<?= $livestock->id ?>deleteBreedRegistration" ><i class="fa fa-trash fa-sm"></i></a>

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





<style>

    a {

        color: #16192c;

        text-decoration: none;

        background-color: transparent;

    }

    a:hover {

        color: green;

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

        border: 1px solid #eaecf0;

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



</style>

