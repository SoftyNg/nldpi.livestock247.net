<!-- DELETE BUTCHERY MODAL-->
<div class="modal fade" id="<?= isset($breed->id)? $breed->id : ''  ?>deleteBreedRegistration" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= $form_location_delete_breed ?>" method="POST">
            <input type="hidden" value="<?= isset($breed->id)? $breed->id : ''  ?>" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAnimalRegistrationModalLabel">Are you sure you want to delete this breed <?= $breed->name ?>?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Click on delete button to remove <?= ucwords(strtolower($breed->name)) ?> animal breed from list.</div>
                <div class="modal-footer">
                    <button class="btn btn-outline-dark" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-nldpi-green" >Delete</button>
                </div>
            </div>
        </form>    
    </div>
</div>