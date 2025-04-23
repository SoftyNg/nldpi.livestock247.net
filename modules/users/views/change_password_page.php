<div class="justify-content-center">
    <div class='wrapper-form-container'>
      <div class='form-container'>
        <div class='text-center mb-3'>
          <img src='<?= BASE_URL?>themes/shopping/default/image//meat247-logo-01-1.png' class='w-50 img-fluid mt-5'>
          <h4 class='text-center mb-2 mt-2'>Password reset</h4>
        </div>
              
            <?php    
                echo form_open($form_location);                         
                  flashdata();
                  echo validation_errors();


                  echo " <div class='form-group'>";
                  echo form_label('Enter new Password');
                  echo '<div class="input-group mb-2" id="show_hide_password">'; 
                  echo form_password('password','',
                  array("placeholder" => "Enter a new password",
                  "class" =>"form-control","id"=>"name")); 
                  echo '<div class="input-group-append">';
                  echo  '<span class="input-group-text"><a href=""><i class="fa fa-eye" aria-hidden="true"></i></a></span>';                          
                  echo '</div>';
                  echo '</div>';                  
                  echo " <div>"; 

                  echo " <div class='form-group'>";
                  echo form_label('Confirm Password');
                  echo '<div class="input-group mb-4" id="show_hide_repeat_password">'; 
                  echo form_password('confirm','',
                  array("placeholder" => "Enter confirm password",
                  "class" =>"form-control","id"=>"name")); 
                  echo '<div class="input-group-append">';
                  echo  '<span class="input-group-text"><a href=""><i class="fa fa-eye" aria-hidden="true"></i></a></span>';                          
                  echo '</div>';
                  echo '</div>';                  
                  echo " <div>";            
              
                  echo " <div class='form-group'>";                        
                  echo form_submit('Submit','Submit New Password',array("class" =>"btn btn-primary btn-block")); 
                  echo " <div>";
                  echo " <div class='form-group mt-2'>";
                  echo '<p class="text-center"><a href="login">Back to login</a></p>';                           
                  echo "</div>";                               
                  echo form_close();
              ?>
      </div>
    </div>
</div>    