<?php  require_once ("_navigation.php"); ?>



<div class="baseline mb-4 p-4">
    <div class="base-left">
        <div class="dashboard-name">
            <h1 class="h3 mb-0">Veterinary Professional Registry</h1>
        </div>
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
                            <span>Total Registered</span>
                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>
                        </div>
                       
                         <div class="h2 mb-0 font-weight-bold text-gray-800 mt-2 count"><?= number_format($vet_professionals_total) ?></div>
                 
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
                            <span>Approved</span>
                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>
                        </div>
                       
                         <div class="h2 mb-0 font-weight-bold text-gray-800 mt-2 count"><?= number_format($vet_professionals_approved) ?></div>
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
                            <span>Pending Review</span>
                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>
                        </div>
                       
                         <div class="h2 mb-0 font-weight-bold text-gray-800 mt-2 count"><?= number_format($vet_professionals_pending) ?></div>
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
                            <span>Rejected</span>
                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>
                        </div>
                       
                         <div class="h2 mb-0 font-weight-bold text-gray-800 mt-2 count"><?= number_format($vet_professionals_rejected) ?></div>
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
                        <h5 class="m-0 font-weight-bold font">Veterinary Professionals</h5>
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
                                    <th>Name</th>
                                    <th>Professional ID</th>
                                    <th>Date Registered</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list_of_registered_vet_professionals as $registered_vet_professional) { ?>
                                    <tr>
                                        <td><?= $registered_vet_professional->firstname.' '.$registered_vet_professional->lastname; ?></td>
            
                                        <td><?= $registered_vet_professional->reg_number; ?></td>
                                        <td><?= date('d F, Y',strtotime($registered_vet_professional->date_created));?> </td>
                                        <td>
                                            <?php if($registered_vet_professional->status==1): ?>
                                                <span class="status-active"><i style="font-size:20px">&bull; </i><?= 'Approved'; ?></span>  
                                            <?php elseif($registered_vet_professional->status==2): ?>
                                                <span class="status-reject"><i style="font-size:20px">&bull; </i><?= 'Rejected'; ?></span>  
                                            <?php elseif($registered_vet_professional->status==0): ?>
                                                <span class="status-pending"><i style="font-size:20px">&bull; </i><?= 'Pending'; ?></span>  
                                            <?php endif ?>                                             
                                        </td>
                                        <td>
                                            <a href="<?= BASE_URL . 'admin/users/veterinary-professional/'.$registered_vet_professional->id?>" class="fa-view-icon" title="View"><i class="fa fa-eye"></i> View </a>
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
