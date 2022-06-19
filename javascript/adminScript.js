$(document).ready(function(){
    navBTN();    
    dashboard()

    $("#dashboard").click(function(){
        dashboard();
    });
$("#signout").click(function(){
        logout();
    });
$("#employer").click(function(){
    showEmployer();
});
$("#seeker").click(function(){
    showSeeker();
});
$("#jobs").click(function(){
    showjobs();
});

});
function login(){
    var username = document.getElementById("loginUser").value;
    var passwordLogin = document.getElementById("loginpassword").value;
    if(username == "" || passwordLogin == "") {
        alert("Fill all the fields")
        return;
    }
    console.log(username)
    var accountData = ''
            + 'loginUser=' + window.encodeURIComponent(username)
            + '&passwordLogin=' + window.encodeURIComponent(passwordLogin);
    var error = "Invalid username or password";
    
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () =>{
            if (xhr.readyState == 4 && xhr.status == 200) {
                if (xhr.responseText == "Invalid") {
                    alert(error);
                }
                else {
                    document.getElementById("response").style.display = "none";
                    document.getElementById("response").innerHTML = xhr.responseText;
                    
                }
            }
        };
        
        xhr.open("POST", "loginValidation.php", true);
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhr.send(accountData);
}
function logout(){
    
    var buttonData = ''
    + 'buttonData=' + window.encodeURIComponent("logout");
    
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () =>{
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("response").style.display = "none";
                document.getElementById("response").innerHTML = xhr.responseText;
            }
        };
        
        xhr.open("POST", "loginValidation.php", true);
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhr.send(buttonData);
}

