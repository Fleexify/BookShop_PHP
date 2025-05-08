<?php
include '../Reqiurement/FindIP.php';
include '../Entity/Token.php';
$IP = FindIP();
$Time = time();
$system = FindSystem();
$UserName = "";
if(!isset($_COOKIE["Token"]) || !isset($_COOKIE["User"]) ){
    header('Location: ./Login.php');
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
        header('Location: ./Login.php');
    }



    $UserName = $User;
    if(isset($_POST['Logoutbutton'])){


        $Connection = mysqli_connect('localhost','Admin','Many1387','books_shop');
        $currentDate = date("Y-m-d H:i:s",time()+2592000);
        $commandAddLog = "INSERT INTO logs(IP,System,Type,ExpireTime) VALUES('$IP',' $system','Logout','$currentDate')";
        $resultlog = mysqli_query($Connection,$commandAddLog);
        $commanddeleteLog = "DELETE  FROM tokens WHERE UserName LIKE '$UserName'";
        $resultlog = mysqli_query($Connection,$commanddeleteLog);
        setcookie('User',"",time()-3600,"/");
        setcookie('Token',"",time()-3600,"/");
        mysqli_close($Connection);
        header('Location: ./Login.php');
    
    
    
    
    
    
    }

    

    

}





?>






<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/profilecss.css" rel="stylesheet" type="text/css" />

    <title>Document</title>
</head>
<body>
<div class="user-card">
    <!-- Card Cover/Avatar -->
    <div class="card-cover" style="background-image: url('https://cdn.tailkit.com/media/placeholders/photo-JgOeRuGD_Y4-800x400.jpg');">
      <div class="avatar-wrapper">
        <div class="avatar">
          <img src="../images/219988.png" alt="User Avatar" class="avatar-img">
        </div>
      </div>
    </div>
    <!-- END Card Cover/Avatar -->

    <!-- Card Body -->
    <div class="card-body">
      <h3 style="color:Black" class="card-name"><?php echo $UserName ?></h3>
      <form action="./Profile.php" method="POST">
        <button name="Logoutbutton"  class="profout card-info color:black ">Logout</button>
      </form>
     
    </div>
    <!-- END Card Body -->
  </div>
  <!-- END Cards: User -->
<!-- </body>
</html> --> 
</body>
</html>
