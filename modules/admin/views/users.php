<div class="container-fluid">

    <?php require_once "header-top.php"; ?>

    <!-- header -->
    <?php require_once "header.php"; ?>

    <!-- cards -->
    <?php //require_once "cards.php"; ?>

    <!-- tabs -->
    <?php require_once "tab.php"; ?>

    <!-- content -->
    <div class="row">
        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card shadow mb-4">
                <!-- card header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold"><?php echo $registration_type; ?></h6>
                </div>
                <!-- card body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Registration Date</th>
                                    <th>Full Name</th>
                                    <th>Number</th>
                                    <th>Email Address</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($registration_data as $row) { ?>
                                    <tr>
                                        <td><?php echo $row['registration_date']; ?></td>
                                        <td><?php echo $row['full_name']; ?></td>
                                        <td><?php echo $row['registration_number']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td>
                                            <?php
                                            $btn_cancel_attr = [
                                                'class' => 'btn btn-outline'
                                            ];
                                            echo anchor('admin/users/' . $active_link . '/' . $row['id'], 'View', $btn_cancel_attr);
                                            ?>
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
</div>
