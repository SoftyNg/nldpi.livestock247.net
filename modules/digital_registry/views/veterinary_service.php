
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
    <h1 class="h3 mb-0 text-black-800">Veterinary Professionals <?php //$user_data['company_name'];?></h1>

    <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
</div>



<!-- Content Row -->
<div class="row">
    

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-3 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                  
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Registered</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?= Modules::run('service_providers/countAll'); ?>
                        
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-3 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Approved</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?= Modules::run('service_providers/countApproved'); ?>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-3 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                    Pending Review        
                    </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                 <?= Modules::run('service_providers/countPending'); ?>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-3 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                   Rejected       
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
                  
                </div>
            </div>
        </div>
    </div>


  
</div>


<div class="row">
    





<div class="card shadow" style="width:100%">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-black">Veterinary Professionals</h5>
                             </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
    <?php $sp_data =  Modules::run('service_providers/getApprovedServiceProviders'); ?>

                                        <tr>
                                            <th>Name</th>
                                            <th>CAC Registration Number</th>
                                            <th>Date Registered</th>
                                            
                                            <th>Status</th>
                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>                                 
                                    <tbody>
                                        
                                    <?php if (count($sp_data) > 0) { ?>
                                    <?php foreach ($sp_data as $sp)  {
   
   $name = $sp->company_name;
   $reg_number = $sp->reg_number; 
   $status = $sp->status;
   $reg_date = date('Y-m-d', $sp->date_created);
 
   $idNumberBank =  $sp->id;
   $approval_link = BASE_URL . 'number_bank/approve_number_bank/' . $idNumberBank;
   $rejection_link = BASE_URL . 'number_bank/reject_number_bank/' . $idNumberBank;
   $details_link = BASE_URL . 'number_bank/get_number_bank_details/' . $idNumberBank;
   ?>
                                    <tr>  <!-- Added missing <tr> tag -->
            <td><?php echo $name; ?></td>
            <td><?php echo $reg_number; ?></td>
            <td><?php echo $reg_date; ?></td>
           
            
            <td><?php if ($status == 0): ?>
                <div class="pending-label">Pending</div>
<?php elseif ($status == 1): ?>
    <div class="label">Active</div>
    <?php elseif ($status == null): ?>
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
