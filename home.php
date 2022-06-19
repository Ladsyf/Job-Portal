<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location: index.php');
}
$xml = new DOMdocument();
$xml->load("database/jobs.xml");

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
        <div>
            <h1 class = "page">PAGE 1</h1>
        </div>
        <div id = "jobs">
        <?php foreach($jobs as $job){
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
                "<div class = 'line-content'>
                    <p>$jobTitle ($jobLocation) PHP$jobSalary Monthly</p><p1>> $jobDescription<br> </p1>";  
         
                echo  "<button onclick = 'viewSelectedJobBTN($jobID);'>View</button></div>"; 
            }
            ?>
        </div>
        <center>
            <ul id="pagin"></ul>
        </center>
    <div id = "backgroundblock" onclick = hideSelectedJobBTN();></div>
            
            <div class = "jobView">

            </div>
    </body>

</html>