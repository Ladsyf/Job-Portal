<?php
session_start();
if(isset($_SESSION['username'])){
    header('location: home.php');
}
?>
<html>
<?php
    include 'navbar.php';

?>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="javascript/jquery-3.6.0.js">
        </script>
            <script src="javascript/script.js">
        </script>
    </head>

    <body>
<div class = "content">
    <div>
        <div class = "find">
            <p>FRESH<br>
            TALENT<br>
            TOPMOST<br>
            EMPLOYERS<br>
            create your future <br>with us!<br></p>
            <button>Find Talent</button>
            <button>Find a Job</button>
        </div>
    </div>

        <div class = "yellow">
            <div>
            <img class= "pencil" src="images/pencil1.jpg" alt="">
            <br>Graphic Designer
            </div>
            <div>
            <img class= "paper" src="images/paper.png" alt="">
            <br>Copywriters
            </div>
            <div>
            <img class= "bulb" src="images/bulb.png" alt="">
            <br>Creative Directors
            </div>
            <div>
            <img class= "time" src="images/time.jpg" alt="">
            <br>Client Manager
            </div>
            <div>
            <img class= "programmer" src="images/programmer.jpg" alt="">
            <br>Programmer
            </div>
        </div>

      </div>

    </body>

</html>