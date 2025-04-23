<div class="row mt-3">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="form-group">
            <label><strong>Team Member 1</strong></label>
            <p></p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <?php
                $attr1 = [
                    'class' => 'form-control',
                    'placeholder' => 'Enter Name',
                    'required' => true,
                    'autocomplete' => 'off'
                ];
                echo form_label('Name');
                echo form_input('team_name_1', $team_name_1,  $attr1);
            ?>
            <span class="text-danger"><?php  echo (!empty(validation_errors('team_name_1')) ? validation_errors('team_name_1') : ''); ?></span>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <?php
                $attr1 = [
                    'class' => 'form-control',
                    'placeholder' => 'Enter Email Address',
                    'required' => true,
                    'autocomplete' => 'off'
                ];
                echo form_label('Email Address');
                echo form_input('team_email_1', $team_email_1,  $attr1);
            ?>
            <span class="text-danger"><?php  echo (!empty(validation_errors('team_email_1')) ? validation_errors('team_email_1') : ''); ?></span>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <?php
                $attr1 = [
                    'class' => 'form-control',
                    'placeholder' => 'Enter Position',
                    'required' => true,
                    'autocomplete' => 'off'
                ];
                echo form_label('Position');
                echo form_input('team_position_1', $team_position_1,  $attr1);
            ?>
            <span class="text-danger"><?php  echo (!empty(validation_errors('team_position_1')) ? validation_errors('team_position_1') : ''); ?></span>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="form-group">
            <label><strong>Team Member 2</strong></label>
            <p></p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <?php
                $attr1 = [
                    'class' => 'form-control',
                    'placeholder' => 'Enter Name',
                    'required' => true,
                    'autocomplete' => 'off'
                ];
                echo form_label('Name');
                echo form_input('team_name_2', $team_name_2,  $attr1);
            ?>
            <span class="text-danger"><?php  echo (!empty(validation_errors('team_name_2')) ? validation_errors('team_name_2') : ''); ?></span>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <?php
                $attr1 = [
                    'class' => 'form-control',
                    'placeholder' => 'Enter Email Address',
                    'required' => true,
                    'autocomplete' => 'off'
                ];
                echo form_label('Email Address');
                echo form_input('team_email_2', $team_email_2,  $attr1);
            ?>
            <span class="text-danger"><?php  echo (!empty(validation_errors('team_email_2')) ? validation_errors('team_email_2') : ''); ?></span>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
            <?php
                $attr1 = [
                    'class' => 'form-control',
                    'placeholder' => 'Enter Position',
                    'required' => true,
                    'autocomplete' => 'off'
                ];
                echo form_label('Position');
                echo form_input('team_position_2', $team_position_2,  $attr1);
            ?>
            <span class="text-danger"><?php  echo (!empty(validation_errors('team_position_2')) ? validation_errors('team_position_2') : ''); ?></span>
        </div>
    </div>
</div>