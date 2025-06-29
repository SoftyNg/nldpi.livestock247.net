<!DOCTYPE html>

<html lang="en">



<head>



    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="National Digital Public Infratructure">

    <meta name="author" content="">

    <base href="<?= BASE_URL ?>">

    <title>NLDPI - <?= $title ?></title>

    

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css"  href="bootstrap-4/css/bootstrap.css">



    <link rel="shortcut icon" href="<?= THEME_DIR ?>img/favicon.png" type="image/x-icon">

    <link href="<?= THEME_DIR ?>vendor/select2/select2.min.css" rel="stylesheet">

    <link href="<?= THEME_DIR ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="<?= THEME_DIR ?>css/nldpi.css" rel="stylesheet">

    

    <link href="<?= THEME_DIR ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <script src="<?= THEME_DIR ?>vendor/jquery/jquery.min.js"></script>



</head>



<body style="background:#F5FCF9">



    <!-- Page Wrapper -->

    <div id="wrapper">

        <div class="menu-wrapper">

            <div class="menu-left">

                <!-- Logo -->

                <a href="<?= BASE_URL ?>" class="home">

                    <img src="<?= THEME_DIR?>img/nldpi-logo-extra.png" alt="NLDPI">

                </a>

                <!-- Home link -->

                <span><a href="<?= BASE_URL ?>" class="home">Home</a></span>

                <div class="navbar-nav-left" id="navbar-nav-left" style="display:none">

                    <!-- Home link -->

                    <span class="nav-item-menu">

                        <a href="<?= BASE_URL ?>" class="" aria-current="page" >Home</a>

                    </span>

                    <!-- Login link -->

                    <span class="nav-item-menu auth-menu">

                        <a href="users/login" class="btn-login">Login</a>

                    </span>

                </div>

            </div>

            <div class="menu-right">

                <span><a href="users/login" class="btn login-button">Login</a></span>

                <div class="burger" id="burger-menu">

						<div class="bar"></div>

						<div class="bar"></div>

						<div class="bar"></div>

				</div>

            </div>

        </div>

        <div class="content" id="page-top">

            <?= Template::display($data) ?>

        </div>



        <div class="footer-wrapper">

            <div class="footer-container-1">

                <div class="footer-span-left">

                    <img src="<?= THEME_DIR ?>img/nldpi-logo-extra-white.png" alt="">

                </div>

                <div class="footer-span-right">

                    <ul>

                        <li><h6>Services</h6></li>                       

                        <li><a href="">Digital ID Creation</a></li>         

                        <li><a href="">Animal Registration</a></li>         

                        <li><a href="">Livestock Health Services</a></li>            

                        <li><a href="">Breed Information</a></li>           

                        <li><a href="<?= BASE_URL?>market_registry/public_market">Livestock Market</a></li>           

                        <li><a href="">Transportation Services</a></li>             

                    </ul>



                    <ul> 

                        <li><h6>Organisation</h6></li>

                        <li><a href="">About Us</a></li>

                        <li><a href="">Careers</a></li>

                        <li><a href="">Press</a></li> 

                        <li><a href="">News</a></li>

                        <li><a href="">Media Kit</a></li> 

                        <li><a href="">Contact Us</a></li>

                    </ul> 



                    <ul>

                        <li><h6>Resources</h6></li>

                        <li><a href="">Blog</a></li> 

                        <li><a href="">News Letter</a></li> 

                        <li><a href="">Events</a></li> 

                        <li><a href="">Help Center</a></li> 

                        <li><a href="">Tutorials</a></li> 

                        <li><a href="">Customer Support</a></li>

                    </ul>

                </div>

            </div>

            <hr class="bg-white liner">

            <div class="footer-container-2">

                <!-- Copyright -->

                <div class="text-center p-4" >

                    ©  <?= date('Y') ?> NLDPI.  All rights reserved. Powered by the Ministry of Livestock Development, Federal Republic of Nigeria 

                </div>

                <!-- Copyright -->

            </div>





        </div>

    </div>

    <!-- End of Page Wrapper -->

    <!-- Logout Modal-->

    <div class="modal fade logoutModal" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"

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

                    <a class="btn btn-nldpi-green" href="users/logout">Logout</a>

                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->

  



    <script src="<?= THEME_DIR?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



    <!-- Core plugin JavaScript-->

    <script src="<?= THEME_DIR?>vendor/jquery-easing/jquery.easing.min.js"></script>



    <!-- Custom scripts for all pages-->

    <script src="<?= THEME_DIR?>js/sb-admin-2.js"></script>



    <!-- Page level plugins -->

    <script src="<?= THEME_DIR?>vendor/chart.js/Chart.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Page level custom scripts -->

    <script src="<?= THEME_DIR?>js/demo/chart-area-demo.js"></script>

    <script src="<?= THEME_DIR?>js/demo/chart-area-demo.js"></script>

    <script src="<?= THEME_DIR?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->



    <script>

      $(document).ready(function() {

       // $(".modal").modal('hide');

       $(".modal").modal('hide');



       $('.burger').click(function () {

					if($('.navbar-nav-left').css("display") == "none"){

						$('.navbar-nav-left').css({"display":"flex"}); 

					}else if($('.navbar-nav-left').css("display") == "flex"){

						$('.navbar-nav-left').css({"display":"none"}); 

					}



					$('.burger').toggleClass("toggled");

				});  



				

				var body = document.getElementsByTagName("body");

				body[0].onresize = function(){

					var widthScreen =window.innerWidth;

					if($('.navbar-nav-left').css("display") == "flex"){

						if(widthScreen > 992){

						$('.burger').css({"display":"none"}); 

						$('.navbar-nav-left').css({"display":"none"});

						

						}else if(widthScreen <="992"){

						

							$('.burger').css({"display":"block"});

						

	

						}

					}else if($('.navbar-nav-left').css("display") == "none"){

						if(widthScreen > 992){

							$('.burger').css({"display":"none"}); 

						

						}else if(widthScreen <="992"){

							$('.burger').css({"display":"block"}); 

						

	

						}	

					}



				}	

				       



      });





    function offOverlaySuccess(){

        document.getElementById('overlay_success').style.display ="none";

    }

    function offOverlayFailure(){

        document.getElementById('overlay_failure').style.display ="none";

    }



</script>



</body>



</html>