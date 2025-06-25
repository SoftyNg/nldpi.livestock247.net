<?php  require_once ("_navigation.php"); ?>
<div class="baseline mb-4 p-4">
    <div class="base-only">
        <a href="">Profile</a>
        <a href="">Health Records</a>
    </div>
</div>
<!-- End of Topbar -->
<!-- Begin Page Content -->
<div class="container-fluid">
        <div class="animal-form-name mb-5">
            <h1 class="h3 mb-0 ml-4">Register New Breed</h1>
        </div>
        <div class="register-animal-form my-4 px-4">
        <?php 
            
            echo form_open('breed_registrations/add_breed');
        ?>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Name Of Breed</label>
                            <select name="name" class="form-control">
                                <option value=""> Select Animal identification number</option>
                                <option value="1234561">1234561 </option>
                                <option value="1324575">1324575</option>
                                <option value='2316789'>2316789 </option>
                                <option value='4793248'>4793248</option>
                                <option value='9143578'>9143578</option>
                                <option value='6945289'>6945289</option>
                                <option value='1903724'>1903724</option>
                                <option value='8146932'>8146932</option>
                                <option value='8176932'>8176932</option>
                                <option value='1901124'>1901124</option>
                                <option value='9122932'>9122932</option>
                                <option value='7764932'>7764932</option>
                            </select>
                            <?php  echo (!empty(validation_errors('name')) ? validation_errors('name') : ''); ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Types Of Animal</label>
                            <select name="type_of_animal" class="form-control">
                                <option value=""> Select type of animal</option>
                                <option value="goat"> Goat </option>
                                <option  value="ram">Ram</option>
                                <option  value="cow">Cow</option>
                            </select>
                            <?php  echo (!empty(validation_errors('type_of_animal')) ? validation_errors('type_of_animal') : ''); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Breed Type</label>
                            <select name="breed_type" class="form-control">
                                <option value=""> Select breed type</option>
                                <option value="local"> Local </option>
                                <option value="exotic">Exotic</option>
                            </select>
                            <?php  echo (!empty(validation_errors('breed_type')) ? validation_errors('breed_type') : ''); ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" value=""   placeholder="Enter description" row=4></textarea>
                            <?php  echo (!empty(validation_errors('description')) ? validation_errors('description') : ''); ?>
                        </div>
                    </div>
                </div>
                <div class="row last-form-input">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Additional Note</label>
                            <textarea  name="additional_note" class="form-control" placeholder="Enter additional note" row=4></textarea>
                            <?php  echo (!empty(validation_errors('additional_note')) ? validation_errors('additional_note') : ''); ?>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="mt-4 breed-span">

                    <div class="back-and-next-span">
                        <button type="button" onclick="goBack()" class="btn btn-white btn-back mr-2">Back</button>
                        <button type="submit" name="submit" value="Submit" class="btn btn-nldpi-green shadow-sm btn-next">Register Breed</button>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>

</div>
<script>
    function goBack(){
        window.history.back();
    }
</script>
<!-- /.container-fluid -->