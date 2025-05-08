
<?php

$Time = time();
$downloaded = false;

             

 if(!isset($_GET['Id'])){
    header('Location: ../index.php');
}

else{


    if(!isset($_COOKIE["Token"]) || !isset($_COOKIE["User"]) ){
        header('Location: ./Login.php');
    }
    else{
    
    
        $User = htmlspecialchars( $_COOKIE['User']);
        $Token = htmlspecialchars(($_COOKIE['Token']));
        $Connection = mysqli_connect('localhost','Admin','Many1387','books_shop');
        $command = "SELECT * FROM Tokens WHERE UserName LIKE '$User' AND Code LIKE '$Token' AND ExpireTime >= '$Time'";
    
        $result = mysqli_query($Connection,$command);
        $response = mysqli_fetch_All( $result);
        if(!$response){
            
            mysqli_free_result($result);
            mysqli_close($Connection);
            header('Location: ./Login.php');
        }
        $Id = $_GET['Id'];

        $commandBook = "SELECT * FROM `books` WHERE Id LIKE '$Id' ";
        $result = mysqli_query($Connection,$commandBook);
        $Book = mysqli_fetch_assoc($result);

        if(!$Book){
            header('Location: ./Erorr.php');
        }
        else{
            if (isset($_POST['DownBook'])&&isset($_GET['Id'])&& isset($_POST['Namebook'])) {
                $Id=$_GET['Id'];
                $Connection = mysqli_connect('localhost', 'Admin', 'Many1387', 'books_shop');
            
                $Update = "UPDATE books SET DownloadCount = DownloadCount + 1 WHERE books.Id = $Id";
                $resultupdate = mysqli_query($Connection, $Update);
             $Nameof = strval($_POST['Namebook']);
              header("Location: Download.php?ID=$Nameof");
               
                
            }
            $Update = "UPDATE `books` SET `ViewCount` = `ViewCount`+ 1 WHERE `books`.`Id` = $Id";
            $resultupdate = mysqli_query($Connection,$Update);
           
        }
        
       




    }    


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
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons -->
        <link href="../css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../unicons.iconscout.com/release/v3.0.6/css/line.css">
        <!-- Slider -->               
        <link rel="stylesheet" href="../css/tiny-slider.css"/>
        <!-- Main Css -->
        <link href="../css/style.min.css" rel="stylesheet" type="text/css" id="theme-opt" />
        <link href="../css/colors/default.css" rel="stylesheet" id="color-opt">

        
       
        <link href="css/tobii.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons -->
       
       
       
       
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
        <?php include'../Component/TopBar.php'; ?>
        
        <!-- Hero Start -->
        <section class="bg-half bg-light d-table w-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 text-center">
                        <div class="page-next-level">
                            <h4 class="title"><?php echo htmlspecialchars( $Book['Name'] ); ?></h4>
                            
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div> <!--end container-->
        </section><!--end section-->
       
        <!-- Hero End -->

        <section class="section pb-0">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <div class="tiny-single-item">
                            <div class="tiny-slide"><img src="images/shop/product/single-2.jpg" class="img-fluid rounded" alt=""></div>
                            <div class="tiny-slide"><img src="images/shop/product/single-3.jpg" class="img-fluid rounded" alt=""></div>
                            <div class="tiny-slide"><img src="images/shop/product/single-4.jpg" class="img-fluid rounded" alt=""></div>
                            <div class="tiny-slide"><img src="images/shop/product/single-5.jpg" class="img-fluid rounded" alt=""></div>
                            <div class="tiny-slide"><img src="images/shop/product/single-6.jpg" class="img-fluid rounded" alt=""></div>
                        </div>
                    </div><!--end col-->

                    <div class="col-md-7 mt-4 mt-sm-0 pt-2 pt-sm-0">
                        <div class="section-title ms-md-4">
                            <h4 class="title"><?php echo htmlspecialchars(  $Book['Name']);  ?></h4>
                            <h5  class="text-muted">Free </h5>
                            
                            
                            <h5 class="mt-4 py-2">توضیحات:</h5>
                            <p class="text-muted"><?php echo htmlspecialchars(  $Book['Description']);  ?></p>
                        
                            

                           
                           
                          
                          

<form method="POST" action='<?php echo "BookDetails.php?Id=$Id"?>'>
<div class="mt-4 pt-2">
    <input name="Namebook" type="hidden" value='<?php echo $Book['Name']?>'/>
        <button   name="DownBook" class="btn btn-primary">Download</button>
    </div>

</form>
    
    

            
              
                                    
                          

                           
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->

            <div class="position-relative">
            
        </div>
        <div   class="position-relative">
           
                <img style="with:530px; height:430px; margin-top:-300px; margin-right:250px" src=".<?php echo htmlspecialchars( $Book['CoverAddres']);  ?>" >
            
        </div>
           
     
        <!-- Wishlist Popup End -->

        <!-- Back to top -->
        
        <!-- end Style switcher -->

        <!-- javascript -->
        <script src="js/bootstrap.bundle.min.js"></script>
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