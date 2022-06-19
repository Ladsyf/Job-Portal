<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location: index.php');
}
$xml = new DOMdocument();
$xml->load("database/jobs.xml");
$applicationsXml = new DOMdocument();
$applicationsXml->load("database/applications.xml");
$accountsXml = new DOMdocument();
$accountsXml->load("database/accounts.xml");

$accounts = $accountsXml->getElementsByTagName("account");
$applications = $applicationsXml->getElementsByTagName("application");
$jobs = $xml->getElementsByTagName("job");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="javascript/jquery-3.6.0.js">
        </script>
            <script src="javascript/script.js">
        </script>
    <title>Jobs Posted</title>
</head>
<body>
    <?php include 'navbar.php' ?>
    <div>
    
        <h3>Jobs You Posted<br></h3>
        <div id = 'jobsYouPosted'> 
            <?php
                foreach($jobs as $job){
                    if($job->getAttribute('employerID') == $_SESSION['id']){
                        $id = $job->getAttribute("id");
                        $job_type = $job->getAttribute("job_type");
                        $field = $job->getElementsByTagName("field")[0]->nodeValue;
                        $title = $job->getElementsByTagName("title")[0]->nodeValue;
                        $location = $job->getElementsByTagName("location")[0]->nodeValue;
                        $zip = $job->getElementsByTagName("zip")[0]->nodeValue;
                        $salary = $job->getElementsByTagName("salary")[0]->nodeValue;
                        $description = $job->getElementsByTagName("description")[0]->nodeValue;
                        $qualification = $job->getElementsByTagName("qualification")[0]->nodeValue;
                        $status = $job->getElementsByTagName("status")[0]->nodeValue;
                        ?>
                            <div style = "background-color: gray;">
                                <p> <?php echo $title ?> - <?php echo "($location) PHP$salary" ?> Monthly </p>
                                <p> <?php echo $description ?> </p>
                                <button onclick = toggleJobStatus(<?php echo $id?>);><?php echo $status ?> </button>
                                <button onclick = editJobBTN(<?php echo $id?>);>Edit</button>
                            </div>
                        <?php 
                    }
                }
            ?> 
            </div>
                <h3><br>Jobseekers Applied to your Job<br></h3>
            <div class = "jobseekersApplied">
 

            </div>
    </div>
    <div id = "backgroundblock" onclick = hideSelectedJobBTN();></div>
    <div class = "applicantShow"></div>
</body>
</html>
