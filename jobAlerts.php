<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location: index.php');
}
$xml = new DOMdocument();
$xml->load("database/jobAlerts.xml");

if ($_SESSION['acc_type'] == "employer"){
    header('location: jobsPosted.php');
}

$jobAlerts = $xml->getElementsByTagName("jobAlert");

?>
<html>
<?php
    include 'navbar.php';
?>
<div class = "bigContainer">
        <div class = "alerjob">   
            <h1 class = "jobaler">Job Alerts</h1><br>
        </div>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="javascript/jquery-3.6.0.js">
        </script>
            <script src="javascript/script.js">
        </script>
    </head>

    <body>
        <div id = "jobAlerts">
            <div>
            <?php
                foreach($jobAlerts as $jobAlert){
                    $alertID = $jobAlert->getAttribute("id");
                    $userID = $jobAlert->getAttribute("userID");
                    $alert_type = $jobAlert->getAttribute("alert_type");
                    if($userID == $_SESSION['id'] && $alert_type == "email"){
                    $keyWord = $jobAlert->getElementsByTagName("keyword")[0]->nodeValue;
                    $Location = $jobAlert->getElementsByTagName("location")[0]->nodeValue;
                    $job_type = $jobAlert->getElementsByTagName("jobType")[0]->nodeValue;

                ?>
                    <div>
                        <p><?php echo $keyWord ?> jobs in <?php echo $Location ?></p>
                        <button onclick = editJobAlert('<?php echo $alertID ?>'); >Edit</button>
                        <button onclick = deleteJobAlert('<?php echo $alertID ?>'); >Delete</button>
                    </div>
                <?php
                    }
                }
                ?>
                <div class = "createE">
                <button id = "createe" onclick = createJobAlert('email');>Create new Email Alert</button>
                </div>
            </div>

            <div>
            <?php
                foreach($jobAlerts as $jobAlert){
                    $alertID = $jobAlert->getAttribute("id");
                    $userID = $jobAlert->getAttribute("userID");
                    $alert_type = $jobAlert->getAttribute("alert_type");
                    if($userID == $_SESSION['id'] && $alert_type == "sms"){
                    $keyWord = $jobAlert->getElementsByTagName("keyword")[0]->nodeValue;
                    $Location = $jobAlert->getElementsByTagName("location")[0]->nodeValue;
                    $job_type = $jobAlert->getElementsByTagName("jobType")[0]->nodeValue;

                ?>
                    <div>
                    <p><?php echo $keyWord ?> jobs in <?php echo $Location ?></p>
                        <button onclick = editJobAlert('<?php echo $alertID ?>');>Edit</button>
                        <button onclick = deleteJobAlert('<?php echo $alertID ?>');>Delete</button>
                    </div>
                <?php
                    }
                }
                ?>
                <div class = "createS">
                <button id = "creates" onclick = createJobAlert('sms');>Create new SMS Alert</button>
                </div>
            </div>
        </div>
    </body>

</html>