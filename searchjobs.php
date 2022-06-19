<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location: index.php');
}

    $_POST['searchquery'] = "";
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="javascript/jquery-3.6.0.js">
        </script>
            <script src="javascript/script.js">
        </script>
    </head>

    <body> 
<?php    include 'navbar.php'; ?>

        <select id = "job_type">
            <option value = "Full-time">Full-time</option>
            <option value = "Part-time">Part-time</option>
        </select>
        <input type = "text" placeholder = "Search job title here" id = "search"> 
        <input type = "text" placeholder = "Location" id = "loc">
        <input type = "text" placeholder = "Seach job on the basis of the skills" id = "skills"> 
        <br>
        <a id = "searchBTN"><button class = "btn">Search</button></a>
        <div id = "jobs">
        <p>Search Jobs Here...</p>
        </div>
        
<div>
        
    </div>
        <div id = "backgroundblock" onclick = hideSelectedJobBTN();></div>
            <div class = "jobView">
            </div>
        
    </body>
</html>