<h1><?= out($headline) ?> <span class="smaller hide-sm">(Record ID: <?= out($update_id) ?>)</span></h1>
<?= flashdata() ?>
<div class="card">
    <div class="card-heading">
        Options
    </div>
    <div class="card-body">
        <?php 
        echo anchor('livestock_markets/manage', 'View All Livestock_markets', array("class" => "button alt"));
        echo anchor('livestock_markets/create/'.$update_id, 'Update Details', array("class" => "button"));
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
            Livestock_market Details
        </div>
        <div class="card-body">
            <div class="record-details">
                <div class="row">
                    <div>nldpi_number</div>
                    <div><?= out($nldpi_number) ?></div>
                </div>
                <div class="row">
                    <div>name</div>
                    <div><?= out($name) ?></div>
                </div>
                <div class="row">
                    <div>state</div>
                    <div><?= out($state) ?></div>
                </div>
                <div class="row">
                    <div>lga</div>
                    <div><?= out($lga) ?></div>
                </div>
                <div class="row">
                    <div>address</div>
                    <div><?= out($address) ?></div>
                </div>
                <div class="row">
                    <div>operating_days</div>
                    <div><?= out($operating_days) ?></div>
                </div>
                <div class="row">
                    <div>types_of_livestock_traded</div>
                    <div><?= out($types_of_livestock_traded) ?></div>
                </div>
                <div class="row">
                    <div>major_breeds_found</div>
                    <div><?= out($major_breeds_found) ?></div>
                </div>
                <div class="row">
                    <div>lon</div>
                    <div><?= out($lon) ?></div>
                </div>
                <div class="row">
                    <div>lat</div>
                    <div><?= out($lat) ?></div>
                </div>
                <div class="row">
                    <div>status</div>
                    <div><?= out($status) ?></div>
                </div>
                <div class="row">
                    <div>ownership_type</div>
                    <div><?= out($ownership_type) ?></div>
                </div>
                <div class="row">
                    <div>market_leadership_details</div>
                    <div><?= out($market_leadership_details) ?></div>
                </div>
                <div class="row">
                    <div>email</div>
                    <div><?= out($email) ?></div>
                </div>
                <div class="row">
                    <div>phone</div>
                    <div><?= out($phone) ?></div>
                </div>
                <div class="row">
                    <div>website</div>
                    <div><?= out($website) ?></div>
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
        <?= form_open('livestock_markets/submit_delete/'.$update_id) ?>
        <p>Are you sure?</p>
        <p>You are about to delete a livestock_market record.  This cannot be undone.  Do you really want to do this?</p> 
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