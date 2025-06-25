<?php 
  if(isset($user_data)){
    foreach($user_data as $data){
        $initials = strtoupper(substr($data->email,0,1)); 
        $id = $data->id;
        $picture = $data->picture;
   } 
    $image_path = BASE_URL.'profile_pics/';
    $image_path .= (isset($picture) && $picture !='')?  $id.'/'.$picture : 'user.jpg';

  }else{
    $image_path = BASE_URL.'profile_pics/';
    $image_path .= 'user.jpg';
    $initials  = '';
    $image_path = $image_path;

  }
?>
<nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow">
    
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">

        <div class="form-group has-search">
            <span class="fa fa-search  form-control-feedback"></span>
            <input type="text" class="form-control" placeholder="Search">
        </div>

    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bell"></i>
                
            </a>
        </li>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="rounded-circle bg-user-initials"><span class="rounded-circle bg-user-initials"><?= isset($initials) ? $initials : '' ?></span></span>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target=".logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>
    
    
</nav>