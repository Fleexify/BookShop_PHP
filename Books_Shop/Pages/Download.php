<?php
$Time = time();

if(!isset($_COOKIE["Token"]) || !isset($_COOKIE["User"]) ){
    header('Location: ./Login.php');
}
else if(!isset($_GET['ID'])){
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
        header('Location: Pages/Login.php');
        mysqli_free_result($result);
        mysqli_close($Connection);
    }
   
}
?>








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
        <!-- Main Css -->
        <link href="../css/style.min.css" rel="stylesheet" type="text/css" id="theme-opt" />
        <link href="../css/colors/default.css" rel="stylesheet" id="color-opt">
    </head>
<body>
    <?php include'../Component/TopBar.php'?>
<section class="bg-home d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-12 text-center">
                        <img src="images/404.svg" class="img-fluid" alt="">
                        <div class="text-uppercase mt-4 display-3">شروع دانلود</div>
                       
                        <a  href='../FileBooks/<?php echo $_GET['ID']?>.pdf' name="DownBook" class="btn btn-primary">Download</a>
                    </div><!--end col-->
                </div><!--end row-->

            </div><!--end container-->
        </section><!--end section-->
</body>
</html>