   <!-- Topbar Navbar -->
   
<?php 
  if(isset($user_data)){
    foreach($user_data as $data){
    $name = $data->full_name;
    $user_type = $data->user_type;
    $email = $data->email;
    $id = $data->id;
    $picture = $data->picture;
   } 
   $image_path = BASE_URL.'profile_pics/';
   $image_path .= (isset($picture) && $picture !='')?  $id.'/'.$picture : 'user.jpg';
   
   $remove_profile_pic = 'remove_profile_image/' . $id;
  }else{
    $name = $name;
    $email = '';
    $image_path = $image_path;

  }
?>
<ul class="navbar-nav ml-auto">


<div class="topbar-divider d-none d-sm-block"></div>

<!-- Nav Item - User Information -->
<li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            
        <img class="img-profile rounded-circle"src="<?= $image_path;?>">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
            <strong><?= $name;?></strong>
            <br>
            <?=  $user_type;?>
        </span>
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="userDropdown">
        <?php if(isset($_SESSION['access']) && $_SESSION['access'] == "1"){ ?>
            <a class="dropdown-item" href="<?= BASE_URL?>users/settings">
                <i class="fas fa-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                Settings
            </a>
            <div class="dropdown-divider"></div>
        <?php }?>
      
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
        </a>
    </div>
</li>

</ul>

</nav>



