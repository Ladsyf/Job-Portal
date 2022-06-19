<?php
session_start();
if(isset($_SESSION['username'])){
    header('location: home.php');
}

    include 'navbar.php';
    $outputForm = "";
    $sideBar = "";
    if ($_GET['acc_type'] == "jobseeker"){
        $sideBar = "Job Seeker Sign up <br><br>Register your account as Jobseeker <br><br> We provide the Following: <br><br>
        -Find Jobs with the top<br>mostcompanies <br><br> 
        -More job opportunities <br>are available through <br> Job Portal <br><br>
        -Job seekers can easily<br>find employment via Job Portal";
        $outputForm = "
            <input type = 'text' placeholder = 'First Name' name = 'fname' id = 'fname'><br>
            <input type = 'text' placeholder = 'Last Name' name = 'lname' id = 'lname'><br>
            <input type = 'text' placeholder = 'Username' name = 'username' id = 'username'><br>
            <input type = 'email' placeholder = 'Email Address' name = 'email' id = 'email'><br>
            <input type = 'password' placeholder = 'Password' name = 'password' id = 'password'><br>
            <input type = 'password' placeholder = 'Confirm Password' name = 'password2' id = 'password2'><br>
            <select name = 'interestcategories' id = 'interestcategories'>
                <option selected disabled>Interest Categories</option>
                <option value='IT'>IT</option>
                <option value='Medical'>Medical</option>
                <option value='Service'>Service</option>
            </select><br>
            <input type = 'text' id = 'acc_type' value = 'jobseeker' style = 'display:none;'>
            <label><input type = 'checkbox' class = 'ckbx'>By signing up , do you agree to the terms and conditions?</label>
            <label1><br>Already have account? Sign In here! </label1>
            <br><br>
            <button id = 'register' name = 'registerJS'>Register</button>";

    }
    else if ($_GET['acc_type'] == "employer"){
        $sideBar = "Employer Sign up<br><br>  Register your account as Jobseeker <br><br> We provide the Following: <br><br>
        -Find Jobs with the top<br>mostcompanies <br><br> 
        -More job opportunities <br>are available through <br> Job Portal <br><br>
        -Job seekers can easily<br>find employment via Job Portal";
        $outputForm = "
            <input type = 'text' placeholder = 'Company Name' name = 'cname' id = 'cname'><br>
            <input type = 'text' placeholder = 'First Name' name = 'fname' id = 'fname'><br>
            <input type = 'text' placeholder = 'Last Name' name = 'lname' id = 'lname'><br>
            <input type = 'text' placeholder = 'Job Position' name = 'jposition' id = 'jposition'><br>
            <input type = 'text' placeholder = 'Username' name = 'username' id = 'username'><br>
            <input type = 'email' placeholder = 'Email Address' name = 'email' id = 'email'><br>
            <input type = 'password' placeholder = 'Password' name = 'password' id = 'password'><br>
            <input type = 'password' placeholder = 'Confirm Password' name = 'password2' id = 'password2'><br>
            <input type = 'text' id = 'acc_type' value = 'employer' style = 'display:none;'>
            <label><input type = 'checkbox' class = 'ckbx'>By signing up , do you agree to the terms and conditions?</label>
            <label1><br>Already have account? Sign In here! </label1>
            <br><br>
            <button id = 'register' name = 'registerEM'>Register</button>";
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
<div class = "container"> 
        <div class = "left">
            <h1 class = "register1">REGISTER</h1>
            <?php 
                echo $sideBar;
            ?>
        </div>
        <div class = "right">
        <h1 style = "font-size: 60px; font-weight: bold;">Job Portal</h1>
            <div class="crtacc" style="font-family: sans-serif; align=center">
            CREATE AN ACCOUNT<br>
            </div>
            <div>
            <?php 
                echo $outputForm;

            ?>
                    <div id = "errors">
                    </div>
            </div>
        </div>
    </body>
</div>



</html>
