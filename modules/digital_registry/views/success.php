<div class="modal fade show d-block" id="autoModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-3">
            <div class="modal-header border-0 justify-content-center">
                <img src="<?= THEME_DIR ?>img/check.png" alt="Check img" class="img-fluid" style="width: 80px; height: 80px;">
            </div>
            <div class="modal-body d-flex flex-column align-items-center justify-content-center">
                <h2 class="fw-bold">Registration Successful</h2>
                <p class="justify" >Your credentials are being reviewed. Once verification is complete you will be notified via your provided email.</p>
            </div>
            <div class="modal-footer border-0 d-flex justify-content-center">
                <a href="digital_registry" class="btn btn-success w-auto px-3 btn-wide">OK</a>  
            </div>
        </div>
    </div>
</div>
<?php
    unset($_SESSION['success']);
?>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
<script>
    // Show the modal on page load
    window.onload = function () {
        var myModal = new bootstrap.Modal(document.getElementById('autoModal'));
        myModal.show();
    };
</script>

<style>
    .btn-wide {
        width: 50%;
    }
</style>