function navBTN(){
    $("#dashboard").click(function(){
        $("#dashboard").css("background-color", "rgba(30, 30, 30, 0)");
        $("#employer").css("background-color", "rgba(30, 30, 30, 0)");
        $("#seeker").css("background-color", "rgba(30, 30, 30, 0)");
        $("#schedules").css("background-color", "rgba(30, 30, 30, 0)");
        $("#signout").css("background-color", "rgba(30, 30, 30, 0)");
    });
    $("#employer").click(function(){
        $("#dashboard").css("background-color", "rgba(39, 39, 39, 0.220)");
        $("#employer").css("background-color", "rgba(30, 30, 30, 0)");
        $("#seeker").css("background-color", "rgba(30, 30, 30, 0)");
        $("#schedules").css("background-color", "rgba(30, 30, 30, 0)");
        $("#signout").css("background-color", "rgba(30, 30, 30, 0)");
    });
    $("#seeker").click(function(){
        $("#dashboard").css("background-color", "rgba(39, 39, 39, 0.220)");
        $("#employer").css("background-color", "rgba(30, 30, 30, 0)");
        $("#seeker").css("background-color", "rgba(30, 30, 30, 0)");
        $("#schedules").css("background-color", "rgba(30, 30, 30, 0)");
        $("#signout").css("background-color", "rgba(30, 30, 30, 0)");
    });
    $("#schedules").click(function(){
        $("#dashboard").css("background-color", "rgba(39, 39, 39, 0.220)");
        $("#employer").css("background-color", "rgba(30, 30, 30, 0)");
        $("#seeker").css("background-color", "rgba(30, 30, 30, 0)");
        $("#schedules").css("background-color", "rgba(30, 30, 30, 0)");
        $("#signout").css("background-color", "rgba(30, 30, 30, 0)");
    });
    $("#signout").click(function(){
        $("#dashboard").css("background-color", "rgba(39, 39, 39, 0.220)");
        $("#employer").css("background-color", "rgba(30, 30, 30, 0)");
        $("#seeker").css("background-color", "rgba(30, 30, 30, 0)");
        $("#schedules").css("background-color", "rgba(30, 30, 30, 0)");
        $("#signout").css("background-color", "rgba(30, 30, 30, 0)");
    });
  
  
}
function dashboard(){
    $.ajax({
        method: "post",
        url: "dashboard.php"
    }).done(function(response){
        $("#content").html(response);
        $("#dashboard").css("background-color", "rgba(39, 39, 39, 0.220)");
        $("#employer").css("background-color", "rgba(30, 30, 30, 0)");
        $("#seemer").css("background-color", "rgba(30, 30, 30, 0)");
        $("#schedules").css("background-color", "rgba(30, 30, 30, 0)");
        $("#signout").css("background-color", "rgba(30, 30, 30, 0)");
    });

}
//create
function editAccountsSeeker(id){
    console.log(id);
    $.ajax({
        method: "post",
        url: "crudAccountsSeeker.php",
        data: "editID=" + id
    }).done(function(response){
        $(".adminAccounts").html(response);
    });
}
function editAccountsEmployer(id){
    console.log(id);
    $.ajax({
        method: "post",
        url: "crudAccountsEmployer.php",
        data: "editID=" + id
    }).done(function(response){
        $(".adminAccounts").html(response);
    });
}
function deleteAccountsEmployer(id){
    if(confirm("Are you sure you want to delete this account with userID = " + id + "?")){

    }
    else {
        return;
    }
        $.ajax({
            method: "POST",
            url: "crudAccountsEmployer.php",
            data: "deleteID=" + id
        }).done(function(response){
            $(".adminAccounts").html(response);
       });
}
function deleteAccountsSeeker(id){
    if(confirm("Are you sure you want to delete this account with userID = " + id + "?")){

    }
    else {
        return;
    }
        $.ajax({
            method: "POST",
            url: "crudAccountsSeeker.php",
            data: "deleteID=" + id
        }).done(function(response){
            $(".adminAccounts").html(response);
       });
}
function showEmployer(){
    $.ajax({
        method: "POST",
        url: "accountsDatabaseEmployer.php"
        
    }).done(function(response){
        $("#content").html(response);
    });
}
function showSeeker(){
    $.ajax({
        method: "POST",
        url: "accountsDatabaseSeeker.php"
        
    }).done(function(response){
        $("#content").html(response);
    });
}
function showCreateSeeker(){
    $.ajax({
        method: "POST",
        url: "createAccountSeeker.php"
    }).done(function(response){
        $(".adminAccounts").html(response);
    });
}
function showCreateEmployer(){
    $.ajax({
        method: "POST",
        url: "createAccountEmployer.php"
    }).done(function(response){
        $(".adminAccounts").html(response);
    });
}
function newAccountSeeker(){

    acc_type = $("#acc_type").val();
    email = $("#email").val();
    password = $("#password").val();
    field = $("#field").val();
    username = $("#username").val();
    fname = $("#fname").val();
    lname = $("#lname").val();
     gender = $("#gender").val();
     number = $("#number").val();
     address = $("#address").val();
     city = $("#city").val();
     country = $("#country").val();
     zip = $("#zip").val();
     resume = $("#resume").val();
     skills = $("#skills").val();
     qualifications = $("#qualifications").val();
     experience = $("#experience").val();


  console.log(field);
    $.ajax({
        method: "post",
        url: "crudAccountsSeeker.php",
        data: "newAccountSeeker=1" + "&acc_type=" + acc_type + "&email=" + email + "&field=" + field + "&password=" + password + "&username=" + username + "&fname=" + fname  + "&lname=" + lname
       + "&gender=" + gender + "&number=" + number + "&address=" + address + "&city=" + city + "&country=" + country + "&zip=" + zip + 
         "&resume=" + resume + "&skills=" + skills + "&qualifications=" + qualifications + "&experience=" + experience
    }).done(function(response){
  console.log(response);
       showSeeker();
    });
}
function newAccountEmployer(){

    acc_type = $("#acc_type").val();
    email = $("#email").val();
    password = $("#password").val();
    username = $("#username").val();
    fname = $("#fname").val();
    lname = $("#lname").val();
     gender = $("#gender").val();
     number = $("#number").val();
     address = $("#address").val();
     city = $("#city").val();
     country = $("#country").val();
     zip = $("#zip").val();
     company = $("#company").val();
     Jobposition = $("#Jobposition").val();
     

    $.ajax({
        method: "post",
        url: "crudAccountsEmployer.php",
        data: "newAccountEmployer=1" + "&acc_type=" + acc_type + "&email=" + email + "&password=" + password + "&username=" + username + "&fname=" + fname  + "&lname=" + lname
       + "&gender=" + gender + "&number=" + number + "&address=" + address + "&city=" + city + "&country=" + country + "&zip=" + zip + "&company=" + company + "&jobposition=" + Jobposition 
         
    }).done(function(response){
  console.log(response);
     showEmployer();
    });
}
function editJobs(editID){
    $.ajax({
        method: "POST",
        url: "crudJobs.php",
        data: "editid=" + editID
    }).done(function(response){
        $(".adminSched").html(response);
   });
}
function deleteJobs(deleteid){
    console.log("pumasok");
    if(confirm("Are you sure you want to Delete this Job with ID = " + deleteid + "?")){

    }
    else {
        return;
    }
    $.ajax({
        method: "POST",
        url: "crudJobs.php",
        data: "deleteid=" + deleteid
    }).done(function(response){
        $(".adminSched").html(response);
   });
}
function showjobs(){
    $.ajax({
        method: "POST",
        url: "Jobs.php"
        
    }).done(function(response){
        $("#content").html(response);
    });
}
function showApplications(){
    $.ajax({
        method: "POST",
        url: "applicationsDatabase.php"
        
    }).done(function(response){
        $("#content").html(response);
    });
}