$(document).ready(function(){

    $("#registerDROP").click(function(){
        if ($(".loginAS").css("display") == "block"){
            $(".loginAS").hide();
        }
        $(".registerAS").toggle();
    });

    $("#loginDROP").click(function(){
        if ($(".registerAS").css("display") == "block"){
            $(".registerAS").hide();
        }
        $(".loginAS").toggle();
    })
    $("#usernameBTN").click(function(){
        $(".usernameDROP").toggle();
    });
    //ajax register
    $("#register").click(function(){
        email = $("#email").val();
        username = $("#username").val();
        fname = $("#fname").val();
        lname = $("#lname").val();
        p1 = $("#password").val();
        p2 = $("#password2").val();
        cname = $("#cname").val();
        jposition = $("#jposition").val();
        interestcategories = $("#interestcategories").val();
        acc_type = $("#acc_type").val();
        if (acc_type == "employer"){
        if(jposition == null || cname == null){
            email = null;
        }}
        $.ajax({
            method: "post",
            url: "processes/registerPRC.php",
            data: "email=" + email + "&username=" + username
            + "&fname=" + fname + "&lname="+ lname + "&password=" 
            + p1 + "&password2=" + p2 + "&acc_type=" + acc_type
            + "&interestcategories=" + interestcategories + "&cname="
            + cname + "&jposition=" + jposition
        }).done(function(response) {
            $("#errors").html(response);
        });

    });


    //ajax login
    $("#login").click(function(){
        username = $("#username").val();
        password = $("#password").val();
        acc_type = $("#acc_type").val();

        $.ajax({
            method: "post",
            url: "processes/loginPRC.php",
            data: "username=" + username + "&password=" + password
            + "&acc_type=" + acc_type
        }).done(function(response){
            $("#errors").html(response);
        });

    });

    //search job
    $("#searchBTN").click(function(){
        viewJobs();
    });
    showJobApplications();
    pagination();

});

function viewJobs(){
    query = $("#search").val();
    loc = $("#loc").val();
    skills = $("#skills").val();
    job_type = $("#job_type").val();


    $.ajax({
        method: "get",
        url: "processes/viewJobs.php",
        data: "searchquery=" + query + "&loc=" + loc + "&skills=" + skills + 
        "&job_type=" + job_type
    }).done(function(response){
        $("#jobs").html(response);
    });

}
function createJob(){ 
    field = $("#field").val();
    job_type = $("#job_type").val();
    job_title = $("#job_title").val();
    loclang = $("#location").val();
    zip = $("#zip").val();
    salary = $("#salary").val();
    description = $("#description").val();
    qualification = $("#qualification").val();
    employerID = $("#employerID").val();

    $.ajax({
        method: "post",
        url: "processes/createJobPRC.php",
        data: "title=" + job_title + "&field=" +field+ "&job_type=" + job_type + "&location=" + loclang +  "&zip=" +zip+ 
        "&salary=" +salary+ "&description=" +description+ "&qualification=" +qualification + "&id=" + employerID
    }).done(function(response){
        if(response){
        $("#errors").html(response);
        return;
        }
        else {
        alert("Job Created!");
        window.location.replace("home.php");
        }
    });
}
function toggleJobStatus(id){
    if(!confirm("Are you sure you want to deactivate this job?")){
        return;
    }
    $.ajax({
        method: "post",
        url: "processes/jobsPRC.php",
        data: "toggleStatus=1" + "&jobID=" + id
    }).done(function(response){// add confirmation
      window.location.replace("jobsPosted.php");
    });
}
function editJobBTN(id){ // dito na ko
    $.ajax({
        method: "post",
        url: "processes/jobsPRC.php",
        data: "ShoweditJob=1" + "&jobID=" + id
    }).done(function(response){
        $("#jobsYouPosted").html(response);

    });
}
function editJob(id){
    job_type = $("#job_type").val();
    field = $("#field").val();
    job_title = $("#job_title").val();
    loc = $("#location").val();
    zip = $("#zip").val();
    salary = $("#salary").val();
    description = $("#description").val();
    qualification = $("#qualification").val();
    currentstatus = $("#status").val();;

    $.ajax({
        method: "post",
        url: "processes/jobsPRC.php",
        data: "editJob=1" + "&jobID=" + id + "&job_type=" + job_type + "&field=" + field + 
        "&job_title=" + job_title + "&location=" + loc + "&zip=" + zip + 
        "&salary=" + salary + "&description=" + description + 
        "&qualification=" + qualification + "&status=" + currentstatus
    }).done(function(response){ // maglagay ng confirmation/successfully updated
        if(response){
        $("#errors").html(response);
        return;
        }
        alert("Changes Saved!");
        window.location.replace("jobsPosted.php");
    });
}

