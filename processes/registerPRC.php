<?php
session_start();
$emailINPUT = strtolower($_POST['email']);
$usernameINPUT = strtolower($_POST['username']);
$passwordINPUT = $_POST['password'];
$password2INPUT = $_POST['password2'];
$fnameINPUT = strtolower($_POST['fname']);
$lnameINPUT = strtolower($_POST['lname']);
$acc_type = $_POST['acc_type'];

$xml = new DOMdocument();
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->load("../database/accounts.xml");

$errors = false;

$accounts = $xml->getElementsByTagName("account");

//VALIDATION

//check for existing username or email
foreach($accounts as $account){
    if($account->getElementsByTagName("username")[0]->nodeValue == $usernameINPUT){
        echo "Username already exists! Please choose a new one";
        return;
    }
    if($account->getAttribute("acc_type") == "jobseeker"){
        if($account->getElementsByTagName("email")[0]->nodeValue == $emailINPUT){
            echo "Email already exists for Jobseeker!";
            return;
        }
    }
    else {
        if($account->getElementsByTagName("email")[0]->nodeValue == $emailINPUT){
            echo "Email already exists for Employer!";
            return;
        }
    }
}
//check if confirm password is matched
echo "Please check all the required input fields<br>";
//check for valid/empty inputs
if($emailINPUT == null || $fnameINPUT == null || $lnameINPUT == null){
    $errors = true;
}
if(strlen($usernameINPUT) <= 7){
    $errors = true;
    echo "Username Requires 8 characters<br>";
}
if(strlen($usernameINPUT) >= 17){
    $errors = true;
    echo "Username's maximum character is 16<br>";
}
if(strlen($passwordINPUT) <= 7){
    $errors = true;
    echo "Passwords Requires 8 characters<br>";
}
if($passwordINPUT != $password2INPUT){
    $errors = true;
    echo "Password does not match<br>";
}
if($errors){
    echo "Please try again<br>";
}

//if there are no validation errors
else{
    $lastId= 0;
    foreach($accounts as $account){
        $lastId = $account->getAttribute("id");
    }

    $account = $xml->createElement("account");
    $account->setAttribute("id", $lastId + 1);

    $email = $xml->createElement("email", $emailINPUT);
    $username = $xml->createElement("username", $usernameINPUT);
    $password = $xml->createElement("password", md5($passwordINPUT));
    $fname = $xml->createElement("firstname", $fnameINPUT);
    $lname = $xml->createElement("lastname", $lnameINPUT);

    if($acc_type == "employer"){
        $cnameINPUT = $_POST['cname'];
        $jpositionINPUT = $_POST['jposition'];
        $account->setAttribute("acc_type", "employer");

        $account->appendChild($xml->createElement("CompanyName", $cnameINPUT));
        $account->appendChild($xml->createElement("JobPosition", $jpositionINPUT));

    }

    $account->appendChild($email);
    $account->appendChild($username);
    $account->appendChild($password);
    $account->appendChild($fname);
    $account->appendChild($lname);
    $account->appendChild($xml->createElement("gender"));
    $account->appendChild($xml->createElement("contactnumber"));
    $account->appendChild($xml->createElement("address"));
    $account->appendChild($xml->createElement("city"));
    $account->appendChild($xml->createElement("country"));
    $account->appendChild($xml->createElement("zip"));
    if($acc_type == "jobseeker"){
        $interestcategoriesINPUT = $_POST['interestcategories'];
        $account->setAttribute("acc_type", "jobseeker");
        $interestcategories = $xml->createElement("interestcategories", $interestcategoriesINPUT);
        $account->appendChild($interestcategories);
        $account->appendChild($xml->createElement("resume"));
        $account->appendChild($xml->createElement("skills"));
        $account->appendChild($xml->createElement("qualifications"));
        $account->appendChild($xml->createElement("experience"));
    }
    $account->appendChild($xml->createElement("resume"));
    $account->appendChild($xml->createElement("picture", "profile.png"));
    $account->appendChild($xml->createElement("status", "active"));
    $xml->getElementsByTagName("accounts")->item(0)->appendChild($account);
    $xml->save("../database/accounts.xml");
    $_SESSION['id'] = $lastId + 1;
    $_SESSION['username'] = $usernameINPUT;
    $_SESSION['acc_type'] = $acc_type;
    echo "<meta http-equiv='Refresh' content='0; url=home.php' />";
}
?>