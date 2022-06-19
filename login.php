<?php
session_start();
if(isset($_SESSION['username'])){
    header('location: home.php');
}
?>
<?php
    $outputForm = "";
    $sideBar = "";
    if ($_GET['acc_type'] == "jobseeker"){
        $sideBar = "Job Seeker Login<br><br> We provide the following:<br><br>
        -Find jobs with the top <br>most companies<br><br>
        -More job opportunities <br>are available through <br>Job Portal<br><br>
        -Job Seekers can easily <br>find employment via <br>Job Portal";
        $outputForm = "
            <input type = 'text' id = 'acc_type' value = 'jobseeker' style = 'display:none;'>";
    }
    else if ($_GET['acc_type'] == "employer"){
        $sideBar = "Employer Login<br><br> We Provide the following:<br><br>
        -Find skilled and fresh <br>talent graduates<br><br>
        -Provide expert <br>employee<br><br>
        -Companies or Employer can easily find skillful <br>employee via Job Portal ";
        $outputForm = "
            <input type = 'text' id = 'acc_type' value = 'employer' style = 'display:none;'>";
    }
    else {
        header('location: index.php');
    }
?>
<html>

    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="javascript/jquery-3.6.0.js">
        </script>
        <script src="javascript/script.js">
        </script>
    </head>

    <body>
<?php
    include 'navbar.php';
?>
<div class = "bigContainer">
        <div class = "leftbar">   
            <h1 class = "logintxt">LOGIN </h1><br>
            <?php 
                echo $sideBar;
            ?>
        </div>
        <div class = "rightbar">
            <h1 style = "font-size: 60px; font-weight: bold;">Job Portal</h1>
            
            <div class="lgnacc" style="font-family: sans-serif; align=center">
            
            LOGIN ACCOUNT<br>
            </div>

            <div>
                <input type = 'text' placeholder = 'Username/Email' name = 'username' id = 'username'><br>
                <input type = 'password' placeholder = 'Password' name = 'password' id = 'password'><br>
                <div id = "errors"></div>
            <?php 
                echo $outputForm;
            ?>
                <button id = 'login'>Log in</button><br>
                Didn't have an account?<br>
                <button id = 'signup'>Sign Up</button>

            </div>
        </div>


</div>
    </body>



</html>