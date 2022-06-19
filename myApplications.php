<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location: index.php');
}
$xml = new DOMdocument();
$xml->load("database/jobs.xml");

$applicationsXml = new DOMdocument();
$applicationsXml->load("database/applications.xml");

$applications = $applicationsXml->getElementsByTagName("application");

$jobs = $xml->getElementsByTagName("job");
if ($_SESSION['acc_type'] == "employer"){
    header('location: jobsPosted.php');
}
?>
<html>
<?php
    include 'navbar.php';
?>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="javascript/jquery-3.6.0.js">
        </script>
            <script src="javascript/script.js">
        </script>
    </head>

    <body>
        <div id = "jobs">
        <?php 
        foreach($applications as $application){
            if($application->getAttribute("accountID") == $_SESSION['id']){
            foreach($jobs as $job){
                if($application->getAttribute("jobID") == $job->getAttribute("id")){
                    $yourStat = $application->getElementsByTagName("status")[0]->nodeValue;
                
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
                echo 
                "<div class = 'line-content' style = 'background-color: grey'>
                    Your Status: $yourStat
                <br>
                    $jobTitle ($jobLocation) PHP$jobSalary Monthly<br>$jobDescription<br>";  
         
                echo  "<button onclick = 'viewSelectedJobBTN($jobID);'>View</button></div><br>"; 
                }
            }
        }
    }
            ?>
        </div>
    <ul id="pagin"></ul>
    <div id = "backgroundblock" onclick = hideSelectedJobBTN();></div>
            <div class = "jobView">
            </div>
    </body>

</html>