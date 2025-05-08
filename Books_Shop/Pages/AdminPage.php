<?php


$Erorr = "";
$time = time();
if(!isset($_COOKIE["Token"]) || !isset($_COOKIE["User"]) ){
    header('Location: ./Login.php');
}else{
    $code =$_COOKIE["Token"];
    $Connection = mysqli_connect('localhost','Admin','Many1387','books_shop');
    $sqlcommand = "SELECT * FROM `tokens` WHERE Code LIKE '$code' AND 'ExpireTime' >= '$time' LIMIT 1 ";
    $Result = mysqli_query( $Connection,$sqlcommand);
    $Tokenvalid = mysqli_fetch_assoc($Result);
    if($Tokenvalid['UserName'] != "Admin"){
        mysqli_free_result( $Result);
        mysqli_close($Connection);
        header('Location: ./Login.php');
    }
    else{




        if(isset($_POST['AddBook'])){


            $Name = htmlspecialchars($_POST['bookName']);
            $Rank = htmlspecialchars($_POST['RankBook']);
            $Description = htmlspecialchars($_POST['Description']);
            $CoverBook = $_FILES['CoverBook'];
            $FileBook = $_FILES['FileBook'];
                if($Name =="" || $Rank == "" || $CoverBook == "" || $CoverBook == ""){
                    $Erorr = "A Params is not set";
                    
                }
                else if(floatval($Rank)>10){
                    $Erorr = "Rank is not valid";
                }
                else if(strlen($Name)>20){
                    $Erorr = "Max lenght of name is 20";
                }
               
                else if(!filter_var(floatval($Rank),FILTER_VALIDATE_FLOAT) !== FALSE){
                    $Erorr = "Rank is not valid type";
                }
                else if(strlen($Description)>1000){
                    $Erorr = "Max lenght of Description is 1000";
                }
                else if(strpos($CoverBook['name'],'.png') == FALSE){
                    $Erorr = "Covertype is not valid";
                }
                else if(strpos($FileBook['name'],'.pdf') == FALSE ){
                    
                    $Erorr = "FileType is not valid";
                }
                else {
               
                $target = '../CoverBooks/'.basename($Name).".png";
                $target2 = '../FileBooks/'.basename($Name).".pdf";
                $sqlcommand = "SELECT * FROM `Books` WHERE `Name` LIKE '$Name'";
                $result = mysqli_query( $Connection,$sqlcommand);
                $book = mysqli_fetch_assoc($result);
                if($book){
                    $Erorr = "This book is exist";
                }
                else if(!move_uploaded_file($_FILES['CoverBook']['tmp_name'], $target)){
                    $Erorr = "An Erorr in upload Cover";
                    
                    mysqli_close($Connection );
                 }
                else if(!move_uploaded_file($_FILES['FileBook']['tmp_name'], $target2)){
                    if(file_exists($target)){
                        unlink($target);
                    }
                  
                    mysqli_close($Connection );
                    $Erorr = "An Erorr in upload File";
                 }
                 else{
                    mysqli_free_result($result);
                    $Path1 = './CoverBooks/'.basename($Name).".png";
                    $Pathfile = './FileBooks/'.basename($Name).".pdf";
                    $Command = "INSERT INTO books(Id,Name, CoverAddres, FileAddres, ViewCount,Rank,DownloadCount,CreateTime,Description) VALUES (NULL, '$Name', '$Path1', '$Pathfile', '0', '$Rank', '0', current_timestamp(),'$Description')";
                    $resultAdd = mysqli_query($Connection,$Command);
                    $Erorr = "Book is Added";
                    mysqli_close($Connection );
                 }
                 
        
                }
        }
        
        
        


    }



}
















?>















<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


        <form action="AdminPage.php" method="POST" enctype = "multipart/form-data">



        <input type="text" name =" bookName" placeholder="Book Name" >
        <P> cover</p> 
        <input type="File" id="CoverBook" name =" CoverBook" accept=".png" require>
        <P> File book</p>
        <input type="File" name ="FileBook"  id="FileBook" accept=".pdf" require>
        <input type="text" name ="RankBook" placeholder="Book Rank"   >
        <input type="text" name ="Description" placeholder="Description"   >
        <input type="submit" name ="AddBook" text="Add Book"  >
        <P style="color:red"><?php echo $Erorr?></P>
        </form>



</body>
</html>