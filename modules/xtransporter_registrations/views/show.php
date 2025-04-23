<h1><?= out($headline) ?> <span class="smaller hide-sm">(Record ID: <?= out($update_id) ?>)</span></h1>
<?= flashdata() ?>
<div class="card">
    <div class="card-heading">
        Options
    </div>
    <div class="card-body">
        <?php 
        echo anchor('transporter_registrations/manage', 'View All Transporter_registrations', array("class" => "button alt"));
        echo anchor('transporter_registrations/create/'.$update_id, 'Update Details', array("class" => "button"));
        $attr_delete = array( 
            "class" => "danger go-right",
            "id" => "btn-delete-modal",
            "onclick" => "openModal('delete-modal')"
        );
        echo form_button('delete', 'Delete', $attr_delete);
        ?>
    </div>
</div>
<div class="two-col">
    <div class="card">
        <div class="card-heading">
            Transporter_registration Details
        </div>
        <div class="card-body">
            <div class="record-details">
                <div class="row">
                    <div>company_name</div>
                    <div><?= out($company_name) ?></div>
                </div>
                <div class="row">
                    <div>registration_number</div>
                    <div><?= out($registration_number) ?></div>
                </div>
                <div class="row">
                    <div>phone_number</div>
                    <div><?= out($phone_number) ?></div>
                </div>
                <div class="row">
                    <div>emal</div>
                    <div><?= out($emal) ?></div>
                </div>
                <div class="row">
                    <div class="full-width">
                        <div><b>operating_state</b></div>
                        <div><?= nl2br(out($operating_state)) ?></div>
                    </div>
                </div>
                <div class="row">
                    <div>no_of_vehicle_in_fleet</div>
                    <div><?= out($no_of_vehicle_in_fleet) ?></div>
                </div>
                <div class="row">
                    <div>cac_certificate</div>
                    <div><?= out($cac_certificate) ?></div>
                </div>
                <div class="row">
                    <div>trans_licence</div>
                    <div><?= out($trans_licence) ?></div>
                </div>
                <div class="row">
                    <div>insur_certificate</div>
                    <div><?= out($insur_certificate) ?></div>
                </div>
                <div class="row">
                    <div>tax_id</div>
                    <div><?= out($tax_id) ?></div>
                </div>
                <div class="row">
                    <div>vehicle_reg_number</div>
                    <div><?= out($vehicle_reg_number) ?></div>
                </div>
                <div class="row">
                    <div>vehicle_type</div>
                    <div><?= out($vehicle_type) ?></div>
                </div>
                <div class="row">
                    <div>carrying_cap</div>
                    <div><?= out($carrying_cap) ?></div>
                </div>
                <div class="row">
                    <div>vehicle_photo</div>
                    <div><?= out($vehicle_photo) ?></div>
                </div>
                <div class="row">
                    <div>password</div>
                    <div><?= out($password) ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-heading">
            Comments
        </div>
        <div class="card-body">
            <div class="text-center">
                <p><button class="alt" onclick="openModal('comment-modal')">Add New Comment</button></p>
                <div id="comments-block"><table></table></div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="comment-modal" style="display: none;">
    <div class="modal-heading"><i class="fa fa-commenting-o"></i> Add New Comment</div>
    <div class="modal-body">
        <p><textarea placeholder="Enter comment here..."></textarea></p>
        <p><?php
            $attr_close = array( 
                "class" => "alt",
                "onclick" => "closeModal()"
            );
            echo form_button('close', 'Cancel', $attr_close);
            echo form_button('submit', 'Submit Comment', array("onclick" => "submitComment()"));
            ?>
        </p>
    </div>
</div>
<div class="modal" id="delete-modal" style="display: none;">
    <div class="modal-heading danger"><i class="fa fa-trash"></i> Delete Record</div>
    <div class="modal-body">
        <?= form_open('transporter_registrations/submit_delete/'.$update_id) ?>
        <p>Are you sure?</p>
        <p>You are about to delete a transporter_registration record.  This cannot be undone.  Do you really want to do this?</p> 
        <?php 
        echo '<p>'.form_button('close', 'Cancel', $attr_close);
        echo form_submit('submit', 'Yes - Delete Now', array("class" => 'danger')).'</p>';
        echo form_close();
        ?>
    </div>
</div>
<script>
const token = '<?= $token ?>';
const baseUrl = '<?= BASE_URL ?>';
const segment1 = '<?= segment(1) ?>';
const updateId = '<?= $update_id ?>';
const drawComments = true;
</script>