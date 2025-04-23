<h1><?= $headline ?></h1>
<?= validation_errors() ?>
<div class="card">
    <div class="card-heading">
        ServiceProvidersRegister Details
    </div>
    <div class="card-body">
        <?php
        echo form_open($form_location);
        echo form_label('ndlpi_number');
        echo form_number('ndlpi_number', $ndlpi_number, array("placeholder" => "Enter ndlpi_number"));
        echo form_submit('submit', 'Submit');
        echo anchor($cancel_url, 'Cancel', array('class' => 'button alt'));
        echo form_close();
        ?>
    </div>
</div>