<?php
session_start();
$xml = new DOMdocument();
$xml->preserveWhiteSpace = false;
$xml->formatOutput = true;
$xml->load("../database/accounts.xml");
$accounts = $xml->getElementsByTagName("account");


if(isset($_POST['editJobSeeker'])){

    foreach ($accounts as $account){
        $oldid = $account->getAttribute("id");
        if ($_SESSION['id'] == $oldid) {
            $newEmail = $_POST["editEmail"];
            $newUname = $_POST["editUname"];
            $newFname = $_POST["editFname"];
            $newLname = $_POST["editLname"];
            $newgender = $_POST["editgender"];
            $newnumber = $_POST["editnumber"];
            $newaddress = $_POST["editaddress"];
            $newcity = $_POST["editcity"];
            $newcountry = $_POST["editcountry"];
            $newzip = $_POST["editzip"];
            //$newresume = $_POST["editresume"];
            $newskills = $_POST["editskills"];
            $newqualifications = $_POST["editqualifications"];
            $newexperience = $_POST["editexperience"];
            $oldpw = $_POST['oldpw'];
            $confirmpw = $_POST['confirmpw'];
            $newpw = $_POST['newpw'];

            $newPassword = $account->getElementsByTagName("password")[0]->nodeValue;

            if(!empty($oldpw)){
                if(MD5($oldpw) != $newPassword){
                    echo "Incorrect Password";
                    return;
                }
                else if($newpw != $confirmpw){
                    echo "Password does not match";
                    return;
                }
                else if(empty($confirmpw)){
                    echo "Please complete the password field or empty it all";
                }
                else if(empty($newpw)){
                    echo "Please complete the password field or empty it all";
                }
                else{
                    $newPassword = MD5($newpw);
                }

            }
            $stats = $account->getElementsByTagName("status")[0]->nodeValue;


            $newNode = $xml->createElement("account");
            
            $newNode->setAttribute("id", $_SESSION['id']);
            $newNode->setAttribute("acc_type", "jobseeker");
            $interestcategories = $account->getElementsByTagName("interestcategories")[0]->nodeValue;
            $newresume = $account->getElementsByTagName("resume")[0]->nodeValue;
            $newpicture = $account->getElementsByTagName("picture")[0]->nodeValue;

            $newNode->appendChild($xml->createElement("email", $newEmail));
            $newNode->appendChild($xml->createElement("username", $newUname));
            $newNode->appendChild($xml->createElement("password", $newPassword));
            $newNode->appendChild($xml->createElement("firstname", $newFname));
            $newNode->appendChild($xml->createElement("lastname", $newLname));
            $newNode->appendChild($xml->createElement("gender", $newgender ));              
            $newNode->appendChild($xml->createElement("contactnumber", $newnumber ));
            $newNode->appendChild($xml->createElement("address", $newaddress ));
            $newNode->appendChild($xml->createElement("city", $newcity ));
            $newNode->appendChild($xml->createElement("country", $newcountry ));
            $newNode->appendChild($xml->createElement("zip", $newzip ));
            $newNode->appendChild($xml->createElement("interestcategories", $interestcategories ));
            $newNode->appendChild($xml->createElement("skills", $newskills));
            $newNode->appendChild($xml->createElement("qualifications", $newqualifications ));
            $newNode->appendChild($xml->createElement("experience", $newexperience));
            $newNode->appendChild($xml->createElement("resume", $newresume));
            $newNode->appendChild($xml->createElement("picture", $newpicture));
            $newNode->appendChild($xml->createElement("status", $stats));

            $oldNode = $account;
            $xml->getElementsByTagName("accounts")[0]->replaceChild($newNode, $oldNode);
            $xml->save("../database/accounts.xml");
            unset($_POST['editJobSeeker']);
            return;
    }
}
}
if(isset($_POST['editEmployer'])){

    foreach ($accounts as $account){
        $oldid = $account->getAttribute("id");
        if ($_SESSION['id'] == $oldid) {
            $newEmail = $_POST["editEmail"];
            $newUname = $_POST["editUname"];
            $newFname = $_POST["editFname"];
            $newLname = $_POST["editLname"];
            $newgender = $_POST["editgender"];
            $newnumber = $_POST["editnumber"];
            $newaddress = $_POST["editaddress"];
            $newcity = $_POST["editcity"];
            $newcountry = $_POST["editcountry"];
            $newzip = $_POST["editzip"];
            $newCompanyName = $_POST['comapanyname'];
            $newJobPosition = $_POST['editPosition'];
            $oldpw = $_POST['oldpw'];
            $confirmpw = $_POST['confirmpw'];
            $newpw = $_POST['newpw'];

            $newPassword = $account->getElementsByTagName("password")[0]->nodeValue;

            if(!empty($oldpw)){
                if(MD5($oldpw) != $newPassword){
                    echo "Does not match your current password";
                    return;
                }

            }

            $newNode = $xml->createElement("account");
            
            $newNode->setAttribute("id", $_SESSION['id']);
            $newNode->setAttribute("acc_type", "employer");
 
            $newpicture = $account->getElementsByTagName("picture")[0]->nodeValue;

            $newNode->appendChild($xml->createElement("CompanyName", $newCompanyName));
            $newNode->appendChild($xml->createElement("JobPosition", $newJobPosition));
            $newNode->appendChild($xml->createElement("email", $newEmail));
            $newNode->appendChild($xml->createElement("username", $newUname));
            $newNode->appendChild($xml->createElement("password", $newPassword));
            $newNode->appendChild($xml->createElement("firstname", $newFname));
            $newNode->appendChild($xml->createElement("lastname", $newLname));
            $newNode->appendChild($xml->createElement("gender", $newgender ));              
            $newNode->appendChild($xml->createElement("contactnumber", $newnumber ));
            $newNode->appendChild($xml->createElement("address", $newaddress ));
            $newNode->appendChild($xml->createElement("city", $newcity ));
            $newNode->appendChild($xml->createElement("country", $newcountry ));
            $newNode->appendChild($xml->createElement("zip", $newzip ));
            $newNode->appendChild($xml->createElement("picture", $newpicture));
            $newNode->appendChild($xml->createElement("status", $stats));

            $oldNode = $account;
            $xml->getElementsByTagName("accounts")[0]->replaceChild($newNode, $oldNode);
            $xml->save("../database/accounts.xml");
            unset($_POST['editEmployer']);
            return;
    }
}
}

