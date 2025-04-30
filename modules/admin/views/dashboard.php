

<div class="container-fluid" style="background-color:#F5FCF9;">
<?php $email = $_SESSION['email'];
    $user_data =  Modules::run('service_providers/_fetch_all_data_for_user', $email); 
   foreach ($user_data as $user) :
   $name = $user->company_name;
   $nldpiNumber = $user->nldpi_number;      
 endforeach; ?>
    <div class="company-parent">

        <div class="company">Welcome, Admin</div>

        <div class="company-group">

            <div class="company1">System Overview</div>
        </div>

    </div>

    <div class="row">

        <div class="col-xl-4 col-md-6 mb-4">

            <div class="card shadow h-100 py-2">

                <div class="card-body">

                    <div class="no-gutters align-items-center">

                        <a class="nav-link" href="<?= BASE_URL."number_banks" ?>">

                            <div class="animal-registered-container">

                                <span>Registered Livestock</span>

                                <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>

                            </div>

                            <div class="h5 mb-0 font-weight-bold text-gray-800 mt-2">
                            <?= Modules::run('admin/count_animals');?>
                            </div>

                        </a>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-4 col-md-6 mb-4">

            <div class="card shadow h-100 py-2">

                <div class="card-body">

                    <div class="no-gutters align-items-center">

                        <div class="animal-registered-container">

                            <span>Approved Service Providers</span>

                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>

                        </div>

                        

                            <div class="h5 mb-0 font-weight-bold text-gray-800 mt-2">
                            <?= Modules::run('admin/count_service_providers');?>
                            </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-4 col-md-6 mb-4">

            <div class="card shadow h-100 py-2">

                <div class="card-body">

                    <div class="no-gutters align-items-center">

                        <div class="animal-registered-container">

                            <span>Health Compliance Rate</span>

                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>

                        </div>

                        

                            <div class="h5 mb-0 font-weight-bold text-gray-800 mt-2">0</div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    
<div class="row">

  <!-- Pie Chart -->
  <div class="card col-xl-4 col-lg-5">

                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-black">Activities</h5>
                                                   </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                                 
                                    <tbody>
                           
                <tr><td> Daily Average</td><td> </td></tr>
                <tr><td> Weekly Average</td><td> </td></tr>
                <tr><td> Monthly Average</td><td> </td></tr>
                <tr><td> Peak day</td><td> </td></tr>
                <tr><td> Last activity</td><td> </td></tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>


<div class="card shadow col-xl-8 col-lg-7">

                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-black">Service Providers Distribution</h5>
                        </div>
                        <div class="card-body">
                        <canvas id="myChart" style="width:100%;"></canvas>
                                 
                            </div>
                        </div>
                    </div>       
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
var xValues = ["Livestock Identity Providers", "Vetrinary Professionals", "Transporters", "Extention Workers", "Others"];
var yValues = [55, 49, 44, 24, 15];
var barColors = [
  "#079455",
  "#17B26A",
  "#47CD89",
  "#75E0A7",
  "#EAECF0"
];

new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: ""
    }
  }
});
</script>

