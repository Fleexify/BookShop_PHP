
<?php

include '../Reqiurement/FindIP.php';
include '../Entity/Token.php';
$Time = time();
$IP = FindIP();
$system = FindSystem();

$Erorr = '';


if(isset($_POST['Login'])){
    $UserName = htmlspecialchars( $_POST['UserName']);
    $Password = htmlspecialchars($_POST['Password']);
    if(!isset($_POST['UserName'])){
        $Erorr = "UserName is empty";
    }
    else if(!isset($Password)){
        $Erorr = "Password is empty";
    }
    else if(strpos($UserName,' ')){
        $Erorr = "UserName Have Space";
    }
    else if(strpos($Password,' ')){
        $Erorr = "Password Have Space";
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
      else{
        $Connection = mysqli_connect('localhost','Admin','Many1387','books_shop');

        $Result = "SELECT * FROM `users` WHERE `UserName` LIKE '$UserName'";
        $response = mysqli_query($Connection,$Result);
        $GetResult = mysqli_fetch_assoc($response);
        $currentDate = date("Y-m-d H:i:s",time()+2592000);
        if(!$GetResult){
            $Erorr = "User is nox Exist";
           
           
        }

        else{
            
            $sqllog =  "SELECT * FROM `logs` WHERE `IP` LIKE '$IP' AND 'System' LIKE '$system '";
            $response2 = mysqli_query($Connection,$sqllog);
            $res = mysqli_fetch_All($response2);

            if(count( $res)> 100){
                $Erorr = "Your Limit Login for today is 100";
                mysqli_free_result($response2);
                mysqli_close($Connection);
            }
           else if( !HashPasswordVerify($Password,$GetResult['Password'])){
            
                $Erorr = "Password is not Exist";
                $sqllog =  "INSERT INTO logs(IP,System,Type,ExpireTime) VALUES('$IP','$system','LoginFaild','$currentDate')";
                $resultinsert = mysqli_query($Connection,$sqllog);
               
                mysqli_close($Connection);
            }else{

                $TokenCreate =  Token::GenerateToken($UserName);
                
                setcookie("Token",$TokenCreate,time() + 1728000 ,"/");
                setcookie("User",$UserName,time() + 1728000 ,"/");
                mysqli_free_result($response);
                $sqllog =  "INSERT INTO logs(IP,System,Type,ExpireTime) VALUES('$IP',' $system','Login','$currentDate')";
                $response4 = mysqli_query($Connection,$sqllog);
                $commanddeleteLog = "DELETE  FROM logs WHERE ExpireTime < '$Time'";
                $resultlogdelete = mysqli_query($Connection,$commanddeleteLog);
                mysqli_close($Connection);
                header('Location: ../index.php');
            }
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
                                <h4 class="card-title text-center">لاگین</h4>  
                                <form class="login-form mt-4" action="Login.php" method="POST">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">یوزرنیم <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="user" class="fea icon-sm icons"></i>
                                                    <input name="UserName" type="text" class="form-control ps-5" placeholder="یوزرنیم" name="email" required="">
                                                </div>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">رمز عبور  <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="key" class="fea icon-sm icons"></i>
                                                    <input name= "Password" type="password" class="form-control ps-5" placeholder="رمز عبور " required="">
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
                                                <button name="Login" class="btn btn-primary">ورود </button>
                                            </div>
                                        </div><!--end col-->

                                        

                                        <div class="col-12 text-center">
                                            <p class="mb-0 mt-3"><small class="text-dark me-2">حسابی ندارید؟ </small> <a href="Register.php" class="text-dark fw-bold">ثبت نام کنید </a></p>
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