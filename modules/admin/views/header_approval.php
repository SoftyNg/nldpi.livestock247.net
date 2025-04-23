<div class="baseline mt-4">
    <div class="base-left">
        <div class="dashboard-name">
            <a href="<?= BASE_URL . 'admin/users/'. segment(3)?>"><i class="fa fa-arrow-left"></i> Back to User Registrations</a>
            <h1 class="h3 mb-0 mt-2"><?= ucwords($record_obj->full_name); ?></h1>
        </div>
    </div>
    <div class="base-right d-flex justify-content-between">
        <?php if($record_obj->status == 1): ?>
            <div class="user-approved">Verified</div>
        <?php else: ?>   
            <a href="" class="d-none d-sm-inline-block btn btn-nldpi-red shadow-sm mr-2 reject"  id="reject-<?= $record_obj->id ?>" data-toggle="modal" title="Reject" data-target="#reject">Reject Application</a>
            <a href="" class="d-none d-sm-inline-block btn  btn-nldpi-green shadow-sm approve" id="approve-<?= $record_obj->id ?>" data-toggle="modal" title="Approve" data-target="#approve">Approve Application</a>
        <?php endif ?>
    </div>
</div>



<!-- Approve MODAL-->
<div class="modal fade" id="approve" role="dialog" aria-labelledby="approveModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <?= form_open($approve_url) ?>
            <input type="hidden" value="<?= isset($record_obj->id)? $record_obj->id : ''  ?>" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveModalLabel">Approve Application</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to approve the application?</div>
                <div class="modal-footer">
                    <?php
                        $attr_close = array(
                            "class" => "btn btn-outline-dark",
                            "data-dismiss" => "modal"
                        );
                        echo form_button('close', 'Cancel', $attr_close);
                        echo form_submit('submit', 'Approve', array("class" => 'btn btn-nldpi-green shadow-sm'));
                    ?>
                </div>
            </div>
        <?php echo form_close();?>   
    </div>
</div>



<!-- Reject MODAL-->
<div class="modal fade" id="reject" role="dialog" aria-labelledby="rejectModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <?= form_open($reject_url) ?>
            <input type="hidden" value="<?= isset($record_obj->id)? $record_obj->id : ''  ?>" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Reject Application</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea name="reason" class="form-control" placeholder="Enter reasons for rejection.." rows="4" cols="50"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php
                        $attr_close = array(
                            "class" => "btn btn-outline-dark",
                            "data-dismiss" => "modal"
                        );
                        echo form_button('close', 'Cancel', $attr_close);
                        echo form_submit('submit', 'Reject', array("class" => 'btn btn-nldpi-red shadow-sm'));
                    ?>
                </div>
            </div>
        <?php echo form_close();?>      
    </div>
</div>

<style>
    .modal-title {
        font-weight: bold;
    }
    .user-approved {
        color: #28a745;
        font-weight: bold;
    }
</style>