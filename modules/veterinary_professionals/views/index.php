<?php  require_once ("_navigation.php"); ?>
<div class="baseline-container">
    <div class="baseline px-4 pt-3">
        <div class="base-left">
            <div class="dashboard-name">
                <h1 class="h3 mb-0">Users Registrations</h1>
            </div>
        </div>
    </div>
    <div class="span-tab px-4 pt-4">
        <!--<a href="">
            <div class="animal-span-tab">
                <span class="animal-tag">Animal Identity Service Provider</span> 
                <?php if(strlen('1') ==1):  ?>
                    <span class="count-tag count-tag-grey-single">1</span>
                <?php else: ?>  
                    <span class="count-tag count-tag-grey-double">20</span>
                <?php endif ?>            
            </div>
        </a>-->
        <a href="" class="a-color-green">
            <div class="vet-professional-span-tab">
            <span class="vet-professional-tag">Veterinary Professionals</span> 
                <?php if(strlen($vet_professionals_total) == 1):  ?>
                    <?php if($vet_professionals_total  != 0):  ?>
                        <span class="count-tag count-tag-green-single"><?= $vet_professionals_total ?></span>
                    <?php endif ?> 
                
                <?php else: ?>  
                    <span class="count-tag count-tag-green-double"><?= $vet_professionals_total ?></span>
                <?php endif ?> 
            </div>
        </a>
        <!--<a href="">
            <div class="animal-keeper-span-tab">
                <span class="animal-keepers-tag">Animal keepers</span> 
                <?php if(strlen('50') == 1):  ?>
                    <span class="count-tag count-tag-grey-single">1</span>
                <?php else: ?>  
                    <span class="count-tag count-tag-grey-double">20</span>
                <?php endif ?>  
            </div>
        </a>
        <a href="">
            <div class="transporter-span-tab">
                <span class="transporter-tag">Transporters</span> 
                <?php if(strlen('48') == 1):  ?>
                    <span class="count-tag count-tag-grey-single">1</span>
                <?php else: ?>  
                    <span class="count-tag count-tag-grey-double">48</span>
                <?php endif ?> 
            </div>
        </a>-->
    </div>
</div>

<!-- End of Topbar -->


<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <!-- Table Area -->
        <div class="col-xl-12 col-md-12 col-sm-12 mt-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <h5 class="m-0 font-weight-bold font">
                            Veterinary Professionals                 
                            <?php if(strlen($vet_professionals_total) == 1):  ?>
                                <?php if($vet_professionals_total  != 0):  ?>
                                    <span class="count-tag count-tag-green-single"><?= $vet_professionals_total ?></span>
                                <?php endif ?> 
                            <?php else: ?>  
                                <span class="count-tag count-tag-green-double"><?= $vet_professionals_total ?></span>
                            <?php endif ?>  
                        </h5>
                    
                    </div>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable"  width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Professional ID</th>
                                    <th>Date Registered</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list_of_registered_vet_professionals as $registered_vet_professional) { ?>
                                    <tr>
                                        <td><?= $registered_vet_professional->firstname.' '.$registered_vet_professional->lastname; ?></td>
            
                                        <td><?= $registered_vet_professional->reg_number; ?></td>
                                        <td><?= $registered_vet_professional->reg_date; ?></td>

                                        <td>
                                            <a href="<?= BASE_URL . 'veterinary_professionals/approval/'.$registered_vet_professional->id?>" class="fa-view-icon" title="View"><i class="fa fa-eye"></i> View </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div> 
                </div>              
            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->


<script>
    /*$(document).ready(function() {
       // $(".modal").modal('hide');
       $(".modal").modal('hide');


        $('.set-vet-professtional-status').on('change', function(){
            var id= $(this).attr('id');
            alert(id);
            exit();
            var vet_doctor_id = $(this).value();


            values= {
                "id": vet_doctor_id,
                "status": vet_doctor_id
            }

                // delete staff
                $.ajax({
                    type: "POST",
                    url: "<?= BASE_URL . 'veterinary_professionals/set_vet_professtional_status'?>",
                    data: values,
                }).done(function(result){
                    if (result.success=='success'){
                    $("#set-status").prepend("<div class='status alert alert-success text-center col-sm-9 offset-sm-1'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a><strong >" +result.message+"</strong></div>"); 
                    setTimeout(function(){
                    location.reload();
                    }, 6000);
                    }else if(result.success=='fail'){
                        $("#set-status").prepend("<div class='status alert alert-danger text-center col-sm-9 offset-sm-1'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a><strong >" +result.message+"</strong></div>");
                    setTimeout(function(){
                    location.reload();
                    }, 6000);                  
                    }
                });
        });
            
    });*/
      
    // json to get state and local government to fill state and local goverment dropdown
    $.getJSON("<?= BASE_URL?>states-localgovts/states-localgovts.json",function(states){
        $.each(states.states, function(key, value){
        $('#state').append($("<option></option>").attr('value', states.states[key].state).text(value.state));
        $('#state').on('change', function(){
            var state =$(this).val();
            if (states.states[key].state == state){
            //$('#state').find("option:gt(0)").remove();
            $('#localG').children("option").not(':first').remove();
            $.each(states.states[key].local, function(key, value){
                $('#localG').append($("<option></option>").attr('value', value).text(value));
            });
            }
        });
        });
    });



</script>