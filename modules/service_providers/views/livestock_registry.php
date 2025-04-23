<div class="baseline mb-4 p-4">

    <div class="base-left">

        <div class="dashboard-name">

            <h1 class="h3 mb-0">Livestock Registry</h1>

        </div>

    </div>

    <div class="base-right">

    <a href="<?= BASE_URL."service_providers/register_new_animal" ?>" class="btn btn-success">Register New Livestock</a>

    </div>

</div>

<!-- End of Topbar -->



<!-- Begin Page Content -->

<div class="container-fluid">

    <!-- Content Row -->

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card shadow h-100 py-2">

                <div class="card-body">

                    <div class="no-gutters align-items-center">

                        <div class="animal-registered-container">

                            <span>Livestock Registered</span>

                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>

                        </div>

                       

                         <div class="h5 mb-0 font-weight-bold text-gray-800 mt-2"><?= $total_registered_breed ?></div>

                 

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card shadow h-100 py-2">

                <div class="card-body">

                    <div class="no-gutters align-items-center">

                        <div class="animal-registered-container">

                            <span>Cow</span>

                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>

                        </div>

                       

                         <div class="h5 mb-0 font-weight-bold text-gray-800 mt-2"><?= $total_registered_local_breed?></div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card shadow h-100 py-2">

                <div class="card-body">

                    <div class="no-gutters align-items-center">

                        <div class="animal-registered-container">

                            <span>Sheep</span>

                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>

                        </div>

                       

                         <div class="h5 mb-0 font-weight-bold text-gray-800 mt-2"><?= $total_registered_exotic_breed?></div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card shadow h-100 py-2">

                <div class="card-body">

                    <div class="no-gutters align-items-center">

                        <div class="animal-registered-container">

                            <span>Goat</span>

                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>

                        </div>

                       

                         <div class="h5 mb-0 font-weight-bold text-gray-800 mt-2"><?= $total_registered_exotic_breed?></div>

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

                                                <?php foreach ($livestock_list as $livestock) { ?>

                                                    <tr>

                                                        <td><?= $livestock->name; ?></td>

                                                        <td><?= $livestock->type_of_animal; ?></td>

                                                        <td><?= $livestock->breed_type; ?></td>

                                                        <td><?= $livestock->description; ?></td>

                                                        <td><?= $livestock->additional_note; ?></td>

                                                        <td>

                                                            <a href="" class="btn btn-outline-dark btn-sm edit-breed-registration" id="<?= $breed->id ?>" data-toggle="modal" title="Edit" data-target="#<?= $breed->id ?>editBreedRegistration" ><i class="fa fa-edit fa-sm"></i></a>

                                                            <a href="" class="btn btn-outline-danger btn-sm delete-breed-registration" id-data="<?= $breed->id ?>" data-toggle="modal" title="Delete" data-target="#<?= $breed->id ?>deleteBreedRegistration" ><i class="fa fa-trash fa-sm"></i></a>

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