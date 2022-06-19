<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="javascript/jquery-3.6.0.js">
        </script>
            <script src="javascript/script.js">
        </script>
    <title>Create Job</title>
</head>
<body>
<?php
    include 'navbar.php';
?>
        <h1> Post a New Job Ad on the Website</h1>
        <select id = "job_type">
            <option value = "Full-time">Full-time</option>
            <option value = "Part-time">Part-time</option>
        </select>
        <select id = "field">
            <option value = "Medical">Medical</option>
            <option value = "IT">IT</option>
        </select>
            <input type = 'text' placeholder = 'Job Title:' id = 'job_title'><br>
            <input type = 'text' placeholder = 'Location:' id = 'location'><br>
            <input type = 'text' placeholder = 'Zip:' id = 'zip'><br>
            <input type = 'text' placeholder = 'Salary:' id = 'salary'><br>
            <input type = 'text' id = 'employerID' value = '<?php echo $_SESSION['id'] ?>' style = 'display:none'>
            <textarea placeholder = 'Add some description here:' id = "description"></textarea>
            <textarea placeholder = 'List of skills needed and qualifications for the job' id = "qualification"></textarea>
            <button id = 'postjob' onclick = "createJob();">Post Job</button>
            <div id = "errors"></div>
</body>
</html>
