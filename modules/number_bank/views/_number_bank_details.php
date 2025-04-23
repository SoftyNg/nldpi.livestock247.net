
    <!-- Begin Page Content -->
   <style>
    
    .label {
            display: inline-flex;
            align-items: center;
            background-color: #e8f5e9; /* Light green background */
            /*border: 1px solid #4caf50; /* Green border */
            /* border-radius: 12px; /* Rounded corners */
            padding: 5px 10px;
            font-size: 14px;
            color: #4caf50;
            font-weight: 500;
        }

  
    </style>
    <div class="container-fluid" style="background-color:#D6FFEA height=100%;">
<?php
  foreach($number_bank_user as $nb_user){
      $name = $nb_user->company_name;
      $number = $nb_user->nldpi_number;
      $allocation_date = $nb_user->allocation_date;
      $from = $nb_user->number_from;
      $to = $nb_user->number_to;
      $contact = $nb_user->address;
      $email = $nb_user->email;
      $phone = $nb_user->phone_number;
  }
  ?>
<!-- Page Heading -->
<div class="row  mb-4">
<div class="col-12"> <h2 style="color:black;">Number Bank Details</h2> </div>
 <div class="col-6">       
    <h5 class="mb-0 text-black"><?= $name; ?> | <?= $number; ?> 
    <div class="label"><b>Verified Provider</b></div></h5>
    <p>Allocation Data: <?= date("F d, Y", $allocation_date); ?></p>
    <p>Number Bank Range: <?= $from ?> to  <?= $to ?></p>
</div>
<div class="col-6">    
<p>Contact address: <?= $contact?></h5>
    <p>Email: <?= $email ?></p>
    <p>Phone: <?= $phone ?> </p>
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
                            Total Allocated</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?= $total= Modules::run('number_bank/_get_total_approved_for_user'); ?>
                        </div>
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
                            Numbers Used</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?=   $used=Modules::run('number_bank/_get_total_used_for_user');
                         ?>
                        </div>
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
                            Available Numbers
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                <?php 
                               
                                echo $remain = $total - ($used);
                               
                                ?>
                                </div>
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
                            Usage Rate
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

<div class="card shadow col-xl-8 col-lg-7">

                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-black">Registrations</h5>
                            <h6 class="m-0 font-weight-light text-grey">Keep track of Your allocated number banks</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
    <?php $number_bank_data =  Modules::run('number_bank/fetch_all_number_bank_request', $number); ?>

                                        <tr>
                                            <th>Bank Id</th>
                                            <th>Type of tag</th>
                                           
                                            <th>available</th>
                                            <th>Request date</th>
                                            <th>Allocation date</th>
                                    
                                        </tr>
                                    </thead>                                 
                                    <tbody>
                                    <?php if (count($number_bank_data) > 0) { ?>
                                    <?php foreach ($number_bank_data as $numberBank)  {
   $type_of_tag = $numberBank->type_of_tag;
   $range = $numberBank->qty; 
   $bank_id = $numberBank->id;
   $reg_date = date('Y-m-d', $numberBank->request_date);
   $allocation_date = date('Y-m-d', $numberBank->allocation_date);
   $status =  $numberBank->status;
   ?>
                                    <tr>  <!-- Added missing <tr> tag -->
            <td><?php echo $bank_id; ?></td>
            <td><?php echo $type_of_tag; ?></td>
            <td><?php echo $range; ?></td>
          
            <td><?php echo $reg_date; ?></td>
            <td><?php echo $allocation_date; ?></td>
       
        </tr>
        <?php }  ?>
    <?php } else { ?>
    <tr>
        <td colspan="5">There is no entry yet</td>  <!-- colspan added to align message properly -->
    </tr>
<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

  <!-- Pie Chart -->
  <div class="card col-xl-4 col-lg-5">

                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-black">Activities</h5>
                                                   </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                                 
                                    <tbody>
                           
                <tr><td> Daily Average</td><td> </td></tr>
                <tr><td> Weekly Average</td><td> </td></tr>
                <tr><td> Monthly Average</td><td> </td></tr>
                <tr><td> Peak day</td><td> </td></tr>
                <tr><td> Last activity</td><td> </td></tr>


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

        <!-- Success Modal -->
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Submission Successful</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Your request has been successfully submitted!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


                </div>
            </div>
        </div>
 



