
<?php $email = $_SESSION['email'];
    $user_data =  Modules::run('service_providers/_fetch_all_data_for_user', $email); 
    ?>
<?php foreach ($user_data as $user) :
   $name = $user->company_name;
   $nldpiNumber = $user->nldpi_number;      
 endforeach; 
 ?>


  <style>
    .hero-banner {
      background-color: #0b9d5c; /* Green */
      padding: 100px 20px;
      color: white;
      text-align: center;
    }
    .search-box {
      max-width: 500px;
      margin: 30px auto 0;
    }
    .form-control::placeholder {
      color: #888;
    }
    .input-group .form-control {
      border-right: none;
    }
    .input-group .input-group-append .btn {
      border-left: none;
    }
  </style>
<div class="hero-banner">
  <h2 class="font-weight-bold">Livestock Services</h2>
  <div class="search-box">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Search Vet clinic, markets, transporters, service provider">
      <div class="input-group-append">
        <button class="btn btn-white " type="button">
          <span><img src="<?= BASE_URL ?>images/MagnifyingGlass.png"></span> <!-- Unicode for search icon -->
        </button>
      </div>
    </div>
  </div>
</div>

  
 <div class="container-fluid row" >

    <div class="card col-md-4">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="mb-0 font-weight-bold">Filters</h5>
      <button class="btn p-0" type="button" data-toggle="collapse" data-target="#filterOptions" aria-expanded="true">
        <span>&#9660;</span> <!-- Down arrow icon -->
      </button>
    </div>

    <div class="collapse show" id="filterOptions">
      <div class="custom-control custom-radio mb-2">
        <input type="radio" id="allServices" name="serviceFilter" class="custom-control-input" checked>
        <label class="custom-control-label font-weight-bold" for="allServices">All Services <span class="text-muted font-weight-normal">(62,934)</span></label>
      </div>
      <div class="custom-control custom-radio mb-2">
        <input type="radio" id="vetProfessionals" name="serviceFilter" class="custom-control-input">
        <label class="custom-control-label" for="vetProfessionals">Vet Professionals <span class="text-muted">(134)</span></label>
      </div>
      <div class="custom-control custom-radio mb-2">
        <input type="radio" id="healthServices" name="serviceFilter" class="custom-control-input">
        <label class="custom-control-label" for="healthServices">Health Services <span class="text-muted">(150)</span></label>
      </div>
      <div class="custom-control custom-radio mb-2">
        <input type="radio" id="markets" name="serviceFilter" class="custom-control-input">
        <label class="custom-control-label" for="markets">Markets <span class="text-muted">(54)</span></label>
      </div>
      <div class="custom-control custom-radio mb-2">
        <input type="radio" id="farmersKeepers" name="serviceFilter" class="custom-control-input">
        <label class="custom-control-label" for="farmersKeepers">Farmers/Keepers <span class="text-muted">(647)</span></label>
      </div>
      <div class="custom-control custom-radio mb-2">
        <input type="radio" id="transporters" name="serviceFilter" class="custom-control-input">
        <label class="custom-control-label" for="transporters">Transporters <span class="text-muted">(15)</span></label>
      </div>
    </div>
  </div>
</div>


<div class="col-md-8" style="background-color:#F5FCF9 height=100%;">

  <div class="row">
     <!-- Navigation Tabs or Filter Bar -->
 
    <!-- Card Starts -->
    <div class="col mb-4 mt-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <small class="text-success font-weight-bold">Market</small>
          <h5 class="card-title mb-1">Gurin</h5>
          <p class="mb-2 text-muted">
            <i class="fas fa-map-marker-alt mr-1"></i> Fufore LGA, Adamawa
          </p>
          <div class="d-flex align-items-center text-muted">
            <i class="fas fa-stethoscope mr-2"></i> Vet
            <i class="fas fa-university ml-4 mr-2"></i> Banking
          </div>
        </div>
      </div>
    </div>
    <!-- Card Ends -->

    <!-- Duplicate card with different content -->
    <div class="col mb-4 mt-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <small class="text-success font-weight-bold">Identity Service Provider</small>
          <h5 class="card-title mb-1">EdTech Nigeria LTD</h5>
          <p class="mb-0 text-muted">
            <i class="fas fa-map-marker-alt mr-1"></i> Ikeja, Lagos
          </p>
        </div>
      </div>
    </div>

    <!-- Add more cards below similarly... -->

  
</div>


 <div class="row">
    <!-- Card Starts -->
    <div class="col mb-4 mt-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <small class="text-success font-weight-bold">Market</small>
          <h5 class="card-title mb-1">Gurin</h5>
          <p class="mb-2 text-muted">
            <i class="fas fa-map-marker-alt mr-1"></i> Fufore LGA, Adamawa
          </p>
          <div class="d-flex align-items-center text-muted">
            <i class="fas fa-stethoscope mr-2"></i> Vet
            <i class="fas fa-university ml-4 mr-2"></i> Banking
          </div>
        </div>
      </div>
    </div>
    <!-- Card Ends -->

    <!-- Duplicate card with different content -->
    <div class="col mb-4 mt-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <small class="text-success font-weight-bold">Identity Service Provider</small>
          <h5 class="card-title mb-1">EdTech Nigeria LTD</h5>
          <p class="mb-0 text-muted">
            <i class="fas fa-map-marker-alt mr-1"></i> Ikeja, Lagos
          </p>
        </div>
      </div>
    </div>

    <!-- Add more cards below similarly... -->

  
</div>

</div>

</div>






 
