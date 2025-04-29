<!DOCTYPE html>

<html lang="en">



<head>



    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="National Digital Public Infratructure">

    <meta name="author" content="">

    <base href="<?= BASE_URL ?>">

    <title>NLDPI - <?php echo $title ?></title>



    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css"  href="bootstrap-4/css/bootstrap.css">

    

    <link rel="shortcut icon" href="<?= THEME_DIR ?>img/favicon.png" type="image/x-icon">

    <!-- <link href="<?= THEME_DIR ?>vendor/select2/select2.min.css" rel="stylesheet"> -->

    <link href="<?= THEME_DIR ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="<?= THEME_DIR ?>css/external-project.css" rel="stylesheet">

    <link href="<?= THEME_DIR ?>css/nldpi.css" rel="stylesheet">

    

    <link href="<?= THEME_DIR ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <script src="<?= THEME_DIR ?>vendor/jquery/jquery.min.js"></script>

    <script src="js/trongate-mx.js"></script>





</head>



<body id="page-top">



    <!-- Page Wrapper -->

    <div id="wrapper">

        <!-- Sidebar -->

        <ul class="navbar-nav bg-gradient-nlpdi-green sidebar sidebar-dark accordion" id="accordionSidebar">

            <?= Template::partial('partials/admin/sidebar_admin') ?>

        </ul>

        <!-- End of Sidebar -->



        <!-- Content Wrapper -->

        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->

            <div id="content">

                <?= Template::display($data) ?>

            </div>

            <!-- End of Main Content -->

            <!-- Footer -->

            <footer class="sticky-footer bg-white">

                <div class="container my-auto">

                    <div class="copyright text-center my-auto">

                        <span>Copyright &copy; NLDPI <script>document.write( new Date().getFullYear() );</script></span>

                    </div>

                </div>

            </footer>

            <!-- End of Footer -->

        </div>

        <!-- End of Content Wrapper -->

    </div>

    <!-- End of Page Wrapper -->



    <!-- Scroll to Top Button-->

    <a class="scroll-to-top rounded" href="#page-top">

        <i class="fas fa-angle-up"></i>

    </a>



    <!-- Logout Modal-->

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"

        aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>

                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">×</span>

                    </button>

                </div>

                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>

                <div class="modal-footer">

                    <button class="btn btn-outline-dark" type="button" data-dismiss="modal">Cancel</button>

                    <a class="btn btn-nldpi-green" href="<?= BASE_URL."users/logout" ?>">Logout</a>

                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->

  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    
    <script src="<?= THEME_DIR?>vendor/jquery/jquery.min.js"></script>

    <script src="<?= THEME_DIR?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



    <!-- Core plugin JavaScript-->

    <script src="<?= THEME_DIR?>vendor/jquery-easing/jquery.easing.min.js"></script>



    <!-- Custom scripts for all pages-->

    <script src="<?= THEME_DIR?>js/sb-admin-2.js"></script>



    <!-- Page level plugins -->

    <!-- <script src="<?= THEME_DIR?>vendor/chart.js/Chart.min.js"></script> -->



    <!-- Page level custom scripts -->

    <!-- <script src="<?= THEME_DIR?>js/demo/chart-area-demo.js"></script>

    <script src="<?= THEME_DIR?>js/demo/chart-pie-demo.js"></script> -->



     <!-- Custom styles for this page -->
     <script src="https://unpkg.com/htmx.org@1.9.12"></script>
     <script src="<?= THEME_DIR?>vendor/datatables/jquery.dataTables.min.js"></script>

     <script src="<?= THEME_DIR?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

     <script src="<?= THEME_DIR?>js/demo/datatables-demo.js"></script>

    <!-- Page level custom scripts -->



    <script>

      $(document).ready(function() {

       // $(".modal").modal('hide');

       $(".modal").modal('hide');



        $('.add-animal-registration').click(function () {

      

            $(this).parent().find('#animalRegistrationModal').modal('toggle'); 

            

        });





        $('.edit-animal-registration').click(function () {

        

            var id= $(this).attr('id');

      

            $(this).parent().find('#'+id+'editAnimalRegistration').modal('toggle'); 

            

        });



        $('.delete-animal-registration').click(function () {

            

            var id= $(this).attr('id-data');

      

            $(this).parent().find('#'+id+'deleteAnimalRegistration').modal('toggle'); 

            

        }); 













        $('.add-breed-registration').click(function () {

      

            $(this).parent().find('#breedRegistrationModal').modal('toggle'); 

            

        });





        $('.edit-breed-registration').click(function () {

                    

            var id= $(this).attr('id');



            $(this).parent().find('#'+id+'editBreedRegistration').modal('toggle'); 

            

        });



        $('.delete-breed-registration').click(function () {

            

            var id= $(this).attr('id-data');



            $(this).parent().find('#'+id+'deleteBreedRegistration').modal('toggle'); 

            

        }); 













        // grant user access

        $('.grant-access').on('click', function(){

          $('.user-group').empty();

          $('.user-type-group').empty();

          $('.message').empty();

          var user =  $('#user').val();

          var user_type = $('#user-type option:selected').text();

          var access =  $('#user-type option:selected').val(); 

          values= {

            "user":user,

            "access": access,

            "user_type":user_type,

          }

          $.ajax({

              type: "POST",

              url: "<?= BASE_URL ?>users/grant_access",

              data: values,

              dataType: 'json',

          }).done(function(result){

            if (result.user=='failure'){

              $(".user-group").append(result.error_message); 

            }else if(result.user_type=='failure'){

                $(".user-type-group").append(result.error_message)

            }              

            if (result.status=='success'){

              $(".message_success").prepend(result.message); 

              setTimeout(function(){

              location.reload();

              }, 3000);

            }

          });

        });   





        



              

      });



    </script>

    <script src="js/app.js"></script>

</body>



</html>