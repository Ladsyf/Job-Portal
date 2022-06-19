<?php
$employerID = $_POST['id'];
$field = $_POST['field'];
$job_type = $_POST['job_type'];
$job_title = $_POST['title'];
$location = $_POST['location'];
$zip = $_POST['zip'];
$salary = $_POST['salary'];
$description = $_POST['description'];
$qualification = $_POST['qualification'];


//validations
if(empty($job_title) || empty($job_type) || empty($location) || empty($zip) || empty($salary) || empty($description) || empty($qualification)){
    echo "Please complete the form";
    return;
}

$xml = new DOMdocument();
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->load("../database/jobs.xml");

$errors = false;

$jobs = $xml->getElementsByTagName("job");

    $lastId= 0;
    foreach($jobs as $job){
        $lastId = $job->getAttribute("id");
        $lastId = intval($lastId) +1;
    }

    $job = $xml->createElement("job");
    $job->setAttribute("id", $lastId);
    $job->setAttribute("employerID", $employerID);
    $job->setAttribute("job_type", $job_type);

    $newfield = $xml->createElement("field", $field);
    $newjobtitle = $xml->createElement("title", $job_title);
    $newlocation = $xml->createElement("location", $location);
    $newzip = $xml->createElement("zip", $zip);
    $newsalary = $xml->createElement("salary", $salary);
    $newdescription = $xml->createElement("description", $description);
    $newqualification = $xml->createElement("qualification", $qualification);

    $job->appendChild($newfield);
    $job->appendChild($newjobtitle);
    $job->appendChild($xml->createElement("status", "active"));
    $job->appendChild($newlocation);
    $job->appendChild($newzip);
    $job->appendChild($newsalary);
    $job->appendChild($newdescription);
    $job->appendChild($newqualification);


    $xml->getElementsByTagName("jobs")->item(0)->appendChild($job);
    $xml->save("../database/jobs.xml");

?>