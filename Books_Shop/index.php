
<?php

$Time = time();



if(!isset($_COOKIE["Token"]) || !isset($_COOKIE["User"]) ){
    header('Location: Pages/Login.php');
}
else{


    $User = htmlspecialchars( $_COOKIE['User']);
    $Token = htmlspecialchars( ($_COOKIE['Token']));
    $Connection = mysqli_connect('localhost','Admin','Many1387','books_shop');
    $command = "SELECT * FROM Tokens WHERE UserName LIKE '$User' AND Code LIKE '$Token' AND ExpireTime >= '$Time'";

    $result = mysqli_query($Connection,$command);
    $response = mysqli_fetch_All( $result);
    if(!$response){
        mysqli_free_result($result);
        mysqli_close($Connection);
        header('Location: Pages/Login.php');
      
    }


    $commandbook = "SELECT * FROM `books` ORDER BY CreateTime DESC LIMIT 8";
    $resultlast = mysqli_query($Connection,$commandbook);
    $responselast = mysqli_fetch_All($resultlast,MYSQLI_ASSOC);

    
    $commandTopbook = "SELECT * FROM `books` ORDER BY ViewCount DESC LIMIT 15";
    $resultTop = mysqli_query($Connection,$commandTopbook);
    $responseTop = mysqli_fetch_All($resultTop,MYSQLI_ASSOC);

 
    $commandpopbook = "SELECT * FROM `books` ORDER BY DownloadCount DESC LIMIT 8";
    $resultpop = mysqli_query($Connection,$commandpopbook);
    $responsepop = mysqli_fetch_All($resultpop,MYSQLI_ASSOC);
   
}

?>







