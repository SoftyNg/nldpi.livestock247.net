<style>

    a {

        color: #16192c;

        text-decoration: none;

        background-color: transparent;

    }

    a:hover {

        color: #00ad56;

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

        /*border: 1px solid #eaecf0;*/

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

    .quick-action{
        color: #101828 !important;
    }


    .lookup {
        margin-top:16px;
        margin-bottom:16px;
        padding: 20px;
        display:grid;
        grid-template-columns: 350px 3fr;
        background-color: #ffffff;
        border-radius:3px;
    }

    .loopkup > .lookup-span-lable{

        margin-right:16px;
    }

    .lookup > .lookup-span-lable > h6{
        color: #101828 !important;
      
    }

    .lookup > .lookup-span-search > .has-search{
        display:inline-block
       
    }

    .lookup > .lookup-span-search > button{
       display:inline-block
       
    }



    .has-search{
       padding:0;
    }



    .nav-link-tab {

color: grey !important;  /* Green text for all links */

display: flex;

justify-content: space-between;  /* Push text and number to opposite ends */

align-items: center;

width: 100%;  /* Ensure proper space distribution */

}



.nav-link-tab.active {

color: #00ad56 !important;

text-decoration: underline;  /* Underline the active link */

}



.nav-item {

margin-right: 15px;  /* Add space between links */

}



.found-placeholder {

color: #00ad56;

border: 1px solid #00ad56;  /* Circle background */

border-radius: 50%;  /* Make it circular */

width: 24px;  /* Set fixed size for the circle */

height: 24px;

display: flex;

justify-content: center;

align-items: center;

font-size: 0.9em;

margin-left: 10px;  /* Space between text and number circle */

}

.not-found-placeholder {
    color: grey;

    border: 1px solid grey;  /* Circle background */

    border-radius: 50%;  /* Make it circular */

    width: 24px;  /* Set fixed size for the circle */

    height: 24px;

    display: flex;

    justify-content: center;

    align-items: center;

    font-size: 0.9em;

    margin-left: 10px;  /* Space between text and number circle */

}


.nav-link-tab.active{
    border-bottom: 1px solid #00ad56;
}

.header-content{
    display: flex;
    justify-content:space-between;
} 

.btn-lookup, .btn-medical-history{
    background-color:#00ad56;
    color: #ffffff;
}


.btn-lookup:hover, .btn-medical-history:hover{
    color: #ffffff;
}


@media (max-width: 992px) {
    .lookup {
        grid-template-columns: 1fr;

    }

    .has-search > input[type=text]{
        margin-bottom: 5px;
    }
 
}

  

</style>

<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

<!-- Begin Page Content -->

    <!-- DataTales Example -->

    <div class="card shadow mb-4 mt-5">

        <div class="card-header py-3">

            <div class="header-content">

                <h6 class="m-0 font-weight-bold">Medical Diagnosis</h6>

                <button type="button" class="btn btn-medical-history" data-toggle="modal" title="Medical Diagnosis" data-target=".medical-history">New Medical Diagnosis</button>
                
            </div>

            <!-- medical diagnosis Modal -->
            <div class="modal fade medical-history" role="dialog" aria-labelledby="MedicalDiagnosisModalLabel" aria-hidden="true">

                <div class="modal-dialog" role="document">
                     
                    <?php  echo form_open('veterinary_professionals/submit_medical_diagnosis_record'); ?>

                        <input type="hidden" value="<?= isset($found_livestock->id)? $found_livestock->id : ''  ?>" name="id">

                        <input type="hidden" value="<?= isset($found_livestock->reg_by)? $found_livestock->reg_by : ''  ?>" name="reg_by">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h5 class="modal-title" id="medicalDiagnosisModalLabel">Record Medical Diagnosis</h5>

                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">

                                    <span aria-hidden="true">×</span>

                                </button>

                            </div>

                            <div class="modal-body">

                                <div class="form-group">

                                    <label>Illness</label>

                                    <select name="disease_type" class="form-control" required>
                        
                                        <?php foreach($disease_type_options as $key => $value): ?>

                                            <option value="<?= $key ?>"> <?= $value ?> </option>

                                        <?php endforeach ?>
                                    
                                    </select>

                                </div>

                                <div class="form-group">

                                    <label>Diagnosis Date</label>

                                    <input type="date" class="form-control" name="diagnosis_date"  required>

                                </div>  
                                
                                <div class="form-group">

                                    <label>Note</label>

                                    <textarea class="form-control" name="diagnosis_note"  required placeholder="Enter diagnosis note"></textarea>

                                </div>
                                

                                
                            </div>

                            <div class="modal-footer btn-group">

                                <?php

                                    $attr_close = array(

                                        "class" => "btn btn-outline-dark",

                                        "data-dismiss" => "modal"

                                    );

                                    echo form_button('close', 'Cancel', $attr_close);

                                    echo form_submit('submit', 'Record', array("class" => 'btn btn-vaccination shadow-sm'));

                                ?>

                            </div>

                        </div>

                    <?php echo form_close();?>   

                </div>

            </div>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                    <thead>

                        <tr>

                            <th>Date</th>

                            <th>Illness</th>

                            <th>Provider</th>

                            <th>Diagnosis</th>

                        </tr>

                    </thead>                

                    <tbody>

                        <?php foreach ($medical_history_records as $record) { ?>

                            <?php $veterinary_professional = Modules::run('veterinary_professionals/get_user_veterinary_professionals',$record->reg_by); ?>

                            <tr>
                                <td><?= date('d F, Y',strtotime($record->diagnosis_date)); ?></td>

                                <td><?= $disease_type_options[$record->disease_type]; ?></td>

                                <td><?= $veterinary_professional['provider']; ?> </td>

                                <td><?= $record->note; ?></td>


                            </tr>

                        <?php

                        }

                        ?>   

                    </tbody>

                </table>

            </div>

        </div>

    </div>

<!-- /.container-fluid -->

</div>  

