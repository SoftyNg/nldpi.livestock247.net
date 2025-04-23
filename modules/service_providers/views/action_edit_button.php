
<!-- EDIT BUTCHERY MODAL -->
<div class="modal fade" role="dialog" id="<?= isset($breed->id)? $breed->id : ''  ?>editBreedRegistration">
    <?php

        $form_location_edit_breed = BASE_URL . 'breed_registrations/update_breed_registration';
        $form_location_delete_breed = BASE_URL . 'breed_registrations/delete_breed_registration';

    $result = Modules::run('breed_registrations/get_breed_registration',$breed->id)[0];

    ?>
    <div class="modal-dialog">

        <!-- Modal CONTENT-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" ><span class="text-nldpi-color">Identification Number</span> <br> <?= ucwords(strtolower($result->name)) ?></h4>
                <a  class="close" data-dismiss="modal">&times;</a>
            </div>
            <form action="<?= $form_location_edit_breed ?>" method="POST">
                <input type="hidden" name="id" value="<?= $result->id ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Identification Number</label>
                        <input type="text" class="form-control" name="name" readonly value="<?= $result->name ?>"  placeholder="Enter animal Identification number" required>

                        <?php echo (!empty(validation_errors('id_number')) ? validation_errors('id_number') : ''); ?>
                    </div>
                    <div class="form-group">
                        <label>Types Of Animal</label>
                        <select name="type_of_animal" class="form-control">
                        <?php if($result->type_of_animal =="" || $result->type_of_animal  ===NULL): ?>
                                <option value=""> Select types of animal</option>
                                <option value="goat"> Goat </option>
                                <option  value="ram">Ram</option>
                                <option  value="cow">Cow</option>
                            <?php elseif($result->type_of_animal==="goat"): ?>
                                <option value="<?= $result->type_of_animal ?>" selected><?= $result->type_of_animal ?></option>
                                <option  value="ram">Ram</option>
                                <option  value="cow">Cow</option>
                            <?php elseif($result->type_of_animal==="ram"): ?>
                                <option value="<?= $result->type_of_animal ?>" selected><?= $result->type_of_animal ?></option>
                                <option value="goat"> Goat </option>
                                <option  value="cow">Cow</option>
                            <?php elseif($result->type_of_animal==="cow"): ?>
                                <option value="<?= $result->type_of_animal ?>" selected><?= $result->type_of_animal ?></option>
                                <option value="goat"> Goat </option>
                                <option  value="ram">Ram</option>
                            <?php endif ?>
                            </select>
                        <?php  echo (!empty(validation_errors('type_of_animal')) ? validation_errors('type_of_animal') : ''); ?>
                    </div>
                    <div class="form-group">
                        <label>Breed Type</label>
                        <select name="breed_type" class="form-control">

                        <?php if($result->breed_type =="" || $result->breed_type  ===NULL): ?>
                                <option value=""> Select breed type</option>
                                <option value="local"> Local </option>
                                <option value="exotic">Exotic</option>
                            <?php elseif($result->breed_type==="local"): ?>
                                <option value="<?= $result->breed_type ?>" selected> <?= $result->breed_type ?></option>
                                <option value="exotic">Exotic</option>
                            <?php elseif($result->breed_type==="exotic"): ?>
                                <option value="<?= $result->breed_type ?>" selected> <?= $result->breed_type ?></option>
                                <option value="local"> Local </option>
                            <?php endif ?> 
                        </select>
                        <?php  echo (!empty(validation_errors('breed_type')) ? validation_errors('breed_type') : ''); ?>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" value="<?= $result->description ?>"   placeholder="Enter description" row=4></textarea>
                        <?php  echo (!empty(validation_errors('description')) ? validation_errors('description') : ''); ?>
                    </div>
                    <div class="form-group">
                        <label>Additional Note</label>
                        <textarea class="form-control" name="additional_note" value="<?= $result->additional_note ?>"  placeholder="Enter additional note" row=4></textarea>
                        <?php  echo (!empty(validation_errors('additional_note')) ? validation_errors('additional_note') : ''); ?>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-nldpi-green shadow-sm">Save</button>
                    </div>
            </form>
        </div>

    </div>
</div>