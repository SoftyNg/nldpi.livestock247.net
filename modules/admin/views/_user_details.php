<?php require_once('sidebar.php');?>
<!-- Begin Page Content -->

<?php foreach ($user_data as $user) : ?>
    
 <div class="container-fluid" style="background-color:#F5FCF9;">
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-black"><?= $user->company_name; ?> </h1>
    
    <div class="ms-auto d-flex">
        <form action="admin/reject_application" method="post">
            <button type="submit" class="d-none 
            d-sm-inline-block btn btn-sm btn-danger shadow-sm me-2 mr-2">
                Reject Application
            </button>
        </form>
        <form action="<?=BASE_URL?>admin/approve_application" method="post">
        <input type="hidden" name="email" value="<?= $user->company_email; ?>" >
        
            <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                Approve Application
            </button>
        </form>
    </div>
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



<div class="col-lg-12">

    <!-- Default Card Example -->
    <div class="card mb-4">
        <div class="card-header">
            Identification Service Provider
        </div>

      <div class="col pl-4">     

        <div class="row  mt-4  border-bottom">
           
        <div class="col-lg-6 pr-4">
            <h5>Registration</h5>
            <h5><?= $user->reg_number; ?> </h5>
        </div>

             
        <div class="col-lg-6">
            <h5>Applied</h5>
            <h5><?= date("F d, Y", $user->reg_date); ?> </h5>
        </div>

        </div>

        <div class="row mt-4 pr-4 border-bottom">
    <div class="col-12 mb-3">
        <h5><b>Contact details</b></h5>
    </div>
    
    <div class="col-lg-6 mb-3">
        <h5>Phone number</h5>
        <h5><?= $user->phone_number; ?></h5>
    </div>
    
    <div class="col-lg-6 mb-3">
        <h5>Email address</h5>
        <h5><?= $user->company_email; ?></h5>
    </div>

     
    <div class="col-lg-6 mb-3">
        <h5>Website</h5>
        <h5><?= $user->website; ?></h5>
    </div>
    
    <div class="col-lg-6 mb-3">
        <h5>Address</h5>
        <h5><?= $user->address; ?></h5>
    </div>
</div>



<div class="row mt-4 pr-4 border-bottom">
    <div class="col-12 mb-3">
        <h5><b>Uploaded Documents</b></h5>
    </div>
    
    <div class="col-lg-3 mb-3">
        <h5>CAC Certification</h5>
        <h5><?= $user->capitalization; ?></h5>
    </div>
    
    <div class="col-lg-3 mb-3">
        <h5>Capitalization</h5>
        <h5><?= $user->capitalization; ?></h5>
    </div>

     
    <div class="col-lg-3 mb-3">
        <h5>Logo</h5>
        <h5><?= $user->logo; ?></h5>
    </div>
    
    <div class="col-lg-3 mb-3">
        <h5>Veterinary</h5>
        <h5><?= $user->vet_certification; ?></h5>
    </div>
</div>

        
        <div class="row  mt-4 pr-4 border-bottom">
            
        <div class="col-lg-6 pr-4">
            <h5>Registration</h5>
            <h5><?= $user->reg_number; ?> </h5>
        </div>

             
        <div class="col-lg-6">
            <h5>Applied</h5>
            <h5><?= date("F d, Y", $user->reg_date); ?> </h5>
        </div>

        </div>

        
        <div class="row  mt-4 pr-4 border-bottom">
            
        <div class="col-lg-6 pr-4">
            <h5>Registration</h5>
            <h5><?= $user->reg_number; ?> </h5>
        </div>

             
        <div class="col-lg-6">
            <h5>Applied</h5>
            <h5><?= date("F d, Y", $user->reg_date); ?> </h5>
        </div>

        </div>
        
        <div class="row  mt-4 pr-4 border-bottom">
            
        <div class="col-lg-6 pr-4">
            <h5>Registration</h5>
            <h5><?= $user->reg_number; ?> </h5>
        </div>

             
        <div class="col-lg-6">
            <h5>Applied</h5>
            <h5><?= date("F d, Y", $user->reg_date); ?> </h5>
        </div>

        </div>
</div>

    </div>

</div>






</div>
</div>
<?php endforeach; ?>