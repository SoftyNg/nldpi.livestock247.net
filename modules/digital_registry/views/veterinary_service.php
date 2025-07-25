<!-- ===================== Styles ===================== -->
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
        box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.05);
    }

    .btn-green:hover {
        color: #fff;
        background-color: rgb(22, 199, 120);
        border-color: #079455;
    }

    .label {
        display: inline-flex;
        align-items: center;
        background-color: #e8f5e9;
        border: 1px solid #4caf50;
        border-radius: 12px;
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
        background-color: #4caf50;
        border-radius: 50%;
        margin-right: 8px;
    }

    .reject-label {
        display: inline-flex;
        align-items: center;
        background-color: #FEF3F2;
        border: 1px solid #FECDCA;
        border-radius: 12px;
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
        margin-right: 8px;
    }

    .pending-label {
        display: inline-flex;
        align-items: center;
        background-color: #FFFAEB;
        border: 1px solid #FEDF89;
        border-radius: 12px;
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
        margin-right: 8px;
    }
</style>

<!-- ===================== Page Container ===================== -->
<div class="container-fluid" style="background-color:#F5FCF9;">
    
    <!-- Page Title -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-black-800">Veterinary Professionals <?php //$user_data['company_name']; ?></h1>
    </div>

    <!-- ===================== Summary Cards ===================== -->
    <div class="row">

        <!-- Total Registered -->
        <div class="col-xl-3 col-md-3 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= Modules::run('digital_registry/countAllVet'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Approved -->
        <div class="col-xl-3 col-md-3 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Approved</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= Modules::run('digital_registry/countApprovedVet'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Review -->
        <div class="col-xl-3 col-md-3 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pending Review</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        <?= Modules::run('digital_registry/countPendingVet'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rejected -->
        <div class="col-xl-3 col-md-3 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Rejected</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        <?= Modules::run('number_bank/_get_total_used'); ?>
                                    </div>
                                </div>
                                <div class="col"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ===================== Table of Veterinary Professionals ===================== -->
    <div class="row">
        <div class="card shadow" style="width:100%">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-black">Veterinary Professionals</h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <?php $sp_data = Modules::run('digital_registry/getApprovedVets'); ?>
                            <tr>
                                <th>Name</th>
                                <th>Professional ID</th>
                                <th>Date Registered</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($sp_data) > 0): ?>
                                <?php foreach ($sp_data as $sp): 
                                    $name = $sp->firstname;
                                    $reg_number = $sp->reg_number;
                                    $status = $sp->status;
                                    $reg_date = date('Y-m-d', $sp->date_created);
                                    $idNumberBank = $sp->id;

                                    $approval_link  = BASE_URL . 'number_bank/approve_number_bank/' . $idNumberBank;
                                    $rejection_link = BASE_URL . 'number_bank/reject_number_bank/' . $idNumberBank;
                                    $details_link   = BASE_URL . 'number_bank/get_number_bank_details/' . $idNumberBank;
                                ?>
                                <tr>
                                    <td><?= $name; ?></td>
                                    <td><?= $reg_number; ?></td>
                                    <td><?= $reg_date; ?></td>
                                    <td>
                                        <?php if ($status == 0): ?>
                                            <div class="pending-label">Pending</div>
                                        <?php elseif ($status == 1): ?>
                                            <div class="label">Active</div>
                                        <?php elseif ($status == null): ?>
                                            <div class="reject-label">Reject</div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="#" class="link-approve" style="color:#00AD56;" data-toggle="modal" data-target="#approveModal<?= $idNumberBank ?>">
                                            <b>View</b>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">There is no entry yet</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
