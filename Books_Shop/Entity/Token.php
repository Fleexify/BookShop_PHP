<?php

class Token{

    public  $_Code;

   public static function GenerateToken($UserId){
        $_Code = bin2hex(random_bytes(32));
        $Connection = mysqli_connect('localhost','Admin','Many1387','books_shop');
     
        $timeofcreate = time() + 1728000;
        $currentDate = date("Y-m-d H:i:s", $timeofcreate);
        $command = "INSERT INTO `tokens` (`Id`, `UserName`, `Code`, `ExpireTime`) VALUES (NULL, '$UserId','$_Code', '$currentDate')";
        $result = mysqli_query($Connection,$command);
        mysqli_close($Connection);
        
        return $_Code;
    }
    public static function Validate($Code,$UserId2){
        $_Code = bin2hex(random_bytes(32));
        $Connection = mysqli_connect('localhost','Admin','Many1387','books_shop');
        $command = "SELECT * FROM `tokens` WHERE Code LIKE '$Code' AND UserName LIKE '$UserId2' AND `ExpireTime` > time().date";
        $result = mysqli_query($Connection,$command);
        $response = mysqli_fetch_assoc($result);
        if($response){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

}

?>