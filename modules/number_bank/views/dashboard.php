
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
 <div class="container-fluid" style="background-color:#F5FCF9;">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">   
    <h1 class="h3 mb-0 text-black-800">Number Banks <?php //$user_data['company_name'];?></h1>

    <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
</div>



<!-- Content Row -->
<div class="row">
    

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                  
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Approved</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?= Modules::run('number_bank/_get_all_total_approved'); ?>
                        
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Active Providers</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?= count(Modules::run('number_bank/_get_all_service_providers')); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                    Current Usage        
                    </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                <?= Modules::run('number_bank/_get_total_used'); ?>
                                </div>
                            </div>
                            <div class="col">
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

  
</div>


<div class="row">
    





<div class="card shadow" style="width:100%">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-black">Allocated requests queue</h5>
                            <h6 class="m-0 font-weight-light text-grey">pending requests from service providers waiting for approval</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
    <?php $number_bank_data =  Modules::run('number_bank/_get_pending_requests'); ?>

                                        <tr>
                                            <th>Service Providers Id</th>
                                            <th>Request date</th>
                                            <th>Type Of Tag</th>
                                            <th>Allocation Size Requested</th>
                                            <th>Status</th>
                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>                                 
                                    <tbody>
                                        
                                    <?php if (count($number_bank_data) > 0) { ?>
                                    <?php foreach ($number_bank_data as $numberBank)  {
   $type_of_tag = $numberBank->type_of_tag;
   $company_name = $numberBank->company_name;
   $quantity = $numberBank->qty; 
   $nldpiNumber = $numberBank->nldpi_number;
   $reg_date = date('Y-m-d', $numberBank->request_date);
   $allocation_date = date('Y-m-d', $numberBank->allocation_date);
   $status =  $numberBank->status;
   $idNumberBank =  $numberBank->id;
   $approval_link = BASE_URL . 'number_bank/approve_number_bank/' . $idNumberBank;
   $rejection_link = BASE_URL . 'number_bank/reject_number_bank/' . $idNumberBank;
   $details_link = BASE_URL . 'number_bank/get_number_bank_details/' . $idNumberBank;
   ?>
                                    <tr>  <!-- Added missing <tr> tag -->
            <td><?php echo $nldpiNumber; ?></td>
            <td><?php echo $reg_date; ?></td>
            <td><?php echo $type_of_tag; ?></td>
            <td><?php echo $quantity ?></td>
            
            <td><?php if ($status == "Pending"): ?>
                <div class="pending-label">Pending</div>
<?php elseif ($status == "Active"): ?>
    <div class="label">Active</div>
    <?php elseif ($status == "Reject"): ?>
    <div class="reject-label">Reject</div>
<?php endif; ?>
</td>
<td> 


    <a href="#" class="link-approve" style="color:#00AD56;" data-toggle="modal" 
   data-target="#approveModal<?=$idNumberBank?>">
<b>View</b>
</a> 
 
</td>
        </tr>

<!--Approval modal -->
<div class="modal fade" id="approveModal<?=$idNumberBank?>" tabindex="-1" 
        aria-labelledby="approveModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="approveModalLabel">Number Bank Request Summary</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
               
      </div>
      <div class="modal-body">
      <?= form_open($approval_link); ?>
                          <!-- Dropdown 1: Select User Role -->
                          <div class="form-group">
                         
                          <input type="hidden" id="" name="nldpi_number" 
                          value="<?= $nldpiNumber?>"  />
                          <input type="hidden" id="" name="name" 
                          value="<?= $company_name;?>"  />
                          </div>
                          <div class="form-group row">
    <div class="col-md-6">
        <label for="allocation1">Service Providers' Name</label>
        <p><?= $company_name;?></p>
    </div>

    <div class="col-md-6">
        <label for="">Service Provider ID</label>
        <p><?= $nldpiNumber?></p>
        <input type="hidden" id="" value="<?= $idNumberBank ?>" name="bank_id" class="form-control" />
    </div>
</div>
                          <div class="form-group row">
    <div class="col-md-6">
        <label for="allocation1">Allocation Size Requested</label>
        <p><?= $quantity?></p>
        <input type="hidden" value="<?= $quantity ?>" name="qty" class="form-control"/>
    </div>

    <div class="col-md-6">
        <label for=""> ID Type</label>
        <p><?= $type_of_tag; ?></p>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-6">
        <label for="allocation1">Number Bank Range </label>
        <p> <?php $highest_value =  Modules::run('number_bank/_fetch_highestvalue'); 
        echo $highest_value +1;?> To <?php  echo $highest_value + $quantity; ?></p>
        
        
        <input type="hidden" value="<?= $highest_value +1; ?>" name="from" class="form-control" 
        />
       
    </div>

   
        <input type="hidden" value="<?= $highest_value + $quantity; ?>" name="to" class="form-control" />

</div>

                                    
                    </div>
<div class="modal-footer d-flex justify-content-between">
    <button type="button" class="btn btn-light me-2" data-dismiss="modal">Cancel</button>
    <button type="submit" class="btn btn-sm btn-green ">Allocate & notify</button>
</div>
      <?= form_close();?>
    </div>
  </div>
</div>
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



                    

<div class="card shadow mt-5" style="width:100%">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-black">Approved Number Banks</h5>
                            <h6 class="m-0 font-weight-light text-grey">Keep track of all approved number banks</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
    <?php $number_bank_data =  Modules::run('number_bank/_get_approved_requests'); ?>

                                        <tr>
                                            <th>Service Providers Id</th>
                                            <th>Number Bank Id</th>
                                          
                                            <th>Type Of Tag</th>
                                            <th>Range</th>
                                            <th>Approval Date</th>
                                            <th>Status</th>
                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>                                 
                                    <tbody>
                                        
                                    <?php if (count($number_bank_data) > 0) { ?>
                                    <?php foreach ($number_bank_data as $numberBank)  {
   $type_of_tag = $numberBank->type_of_tag;
   $range = $numberBank->qty; 
   $nldpiNumber = $numberBank->nldpi_number;
   $from = $numberBank->number_from;
   $to = $numberBank->number_to;
   $reg_date = date('Y-m-d', $numberBank->request_date);
   $allocation_date = date('Y-m-d', $numberBank->allocation_date);
   $status =  $numberBank->status;
   $idNumberBank =  $numberBank->id;
   $approval_link = BASE_URL . 'number_bank/approve_number_bank/' . $idNumberBank;
   $rejection_link = BASE_URL . 'number_bank/reject_number_bank/' . $idNumberBank;
   $details_link = BASE_URL . 'number_bank/get_number_bank_details/' . $idNumberBank;
   ?>
                                    <tr>  <!-- Added missing <tr> tag -->
            <td><?php echo $nldpiNumber; ?></td>
            <td><?php echo $idNumberBank; ?></td>         
            <td><?php echo $type_of_tag; ?></td>
            <td><?php echo $from . ' - ' . $to; ?></td>
            <td><?php echo $allocation_date; ?></td>          
            <td>
    <div class="label">Active</div>   
</td>
<td> 
    <a href="<?= $details_link?>" class="link-approve" style="color:#00AD56;"><b>View Details</b></a> 
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
