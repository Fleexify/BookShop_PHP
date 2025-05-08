<?php

$Time = time();


$Page = 1;
$BookMerg1 = array();
if(!isset($_COOKIE["Token"]) || !isset($_COOKIE["User"]) ){
    header('Location: ./Login.php');
}
else if(!isset($_GET['Tag'])){
    header('Location: ../index.php');
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
        header('Location: Login.php');
       
    }
    $Tag = $_GET['Tag'];
    
    $Searchcommand = "SELECT * FROM `books` WHERE `Name` LIKE '%$Tag%' LIMIT 50";
    $Resultsearch = mysqli_query($Connection,$Searchcommand);
    $responsesearch = mysqli_fetch_All( $Resultsearch,MYSQLI_ASSOC);
     
   
}




?>










<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="shortcut icon" href="images/favicon.ico">
        <!-- Bootstrap -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- tobii css -->
        <link href="../css/tobii.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons -->
        <link href="../css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../unicons.iconscout.com/release/v3.0.6/css/line.css">
        <!-- Slider -->               
        <link rel="stylesheet" href="css/tiny-slider.css"/> 
        <!-- Main Css -->
        <link href="../css/style.min.css" rel="stylesheet" type="text/css" id="theme-opt" />
        <link href="../css/colors/default.css" rel="stylesheet" id="color-opt">
</head>
<body>
   <?php
    include '../Component/TopBar.php'
   ?>
<section class="section" style="margin-top:10px">
    <div class="container">
        <h4 style="margin-right:40px;" class="title mb-4"><?php echo $_GET['Tag']?></h4>
        <div class="row">
            <!-- شروع آیتم‌ها -->
             <?php foreach($responsesearch as $book){ ?>

                <div class="col-md-2 col-sm-4 col-6 mb-4" >
                <div class="card border-0 work-container work-grid position-relative d-block overflow-hidden mx-1">
                    <div class="card-body p-0">
                        <a href="./BookDetails.php?Id=<?php echo htmlspecialchars($book['Id']) ?>" class="lightbox d-inline-block" title="">
                            <img style="with:350px; height:250px" src=".<?php echo htmlspecialchars($book['CoverAddres'])?>" class="img-fluid shadow rounded" alt="work-image">
                        </a>
                        <div class="content bg-white p-3">
                            <h5 class="mb-0"><a href="javascript:void(0)" class="text-dark title"><?php echo $book['Name'] ?></a></h5>
                            <h6 class="text-muted tag mb-0"><?php echo $book['Rank']?>/10</h6>
                        </div>
                    </div>
                </div>
            </div>

                <?php  } ?>
               
              
                            
                    
              

          

          
                <h2 style="margin-Right:350px;">
           <?php if(!$responsesearch ){
            echo "Not  Result For This Book";   
           }
           ?>
          </h2>
            <!-- سایر آیتم‌ها نیز به همین صورت -->
            <!-- فقط کپی کنید و شماره عکس را تغییر دهید -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>

</body>
<script src="js/bootstrap.bundle.min.js"></script>
        <!-- tobii js -->
        <script src="js/tobii.min.js"></script>
        <!-- SLIDER -->
        <script src="js/tiny-slider.js"></script>
        <!-- Icons -->
        <script src="js/feather.min.js"></script>
        <!-- Switcher -->
        <script src="js/switcher.js"></script>
        <!-- Main Js -->
        <script src="js/plugins.init.js"></script><!--Note: All init js like tiny slider, counter, countdown, maintenance, lightbox, gallery, swiper slider, aos animation etc.-->
        <script src="js/app.js"></script>
</html>