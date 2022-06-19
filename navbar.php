<div class = "navbar">
            <div class = "aln">
            <img class = "job" src="images/job.png" alt="">
                <a id = "logo" href = "index.php">&nbsp;&nbsp;Job Portal</a>
            </div>
            <div class = "aln1">
                <a href = "home.php">Home&nbsp;&nbsp;&nbsp;&nbsp;</a>
                
                <?php
                if(isset($_SESSION['acc_type']) && $_SESSION['acc_type'] == "employer" && isset($_SESSION['username'])){
                ?>
                <!-- <a>Find Talent</a> -->
                <a href = "createjob.php">Post a Job</a>
                <?php           
                }
                else if(isset($_SESSION['acc_type']) && $_SESSION['acc_type'] == "jobseeker" && isset($_SESSION['username'])){?>
                    <a href = "searchjobs.php">Find Job&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    <a href = "myApplications.php">My Applications</a>
                    <?php
                }
                else{
                ?>
                <a href = "login.php?acc_type=jobseeker">Find Job&nbsp;&nbsp;&nbsp;&nbsp;</a>
                <a href = "login.php?acc_type=employer">Find Talent</a>
                <?php }?>
            </div>
            <?php 
            if (!isset($_SESSION['username'])){?>
            <div class = "aln2">
                <img class = "profile" src="images/profile.png" alt="">
                <a id = "registerDROP">Register&nbsp;&nbsp;</a>
                <a id = "loginDROP">Login</a>
            </div>
            </div>
            <div class = "registerAS">
                <li><a href = "register.php?acc_type=jobseeker"> Jobseeker Sign up</a></li>
              
                <li><a href = "register.php?acc_type=employer"> Employer Sign up</a></li>
            </div>
                <div class = "loginAS">
                <li><a href = "login.php?acc_type=jobseeker"> Jobseeker Login</a></li>
                <li><a href = "login.php?acc_type=employer"> Employer Login</a></li>
            </div>
            <?php
        }
        else { ?>
            <div class = "usernbtn">
                <a id = "usernameBTN"><?php echo $_SESSION['username']?></a>
            </div>
        </div>
            <div class = "usernameDROP">
                <li><a href = "profile.php"> Profile</a></li>
                <?php 
                if ($_SESSION['acc_type'] == "employer"){     ?>
                <!-- <li><a href = "jobsPosted.php"> Jobs Posted </a></li> -->
                <?php }
                else {?>
                <li><a href = "jobAlerts.php"> Job Alerts </a></li>
                <?php }
                ?>
                <li onclick = logout();><a> Logout</a></li>
            </div>
        <?php
                }   
        ?>
    