<?php



 function FindIP(){
    $IP = $_SERVER['REMOTE_ADDR'];
    return  $IP;
}

 function FindSystem(){
    $SYSTEM = $_SERVER['HTTP_USER_AGENT'];
    return  $SYSTEM;
}
function HashPassword($Pass){
  return password_hash($Pass,PASSWORD_DEFAULT);
}
function HashPasswordVerify($Pass,$pas2){
    if(password_verify($Pass,$pas2)){
        return TRUE;
    }
    else{
        return FALSE;
    }
  }
?>