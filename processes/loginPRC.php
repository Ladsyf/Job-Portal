<?php
session_start();
$usernameINPUT = strtolower($_POST['username']);
$passwordINPUT = $_POST['password'];
$acc_type = $_POST['acc_type'];
$acc_id = 0;
$xml = new DOMdocument();
$xml->load("../database/accounts.xml");

$errors = false;
$errorMSG = "";

$accounts = $xml->getElementsByTagName("account");

//validation
//check if username and password match
foreach($accounts as $account){
    $errors = true;
    if($account->getElementsByTagName("username")[0]->nodeValue == $usernameINPUT || $account->getElementsByTagName("email")[0]->nodeValue == $usernameINPUT){
        if($account->getElementsByTagName("password")[0]->nodeValue == md5($passwordINPUT) &&  $account->getElementsByTagName("status")[0]->nodeValue == "active"){
            if($account->getAttribute("acc_type") == $acc_type){
                $acc_id = $account->getAttribute('id');
                $errors = false;
                break;
            }
        }
    }
}

//print and verify input errors
if ($errors){
    if($usernameINPUT == null){
        $errors = true;
        $errorMSG .= "Please enter a username<br>"; 
    }
    else if($passwordINPUT == null){
        $errors = true;
        $errorMSG .= "Please enter your password<br>";
    }
    else{
        $errorMSG .= "Your input does not match our records";
    }
        echo $errorMSG;
}
//login if there are no errors
else {
    $_SESSION['id'] = $acc_id;
    $_SESSION['username'] = $usernameINPUT;
    $_SESSION['acc_type'] = $acc_type;
    echo "<meta http-equiv='Refresh' content='0; url=home.php' />";
}
?>