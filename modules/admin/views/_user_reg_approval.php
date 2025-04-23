<?php //require_once('sidebar.php');?>
<!-- Begin Page Content -->
 <div class="container-fluid" style="background-color:#F5FCF9;">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">   
    <h1 class="h3 mb-0 text-black">User Registration <?php //$user_data['company_name'];?></h1>

    <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
</div>

<style>
       .nav-link-tab {
      color: grey !important;  /* Green text for all links */
      display: flex;
      justify-content: space-between;  /* Push text and number to opposite ends */
      align-items: center;
      width: 100%;  /* Ensure proper space distribution */
    }

    .nav-link-tab.active {
      color: green !important;
      text-decoration: underline;  /* Underline the active link */
    }

    .nav-item {
      margin-right: 15px;  /* Add space between links */
    }

    .number-placeholder {
      color: white;
      background-color: green;  /* Circle background */
      border-radius: 50%;  /* Make it circular */
      width: 24px;  /* Set fixed size for the circle */
      height: 24px;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 0.9em;
      margin-left: 10px;  /* Space between text and number circle */
    }
  </style>

<!-- Begining of Tab -->
<div class="row">

<div class="mt-5 w-100">
    

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs w-100" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link-tab active" id="home-tab" data-bs-toggle="tab" 
        data-bs-target="#home" type="button" role="tab" aria-controls="home" 
        aria-selected="true">Animal Identity Service Provider
         <span class="number-placeholder"><?= count($reg_data);?></span></a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link-tab" id="profile-tab" data-bs-toggle="tab" 
        data-bs-target="#profile" type="button" role="tab" aria-controls="profile" 
        aria-selected="false">Veterinary Professional 
        <span class="number-placeholder">0</span></a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link-tab" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" 
        type="button" role="tab" aria-controls="contact" aria-selected="false">
    Animal Keepers
    <span class="number-placeholder">0</span></a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link-tab" id="settings-tab" data-bs-toggle="tab" 
        data-bs-target="#settings" type="button" role="tab" aria-controls="settings" 
        aria-selected="false">Transporters
        <span class="number-placeholder">0</span></a>
      </li>
    </ul>

    <!-- Tabs Content -->
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <!-- Begin Page Content -->
          <div class="container-fluid">




<!-- DataTales Example -->
<div class="card shadow mb-4 mt-5">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Animal Identity Service Providers</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                                
                    <tr>
                        <th><input type="checkbox" id="option1" name="option1" value="Option 1"></th>
                        <th>Name</th>
                        <th>CAC-reg</th>
                        <th>Date registered</th>
                        <th>Action</th>
                     
                    </tr>
                    
                </thead>
                
              
                <tbody><?php if (count($reg_data) > 0) { ?>
    <?php foreach ($reg_data as $service_provider_data) { ?>
        <tr>  <!-- Added missing <tr> tag -->
            <td><input type="checkbox" id="option1" name="option1" value="Option 1"></td>
            <td><?php echo $service_provider_data->reg_number; ?></td>
            <td><?php echo $service_provider_data->email; ?></td>
            <td><?php echo date('Y-m-d', $service_provider_data->reg_date);; ?></td>
            <td><a class="nav-link-tab" href="users_details/<?php echo $service_provider_data->company_email; ?>">View </a>
            </td>
        </tr>
    <?php } ?>
<?php } else { ?>
    <tr>
        <td colspan="5">There is no entry yet</td>  <!-- colspan added to align message properly -->
    </tr>
<?php } ?>
                   
                   
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->
      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <p class="mt-3">Content.</p>
      </div>
      <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        <p class="mt-3">Content</p>
      </div>
      <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
        <p class="mt-3">Content.</p>
      </div>
    </div>
  </div>

</div>

</div>
</div>