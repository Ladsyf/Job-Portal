<?php
    session_start();
    $xml = new DOMdocument();
    $xml->formatOutput = true;
    $xml->preserveWhiteSpace = false;
    $xml->load("../database/jobAlerts.xml");

    $jobAlerts = $xml->getElementsByTagName("jobAlert");

    if(isset($_POST['createType'])){
        
    $alert_type = $_POST['createType'];
        if($alert_type == "email"){
        ?>       
        <p>Email me new job openings.</p>
    <?php } 
    else{
        ?>     
        <p>Text me new job openings.</p>      
        <?php
    }  
    ?>
    <input type = "text" id ="keyword" placeholder = "jobtitle, company, keyword">
    <input type = "text" id = "location" placeholder = "City or State">
    <select id = "job_type">
        <option value = "Full-time">Full-time</option>
        <option value = "Part-time">Part-time</option>
    </select>
        <button onclick = createNewJobAlertBTN('<?php echo $alert_type ?>');>Create Job Alert</button>
        <button onclick = cancelCreateJobAlert();>Cancel</button>
        <div id = "errors"></div>
    <?php
    unset($_POST['createType']);
    }

if(isset($_POST['newCreateType'])){


    $type = $_POST['newCreateType'];
    $keyword = $_POST['keyword'];
    $loc = $_POST['loc'];
    $job_type = $_POST['job_type'];

    if(empty($type) || empty($keyword) || empty($loc) || empty($job_type)){
        echo "Please complete the form";
        unset($_POST['newCreateType']);
        return;
    }

    $last_id = 0;
    foreach($jobAlerts as $jobAlert){
        $last_id = $jobAlert->getAttribute("id");
    }
    $newAlert = $xml->createElement("jobAlert");
    $newAlert->setAttribute("id", $last_id + 1);
    $newAlert->setAttribute("userID", $_SESSION['id']);
    $newAlert->setAttribute("alert_type", $type);
    $newAlert->appendChild($xml->createElement("keyword", $keyword));
    $newAlert->appendChild($xml->createElement("location", $loc));
    $newAlert->appendChild($xml->createElement("jobType", $job_type));
    $xml->getElementsByTagName("jobAlerts")->item(0)->appendChild($newAlert);
    $xml->save("../database/jobAlerts.xml");
    unset($_POST['newCreateType']);
}



if(isset($_POST['showEditJob'])){

    $id = $_POST['showEditJob'];
    foreach($jobAlerts as $jobAlert){
        $alertID = $jobAlert->getAttribute("id");
        if($id == $alertID){
            $userID = $jobAlert->getAttribute("userID");
            $alert_type = $jobAlert->getAttribute("alert_type");
            $keyWord = $jobAlert->getElementsByTagName("keyword")[0]->nodeValue;
            $Location = $jobAlert->getElementsByTagName("location")[0]->nodeValue;
            $job_type = $jobAlert->getElementsByTagName("jobType")[0]->nodeValue;

            if($alert_type == "email"){
            ?>
            <p>Email me new job openings.</p>
            <?php } 
            else{
            ?>
            <p>Text me new job openings.</p>
            <?php
        }  
        ?>
        <input type = "text" id ="keyword" placeholder = "jobtitle, company, keyword" value = '<?php echo $keyWord?>'>
        <input type = "text" id = "location" placeholder = "City or State" value = '<?php echo $Location?>'>
        <select id = "job_type">
            <?php if($job_type == "Full-time"){ ?>
            <option value = "Full-time" selected>Full-time</option>
            <option value = "Part-time">Part-time</option>
            <?php }
            else {
            ?>
            <option value = "Full-time">Full-time</option>
            <option value = "Part-time" selected>Part-time</option>
            <?php
            }
            ?>
        </select>
            <button onclick = saveEditJob('<?php echo $id ?>','<?php echo $_SESSION['id']?>','<?php echo $alert_type ?>'); >Save</button>
            <button onclick = cancelCreateJobAlert();>Cancel</button>
            <div id = "errors"></div>
        <?php
        }
    }
    unset($_POST['showEditJob']);    
}
if(isset($_POST['saveEditJob'])){
    $alertID = $_POST['saveEditJob'];
    $userID = $_POST['userID'];
    $alert_type = $_POST['alert_type'];
    $keyword = $_POST['keyword'];
    $job_type = $_POST['job_type'];
    $loc = $_POST['loc'];
    
    if(empty($loc) || empty($keyword)){
        echo "Please complete the form";
        unset($_POST['saveEditJob']);
        return;
    }

    foreach($jobAlerts as $jobAlert){
        $oldID = $jobAlert->getAttribute("id");
        if($oldID == $alertID){
        $newNode = $xml->createElement("jobAlert");
        $newNode->setAttribute("id", $alertID);
        $newNode->setAttribute("userID", $userID);
        $newNode->setAttribute("alert_type", $alert_type);
        $newNode->appendChild($xml->createElement("keyword", $keyword));
        $newNode->appendChild($xml->createElement("location", $loc));
        $newNode->appendChild($xml->createElement("jobType", $job_type));
        $oldNode = $jobAlert;
        $xml->getElementsByTagName("jobAlerts")->item(0)->replaceChild($newNode, $oldNode);
        $xml->save("../database/jobAlerts.xml");
        unset($_POST['saveEditJob']);
        }
    }

}
if(isset($_POST['deleteID'])){
    foreach($jobAlerts as $jobAlert){
        if($jobAlert->getAttribute("id") == $_POST['deleteID']){
            $xml->getElementsByTagName("jobAlerts")[0]->removeChild($jobAlert);
            $xml->save("../database/jobAlerts.xml");
            unset($_POST['deleteID']);
            return;
        }
    }
    unset($_POST['deleteID']);
}

?>
