<?php
session_start();
$xml = new DOMdocument();
$xml->load("../database/jobs.xml");
$applicationsXml = new DOMdocument();
$applicationsXml->load("../database/applications.xml");
$accountsXml = new DOMdocument();
$accountsXml->load("../database/accounts.xml");

$accounts = $accountsXml->getElementsByTagName("account");
$applications = $applicationsXml->getElementsByTagName("application");
$jobs = $xml->getElementsByTagName("job");

                    foreach($jobs as $job){
                        if($job->getAttribute('employerID') == $_SESSION['id']){
                            foreach($applications as $application){
                                $jobID = $application->getAttribute("jobID");
                                $status = $application->getElementsByTagName("status")[0]->nodeValue;
                            
                                if($status == "rejected"){
                                    continue;
                                }
                                if($status == "archived"){
                                    continue;
                                }

                                if($jobID == $job->getAttribute("id")){
                                    $title = $job->getElementsByTagName("title")[0]->nodeValue;
                                        $userID;
                                        $applicantFname;
                                        $applicantLname;
                                        $skills;
                                        $qualifications;
                                        $experience;
                                        foreach($accounts as $account){
                                            $userID = $application->getAttribute("accountID"); 
                                            if($account->getAttribute("id") == $application->getAttribute("accountID")){
                                               $applicantFname = $account->getElementsByTagName("firstname")[0]->nodeValue; 
                                               $applicantLname = $account->getElementsByTagName("lastname")[0]->nodeValue;
                                               $skills = $account->getElementsByTagName("skills")[0]->nodeValue;
                                               $qualifications = $account->getElementsByTagName("qualifications")[0]->nodeValue;
                                               $experience = $account->getElementsByTagName("experience")[0]->nodeValue;
                                            }
                                        }

                                    ?>
                                        <div style = "background-color: gray;">
                                            <p> Status: <?php echo $status ?></p>
                                            <p> <?php echo "$applicantFname $applicantLname" ?> - Applied to your job (<?php echo $title ?>) </p>
                                            <p>Skills: <?php echo $skills ?></p>
                                            <p>Qualifications: <?php echo $qualifications ?></p>
                                            <p>Experience: <?php echo $experience ?></p>
                                            <button onclick = applicantShow('<?php echo $userID ?>','<?php echo $jobID ?>','<?php echo $status ?>');>View</button>
                                        </div>
                                    <?php

                                }
                            }
                        }
                    }
                ?>