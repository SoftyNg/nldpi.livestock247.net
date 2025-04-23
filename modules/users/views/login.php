<div class="content-wrapper d-flex justify-content-center align-items-center " style="height: 70vh;">
    <div class="justify-content-center">
    <div class='wrapper-form-container'>
      <div class='form-container'>
        <div class='text-center mb-3'>
          <h4 class='text-center mb-1 mt-2'>Login into your account</h4>
          <p class="login-subtitle mb-4">Welcome back! Please enter your details.</p>
        </div>
          <?php    
             
              echo form_open('users/login_account');                         
              echo "<div class='form-group'>";
              echo form_label('Email');          
              echo form_input('email','',array("placeholder" =>
                "Enter your email","class" =>"form-control",
              "id"=>"email")); 
               echo "<span class='text-danger'>".(!empty(validation_errors('email')) ? validation_errors('email') : ''). "</span>";
              echo "</div>";                           
              
                                                          
              echo " <div class='form-group'>";
              echo form_label('Password');
              echo "<div class='input-group mb-3'>";
              echo form_password('password','',array("placeholder" =>
                "Enter your password","class" =>"form-control",
              "id"=>"password")); 
              echo"</div>";


              echo "<span class='text-danger'>".(!empty(validation_errors('password')) ? validation_errors('password') : ''). "</span>";
              echo "</div>";


              
              echo "<div class='d-flex justify-content-between'>";
              echo "<div class='checkbox'><input type='checkbox'> Remember for 30 days</div>";
              echo "<a href='recover_password' class='text-success'>Forgot Password?</a>";
              echo "</div>";              
              
              echo "<div class='form-group'>";                        
              echo form_submit('Submit','Sign in',array("class" =>"btn btn-success btn-block nldpi-login")); 
              echo "</div>"; 
              
              echo form_close();
          ?>

          <!-- <a href="register" class="text-dark">Register here</a>-->
      </div>
</div>                  
<script>

  function revealPassword() {
      var password = document.getElementById("password");
      if (password.type === "password") {
          password.type = "text";
      } else {
          password.type = "password";
      }
  }

</script>        
      
    </div>
</div>             
            
      