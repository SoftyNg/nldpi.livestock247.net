
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
            /* Shadow/xs */
            box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.05);
        
        }
        
        .btn-green:hover {
            color: #fff;
            background-color:rgb(22, 199, 120);
            border-color: #079455;
        }
    </style>
    <div class="modal fade show d-block" id="autoModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-3">
                <div class="modal-header border-0 justify-content-center">
                <img src="<?= BASE_URL?>public/images/check.png" alt="Check img" class="img-fluid" style="width: 80px; height: 80px;">
                 
                </div>
                <div class="modal-body d-flex flex-column align-items-center justify-content-center">
                    <h2 class="fw-bold">Approval Successful</h2>
                    <p class="justify" >You have succesfully approved a number bank request of 
                        <?= $_SESSION['qty']; ?> Livestock Identification Number (IDs) to  <?= $_SESSION['id_provider']; ?>.</p>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-center">
                <a href="<?= BASE_URL?>number_bank/dashboard" 
                class="btn btn-green w-auto px-3">OK</a>  
</div>
            </div>
        </div>
    </div>
        <script>
        // Show the modal on page load
        window.onload = function () {
            var myModal = new bootstrap.Modal(document.getElementById('autoModal'));
            myModal.show();
        };
    </script>