if(isset($_POST['deleteID'])){

    $jobsXml = new DOMdocument();
    $jobsXml->preserveWhiteSpace = false;
    $jobsXml->formatOutput = true;
    $jobsXml->load("../database/jobs.xml");
    $jobs = $jobsXml->getElementsByTagName("job");

    $ID = $_POST['deleteID'];
    
    foreach($accounts as $account){
        if($ID == $account->getAttribute("id")){
            $xml->getElementsByTagName("accounts")[0]->removeChild($account);
            $xml->save("../database/accounts.xml");
            break;
        }
    }
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['acc_type']);
    
    foreach($jobs as $job){
        $employerID = $job->getAttribute("employerID");
        if($employerID == $ID){

            $jobID = $job->getAttribute("id");
            $job_type = $job->getAttribute("job_type");
            $field = $job->getElementsByTagName("field")[0]->nodeValue;
            $title = $job->getElementsByTagName("title")[0]->nodeValue;
            $location = $job->getElementsByTagName("location")[0]->nodeValue;
            $zip = $job->getElementsByTagName("zip")[0]->nodeValue;
            $salary = $job->getElementsByTagName("salary")[0]->nodeValue;
            $description = $job->getElementsByTagName("description")[0]->nodeValue;
            $qualification = $job->getElementsByTagName("qualification")[0]->nodeValue;
            $status = "inactive";
            
            $newNode = $jobsXml->createElement("job");
            $newNode->setAttribute("id", $jobID);
            $newNode->setAttribute("employerID", $employerID);
            $newNode->setAttribute("job_type", $job_type);
            $newNode->appendChild($jobsXml->createElement("field", $field));
            $newNode->appendChild($jobsXml->createElement("title", $title));
            $newNode->appendChild($jobsXml->createElement("status", $status));
            $newNode->appendChild($jobsXml->createElement("location", $location));
            $newNode->appendChild($jobsXml->createElement("zip", $zip));
            $newNode->appendChild($jobsXml->createElement("salary", $salary));
            $newNode->appendChild($jobsXml->createElement("description", $description));
            $newNode->appendChild($jobsXml->createElement("qualification", $qualification));

            $oldNode = $job;
            $jobsXml->getElementsByTagName("jobs")->item(0)->replaceChild($newNode, $oldNode);
            $jobsXml->save("../database/jobs.xml");
        }
    }
    echo "<script>alert('Account Deleted')</script>";

}
?>
    