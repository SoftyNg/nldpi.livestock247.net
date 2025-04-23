
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
                <h6 class="h3 mb-0 text-gray-800">Grant Privilege</h6>
            </div>

            <!-- Content Row Start -->
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 " style="min-height:500px;">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">Grant Privilege</h6>
                        </div>
                        <div class="card-body">
                            <div class="message_success text-success"></div>
                            <strong>Grant user access type to the application</strong>
                            <div class="row">
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Select User</label>
                                        <select name="user" id="user" class="form-control">
                                            <option value="">Select-User</option>
                                            <?php foreach($users as $user){?>
                                                <option value="<?= $user->id ?>"><?= ucwords($user->full_name) ?></option>
                                            <?php }?>
                                        </select>
                                        <span class="user-group text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Select Access Type</label>
                                        <select name="user_type" id="user-type" class="form-control">
                                            <option value="">Select-Access-Type</option>
                                            <option value="0">Lock Out</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Sales</option>
                                            <option value="3">Butchery</option>
                                        </select>
                                        <span class="user-type-group text-danger"></span>
                                    </div>
                                </div>                      
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary form-control grant-access"> Grant Access</button>     
                                    </div>
                                </div> 
                            </div>

                            <br>
                            <div class="message_butchery_success text-success"></div>
                            <strong>Assign butchery to user</strong>
                            <br><br>
                            <div class="row">
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                    <label>Select User</label>
                                        <select name="user-butchery" id="user-butchery" class="form-control">
                                            <option value="">Select-User</option>
                                            <?php foreach($butchers as $butcher){?>
                                                <option value="<?= $butcher->id ?>"><?= ucwords($butcher->full_name) ?></option>
                                            <?php }?>
                                        </select>
                                        <span class="user-butchery-group text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Select Butchery</label>
                                        <select name="butchery" id="butchery" class="form-control">
                                            <option value="">Select-Butchery</option>
                                            <?php foreach($butcheries as $butchery){?>
                                                <option value="<?= $butchery->id ?>"><?= ucwords($butchery->butchery_name) ?></option>
                                            <?php }?>
                                        </select>
                                        <span class="butchery-group text-danger"></span>
                                    </div>
                                </div>                      
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary form-control assign-user-to-butchery"> Assign Butchery</button>  
                                    </div>
                                </div> 
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
                            <h6 class="m-0 font-weight-bold">Users List</h6>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>NAME</th>
                                        <th>EMAIL</th>
                                        <th>ACCESS TYPE</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user) { ?>
                                        <tr>
                                            <td>
                                                <span><?= ucwords($user->full_name); ?></span>
                                                <br>
                                                <span>                                            
                                                    <?php $result = ($user->butchery_id !=NULL ? Modules::run('users/get_butchery',$user->butchery_id)[0]  : ''); ?>
                                                    <?= ($user->butchery_id !=NULL?  ucwords($result->butchery_name.' butchery') : '') ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?= $user->email !='' ?  $user->email : 'Not Available'; ?>
                                            </td>
                                            <td>
                                                <?= ucwords($user->user_type) ?>
                                            </td>

                                            <td>
                                                <?= ($user->access != 0 ? "<span class='badge badge-warning py-1'><i class='fa fa-unlock'></i> Active</span>" : "<span class='badge badge-danger py-1'><i class='fa fa-lock'></i> Locked</span>" ) ?>   
                                            </td>
                                        </tr>
                                    <?php } ?>
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



