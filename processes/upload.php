<?php
session_start();
$target_dir = "../profilepics/";
$path = $_FILES['fileToUpload']['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);
// $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $_SESSION['id'].$_SESSION['acc_type'].".".$ext;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
// if (file_exists($target_file)) {
//   echo "Sorry, file already exists.";
//   $uploadOk = 0;
// }

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

    $xml = new DOMdocument();
    $xml->preserveWhiteSpace = false;
    $xml->formatOutput = true;
    $xml->load("../database/accounts.xml");
    $accounts = $xml->getElementsByTagName("account");

    foreach($accounts as $account){
        $oldid = $account->getAttribute("id");    
    if($oldid == $_SESSION["id"]){
      if($_SESSION['acc_type'] == "jobseeker"){
    $newEmail = $account->getElementsByTagName("email")[0]->nodeValue;
    $newUname = $account->getElementsByTagName("username")[0]->nodeValue;
    $newFname = $account->getElementsByTagName("firstname")[0]->nodeValue;
    $newLname = $account->getElementsByTagName("lastname")[0]->nodeValue;
    $newgender = $account->getElementsByTagName("gender")[0]->nodeValue;
    $newnumber = $account->getElementsByTagName("contactnumber")[0]->nodeValue;
    $newaddress = $account->getElementsByTagName("address")[0]->nodeValue;
    $newcity = $account->getElementsByTagName("city")[0]->nodeValue;
    $newcountry = $account->getElementsByTagName("country")[0]->nodeValue;
    $newzip = $account->getElementsByTagName("zip")[0]->nodeValue;
    $newskills = $account->getElementsByTagName("skills")[0]->nodeValue;
    $newqualifications = $account->getElementsByTagName("qualifications")[0]->nodeValue;
    $newexperience = $account->getElementsByTagName("experience")[0]->nodeValue;


    $newPassword = $account->getElementsByTagName("password")[0]->nodeValue;
    $interestcategories = $account->getElementsByTagName("interestcategories")[0]->nodeValue;
    $newresume = $account->getElementsByTagName("resume")[0]->nodeValue;
    $newpicture = $account->getElementsByTagName("picture")[0]->nodeValue;
    $newstats = $account->getElementsByTagName("status")[0]->nodeValue;
    $newNode = $xml->createElement("account");

    $newNode->setAttribute("id", $_SESSION['id']);
    $newNode->setAttribute("acc_type", "jobseeker");

    $newNode->appendChild($xml->createElement("email", $newEmail));
    $newNode->appendChild($xml->createElement("username", $newUname));
    $newNode->appendChild($xml->createElement("password", $newPassword));//
    $newNode->appendChild($xml->createElement("firstname", $newFname));
    $newNode->appendChild($xml->createElement("lastname", $newLname));
    $newNode->appendChild($xml->createElement("gender", $newgender ));              
    $newNode->appendChild($xml->createElement("contactnumber", $newnumber ));
    $newNode->appendChild($xml->createElement("address", $newaddress ));
    $newNode->appendChild($xml->createElement("city", $newcity ));
    $newNode->appendChild($xml->createElement("country", $newcountry ));
    $newNode->appendChild($xml->createElement("zip", $newzip ));
    $newNode->appendChild($xml->createElement("interestcategories", $interestcategories ));//
    $newNode->appendChild($xml->createElement("skills", $newskills));
    $newNode->appendChild($xml->createElement("qualifications", $newqualifications ));
    $newNode->appendChild($xml->createElement("experience", $newexperience));
    $newNode->appendChild($xml->createElement("resume", $newresume));//
    $newNode->appendChild($xml->createElement("picture", $_SESSION['id'].$_SESSION['acc_type'].".".$ext));
    $newNode->appendChild($xml->createElement("status", $newstats));

    $oldNode = $account;
    $xml->getElementsByTagName("accounts")[0]->replaceChild($newNode, $oldNode);
    $xml->save("../database/accounts.xml");
    header('location: ../profile.php');
    }
    else{
      $newEmail = $account->getElementsByTagName("email")[0]->nodeValue;
      $newUname = $account->getElementsByTagName("username")[0]->nodeValue;
      $newFname = $account->getElementsByTagName("firstname")[0]->nodeValue;
      $newLname = $account->getElementsByTagName("lastname")[0]->nodeValue;
      $newgender = $account->getElementsByTagName("gender")[0]->nodeValue;
      $newnumber = $account->getElementsByTagName("contactnumber")[0]->nodeValue;
      $newaddress = $account->getElementsByTagName("address")[0]->nodeValue;
      $newcity = $account->getElementsByTagName("city")[0]->nodeValue;
      $newcountry = $account->getElementsByTagName("country")[0]->nodeValue;
      $newzip = $account->getElementsByTagName("zip")[0]->nodeValue;

      $newPassword = $account->getElementsByTagName("password")[0]->nodeValue;
      $newpicture = $account->getElementsByTagName("picture")[0]->nodeValue;
      $newstats = $account->getElementsByTagName("status")[0]->nodeValue;
      $newCompanyName = $account->getElementsByTagName("CompanyName")[0]->nodeValue;
      $newJobPosition = $account->getElementsByTagName("JobPosition")[0]->nodeValue;

      $newNode = $xml->createElement("account");

      $newNode->setAttribute("id", $_SESSION['id']);
      $newNode->setAttribute("acc_type", "employer");
  
      $newNode->appendChild($xml->createElement("CompanyName", $newCompanyName));
      $newNode->appendChild($xml->createElement("JobPosition", $newJobPosition));
      $newNode->appendChild($xml->createElement("email", $newEmail));
      $newNode->appendChild($xml->createElement("username", $newUname));
      $newNode->appendChild($xml->createElement("password", $newPassword));//
      $newNode->appendChild($xml->createElement("firstname", $newFname));
      $newNode->appendChild($xml->createElement("lastname", $newLname));
      $newNode->appendChild($xml->createElement("gender", $newgender ));              
      $newNode->appendChild($xml->createElement("contactnumber", $newnumber ));
      $newNode->appendChild($xml->createElement("address", $newaddress ));
      $newNode->appendChild($xml->createElement("city", $newcity ));
      $newNode->appendChild($xml->createElement("country", $newcountry ));
      $newNode->appendChild($xml->createElement("zip", $newzip ));
      $newNode->appendChild($xml->createElement("picture", $_SESSION['id'].$_SESSION['acc_type'].".".$ext));
      $newNode->appendChild($xml->createElement("status", $newstats));
  
      $oldNode = $account;
      $xml->getElementsByTagName("accounts")[0]->replaceChild($newNode, $oldNode);
      $xml->save("../database/accounts.xml");
      header('location: ../profile.php');
    }

  }

  
  }
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>