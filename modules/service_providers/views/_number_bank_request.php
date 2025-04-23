
<?php $email = $_SESSION['email'];
    $user_data =  Modules::run('service_providers/_fetch_all_data_for_user', $email); 
    ?>
<?php foreach ($user_data as $user) :
   $name = $user->company_name;
   $nldpiNumber = $user->nldpi_number;      
 endforeach; ?>


    <!-- Begin Page Content -->
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
    
        .label {
            display: inline-flex;
            align-items: center;
            background-color: #e8f5e9; /* Light green background */
            border: 1px solid #4caf50; /* Green border */
            border-radius: 12px; /* Rounded corners */
            padding: 5px 10px;
            font-size: 14px;
            color: #4caf50;
            font-weight: 500;
        }

        .label::before {
            content: '';
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: #4caf50; /* Green dot */
            border-radius: 50%;
            margin-right: 8px; /* Space between dot and text */
        }

        .reject-label {
            display: inline-flex;
            align-items: center;
            background-color: #FEF3F2; 
            border: 1px solid #FECDCA; 
            border-radius: 12px; /* Rounded corners */
            padding: 5px 10px;
            font-size: 14px;
            color: #B42318;
            font-weight: 500;
        }

        .reject-label::before {
            content: '';
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: #B42318; 
            border-radius: 50%;
            margin-right: 8px; /* Space between dot and text */
        }

        
        .pending-label {
            display: inline-flex;
            align-items: center;
            background-color: #FFFAEB; 
            border: 1px solid #FEDF89; 
            border-radius: 12px; /* Rounded corners */
            padding: 5px 10px;
            font-size: 14px;
            color: #F79009;
            font-weight: 500;
        }

        .pending-label::before {
            content: '';
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: #F79009; 
            border-radius: 50%;
            margin-right: 8px; /* Space between dot and text */
        }
    </style>
 <div class="container-fluid" style="background-color:#F5FCF9 height=100%;">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
 <div>
    <h2 style="color:black;">Number bank</h2>     
    <h5 class="mb-0 text-black"><?= $name; ?> | Nigeria | </h5>

</div>
<div>

<button class="btn btn-outline-dark mr-2" data-toggle="modal" data-target="#allocateModal">Allocate Id Number</button>
<button class="btn btn-success" data-toggle="modal" data-target="#myModal">
    Request Number Bank</button>
</div>
</div>



<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-3">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                  
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Available number bank</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?= count(Modules::run('number_bank/_countNumberBank', $nldpiNumber));?>
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
    <div class="col-xl-6 col-md-3 mb-3">
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

   

  
</div>



<div class="row">


<div class="card shadow" style="width:100%">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-black">My number banks</h5>
                            <h6 class="m-0 font-weight-light text-grey">Keep track of Your allocated number banks</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
    <?php $number_bank_data =  Modules::run('number_bank/fetch_all_number_bank_request', $nldpiNumber); ?>

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
            <td><?php echo $range; ?></td>
            <td><?php echo $reg_date; ?></td>
            <td><?php echo $allocation_date; ?></td>
            <td><?php if ($status == "Pending"): ?>
                <div class="pending-label">Pending</div>
<?php elseif ($status == "Active"): ?>
    <div class="label">Active</div>
    <?php elseif ($status == "Reject"): ?>
    <div class="reject-label">Reject</div>
<?php endif; ?>
</td>
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






        
 <!-- The Modal -->
 <div class="modal fade" id="allocateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title text-dark" id="myModalLabel"><b>
                            Allocate ID Numbers</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                    <?= form_open('number_bank/number_bank_request_submit') ?>
                          <!-- Dropdown 1: Select User Role -->
                          <div class="form-group">
                          <input type="hidden" id="" name="nldpi_number" 
                          value="<?= $nldpiNumber?>"  />
                          </div>

                          <div class="form-group">
                            <label for="user_role">Select Number Bank</label>
                            <select name="qty" id="user_role" class="form-control">
                                <option value="10000 - 100000">10000 - 100000</option>
                                <option value="100001-500000">100001-500000</option>
                               
                            </select>
                            <span>Select a number bank from your assigned number bank ID</span>
                        </div>
                          <div class="form-group">
                            <label for="user_role">Quantity</label>
                            <input type="text" id="" name="qty" 
                            value=" " class="form-control"/>
                            <span>10,000 Available</span>
                        </div>

                        <!-- Dropdown 2: Select Country -->
                        <div class="form-group">
                            <label for="country">Professional Id Number</label>
                            <select name="type_of_tag" id="" class="form-control">
                                <option value="Micro chip">Mvj</option>
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
 
 