<!DOCTYPE html>
<html lang="en">

    
<head>
        <meta charset="utf-8" />   <title>لندریک  - قالب چندمنظوره ای مدرن html</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Premium Bootstrap 5 Landing Page Template" />
        <meta name="keywords" content="Saas, Software, multi-uses, HTML, Clean, Modern" />
        <meta name="author" content="JafarAbbasi" />
        <meta name="email" content="jabasi26@gmail.com" />
        <meta name="website" content="https://www.rtl-theme.com/author/tn_plugin/" />
        <meta name="Version" content="v3.2.1" />
        <!-- favicon -->
        <link rel="shortcut icon" href="images/favicon.ico">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- tobii css -->
        <link href="css/tobii.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons -->
        <link href="css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="unicons.iconscout.com/release/v3.0.6/css/line.css">
        <!-- Slider -->               
        <link rel="stylesheet" href="css/tiny-slider.css"/> 
        <!-- Main Css -->
        <link href="css/style.min.css" rel="stylesheet" type="text/css" id="theme-opt" />
        <link href="css/colors/default.css" rel="stylesheet" id="color-opt">
    </head>

    <body>
        <!-- Loader -->
        <!-- <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
            </div>
        </div> -->
        <!-- Loader -->
        
        <!-- Navbar STart -->
        <header id="topnav" class="defaultscroll sticky">
            <div class="container">
                <!-- Logo container-->
                <div>
                    <a class="logo" href="index.php">
                        <lable style="color:blue;" src="images/logo-dark.png" height="24" alt="">MOVIEDEV</lable>
                    </a>
                </div>                 
                <ul class="buy-button list-inline mb-0">
                    <li class="list-inline-item mb-0">
                        <div class="dropdown">
                            <button type="button" class="btn btn-link text-decoration-none dropdown-toggle p-0 pe-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img style="zoom:4%" class="uil uil-search h5 text-muted" src="images/magnifying-glass-search.png"></img>
                            </button>
                            <div class="dropdown-menu dd-menu dropdown-menu-end bg-white shadow rounded border-0 mt-3 py-0" style="width: 300px;">
                                <form method="GET" action='<?php if (isset( $_GET['nameTag'])) {
                                     header("Location: ./Pages/BooksSearch.php?Tag=".$_GET['nameTag']);
                                }
                                ?>'>
                                    <input type="text"  name="nameTag" class="form-control border bg-white" placeholder="جستجو...">
                                </form>
                            </div>
                        </div>
                    </li>
                    <li   class="list-inline-item mb-0">
                        <div  class="dropdown dropdown-primary">
                           
                          
                        <form action='Pages/Profile.php'  method="GET">
                          <button   class="btn btn-icon btn-primary dropdown-toggle"  aria-haspopup="true" aria-expanded="false">
                          
                          <i class="uil uil-user align-middle icons"></i>
                          
                        </button>
                        </form>
                       
                        </div>
                    </li>
                   
                </ul><!--end login button-->
                <!-- End Logo container-->
                <div class="menu-extras">
                    <div class="menu-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </div>
                </div>
        
                <div id="navigation">
                    <!-- Navigation Menu-->   
                  
                   
                </div><!--end navigation-->
            </div><!--end container-->
        </header><!--end header-->
        <!-- Navbar End -->

        <!-- Hero Start -->
        <section class="bg-half-170 d-table w-100 bg-light" style = "margin-top:30px">
            <div class="container">
                <div class="row mt-5 mt-sm-0 align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="title-heading me-lg-4">
                            <h4 class="display-4 fw-bold mb-3"> بهترین  <br>کتاب ها رو<br>  رایگان دانلود کن</h4>
                            <p class="text-muted para-desc mb-0">کتابتو پیدا کن و دانلود کن بدون پرداخت هیچ پولی</p>
                            <div class="mt-4 pt-2">
                                <a href="./Pages/BooksSearch.php?Tag=Book" class="btn btn-soft-primary m-1">Download Books</a>
                               
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-lg-6 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                        <div class="bg-white p-5 rounded-md">
                            <img src="images/book/book.png" class="img-fluid mx-auto d-block" alt="">
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div> <!--end container-->
        </section><!--end section-->
        <!-- Hero End -->
   
        <section class="section" style ="margin-top:-300px">
            <div class="container">
                
            </div><!--end container-->

            

           
           
                            <h4 style = " margin-right:40px; " class="title mb-4">Top Books</h4>
               

            <div class="container-fluid mb-md-5">
                <div class="row">
                    <div class="col-md-12 mt-4 pt-2">
                        <div class="tiny-six-item">




                        <?php foreach($responseTop as $topbook){?>
                            <div class="tiny-slide">
                                <div class="card border-0 work-container work-grid position-relative d-block overflow-hidden mx-2">
                                    <div class="card-body p-0">
                                        <a href="./Pages/BookDetails.php?Id=<?php echo htmlspecialchars($topbook['Id']) ?>" class="lightbox d-inline-block" title="">
                                            <img style="with:550px; height:400px" src="<?php echo htmlspecialchars($topbook['CoverAddres'])?>" class="img-fluid shadow rounded" alt="work-image">
                                        </a>
                                        <div class="content bg-white p-3">
                                            <h5 class="mb-0"><a href="javascript:void(0)" class="text-dark title"><?php echo htmlspecialchars( $topbook['Name']) ?></a></h5>
                                            <h6 class="text-muted tag mb-0"><?php echo htmlspecialchars( $topbook['Rank']) ?>/10</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } mysqli_free_result($resultTop); ?>
                           

                            
                        </div>
                    </div>
                    
                </div><!--end row-->

            </div><!--end container-->
            
            
            
        </section><!--end section-->
        



        <section class="section" style="margin-top:-150px ">
    <div class="container">
    </div><!--end container-->

    <h4 style="margin-right:40px;" class="title mb-4">Last Books</h4>

    <div class="container-fluid mb-md-5 " style="zoom:70%">
        <div class="row">
            <div class="col-md-12 mt-4 pt-2">
                <!-- Flex container برای قرار دادن آیتم‌ها کنار هم -->
                <div class="d-flex flex-row flex-nowrap overflow-auto " >
                    
                <?php foreach($responselast as $Book){?>
                  
                    <div class="card border-0 work-container work-grid position-relative d-block overflow-hidden mx-2 " style="min-width: 200px; ">
                        <div class="card-body p-0 ">
                            <a href="./Pages/BookDetails.php?Id=<?php echo htmlspecialchars($Book['Id']) ?>" class="lightbox d-inline-block" title="">
                                <img style="with:550px; height:400px" src='<?php echo ( $Book['CoverAddres']) ?>' class="img-fluid shadow rounded" alt="work-image">
                            </a>
                            <div class="content bg-white p-3">
                                <h5 class="mb-0"><a  class="text-dark title"><?php echo htmlspecialchars( $Book['Name'])?></a></h5>
                                <h6 class="text-muted tag mb-0"><?php echo htmlspecialchars($Book['Rank'])?>/10</h6>
                            </div>
                        </div>
                    </div>


                    <?php }  mysqli_free_result( $resultlast); ?>
                    
                    <!-- بقیه کارت‌ها به همین شکل... -->
                    <!-- تکرار کارت برای سایر کتاب‌ها -->
                    
                </div>
            </div>
        </div><!--end row-->
    </div><!--end container-->

    <!-- ویژگی‌ها -->
   
