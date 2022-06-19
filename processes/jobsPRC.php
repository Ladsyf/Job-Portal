<?php
session_start();
 $jobID = $_POST['jobID'];
 $xml = new domdocument();
 $xml->preserveWhiteSpace = false;
 $xml->formatOutput = true;
 $xml->load("../database/jobs.xml");

 $applicationXml = new domdocument();

 $applicationXml->load("../database/applications.xml");

 
 $applications = $applicationXml->getElementsByTagName("application");
 $jobs = $xml->getElementsByTagName("job");

if(isset($_POST['toggleStatus']) || isset($_POST["ShoweditJob"])){
    foreach ($jobs as $job) {
        $oldid = $job->getAttribute("id");
        if ($jobID == $oldid) {
            $employerID = $job->getAttribute("employerID");
            $job_type = $job->getAttribute("job_type");
            $field = $job->getElementsByTagName("field")[0]->nodeValue;
            $title = $job->getElementsByTagName("title")[0]->nodeValue;
            $location = $job->getElementsByTagName("location")[0]->nodeValue;
            $zip = $job->getElementsByTagName("zip")[0]->nodeValue;
            $status = $job->getElementsByTagName("status")[0]->nodeValue;
            $salary = $job->getElementsByTagName("salary")[0]->nodeValue;
            $description = $job->getElementsByTagName("description")[0]->nodeValue;
            $qualification = $job->getElementsByTagName("qualification")[0]->nodeValue;
            
            if(isset($_POST['ShoweditJob'])){
                ?>
                <h1> Edit your job posting</h1>
                <select id = "job_type">
                    <?php if ($job_type == "Full-time"){
                        ?>
                    <option value = "Full-time" selected>Full-time</option>
                    <option value = "Part-time">Part-time</option>
                    <?php }
                    else {?>
                    <option value = "Full-time">Full-time</option>
                    <option value = "Part-time" selected>Part-time</option>
                    <?php }?>
                </select><br>
                <input type = 'text' id = "field" value = '<?php echo $field ?>' style = 'display:none'>
                    
                Job Title: <br><input type = 'text' placeholder = 'Job Title:' id = 'job_title' value = '<?php echo $title?>'><br>
                Location: <br><input type = 'text' placeholder = 'Location:' id = 'location' value = '<?php echo $location ?>'><br>
                Zip: <br><input type = 'text' placeholder = 'Zip:' id = 'zip' value = '<?php echo $zip ?>'><br>
                Salary: <br><input type = 'text' placeholder = 'Salary:' id = 'salary' value = '<?php echo $salary ?>'><br>
                Description: <br><textarea placeholder = 'Add some description here:' id = "description"><?php echo $description ?></textarea><br>
                    <input type = 'text'  id = "status" value = '<?php echo $status?>' style = "display:none;">
                Qualifications: <br><textarea placeholder = 'List of skills needed and qualifications for the job' id = "qualification"><?php echo $qualification ?></textarea>
                    <br><button id = 'postjob' onclick = editJob('<?php echo $jobID ?>');>Save</button><br>
                    <a href = "jobsPosted.php"><button>Cancel</button></a>
                    <div id = "errors"></div>

                    <button onclick = deleteJobBTN(<?php echo $jobID?>)>Delete this posting</button>
             <?php
             unset($_POST['ShoweditJob']);
            }


            if(isset($_POST['toggleStatus'])){
                $status = "active";
                if($job->getElementsByTagName("status")[0]->nodeValue == "active"){
                    $status = "inactive";
                }
                $newNode = $xml->createElement("job");
                $newNode->setAttribute("id", $jobID);
                $newNode->setAttribute("employerID", $employerID);
                $newNode->setAttribute("job_type", $job_type);
                $newNode->appendChild($xml->createElement("field", $field));
                $newNode->appendChild($xml->createElement("title", $title));
                $newNode->appendChild($xml->createElement("status", $status));
                $newNode->appendChild($xml->createElement("location", $location));
                $newNode->appendChild($xml->createElement("zip", $zip));
                $newNode->appendChild($xml->createElement("salary", $salary));
                $newNode->appendChild($xml->createElement("description", $description));
                $newNode->appendChild($xml->createElement("qualification", $qualification));

                $oldNode = $job;
                $xml->getElementsByTagName("jobs")->item(0)->replaceChild($newNode, $oldNode);
                $xml->save("../database/jobs.xml");
                unset($_POST["toggleStatus"]);
                return;
                }
            }
        }
    }
    if(isset($_POST['editJob'])){
        $job_type = $_POST['job_type'];
        $field = $_POST['field'];
        $title = $_POST['job_title'];
        $location = $_POST['location'];
        $zip = $_POST['zip'];
        $salary = $_POST['salary'];
        $description = $_POST['description'];
        $qualification = $_POST['qualification'];
        $status = $_POST['status'];
        $employerID = $_SESSION['id'];
        //if empty;
        if(empty($job_type) || empty($field) || empty($title) || empty($location) || empty($zip) || empty($salary) || empty($description) || empty($qualification)){
            echo "Please complete the given fields";
            unset($_POST['editJob']);
            return;
        }

        foreach ($jobs as $job) {

            $oldid = $job->getAttribute("id");
            
            if ($jobID == $oldid) {
                $newNode = $xml->createElement("job");
                $newNode->setAttribute("id", $jobID);
                $newNode->setAttribute("employerID", $employerID);
                $newNode->setAttribute("job_type", $job_type);
                $newNode->appendChild($xml->createElement("field", $field));
                $newNode->appendChild($xml->createElement("title", $title));
                $newNode->appendChild($xml->createElement("status", $status));
                $newNode->appendChild($xml->createElement("location", $location));
                $newNode->appendChild($xml->createElement("zip", $zip));
                $newNode->appendChild($xml->createElement("salary", $salary));
                $newNode->appendChild($xml->createElement("description", $description));
                $newNode->appendChild($xml->createElement("qualification", $qualification));

                $oldNode = $job;
                $xml->getElementsByTagName("jobs")->item(0)->replaceChild($newNode, $oldNode);
                $xml->save("../database/jobs.xml");
                
                
            }
        
        }
        unset($_POST['editJob']);
    }
