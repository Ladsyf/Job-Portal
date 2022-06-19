<?php
    session_start();
    if(!isset($_SESSION['username'])){

        header("location: index.php");
    }
    $xml = new DOMdocument();
    $xml->load("database/accounts.xml");
    $accounts = $xml->getElementsByTagName("account");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="javascript/jquery-3.6.0.js">
        </script>
            <script src="javascript/script.js">
        </script>
</head>
<body>
    <?php
    include 'navbar.php';
        foreach($accounts as $account){
            if($_SESSION['id'] == $account->getAttribute("id")){
            $fname = $account->getElementsByTagName("firstname")[0]->nodeValue;
            $lname = $account->getElementsByTagName("lastname")[0]->nodeValue;
            $username = $account->getElementsByTagName("username")[0]->nodeValue;
            $email = $account->getElementsByTagName("email")[0]->nodeValue;
            $password = $account->getElementsByTagName("password")[0]->nodeValue;
            $acc_type = $account->getAttribute("acc_type");
            $contactnumber = $account->getElementsByTagName("contactnumber")[0]->nodeValue;
            $address = $account->getElementsByTagName("address")[0]->nodeValue;
            $city = $account->getElementsByTagName("city")[0]->nodeValue;
            $country = $account->getElementsByTagName("country")[0]->nodeValue;
            $zip = $account->getElementsByTagName("zip")[0]->nodeValue;
            $gender = $account->getElementsByTagName("gender")[0]->nodeValue;
            $picture = $account->getElementsByTagName("picture")[0]->nodeValue;
            if($acc_type == "employer"){
                $Companyname = $account->getElementsByTagName("CompanyName")[0]->nodeValue;
                $jobposition = $account->getElementsByTagName("JobPosition")[0]->nodeValue;
                echo "Information Details:<Br>";
                echo "Company Name: $Companyname <br>";
                echo "First Name: $fname <br>";
                echo "Last Name: $lname <br>";
                echo "Job Position: $jobposition <br>";
                echo "Username: $username <br>";
                echo "Email: $email <br>";
                echo "Contact Number: $contactnumber <br>";
                echo "Address: $address <Br>";
                echo "City: $city <br>";
                echo "Country: $country <br>";
                echo "Zip code: $zip <br>";
                echo "Gender: $gender";
                ?>
                <div class = "editProfile">
                    <h1>Edit Profile</h1>
                    <div class = "dp" style = "background-image: url('profilepics/<?php echo $picture?>');" > 
                    </div>
                    <form action="processes/upload.php" method="post" enctype="multipart/form-data">
                        Select image to upload:
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <input type="submit" value="Upload Image" name="submit">
                    </form>
                    <div class = "leftEdit">
                        First Name: <input id = "editFname" type="text" value = '<?php echo $fname?>' name="editFname" ><br>
                        Username: <input id = "editUname" type="text" value = '<?php echo $username?>' name="editUname" ><br>
                        Job Position: <input id = "editPosition" type="text" value = '<?php echo $jobposition?>' name="editPosition" ><br>
                        Contact Number: <input id = "editnumber" type="text" value = '<?php echo $contactnumber?>' name = "editnumber" ><br>
                        Address: <input id = "editaddress" type="text" value = '<?php echo $address?>' name = "editaddres" ><br>
                        Zip: <input id = "editzip" type="text" value = '<?php echo $zip?>' name = "editzip" ><br>
                    </div>
                    <div class = "rightEdit">  
                        Last Name: <input id = "editLname" type="text" value = '<?php echo $lname?>' name="editLname" ><br>
                        Email Address: <input id = "editEmail" type="text" value = '<?php echo $email?>' name = "editEmail" ><br>
                        Company Name: <input id = "editCompany" type="" value = '<?php echo $Companyname?>'><br>
                        Gender: <select id = "editgender">
                                    <?php if ($gender == "Female"){?>
                                            <option value = "Male">Male</option>
                                            <option value = "Female" selected>Female</option>
                                        <?php }
                                        else{?>
                                            <option value = "Male" selected>Male</option>
                                            <option value = "Female">Female</option>
                                        <?php
                                        }
                                        ?>
                                </select>    
                        <br>
                        City: <input id = "editcity" type="text" value = '<?php echo $city?>' name = "editcity" ><br>
                        Country: <input id = "editcountry" type="text" value = '<?php echo $country?>' name = "editcountry" ><br>
                        Change Password:<br>
                        <input type = "password" id = "oldpw" placeholder = "Enter Old Password">
                        <input type = "password" id = "newpw" placeholder = "New Password">
                        <input type = "password" id = "confirmpw" placeholder = "Confirm Password">
                            

                    </div>
                    <button id = 'edit' name = 'edit' onclick = editEmployerProfile();>Save Profile</button>
                    <button onclick = deleteAccount(<?php echo $_SESSION['id']?>);>Delete</button>
                    
                </div>
            <?php
                
            }
            else if($acc_type == "jobseeker"){
                $interestcategories = $account->getElementsByTagName("interestcategories")[0]->nodeValue;
                $skills = $account->getElementsByTagName("skills")[0]->nodeValue;
                $qualification = $account->getElementsByTagName("qualifications")[0]->nodeValue;
                $experience = $account->getElementsByTagName("experience")[0]->nodeValue;
                $resume = $account->getElementsByTagName("resume")[0]->nodeValue;
                $picture = $account->getElementsByTagName("picture")[0]->nodeValue;
                ?>
                        <div class = "dp" style = "background-image: url('profilepics/<?php echo $picture?>');"> 
                        </div>
                <?php
                echo "<div class = 'userProfile'>Information Details:<Br>";
                echo "First Name: $fname <br>";
                echo "Last Name: $lname <br>";
                echo "Username: $username <br>";
                echo "Email: $email <br>";
                echo "Contact Number: $contactnumber <br>";
                echo "Address: $address <br>";
                echo "City: $city <br>";
                echo "Country: $country <br>";
                echo "Zip Code: $zip <br>";
                echo "Gender: $gender <br>";
                echo "Skill: $skills <br>";
                echo "Qualification: $qualification <br>";
                echo "Experience: $experience <br>";
                echo "</div>";
                ?>
                    <div class = "editProfile">
                        <h1>Edit Profile</h1>
                        <div class = "dp" style = "background-image: url('profilepics/<?php echo $picture?>');"> 
                        </div>
                        <form action="processes/upload.php" method="post" enctype="multipart/form-data">
                            Select image to upload:
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <input type="submit" value="Upload Image" name="submit">
                        </form>
                        <div class = "leftEdit">
                            First Name: <input id = "editFname" type="text" value = '<?php echo $fname?>' name="editFname" ><br>
                            Username: <input id = "editUname" type="text" value = '<?php echo $username?>' name="editUname" ><br>
                            Contact Number: <input id = "editnumber" type="text" value = '<?php echo $contactnumber?>' name = "editnumber" ><br>
                            Address: <input id = "editaddress" type="text" value = '<?php echo $address?>' name = "editaddres" ><br>
                            Zip: <input id = "editzip" type="text" value = '<?php echo $zip?>' name = "editzip" ><br>
                            Skills: <input id = "editskills" type="text" value = '<?php echo $skills?>' name = "editskills" ><br>
                            Experience: <input id = "editexperience" type="text" value = '<?php echo $experience?>' name = "editexperience" ><br>
                        <form action="processes/resumeUpload.php" method="post" enctype="multipart/form-data">
                            Attach Resume here: <input id = "editresume" type="file" name = "editresume"><br>
                            <input type="submit" value="Upload resume" name="submit">
                        </form>
                        </div>
                        <div class = "rightEdit">  
                            Last Name: <input id = "editLname" type="text" value = '<?php echo $lname?>' name="editLname" ><br>
                            Email Address: <input id = "editEmail" type="text" value = '<?php echo $email?>' name = "editEmail" ><br>
                            Gender: <select id = "editgender">
                                        <?php if ($gender == "Female"){?>
                                                <option value = "Male">Male</option>
                                                <option value = "Female" selected>Female</option>
                                            <?php }
                                            else{?>
                                                <option value = "Male" selected>Male</option>
                                                <option value = "Female">Female</option>
                                            <?php
                                            }
                                            ?>
                                    </select>    
                            <br>
                            City: <input id = "editcity" type="text" value = '<?php echo $city?>' name = "editcity" ><br>
                            Country: <input id = "editcountry" type="text" value = '<?php echo $country?>' name = "editcountry" ><br>
                            Qualifications: <input id = "editqualifications" type="text" value = '<?php echo $qualification?>' name = "editqualifications" ><br>
                            Change Password:<br>
                            <input type = "password" id = "oldpw" placeholder = "Enter Old Password">
                            <input type = "password" id = "newpw" placeholder = "New Password">
                            <input type = "password" id = "confirmpw" placeholder = "Confirm Password">
                        </div>
                        <button id = 'edit' name = 'edit' onclick = editJobseekerProfile();>Save Profile</button>
                        <button onclick = deleteAccount(<?php echo $_SESSION['id']?>);>Delete</button>
                        
                    </div>
                <?php
            }
        }
    }
    ?>

</body>
</html>
