<?php  require_once ("_navigation.php"); ?>

<div class="baseline mb-4 p-4">

    <div class="base-left">

        <div class="dashboard-name">

            <h1 class="h3 mb-0">Breed Registry</h1>

        </div>

    </div>

    <div class="base-right">

    <a href="breed_registrations/create" class="btn btn-success shadow-sm">Register New Breed</a>

    </div>

</div>

<!-- End of Topbar -->



<!-- Begin Page Content -->

<div class="container-fluid">

<?php flashdata(); ?>

    <div class="row">

        <div class="col-xl-4 col-md-6 mb-4">

            <div class="card shadow h-100 py-2">

                <div class="card-body">

                    <div class="no-gutters align-items-center">

                        <div class="animal-registered-container">

                            <span>Registered Breeds</span>

                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>

                        </div>
                       
                         <div class="h2 mb-0 font-weight-bold text-gray-800 mt-2 count"><?= number_format($total_registered_breed) ?></div>
                 
                    </div>

                </div>

            </div>

        </div>
   
        <div class="col-xl-4 col-md-6 mb-4">

            <div class="card shadow h-100 py-2">

                <div class="card-body">

                    <div class="no-gutters align-items-center">

                        <div class="animal-registered-container">

                            <span>Local Breeds</span>

                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>

                        </div>
                       
                         <div class="h2 mb-0 font-weight-bold text-gray-800 mt-2 count"><?= number_format($total_registered_local_breed) ?></div>
                 
                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-4 col-md-6 mb-4">

            <div class="card shadow h-100 py-2">

                <div class="card-body">

                    <div class="no-gutters align-items-center">

                        <div class="animal-registered-container">

                            <span>Exotic Breeds</span>

                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>

                        </div>
                       
                         <div class="h2 mb-0 font-weight-bold text-gray-800 mt-2 count"><?= number_format($total_registered_exotic_breed) ?></div>
                    </div>

                </div>

            </div>

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

                        <h6 class="m-0 font-weight-bold">Registered breeds</h6>

                        <p class="mt-2">Keep track of registered animals</p>

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

                                            <th>Name</th>

                                            <th>Livestock Type</th>

                                            <th>Breed Type</th>

                                            <th>Description</th>

                                            <th>Status</th>

                                            <th>Actions</th>

                                        </tr>

                                        </thead>

                                        <tbody>

                                                <?php foreach ($breed_list as $breed) { ?>

                                                    <tr>

                                                        <td><?= $breed->name; ?></td>

                                                        <td><?= $livestock_type_options[$breed->livestock_type]; ?></td>

                                                        <td><?= $breed_type_options[$breed->breed_type]; ?></td>

                                                        <td><?= $breed->description; ?></td>

                                                        <td><?= $status_options[$breed->status]; ?></td>

                                                        <td>

                                                        <a href="breed_registrations/show/<?= $breed->id ?>" class="btn btn-outline">View</a>

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