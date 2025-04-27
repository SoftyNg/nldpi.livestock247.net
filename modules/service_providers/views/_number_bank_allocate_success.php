
<style>
        .column-content {
            min-height: 200px;
            text-align: left;
        }
        .btn-green {
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;           
            border-radius: 8px;
            border: 1px solid #079455;
            background: #079455;
            /* Shadow/xs */
            box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.05);
        
        }
        
        .btn-green:hover {
            color: #fff;
            background-color:rgb(22, 199, 120);
            border-color: #079455;
        }
    </style>
   

   <?php $email = $_SESSION['email'];
    $user_data =  Modules::run('service_providers/_fetch_all_data_for_user', $email); 
    ?>
<?php foreach ($user_data as $user) :
   $name = $user->company_name;
   $nldpiNumber = $user->nldpi_number;      
 endforeach; ?>
 <div class="container-fluid" style="background-color:#F5FCF9 height=100%;">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
 <div>
    <h2 style="color:black;">Number bank</h2>     
    <h5 class="mb-0 text-black"><?= $name; ?> | Nigeria | </h5>

</div>
<div>

<button class="btn btn-outline-dark mr-2">Allocate Id Number</button>
<button class="btn btn-success" data-toggle="modal" data-target="#myModal">
    Request Number Bank</button>
</div>
</div>




<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                  
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Available number bank</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-ellipsis-v fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-3 mb-3">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Allocated ID's</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                    </div>
                    <div class="col-auto">
                    <i class="fas fa-ellipsis-v fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-3 mb-3">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Requested with chips
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">0</div>
                            </div>
                            <div class="col">
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                    <i class="fas fa-ellipsis-v fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-3 mb-3">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Register with tags
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    0</div>
                            </div>
                            <div class="col">
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-ellipsis-v fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

  
</div>



<div class="row">


<div class="card shadow" style="width:100%">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-black">Allocated number banks</h5>
                            <h6 class="m-0 font-weight-light text-grey">Keep track of Your allocated number banks</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Bank Id</th>
                                            <th>Type of tag</th>
                                            <th>Range</th>
                                            <th>available</th>
                                            <th>Request date</th>
                                            <th>Allocation date</th>
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

<!-- Button to Trigger Modal -->

 <!-- The Modal -->
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title text-dark" id="myModalLabel"><b>
                            Request For A Number Bank</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                    <?= form_open('number_bank/number_bank_request_submit') ?>
                          <!-- Dropdown 1: Select User Role -->
                          <div class="form-group">
                          <input type="text" id="" name="" 
                          value="<?= $name?> | <?= $nldpiNumber?>" disabled />
                          <input type="hidden" id="" name="nldpi_number" 
                          value="<?= $nldpiNumber?>"  />
                          </div>
                          <div class="form-group">
                            <label for="user_role">Select Range</label>
                            <select name="qty" id="user_role" class="form-control">
                                <option value="10000 - 100000">10000 - 100000</option>
                                <option value="100001-500000">100001-500000</option>
                               
                            </select>
                            <span>10,000 Minimum</span>
                        </div>

                        <!-- Dropdown 2: Select Country -->
                        <div class="form-group">
                            <label for="country">Id Type</label>
                            <select name="type_of_tag" id="" class="form-control">
                                <option value="Micro chip">Micro chip</option>
                                <option value="Tags">Tags</option>
                                
                            </select>
                        </div>
                                    
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer d-flex justify-content-between">
    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-success">Submit Request</button>
</div>
<?= form_close() ?> 




                </div>
            </div>
        </div>


        <div class="modal fade show d-block" id="autoModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-3">
                <div class="modal-header border-0 justify-content-center">
                <img src="<?= BASE_URL?>public/images/check.png" alt="Check img" class="img-fluid" style="width: 80px; height: 80px;">
                 
                </div>
                <div class="modal-body d-flex flex-column align-items-center justify-content-center">
                    <h2 class="fw-bold">ID Allocation Successful</h2>
                    <p class="justify" >You have successfully allocated <?= $_SESSION['qty_allocated']?> 
                    Livestock Identification Numbers (IDs) to <?= $_SESSION['vet_prof']?> .</p>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-center">
                <a href="<?= BASE_URL?>service_providers/number_banks" 
                class="btn btn-green w-auto px-3">OK</a>  
</div>
            </div>
        </div>
    </div>
        <script>
        // Show the modal on page load
        window.onload = function () {
            var myModal = new bootstrap.Modal(document.getElementById('autoModal'));
            myModal.show();
        };
    </script>
 



