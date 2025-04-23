
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <?php require_once ("_navigation.php"); ?>


        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h6 class="h3 mb-0 text-gray-800">Profile Setting</h6>
            </div>
            <!-- Content Row Start-->
            <div class="row">
                <!-- Area Chart -->
                <div class="col-md-12 col-sm-12">

                    <!-- Content Row -->
                    <div class="card mb-4">
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <img src="<?= $image_path;?>" class="img-profile" alt="profile image" />
                                </div>
                            </div>
                        <h4 class="card-title">Update Profile</h4>
                        <hr>
                     
                        <?php    
                            echo form_open_upload(segment(1).'/submit_profile_picture/'.$id);
                                echo '<div class="form-group">';                                
                                echo '<div class="row">';
                                echo '<div class="col-md-6 col-sm-12">';                             
                                echo form_file_select('picture', array("class" =>"form-control"));
                                echo flashdata();
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="form-group">';
                                echo '<div class="btn-custom">';
                                echo form_submit("submit_pic", "Upload", array("class" => "btn btn-warning btn-warning-margin mr-4 "));
                                echo '<a href="'.$remove_profile_pic.'" class="btn btn-danger ">Delete</a>';
                                echo '</div>';
                                echo '</div>';
                            echo form_close();
                        ?>

                        <?php      
                            echo form_open('users/save_profile/'.$id);  
                                    
                                echo"<br>";
                                echo '<div class="form-group">';                        
                                echo '<div class="row">';
                                echo '<div class="col-md-6 col-sm-12">';
                                echo form_input("full_name",$name, array("class" =>"form-control","id"=>"", "placeholder"=>"Enter your fullname"));
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo'<br>';                          

                                echo '<div class="form-group">';
                                echo '<div class="row">';
                                echo '<div class="col-md-6 col-sm-12">';         
                                echo form_input("email",$email, array("class" =>"form-control","id"=>"", "placeholder"=>"Enter your email"));
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';     
                                echo form_submit("submit", "Save Changes", array("class" => "btn btn-primary"));
                                echo"<br>";            
                            echo'</form>';                  
                        ?>
                        <br>
                        <br>
                        <h4 class="card-title">Reset Password</h4>
                        <hr>
                        <?php  
                            echo form_open('users/update_password/'.$id);   
                        
                                echo"<br>";
                                echo "<div class='form-group'>";                     
                                echo '<div class="row">';; 
                                echo '<div class="col-md-6 col-sm-12">'; 
                                echo form_password('old_password','',
                                array("class" =>"form-control","id"=>"old_password", "placeholder"=>"Enter old password"));
                                echo '</div>';
                                echo '</div>';
                                echo "</div>";
                                echo"<br>";
                                echo form_hidden('email',$email,array("placeholder" =>"Enter email address","class" =>"form-control","id"=>"email"));
                                echo " <div class='form-group'>";   
                                echo '<div class="row">';
                                echo '<div class="col-md-6 col-sm-12">';            
                                echo form_password('password','', array("class" =>"form-control","id"=>"password", "placeholder"=>"Enter your new password" ));
                                echo '</div>';
                                echo '</div>';
                                echo "</div>";     
                                echo"<br>";   
                                
                                echo " <div class='form-group'>"; 
                                echo '<div class="row">';
                                echo '<div class="col-md-6 col-sm-12">'; 
                                echo form_password('confirm','',
                                array("class" =>"form-control","id"=>"confirm","placeholder"=>"Enter confirm password" ));
                                echo '</div>';
                                echo '</div>';
                                echo "</div>";                 
                    
                                echo form_submit("submit", "Save Changes", array("class" => "btn btn-primary"));
                                echo"<br>";
                            form_close(); 
                        ?>


                        </div>
                    </div>
                </div>

            </div>
            <!-- Content Row End -->

        </div>
    </div>

    <!-- End of Main Content -->



