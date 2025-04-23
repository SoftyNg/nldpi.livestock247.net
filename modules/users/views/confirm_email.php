<div class="justify-content-center">
    <div class='wrapper-form-container'>
      <div class='form-container mb-5'>
        <div class='text-center mb-3'>
          <img src='<?= BASE_URL?>themes/shopping/default/image//meat247-logo-01-1.png' class='w-50 img-fluid mt-5'>
          <h4 class='text-center mb-4 mt-2'>Reset your password</h4>
          <p class="text-center p-2">Enter the email address associated with this account and we will send you a reset link</p>

        </div> 
          <?php    
              echo form_open('users/recover_email');                         
              echo validation_errors();
              echo " <div class='form-group'>";                           
              echo form_input('email','',array("placeholder" =>
              "Enter email address","class" =>"form-control",
              "id"=>"email"));    
              echo " </div>";                           

              echo " <div class='form-group'>";                        
              echo form_submit('Submit','Request reset',array("class" =>"btn btn-primary btn-block")); 
              echo " <div>"; 

              echo " <div class='form-group mt-2'>";
              echo '<p class="text-center"><a href="login">Back to login</a></p>';
              echo "</div>";
              
              echo form_close();
          ?>
      </div>
    </div>
</div>                  
        