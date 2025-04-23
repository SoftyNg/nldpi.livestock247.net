    <!-- Begin Page Content -->

<div class="container-fluid" style="background-color:#F5FCF9 height=100%;">



<!-- Page Heading -->





    <div class="d-sm-flex align-items-center justify-content-between mt-4 mb-4">

        <h1 class="h3 mb-0 text-gray-800">Number Banks</h1>

        <div class="my-2 my-sm-0">

            <a href="<?= BASE_URL."breed_registrations/register_breed" ?>" class="btn btn-outline-dark mr-2">Allocate ID Number</a>

            <a href="<?= BASE_URL."number_banks" ?>" class="btn btn-success">Request Number Bank</a>

        </div>

    </div>









<!-- Content Row -->

<div class="row">

        <div class="col-xl-6 col-md-6 mb-4">

            <div class="card shadow h-100 py-2">

                <div class="card-body">

                    <div class="no-gutters align-items-center">

                        <div class="animal-registered-container">

                            <span>Active Number Banks</span>

                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>

                        </div>

                       

                         <div class="h5 mb-0 font-weight-bold text-gray-800 mt-2">50</div>

                 

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-6 col-md-6 mb-4">

            <div class="card shadow h-100 py-2">

                <div class="card-body">

                    <div class="no-gutters align-items-center">

                        <div class="animal-registered-container">

                            <span>Available ID</span>

                            <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>

                        </div>

                       

                         <div class="h5 mb-0 font-weight-bold text-gray-800 mt-2">10</div>

                    </div>

                </div>

            </div>

        </div>

     

    </div>







<div class="row">

    <div class="card shadow" style="width:100%">

                            <div class="card-header py-3">

                                <h5 class="m-0 font-weight-bold text-black">Allocated Number Banks</h5>

                                <h6 class="m-0 font-weight-light text-grey">Keep track of your allocated number banks</h6>

                            </div>



                            <div class="card-body">

                                <div class="table-responsive">

                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                        <thead>

                                            <tr>

                                                <th>Type of Tag</th>

                                                <th>Range</th>

                                                <th>Available</th>

                                                <th>Request Date</th>

                                                <th>Allocation Date</th>

                                                <th>Status</th>

                                            </tr>

                                        </thead>

                                    

                                        <tbody>

                                                                            

                                            

                                        

                                    

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

    </div>

</div>



<!-- Button to Trigger Modal -->



 <!-- The Modal -->

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

 <div class="modal-dialog modal-dialog-centered" role="document">

                <div class="modal-content">

                    <!-- Modal Header -->

                    <div class="modal-header">

                        <h5 class="modal-title text-dark" id="myModalLabel"><b>

                            Request For A Number Bank</b></h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">&times;</span>

                        </button>

                    </div>



                    <!-- Modal Body -->

                    <div class="modal-body">

                    <?= form_open('number_bank/number_bank_request_submit') ?>

                          <!-- Dropdown 1: Select User Role -->

                          <div class="form-group">

                            <label for="user_role">Quantity Of Id</label>

                            <select name="user_role" id="user_role" class="form-control">

                                <option value="admin">Admin</option>

                                <option value="editor">Editor</option>

                                <option value="viewer">Viewer</option>

                            </select>

                            <span>10,000 Minimum</span>

                        </div>



                        <!-- Dropdown 2: Select Country -->

                        <div class="form-group">

                            <label for="country">Purpose</label>

                            <select name="country" id="country" class="form-control">

                                <option value="nigeria">Nigeria</option>

                                <option value="ghana">Ghana</option>

                                <option value="kenya">Kenya</option>

                                <option value="south_africa">South Africa</option>

                            </select>

                        </div>

                                    

                    </div>



                    <!-- Modal Footer -->

                    <div class="modal-footer d-flex justify-content-between">

    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>

    <button type="submit" class="btn btn-success">Submit Request</button>

</div>

<?= form_close() ?>  

                </div>

            </div>

        </div>









        

<style>

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

