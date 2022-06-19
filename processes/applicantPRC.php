<?php
session_start();
$jobID = $_POST['jobID'];
$userID = $_POST['userID'];

$xml = new DOMdocument();
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;   
$xml->load("../database/applications.xml");

$applications = $xml->getElementsByTagName("application");
if(isset($_POST['rejectApplicant']) || isset($_POST['approveApplication']) || isset($_POST['undoapproveApplication']) || isset($_POST['archiveApplication'])){
    
    foreach($applications as $application){
        if($application->getAttribute("jobID") == $jobID && $application->getAttribute("accountID") == $userID){
            $dateApplied = $application->getElementsByTagName("dateApplied")[0]->nodeValue;
            $newStatus = "";
            
            $newNode = $xml->createElement("application");
            $newNode->setAttribute("accountID", $userID);
            $newNode->setAttribute("jobID", $jobID);
            $newNode->appendChild($xml->createElement("dateApplied", $dateApplied));
            if(isset($_POST['rejectApplicant'])){
                $newStatus = "rejected";}
            else if (isset($_POST['approveApplication'])){
                $newStatus = "approved";
            }
            else if (isset($_POST['undoapproveApplication'])){
                $newStatus = "applied";
            }
            else if (isset($_POST['archiveApplication'])){
                $newStatus = "archived";
            }
            $newNode->appendChild($xml->createElement("status", $newStatus));
            $oldNode = $application;
            $xml->getElementsByTagName("applications")->item(0)->replaceChild($newNode, $oldNode);
            $xml->save("../database/applications.xml");
            
        }


    }
    if(isset($_POST['undoapproveApplication'])){
        unset($_POST['undoapproveApplication']);
        }

    if(isset($_POST['archiveApplication'])){
    unset($_POST['archiveApplication']);
    }
    if(isset($_POST['rejectApplicant'])){
        unset($_POST['rejectApplicant']);
        }
        
    if(isset($_POST['approveApplication'])){
    unset($_POST['approveApplication']);
    }
    return;


}