function deleteJobBTN(id){
    if(!confirm("Are you sure you want to delete this job posting?")){
        return;
    }
    $.ajax({
        method: "post",
        url: "processes/jobsPRC.php",
        data: "deleteJob=1" + "&jobID=" + id
    }).done(function(response){
        if(response){
        $("#errors").html(response);
        return;
        }
        window.location.replace("jobsPosted.php");
    });  
}
function viewSelectedJobBTN(id){
    $.ajax({
        method: "get",
        url: "processes/viewJobs.php",
        data: "jobView=1" + "&jobID=" + id
    }).done(function(response){
        $("#backgroundblock").show();
        $(".jobView").show();
        $(".jobView").html(response);
        
    }); 
}
function hideSelectedJobBTN(){
    $("#backgroundblock").hide();
    $(".jobView").hide();
    $(".applicantShow").hide();
}
function applyOnSelectedJobBTN(id){
    // alert(id);
    // return;
    $.ajax({
        method: "post",
        url: "processes/jobsPRC.php",
        data: "applyJob=1" + "&jobID=" + id
    }).done(function(response){
        if(response){
            alert(response);
            return;
        }
        else{
        alert("Application Sent!");
        hideSelectedJobBTN();
        }
    });
}
function applicantShow(id, jobID, stats){
    $.ajax({
        method: "post",
        url: "processes/viewApplicant.php",
        data: "applicantShow=1" + "&userID=" + id + "&jobID=" + jobID + "&stats=" + stats
    }).done(function(response){
        $("#backgroundblock").show();
        $(".applicantShow").show();
        $(".applicantShow").html(response);
    });
}
function rejectApplication(jobID, userID){
    $.ajax({
        method: "post",
        url: "processes/applicantPRC.php",
        data: "rejectApplicant=1" + "&jobID=" + jobID + "&userID=" + userID
    }).done(function(response){
        alert("applicant rejected.");
        hideSelectedJobBTN();
        showJobApplications();
    });
}
function approveApplication(jobID, userID){
    $.ajax({
        method: "post",
        url: "processes/applicantPRC.php",
        data: "approveApplication=1" + "&jobID=" + jobID + "&userID=" + userID
    }).done(function(response){
        alert("applicant approved.");
        hideSelectedJobBTN();
        showJobApplications();
    });
}
function undoapproveApplication(jobID, userID){
    $.ajax({
        method: "post",
        url: "processes/applicantPRC.php",
        data: "undoapproveApplication=1" + "&jobID=" + jobID + "&userID=" + userID
    }).done(function(response){
        alert("applicant disapproved.");
        hideSelectedJobBTN();
        showJobApplications();
    });
}
function archiveApplication(jobID, userID){
    $.ajax({
        method: "post",
        url: "processes/applicantPRC.php",
        data: "archiveApplication=1" + "&jobID=" + jobID + "&userID=" + userID
    }).done(function(response){
        alert("applicant approved.");
        hideSelectedJobBTN();
        showJobApplications();
    });
}
function showJobApplications(){
    $.ajax({
        method: "post",
        url: "processes/viewApplications.php",
    }).done(function(response){
        $(".jobseekersApplied").html(response);
    });

}
function pagination(){

	pageSize = 5 ;

	var pageCount =  $(".line-content").length / pageSize;
    
     for(var i = 0 ; i<pageCount;i++){
        
       $("#pagin").append('<li><a href="#">'+(i+1)+'</a></li> ');
     }
        $("#pagin li").first().find("a").addClass("current")
    showPage = function(page) {
	    $(".line-content").hide();
	    $(".line-content").each(function(n) {
	        if (n >= pageSize * (page - 1) && n < pageSize * page)
	            $(this).show();
	    });        
	}
    
	showPage(1);

	$("#pagin li a").click(function() {
	    $("#pagin li a").removeClass("current");
	    $(this).addClass("current");
	    showPage(parseInt($(this).text())) 
	});


}
function editJobAlert(id){
    $.ajax({
        method: "post",
        url: "processes/jobAlertsPRC.php",
        data: "showEditJob=" + id
    }).done(function(response){
        console.log(response);
        $("#jobAlerts").html(response);

    });

}
function saveEditJob(id, userID, alert_type){
    keyword = $("#keyword").val();
    loc = $("#location").val();
    job_type = $("#job_type").val();
    $.ajax({
        method: "post",
        url: "processes/jobAlertsPRC.php",
        data: "saveEditJob=" + id + "&userID=" + userID +
        "&alert_type=" + alert_type + "&keyword=" + keyword + 
        "&job_type=" + job_type + "&loc=" + loc
    }).done(function(response){
        if(response){
        $("#errors").html(response);
        return;
        }
        alert("Changes Saved!");
        window.location.replace("jobAlerts.php");

    });
}
function deleteJobAlert(id){
    if(!confirm("Are you sure you want to delete this job alert?")){
        return;
    }
    $.ajax({
        method: "post",
        url: "processes/jobAlertsPRC.php",
        data: "deleteID=" + id
    }).done(function(){
        alert("Job alert deleted!");
        window.location.reload();
    });

}
function createJobAlert(type){
    $.ajax({
        method: "post",
        url: "processes/jobAlertsPRC.php",
        data: "createType=" + type
    }).done(function(response){
        $("#jobAlerts").html(response);

    });
    
}
function createNewJobAlertBTN(type){
    keyword = $("#keyword").val();
    loc = $("#location").val();
    job_type = $("#job_type").val();

    $.ajax({
        method: "post",
        url: "processes/jobAlertsPRC.php",
        data: "newCreateType=" + type + "&keyword=" + keyword + "&loc=" + loc
        + "&job_type=" + job_type
    }).done(function(response){
        if(response){
        $("#errors").html(response);
        return;
        }
        alert("Alert Created!");
        window.location.replace("jobAlerts.php");

    });
}
function cancelCreateJobAlert(){
    window.location.replace("jobAlerts.php");
}
function editJobseekerProfile(){
    if(!confirm("Are you sure you want to save changes?")){
        return;
    }
    lname = $("#editLname").val();
    fname = $("#editFname").val();
    username = $("#editUname").val();
    email = $("#editEmail").val();
    contactnumber = $("#editnumber").val();
    gender = $("#editgender").val();
    address = $("#editaddress").val();
    city = $("#editcity").val();
    zip = $("#editzip").val();
    country = $("#editcountry").val();
    skills = $("#editskills").val();
    qualifications = $("#editqualifications").val();
    experience = $("#editexperience").val();
    oldpw = $("#oldpw").val();
    confirmpw = $("#confirmpw").val();
    newpw = $("#newpw").val();

    $.ajax({
        method: "post",
        url: "processes/editProfile.php",
        data: "editJobSeeker=1" + "&editFname=" + fname + "&editLname=" + lname + "&editUname=" + username +
        "&editEmail=" + email + "&editnumber=" + contactnumber + 
        "&editgender=" + gender + "&editaddress=" + address +
        "&editcity=" + city + "&editzip=" +zip+"&editcountry=" +country+
        "&editskills=" +skills+"&editqualifications=" +qualifications
        +"&editexperience=" +experience+
        "&oldpw=" +oldpw+"&confirmpw=" +confirmpw+"&newpw=" +newpw
    }).done(function(response){
        if(response){
            alert(response);
            return;
        }
        alert("Changes Saved!");
        window.location.reload();
    });
}
function logout(){
    if(!confirm("Are you sure you want to log out?")){
        return;
    }
    $.ajax({
        method: "post",
        url: "processes/logout.php"
    }).done(function(){
        window.location.reload();
    });
}
function editEmployerProfile(){
    if(!confirm("Are you sure you want to save changes?")){
        return;
    }
    lname = $("#editLname").val();
    fname = $("#editFname").val();
    username = $("#editUname").val();
    email = $("#editEmail").val();
    contactnumber = $("#editnumber").val();
    gender = $("#editgender").val();
    address = $("#editaddress").val();
    companyname = $("#editCompany").val();
    city = $("#editcity").val();
    zip = $("#editzip").val();
    country = $("#editcountry").val();
    oldpw = $("#oldpw").val();
    confirmpw = $("#confirmpw").val();
    newpw = $("#newpw").val();
    position = $("#editPosition").val();
    $.ajax({
        method: "post",
        url: "processes/editProfile.php",
        data: "editEmployer=1" + "&editFname=" + fname + "&editLname=" + lname + "&editUname=" + username +
        "&editEmail=" + email + "&editnumber=" + contactnumber + 
        "&editgender=" + gender + "&editaddress=" + address +
        "&editcity=" + city + "&editzip=" + zip + "&editcountry=" + country +
        "&oldpw=" +oldpw+"&confirmpw=" +confirmpw+"&newpw=" +newpw + "&editPosition=" + position
        + "&comapanyname=" + companyname
    }).done(function(response){
        if(response){
            alert(response);
            return;
        }
        alert("Changes Saved!");
        window.location.reload();
    });
}
function deleteAccount(id){
    if(!confirm("Are you sure you want to delete your account?")){
        return;
    }
    $.ajax({
        method: "post",
        url: "processes/editProfile.php",
        data: "deleteID=" + id
    }).done(function (){
        window.location.replace("index.php");
    });
}