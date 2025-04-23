<div class="justify-content-center">
    <div class='wrapper-form-container'>
      <div class='form-container mb-5'>
        <div class='text-center mb-3'>
        <img src="<?= BASE_URL?>public/images/nldpi_logo.png" alt="Brand Logo">
          <h4 class='text-center mb-4 mt-2'>Create your Account</h4>
        </div>  
          <?php   
            echo form_open('users/create_account');                                                
            flashdata();
                                                      
            echo "<div class='form-group'>";
            echo form_label('Firstname');
            echo form_input('firstname','',
            array("placeholder" => "Enter firstname",
            "class" =>"form-control","id"=>"firstname")); 
            echo (!empty(validation_errors('firstname')) ? validation_errors('firstname') : '');
            echo "</div>";  

            echo "<div class='form-group'>";
            echo form_label('lastname');
            echo form_input('lastname','',
            array("placeholder" => "Enter lastname",
            "class" =>"form-control","id"=>"lastname")); 
            echo (!empty(validation_errors('lastname')) ? validation_errors('lastname') : '');
            echo "</div>"; 

            echo " <div class='form-group'>"; 
            echo form_label('Email');                          
            echo form_input('email','',array("placeholder" =>
            "Enter email address","class" =>"form-control",
            "id"=>"email"));    
            echo (!empty(validation_errors('email')) ? validation_errors('email') : '');
            echo " </div>";                          
                                                      
            echo " <div class='form-group'>";
            echo form_label('Password', );
            echo form_password('password','',
            array("placeholder" => "Enter password",
            "class" =>"form-control","id"=>"name")); 
            echo (!empty(validation_errors('password')) ? validation_errors('password') : '');
            echo " </div>"; 

            echo " <div class='form-group'>";
            echo form_label('Confirm Password');
            echo form_password('confirm','',
            array("placeholder" => "Enter confirm password",
            "class" =>"form-control","id"=>"name")); 
            echo (!empty(validation_errors('confirm')) ? validation_errors('confirm') : '');
            echo " </div>"; 
            echo form_hidden('user_type','member'); 

            echo " <div class='form-group'>";                        
            echo form_submit('Submit','Create my account',array("class" =>"btn btn-success btn-block")); 
            echo " </div>"; 

            echo "<div class='d-flex justify-content-between'>";
            echo '<a href="recover_password" class="text-dark">Forgot Password?</a><a href="login" class="text-dark">Login Here</a>';
            echo "</div>";
            echo form_close();
          ?>
      </div>
    </div>
</div>          