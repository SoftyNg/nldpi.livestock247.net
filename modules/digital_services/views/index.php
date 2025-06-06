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
        <button class="btn btn-white" type="button">
          <span><img src="<?= BASE_URL ?>images/MagnifyingGlass.png"></span>
        </button>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid row">

  <div class="card col-md-4">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0 font-weight-bold">Filters</h5>
        <button class="btn p-0" type="button" data-toggle="collapse" data-target="#filterOptions" aria-expanded="true">
          <span>&#9660;</span>
        </button>
      </div>

      <div class="collapse show" id="filterOptions">
        <div class="custom-control custom-radio mb-2">
          <input type="radio" id="allServices" name="serviceFilter" class="custom-control-input" checked>
          <label class="custom-control-label font-weight-bold" for="allServices">All Services
            <span class="text-muted font-weight-normal">(<?= count($all_services); ?>)</span></label>
        </div>
        <div class="custom-control custom-radio mb-2">
          <input type="radio" id="vetProfessionals" name="serviceFilter" class="custom-control-input">
          <label class="custom-control-label" for="vetProfessionals">Vet Professionals
            <span class="text-muted">(<?= count($vets); ?>)</span></label>
        </div>
        <div class="custom-control custom-radio mb-2">
          <input type="radio" id="healthServices" name="serviceFilter" class="custom-control-input">
          <label class="custom-control-label" for="healthServices">Health Services
            <span class="text-muted">(<?= count($health); ?>)</span></label>
        </div>
        <div class="custom-control custom-radio mb-2">
          <input type="radio" id="markets" name="serviceFilter" class="custom-control-input">
          <label class="custom-control-label" for="markets">Markets <span class="text-muted">(<?= count($markets); ?>)</span></label>
        </div>
        <div class="custom-control custom-radio mb-2">
          <input type="radio" id="farmersKeepers" name="serviceFilter" class="custom-control-input">
          <label class="custom-control-label" for="farmersKeepers">Farmers/Keepers
            <span class="text-muted">(<?= count($keepers); ?>)</span></label>
        </div>
        <div class="custom-control custom-radio mb-2">
          <input type="radio" id="transporters" name="serviceFilter" class="custom-control-input">
          <label class="custom-control-label" for="transporters">Transporters <span class="text-muted">(<?= count($transporters); ?>)</span></label>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-8" style="background-color:#F5FCF9; height:100%;">
    <!-- This is where service results will be loaded -->
    <div id="serviceList">
      <?php
    require_once APPPATH . 'modules/digital_services/views/service_list_partial.php';

      ?>
    </div>
  </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    $('input[name="serviceFilter"]').on('change', function () {
      let selectedId = $(this).attr('id');

      $.ajax({
        url: "<?= BASE_URL ?>digital_services/fetch_services",
        method: "POST",
        data: { type: selectedId },
        success: function (response) {
          $('#serviceList').html(response);
        },
        error: function () {
          alert('Error loading data.');
        }
      });
    });

    // Trigger initial load to show all services
    $('input[name="serviceFilter"]:checked').trigger('change');
  });
</script>







 