</section><!--end section-->
<section class="section" style="margin-top:-150px ">
    <div class="container">
    </div><!--end container-->

    <h4 style="margin-right:40px;" class="title mb-4">Popular Books</h4>

    <div class="container-fluid mb-md-5 " style="zoom:70%">
        <div class="row">
            <div class="col-md-12 mt-4 pt-2">
                <!-- Flex container برای قرار دادن آیتم‌ها کنار هم -->
                <div class="d-flex flex-row flex-nowrap overflow-auto " >
                    

                   <?php foreach($responsepop as $pop){?>
                    <div class="card border-0 work-container work-grid position-relative d-block overflow-hidden mx-2 " style="min-width: 200px; ">
                        <div class="card-body p-0 ">
                            <a href="./Pages/BookDetails.php?Id=<?php echo htmlspecialchars($pop['Id']) ?>" class="lightbox d-inline-block" title="">
                                <img style="with:550px; height:400px" src="<?php echo htmlspecialchars($pop['CoverAddres']) ?>" class="img-fluid shadow rounded" alt="work-image">
                            </a>
                            <div class="content bg-white p-3">
                                <h5 class="mb-0"><a href="javascript:void(0)" class="text-dark title"><?php echo htmlspecialchars($pop['Name']) ?></a></h5>
                                <h6 class="text-muted tag mb-0"><?php echo htmlspecialchars($pop['Rank']) ?>/10</h6>
                            </div>
                        </div>
                    </div>
                   <?php } ?>
                    <!-- کارت نمونه -->
                   

                  
                    <!-- بقیه کارت‌ها به همین شکل... -->
                    <!-- تکرار کارت برای سایر کتاب‌ها -->
                    
                </div>
            </div>
        </div><!--end row-->
    </div><!--end container-->

    <!-- ویژگی‌ها -->
    
</section><!--end section-->
        <!-- Start -->
     



        <!-- Subscribe Start -->
       
        <!-- Subscribe End -->

        <!-- Footer Start -->
      
        <!-- Footer End -->

        <!-- Back to top -->
        <a href="#" onclick="topFunction()" id="back-to-top" class="btn btn-icon btn-primary back-to-top"><i data-feather="arrow-up" class="icons"></i></a>
        <!-- Back to top -->

       <!-- Style switcher --> 
        <!-- end Style switcher -->

        <!-- javascript -->
        <script src="js/bootstrap.bundle.min.js"></script>
        <!-- tobii js -->
        
        <!-- SLIDER -->
        <script src="js/tiny-slider.js"></script>
        <!-- Icons -->
        <script src="js/feather.min.js"></script>
        <!-- Switcher -->
        <script src="js/switcher.js"></script>
        <!-- Main Js -->
        <script src="js/plugins.init.js"></script><!--Note: All init js like tiny slider, counter, countdown, maintenance, lightbox, gallery, swiper slider, aos animation etc.-->
        <script src="js/app.js"></script><!--Note: All important javascript like page loader, menu, sticky menu, menu-toggler, one page menu etc. -->
    </body>

</html>