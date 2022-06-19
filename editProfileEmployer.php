<?php
session_start();
$xml = new DOMdocument();
$xml->preserveWhiteSpace = false;
$xml->formatOutput = true;
$xml->load("../database/accounts.xml");
$flag = 0;
$accounts = $xml->getElementsByTagName("account");

if(isset($_POST['editID'])){
    
    $id = $_POST["editID"];
    foreach ($accounts as $account){
        $oldid = $account->getAttribute("id");
        if ($id == $oldid) {
            $acc = $account->getAttribute("acc_type");
            $email = $account->getElementsByTagName("email")->item(0)->nodeValue;
            $username = $account->getElementsByTagName("username")->item(0)->nodeValue;
            $password = $account->getElementsByTagName("password")->item(0)->nodeValue;
            $acc = $account->getAttribute("acc_type");
            $fname = $account->getElementsByTagName("firstname")->item(0)->nodeValue;
            $lname = $account->getElementsByTagName("lastname")->item(0)->nodeValue;
            $gender = $account->getElementsByTagName("gender")[0]->nodeValue;
            $Companyname = $account->getElementsByTagName("CompanyName")[0]->nodeValue;
            $number = $account->getElementsByTagName("number")[0]->nodeValue;
            $address = $account->getElementsByTagName("address")[0]->nodeValue;
            $city = $account->getElementsByTagName("city")[0]->nodeValue;
            $country = $account->getElementsByTagName("country")[0]->nodeValue;
            $zip = $account->getElementsByTagName("zip")[0]->nodeValue;
            $jobposition = $account->getElementsByTagName("position")[0]->nodeValue;

        }
    }

?>  <div class = "formEdit">
        <h1>EDIT ACCOUNT</h1>
        <div class = "formLang">
                
            Company Name: <input id = "editcompany" type="text" value = <?php echo $Companyname?> name = "editcompany" ><br>
            Job Position: <input id = "editjobposition" type="text" value = <?php echo $jobposition?> name = "editjobposition" ><br>
            Email: <input id = "editEmail" type="text" value = <?php echo $email?> name = "editEmail" ><br>
            Username: <input id = "editUname" type="text" value = <?php echo $username?> name="editUname" ><br>
            Password: <input id = "editPassword" type="text" value = <?php echo $password?> name = "editPassword" ><br>
            First Name: <input id = "editFname" type="text" value = <?php echo $fname?> name="editFname" ><br>
            Last Name: <input id = "editLname" type="text" value = <?php echo $lname?> name="editLname" ><br>
            Gender: <input id = "editgender" type="text" value = <?php echo $gender?> name = "editgender" ><br>
            Number: <input id = "editnumber" type="text" value = <?php echo $number?> name = "editnumber" ><br>
            Address: <input id = "editaddress" type="text" value = <?php echo $address?> name = "editaddres" ><br>
            City: <input id = "editcity" type="text" value = <?php echo $city?> name = "editcity" ><br>
            Country: <input id = "editcountry" type="text" value = <?php echo $country?> name = "editcountry" ><br>
            Zip: <input id = "editzip" type="text" value = <?php echo $zip?> name = "editzip" ><br>
            <input id = "userID" type="text" name= "newID" value = "<?php echo $id ?>" style = "display: none">

            </div>
            <button id = "back" name = "back">Back</button>
            <button id = "submit" name = "submit">Submit</button>

    </div>

    <script>
            $("#back").click(function() {
                showAccounts();
            });
            $("#submit").click(function() {

           
                editEmail = $("#editEmail").val();
                editUname = $("#editUname").val();
                editPassword = $("#editPassword").val();
                editFname = $("#editFname").val();
                editLname = $("#editLname").val();
                editgender = $("#editgender").val();               
                editcompany = $("#editcompany").val(); 
                editnumber = $("#editnumber").val();
                editaddress = $("#editaddress").val();
                editcity = $("#editcity").val();
                editcountry = $("#editcountry").val();
                editzip = $("#editzip").val();
                editjobposition = $("#editjobposition").val();        
                userID = $("#userID").val();

$.ajax({
    method: "POST",
        url: "editProfileEmployer.php",
        data: "editEmail=" + editEmail + "&editUname=" + editUname + "&editPassword=" + editPassword + "&editFname=" + editFname +
        "&editLname=" + editLname + "&editgender=" + editgender + "&editnumber=" + editnumber + "&editaddress=" + editaddress + "&editcity=" + editcity + "&editcountry=" + editcountry + "&editzip=" + editzip + 
        "&editcompany=" + editcompany + "&editjobposition=" + editjobposition + "&newID=" + userID + "&submit=true" 
        }).done(function(response) {
            console.log(response);
            alert("Success!");
            showAccounts();
        });
                     
})
  
</script>
    <?php
}
    if (isset($_POST["submit"])) {
        $newID = $_POST["newID"];
        echo "<script>alert($newID)</script>";
        foreach ($accounts as $account) {
            $oldid = $account->getAttribute("id");
            $oldacc = $account->getAttribute("acc_type");
            if ($newID == $oldid) {

              
                $newEmail = $_POST["editEmail"];
                $newUname = $_POST["editUname"];
                $newPassword = md5 ($_POST["editPassword"]);
                $newFname = $_POST["editFname"];
                $newLname = $_POST["editLname"];
                $newgender = $_POST["editgender"];             
                $newcompany = $_POST["editcompany"];               
                $newNode = $xml->createElement("account");
                $newnumber = $_POST["editnumber"];
                $newaddress = $_POST["editaddress"];
                $newcity = $_POST["editcity"];
                $newcountry = $_POST["editcountry"];
                $newzip = $_POST["editzip"];
                $newjobposition = $_POST["editjobposition"];

                $newNode->setAttribute("id", $newID);
                $newNode->setAttribute("acc_type", $oldacc);
              
                
                $newNode->appendChild($xml->createElement("email", $newEmail));
                $newNode->appendChild($xml->createElement("username", $newUname));
                $newNode->appendChild($xml->createElement("password", $newPassword));
                $newNode->appendChild($xml->createElement("firstname", $newFname));
                $newNode->appendChild($xml->createElement("lastname", $newLname));
                $newNode->appendChild($xml->createElement("gender", $newgender ));             
                $newNode->appendChild($xml->createElement("CompanyName", $newcompany));
                $newNode->appendChild($xml->createElement("number", $newnumber ));
                $newNode->appendChild($xml->createElement("address", $newaddress ));
                $newNode->appendChild($xml->createElement("city", $newcity ));
                $newNode->appendChild($xml->createElement("country", $newcountry ));
                $newNode->appendChild($xml->createElement("zip", $newzip ));
                $newNode->appendChild($xml->createElement("position", $newjobposition));

                $oldNode = $account;
                $xml->getElementsByTagName("accounts")->item(0)->replaceChild($newNode, $oldNode);
                $xml->save("../database/accounts.xml");
                return;
            }
        }
    }

    if(isset($_POST['deleteID'])){

        $ID = $_POST['deleteID'];
        
        foreach($accounts as $account){
            if($ID == $account->getAttribute("id")){
                $xml->getElementsByTagName("accounts")[0]->removeChild($account);
                $xml->save("../database/accounts.xml");
                break;
            }
        }
        echo "<script>alert('Account Deleted')</script>";
        ?> <script> showAccounts() </script> <?php
    }
?>
