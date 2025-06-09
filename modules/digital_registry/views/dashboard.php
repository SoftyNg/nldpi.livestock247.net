
<?php $email = $_SESSION['email'];
    $user_data =  Modules::run('service_providers/_fetch_all_data_for_user', $email); 
    ?>
<?php foreach ($user_data as $user) :
   $name = $user->company_name;
   $nldpiNumber = $user->nldpi_number;      
 endforeach; 
 ?>


    <!-- Begin Page Content -->
    <style>
        .column-content {
            min-height: 200px;
            text-align: left;
        }
        .btn-green {
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;           
            border-radius: 8px;
            border: 1px solid #079455;
            background: #079455;
            /* Shadow/xs */
            box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.05);
        
        }
        
        .btn-green:hover {
            color: #fff;
            background-color:rgb(22, 199, 120);
            border-color: #079455;
        }
    
        .label {
            display: inline-flex;
            align-items: center;
            background-color: #e8f5e9; /* Light green background */
            border: 1px solid #4caf50; /* Green border */
            border-radius: 12px; /* Rounded corners */
            padding: 5px 10px;
            font-size: 14px;
            color: #4caf50;
            font-weight: 500;
        }

        .label::before {
            content: '';
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: #4caf50; /* Green dot */
            border-radius: 50%;
            margin-right: 8px; /* Space between dot and text */
        }

        .reject-label {
            display: inline-flex;
            align-items: center;
            background-color: #FEF3F2; 
            border: 1px solid #FECDCA; 
            border-radius: 12px; /* Rounded corners */
            padding: 5px 10px;
            font-size: 14px;
            color: #B42318;
            font-weight: 500;
        }

        .reject-label::before {
            content: '';
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: #B42318; 
            border-radius: 50%;
            margin-right: 8px; /* Space between dot and text */
        }

        
        .pending-label {
            display: inline-flex;
            align-items: center;
            background-color: #FFFAEB; 
            border: 1px solid #FEDF89; 
            border-radius: 12px; /* Rounded corners */
            padding: 5px 10px;
            font-size: 14px;
            color: #F79009;
            font-weight: 500;
        }

        .pending-label::before {
            content: '';
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: #F79009; 
            border-radius: 50%;
            margin-right: 8px; /* Space between dot and text */
        }
    </style>
 <div class="container-fluid" style="background-color:#F5FCF9 height=100%;">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
 <div>
    <h2 style="color:black;">Digital Registry</h2>     
    

</div>

</div>
<style>
.col-a a {
  color: #000000;
  text-decoration: underline;
}
</style>


<!-- Content Row -->
<div class="col col-a">
<p><a href="digital_registry/id_service_providers">Livestock Identity Service Providers</a></p>
<p><a href="">Livestock Transporters</a></p>
<p><a href="">Livestock Keepers and Farmers</a></p>
<p><a href="digital_registry/veterinary_service">veterinary Professionals</a></p>
<p><a href="">Breeding Center</a></p>
<p><a href="">Health Records</a></p>
<p><a href="">Production Data</a></p>
<p><a href="">Grazing Lands and Facilitators</a></p>
<p><a href="">Processing Centers</a></p>
<p><a href="">Veterinary Clinics</a></p>
<p><a href="">Feed Manufacturers</a></p>
<p><a href="">Technical Specialists</a></p>
<p><a href="">Quarantine Centers</a></p>
<p><a href="">Extention Workers</a></p>
</div>



<div class="row d-flex justify-content-center">





<div class="row">


</div>


</div>
                    



 
