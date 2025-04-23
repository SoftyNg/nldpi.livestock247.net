
<div class="baseline mb-4 p-4">
    <div class="base-left">
        <div class="dashboard-name">
            <h1 class="h3 mb-0">Transport Permit</h1>
        </div>
    </div>
</div>
<div class="container-fluid" style="background-color:#F5FCF9;">
    <div class="text-and-action-parent">
        <a class="text-and-action nav-link" href="<?= BASE_URL."number_banks" ?>">
            <img class="text-and-action-child" alt="" src="<?= THEME_DIR?>img/loading.svg">
            
            <div class="company-and-quote">
                    <div class="company">Loading Permit</div>
                    <div class="quote">For livestock departing from origin market. Required at the start of transport.</div>
            </div>
        </a>    
        <a class="text-and-action nav-link" href="<?= BASE_URL."number_banks" ?>">
            <img class="text-and-action-child" alt="" src="<?= THEME_DIR?>img/offloading.svg">
            
            <div class="company-and-quote">
                    <div class="company">Offloading Permit</div>
                    <div class="quote">For Livestocks arriving at destination market. Completes the transport record.</div>
            </div>
        </a>
    </div>

    <div class="row">

        <!-- Table Area -->
        <div class="col-xl-12 col-md-12 col-sm-12 mt-3">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <h6 class="m-0 font-weight-bold">Loading Permits</h6>
                        <p class="mt-2">Keep track of loading permits</p>
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
                                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Permit ID</th>
                                            <th>Origin</th>
                                            <th>Destination</th>
                                            <th>Livestocks</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                                <?php foreach ($livestock_list as $livestock) { ?>
                                                    <tr>
                                                        <td><?= $livestock->name; ?></td>
                                                        <td><?= $livestock->type_of_animal; ?></td>
                                                        <td><?= $livestock->breed_type; ?></td>
                                                        <td><?= $livestock->description; ?></td>
                                                        <td><?= $livestock->additional_note; ?></td>
                                                        <td>
                                                            <a href="" class="btn btn-outline-dark btn-sm edit-breed-registration" id="<?= $breed->id ?>" data-toggle="modal" title="Edit" data-target="#<?= $breed->id ?>editBreedRegistration" ><i class="fa fa-edit fa-sm"></i></a>
                                                            <a href="" class="btn btn-outline-danger btn-sm delete-breed-registration" id-data="<?= $breed->id ?>" data-toggle="modal" title="Delete" data-target="#<?= $breed->id ?>deleteBreedRegistration" ><i class="fa fa-trash fa-sm"></i></a>
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
