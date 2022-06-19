<?php
session_start();
$xml = new DOMdocument();
$xml->load("../database/jobs.xml");

$jobs = $xml->getElementsByTagName("job");

if(isset($_GET['searchquery'])){
    $query = $_GET['searchquery'];
    $loc = $_GET['loc'];
    $skills = $_GET['skills'];
    $job_type = $_GET['job_type'];
    $isEmpty = true;
    $results = 0;

    if(empty($query) && empty($loc) && empty($skills)){
        echo "Please enter some hints about the job";
        return;
    }

    foreach($jobs as $job){
        if($job->getElementsByTagName("status")[0]->nodeValue == "inactive"){
            continue;
        }
        $jobID = $job->getAttribute("id");
        $jobType = $job->getAttribute("job_type");
        $jobField = $job->getElementsByTagName("field")[0]->nodeValue;
        $jobTitle  = $job->getElementsByTagName("title")[0]->nodeValue;
        $jobLocation = $job->getElementsByTagName("location")[0]->nodeValue;
        $jobZip = $job->getElementsByTagName("zip")[0]->nodeValue;
        $jobSalary = $job->getElementsByTagName("salary")[0]->nodeValue;
        $jobDescription = $job->getElementsByTagName("description")[0]->nodeValue;
        $jobQualification = $job->getElementsByTagName("qualification")[0]->nodeValue;
        
        if(!preg_match("/$loc/i", $jobLocation) || !preg_match("/$job_type/i", $jobType) || !preg_match("/$skills/i", $jobQualification)){
            continue;
        }

        if(preg_match("/$query/i", $jobType) || preg_match("/$query/i", $jobField) || preg_match("/$query/i", $jobTitle) || preg_match("/$query/i", $jobLocation) || preg_match("/$query/i", $jobDescription) || preg_match("/$query/i", $jobQualification)){
            $isEmpty = false;
        echo 
        "<div class = 'line-content'>
            $jobTitle ($jobLocation) PHP$jobSalary Monthly<br>$jobDescription<br>";  
 
        echo  "<button class = 'viewSelectedJob' onclick = 'viewSelectedJobBTN($jobID);'>View</button></div><br>"; 
        }
    }
    if($isEmpty){
        echo 
        "<div style = 'background-color: grey'>
            no results found </div>";  
    }
}


if(isset($_GET['jobView'])){
    $accountsXml = new DOMdocument();
    $accountsXml->load('../database/accounts.xml');
    $accounts = $accountsXml->getElementsByTagName("account");
    $employerName = "";

    $jobID = $_GET['jobID'];
    foreach($jobs as $job){
        $ID = $job->getAttribute("id");
        if($jobID == $ID){
            $jobType = $job->getAttribute("job_type");
            $jobField = $job->getElementsByTagName("field")[0]->nodeValue;
            $jobTitle  = $job->getElementsByTagName("title")[0]->nodeValue;
            $jobLocation = $job->getElementsByTagName("location")[0]->nodeValue;
            $jobZip = $job->getElementsByTagName("zip")[0]->nodeValue;
            $jobSalary = $job->getElementsByTagName("salary")[0]->nodeValue;
            $jobDescription = $job->getElementsByTagName("description")[0]->nodeValue;
            $jobQualification = $job->getElementsByTagName("qualification")[0]->nodeValue;

            foreach($accounts as $account){
                if($job->getAttribute("employerID") == $account->getAttribute("id")){
                    $employerName = $account->getElementsByTagName("firstname")[0]->nodeValue;
                }
            }

            ?>
                <p class = "posted">Posted By: <?php echo $employerName ?></p>
                <p class ="jobtitle"><?php echo $jobTitle?></p>
                <p class ="jobtype">Job Type: <?php echo $jobType ?></p>
                <p class = "salary">Salary: <?php echo $jobSalary ?></p>
                <p class = "location">Location: <?php echo $jobLocation ?></p>
                <p class = "descp">Description: <?php echo $jobDescription ?></p>
                <p class = "skills">Skills and Qualifications: <br><?php echo $jobQualification?></p>
                <button class = "btn1" onclick = hideSelectedJobBTN();>Close</button><button class = "btn2" onclick = applyOnSelectedJobBTN('<?php echo $ID?>');>Apply</button>
            <?php
        }
    }
}

?>