if(isset($_POST['deleteJob'])){

    foreach($jobs as $job){
        
        if($jobID == $job->getAttribute("id")){
            $xml->getElementsByTagName("jobs")[0]->removeChild($job);
            $xml->save("../database/jobs.xml");
        }
    }
    foreach($applications as $application){
        if($jobID == $application->getAttribute("jobID")){
               $applicationXml->getElementsByTagName("applications")[0]->removeChild($application); 
               $applicationXml->save("../database/applications.xml");
            }
       }
    unset($_POST['deleteJob']);
}


//userside

if(isset($_POST['applyJob'])){
    $applicationsXml = new DOMdocument();
    $applicationsXml->formatOutput = true;
    $applicationsXml->preserveWhiteSpace = false;
    $applicationsXml->load("../database/applications.xml");
    $applications = $applicationsXml->getElementsByTagName("application");

    foreach($applications as $application){
        if($_SESSION['id'] == $application->getAttribute("accountID") && $jobID == $application->getAttribute("jobID")){
            echo "You already applied on this posting!";
            return;
        }
    }
    $createApplication = $applicationsXml->createElement("application");
    $createApplication->setAttribute("accountID", $_SESSION['id']);
    $createApplication->setAttribute("jobID", $jobID);
    
    $createApplication->appendChild($applicationsXml->createElement("dateApplied", date("Y-m-d")));
    $createApplication->appendChild($applicationsXml->createElement("status", "applied"));
    $applicationsXml->getElementsByTagName("applications")->item(0)->appendChild($createApplication);
    $applicationsXml->save("../database/applications.xml");
    unset($_POST['applyJob']);
}

?>