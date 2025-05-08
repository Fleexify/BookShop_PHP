<?php
include '../Reqiurement/FindIP.php';
include '../Entity/Token.php';
$Erorr = "";
$IP = FindIP();
$Time = time();
$system = FindSystem();

if(isset($_POST['Register'])){
    $Password = htmlspecialchars($_POST['Password']);
    $UserName = htmlspecialchars($_POST['UserName']);

  if(isset( $UserName) && isset($Password )){


    //sample validation

   if($UserName == "" ||$Password == "" ){
    $Erorr = "UserName or Password is empty";
    
   }
    
   else if(strlen($UserName)>20){
    $Erorr = "Max Lenght of UserName is 20 Char";
    
   }
   else if(strlen($Password )>20){
    $Erorr = "Max Lenght of Password is 20 Char";
    
   }
   
   else if(strlen($UserName)<4){
    $Erorr = "Min Lenght of UserName is 5 Char";
    
   }
   else if(strlen($Password )<4){
    $Erorr = "Min Lenght of Password is 4 Char";
    
   }
   
   else if(strpos($UserName,' ')){
    $Erorr = "UserName Have Space";
    
   }
   else if(strpos($Password ,' ')){
    $Erorr = "UserName Have Space";
    
   }else{

   

    //ServerValidation
    $Connection = mysqli_connect('localhost','Admin','Many1387','books_shop');
  
       $CommanofCheck = "SELECT * FROM `users` WHERE `UserName` LIKE '$UserName'";
       $result = mysqli_query($Connection,$CommanofCheck);
       $GetResult = mysqli_fetch_assoc($result);
  
       $CommanofChecklog = "SELECT * FROM `logs` WHERE `IP` LIKE '$IP' AND 'System' LIKE '$system ' AND 'ExpireTime' > ' $Time' AND 'Type'='Register'";
       $resultlog = mysqli_query($Connection,$CommanofChecklog);
    
       $GetResultlog = mysqli_fetch_All($resultlog);

    if(!$Connection){
 
     $Erorr = "An Erorr in server";
     
    }
    else if($GetResult){
 
     $Erorr = "User is Exist";
     mysqli_free_result($result);
     mysqli_close($Connection);
     
 
    }

   else if(count($GetResultlog) > 50){
 
     $Erorr = "Your Limit register today is 50";
     mysqli_free_result($resultlog);
     mysqli_close($Connection);
     
 
    } else{
 
        $Hash = HashPassword($Password);
       $commandAdduser = "INSERT INTO `users` (`Id`, `UserName`, `Password`, `CreateTime`, `Status`) VALUES (NULL, '$UserName', '$Hash', current_timestamp(), 'Activ')";
       $resultuser = mysqli_query($Connection,$commandAdduser);
       
       
       $currentDate = date("Y-m-d H:i:s",time()+2592000);
       $commandAddLog = "INSERT INTO logs(IP,System,Type,ExpireTime) VALUES('$IP',' $system','Register','$currentDate')";
       $resultlog = mysqli_query($Connection,$commandAddLog);
       $commanddeleteLog = "DELETE  FROM logs WHERE ExpireTime < '$Time'";
       $resultlogdelete = mysqli_query($Connection,$commanddeleteLog);
       mysqli_close($Connection);
       $Erorr = "Registered";
      
      
      
       $TokenCreate =  Token::GenerateToken($UserName);
        setcookie("Token",$TokenCreate,time() + 1728000 ,"/");
        setcookie("User",$UserName,time() + 1728000 ,"/");
        header('Location: ../index.php');
     
      
       
           
       
 
    }
    //End












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
        <link rel="stylesheet" href="unicons.iconscout.com/release/v3.0.6/css/line.css">
        <!-- Main Css -->
        <link href="../css/style.min.css" rel="stylesheet" type="text/css" id="theme-opt" />
        <link href="../css/colors/default.css" rel="stylesheet" id="color-opt">

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
        
       

        <!-- شوع آن -->
        <section class="bg-home d-flex align-items-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-6">
                        <div class="me-lg-5">   
                            <img src="../images/user/login.svg" class="img-fluid d-block mx-auto" alt="">
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="card login-page bg-white shadow rounded border-0">
                            <div class="card-body">
                                <h4 class="card-title text-center">وارد شدن </h4>  
                                <form class="login-form mt-4" action='./Register.php' method="POST">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">یوزرنیم شما<span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="user" class="fea icon-sm icons"></i>
                                                    <input type="text" class="form-control ps-5" placeholder="یوزرنیم" name="UserName" required="">
                                                </div>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">رمز عبور  <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="key" class="fea icon-sm icons"></i>
                                                    <input type="password" class="form-control ps-5" placeholder="رمز عبور " name="Password" required="">
                                                </div>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-lg-12">
                                            <div class="d-flex justify-content-between">
                                                <div class="mb-3">
                                                    <div class="form-check">
                                                       
                                                    </div>
                                                </div>
                                                <p  class="forgot-pass mb-0 " style="color:red;" ><?php echo htmlspecialchars($Erorr) ?></p>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-lg-12 mb-0">
                                            <div class="d-grid">
                                                <button name="Register" class="btn btn-primary">ورود </button>
                                            </div>
                                        </div><!--end col-->

                                       

                                        <div class="col-12 text-center">
                                            <p class="mb-0 mt-3"><small class="text-dark me-2">حسابی دارید؟ </small> <a href="Login.php" class="text-dark fw-bold">لاگین کنید</a></p>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </form>
                            </div>
                        </div><!---->
                    </div> <!--end col-->
                </div><!--end row-->
            </div> <!--end container-->
        </section><!--end section-->
        <!-- پایان آن -->

      
        <!-- end Style switcher -->

        <!-- javascript -->
        <script src="js/bootstrap.bundle.min.js"></script>
        <!-- Icons -->
        <script src="js/feather.min.js"></script>
        <!-- Switcher -->
        <script src="js/switcher.js"></script>
        <!-- Main Js -->
        <script src="js/plugins.init.js"></script><!--Note: All init js like tiny slider, counter, countdown, maintenance, lightbox, gallery, swiper slider, aos animation etc.-->
        <script src="js/app.js"></script><!--Note: All important javascript like page loader, menu, sticky menu, menu-toggler, one page menu etc. -->
    </body>

</html>