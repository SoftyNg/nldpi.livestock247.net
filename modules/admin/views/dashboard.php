

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
                            <h5 class="m-0 font-weight-bold text-black">Registrations</h5>
                            <h6 class="m-0 font-weight-light text-grey">Keep track of Your allocated number banks</h6>
                        </div>
                        <div class="card-body">

                        
    <?php $number_bank_data =  Modules::run('number_bank/fetch_all_number_bank_request', $number); ?>

                                   
                                    <?php if (count($number_bank_data) > 0) { ?>
                                    <?php foreach ($number_bank_data as $numberBank)  {
   $type_of_tag = $numberBank->type_of_tag;
   $range = $numberBank->qty; 
   $bank_id = $numberBank->id;
   $reg_date = date('Y-m-d', $numberBank->request_date);
   $allocation_date = date('Y-m-d', $numberBank->allocation_date);
   $status =  $numberBank->status;
  }  } else { } ?>
                                  <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                            </div>
                        </div>
                    </div>


                    
</div>




</div>


<script>
var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
var yValues = [55, 49, 44, 24, 15];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
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
      text: "World Wide Wine Production 2018"
    }
  }
});
</script>



<style>

    a {

        color: #16192c;

        text-decoration: none;

        background-color: transparent;

    }

    a:hover {

        color: green;

    }

    .company {

        align-self: stretch;

        position: relative;

        line-height: 120%;

        font-weight: 600;

    }



    .company1 {

        position: relative;

        line-height: 130%;

    }



    .text {

        position: relative;

        line-height: 18px;

        font-weight: 500;

    }



    .badge {

        border-radius: 16px;

        background-color: #f5fffa;

        border: 1px solid #d6ffea;

        display: flex;

        flex-direction: row;

        align-items: center;

        justify-content: flex-start;

        padding: 2px 8px;

        mix-blend-mode: multiply;

        text-align: center;

        font-size: 12px;

        color: #00ad56;

    }



    .company-group {

        display: flex;

        flex-direction: row;

        align-items: flex-start;

        justify-content: flex-start;

        gap: 8px;

        font-size: 16px;

        color: #475467;

    }



    .company-parent {

        width: 100%;

        position: relative;

        border-bottom: 1px solid #eaecf0;

        box-sizing: border-box;

        display: flex;

        flex-direction: column;

        align-items: flex-start;

        justify-content: center;

        padding: 24px 32px;

        gap: 8px;

        text-align: left;

        font-size: 24px;

        color: #101828;

        font-family: Nunito;

    }



    .frame-icon {

        width: 100%;

        position: relative;

        border-radius: 114.84px;

        height: 58px;

        overflow: hidden;

        flex-shrink: 0;

    }



    .text-and-action-child {

        width: 58px;

        position: relative;

        border-radius: 114.84px;

        height: 58px;

        overflow: hidden;

        flex-shrink: 0;

    }



    .company {

        align-self: stretch;

        position: relative;

        line-height: 120%;

        text-transform: capitalize;

        font-weight: 600;

    }



    .quote {

        align-self: stretch;

        position: relative;

        font-size: 16px;

        line-height: 130%;

        color: #475467;

    }



    .company-and-quote {

        flex: 1;

        display: flex;

        flex-direction: column;

        align-items: flex-start;

        justify-content: flex-start;

        gap: 4px;

    }



    .text-and-action {

        flex: 1;

        border-radius: 8px;

        background-color: #fff;

        border: 1px solid #eaecf0;

        display: flex;

        flex-direction: row;

        align-items: center;

        justify-content: flex-start;

        padding: 16px;

        gap: 18px;

    }



    .company2 {

        align-self: stretch;

        position: relative;

        line-height: 120%;

        font-weight: 600;

    }



    .text-and-action-parent {

        width: 100%;

        position: relative;

        display: flex;

        flex-direction: row;

        align-items: center;

        justify-content: flex-start;

        gap: 24px;

        text-align: left;

        font-size: 18px;

        color: #16192c;

        font-family: Nunito;

    }



</style>

