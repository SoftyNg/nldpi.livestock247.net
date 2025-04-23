<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <?php  require_once ("_navigation.php"); ?>


        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h6 class="h3 mb-0 text-gray-800">Dashboard</h6>
                <a href="" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            </div>
            <!-- Content Row Start-->
            <div class="row">
                <!-- Area Chart -->
                <div class="col-md-6 col-lg-7 col-xl-8">
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-md-3 mb-3">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Pending</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pending Requests Card Example -->
                        <div class="col-md-3 mb-3">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total Pending</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Total Pending</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Pending</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pie Chart -->
                <div class="col-md-6 col-lg-5 col-xl-4">
                    
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Conversion rate</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   0
                                </a>
                                
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="small font-weight-bold">
                                Added to ...
                                <span class="float-right">pending</span>
                            </h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width:0"
                                    aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <h4 class="small font-weight-bold">
                                Reached checkou
                                <span class="float-right">pending</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-warning" role="progressbar" 
                                    aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <h4 class="small font-weight-bold">
                                Final purchase  
                                <span class="float-right"><?= 0;?>% </span>
                            </h4>
                            <div class="progress mb-4">
                                <div class="progress-bar" role="progressbar" 
                                    aria-valuenow="<?= 0;?>" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>                                
                        </div>
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Table Data 1</h6>
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
                                <table class="table table-bordered small-table"  width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Service</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Data pending</td>
                                            <td>Data pending</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Data pending</td>
                                            <td>Data pending</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Content Row End -->

            <!-- Content Row Start -->

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Table 2</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered dataTable"  width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Service</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Data pending</td>
                                            <td>Data pending</td>
                                            <td><a href="" class="btn btn-primary">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Data pending</td>
                                            <td>Data pending</td>
                                            <td><a href="" class="btn btn-primary">View</a></td>
                                        </tr> 
                                        <tr>
                                            <td>1</td>
                                            <td>Data pending</td>
                                            <td>Data pending</td>
                                             <td><a href="" class="btn btn-primary">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Data pending</td>
                                            <td>Data pending</td>
                                            <td><a href="" class="btn btn-primary">View</a></td>
                                        </tr>           
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>                             
            </div>
            <!-- Content Row End -->

            <!-- Row Start -->
            <div class="row">   
                <div class="col-lg-12 mb-4">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data table 3</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Service</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Data pending</td>
                                            <td>Data pending</td>
                                            <td><a href="" class="btn btn-primary">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Data pending</td>
                                            <td>Data pending</td>
                                            <td><a href="" class="btn btn-primary">View</a></td>
                                        </tr> 
                                        <tr>
                                            <td>1</td>
                                            <td>Data pending</td>
                                            <td>Data pending</td>
                                            <td><a href="" class="btn btn-primary">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Data pending</td>
                                            <td>Data pending</td>
                                            <td><a href="" class="btn btn-primary">View</a></td>
                                        </tr>           
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row End -->
        </div>
    </div>
    <!-- End of Main Content -->



