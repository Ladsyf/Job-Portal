<?php
    session_start();
    $userID = $_POST['userID'];
    $jobID = $_POST['jobID'];
    $stats = $_POST['stats'];
    $xml = new DOMdocument();
    $xml->load("../database/accounts.xml");
    $accounts = $xml->getElementsByTagName("account");


    if(isset($_POST['applicantShow'])){
        
        foreach($accounts as $account){
            if($account->getAttribute('id') == $userID){
                $fname = $account->getElementsByTagName("firstname")[0]->nodeValue;
                $lname = $account->getElementsByTagName("lastname")[0]->nodeValue;
                $gender = $account->getElementsByTagName("gender")[0]->nodeValue;
                $skill = $account->getElementsByTagName("skills")[0]->nodeValue;
                $qualification = $account->getElementsByTagName("qualifications")[0]->nodeValue;
                $experience = $account->getElementsByTagName("experience")[0]->nodeValue;
                $email = $account->getElementsByTagName("email")[0]->nodeValue;
                $contactnumber = $account->getElementsByTagName("contactnumber")[0]->nodeValue;
                $country = $account->getElementsByTagName("country")[0]->nodeValue;
                $city = $account->getElementsByTagName("city")[0]->nodeValue;
                $resume = $account->getElementsByTagName("resume")[0]->nodeValue;

                ?>
                <p> Status: <?php echo $stats ?></p>
                <p>Applied by <?php echo "$fname $lname" ?></p>
                <p>Profile Information</p>
                <p>Name: <?php echo "$fname $lname" ?><br>
                Gender: <?php echo "$gender" ?><br>
                Skill: <?php echo "$skill" ?><br>
                Qualification: <?php echo "$qualification" ?><br>
                Experience: <?php echo "$experience" ?><br>
                Email Address: <?php echo "$email" ?><br>
                Contact Number: <?php echo "$contactnumber" ?><br>
                Country: <?php echo "$country" ?><br>
                City: <?php echo "$city" ?><br>
                Resume: 
                <?php 
                    if(!empty($resume)){
                ?>
                <a href = "resume/<?php echo $resume ?>" download>Download Resume</a><br>
                
                        <?php
                    }
                    else{
                        ?>
                <a>No Resume to Download</a><br>
                        <?php
                    }
                        ?>
                </p>
                <button onclick = hideSelectedJobBTN();>Close</button>
                <button onclick = rejectApplication('<?php echo $jobID ?>','<?php echo $userID ?>');>Reject</button>
                <?php if($stats == "approved"){ ?>
                    <button onclick = archiveApplication('<?php echo $jobID ?>','<?php echo $userID ?>');>Archive</button>
                    <button onclick = undoapproveApplication('<?php echo $jobID ?>','<?php echo $userID ?>');>Undo Approve</button>
                <?php
                } 
                else {
                ?>
                <button onclick = approveApplication('<?php echo $jobID ?>','<?php echo $userID ?>');>Approve</button>
                <?php
                }

            }
        }

        unset($_POST['applicantShow']);
    }

?>