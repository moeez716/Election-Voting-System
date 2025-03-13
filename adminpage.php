<?php
include "connection.php";
$adminid="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $adminid=$_POST["adminid"];
    $adminselect="SELECT * FROM `admin` WHERE AdminID='$adminid'";

    $adminresult=mysqli_query($conn,$adminselect);
    if(mysqli_num_rows($adminresult)>0){
        $adminrow=mysqli_fetch_assoc($adminresult);
    }
    
    if(isset($_POST["action"])){
        if($_POST["action"]=="register"){
    $name=$_POST["name"];
    $cnic=$_POST["cnic"];
    $email=$_POST["email"];
    $pass=$_POST["passwordReg"];
    $venue=$_POST["venue"];
    
    $selection="SELECT * FROM `users` WHERE cnic='$cnic' || Email='$email'";
    $result=mysqli_query($conn,$selection);
    if(mysqli_num_rows($result)>0){
        echo "<script>alert('CNIC Or Email Already Exist!')</script>";
    }
    else{
        $insert="INSERT INTO `users`(`cnic`, `Name`, `Email`, `Password`,`VenueID`) VALUES ('$cnic','$name','$email','$pass',$venue)";
    
    if(mysqli_query($conn,$insert)){
        echo "<script> alert('registeration sucessfully')</script>";
    }
    


    }
}

else if($_POST["action"]=="register_candidate"){
    $name=$_POST["name"];
    $cnic=$_POST["cnic"];
    $email=$_POST["email"];
    $partyid=$_POST["partyid"];
    $position=$_POST["position"];
$selectioncandidate="SELECT * FROM `candidate` WHERE cnic='$cnic' or Email='$email'";
$result=mysqli_query($conn,$selectioncandidate);
if(mysqli_num_rows($result)>0){
    echo "<script>alert('CNIC Or Email Already Exist!')</script>";
}
else{
    $insert="INSERT INTO `candidate`(`cnic`, `Name`, `Email`, `PartyID`, `position`) VALUES ('$cnic','$name','$email','$partyid','$position')";
    if(mysqli_query($conn,$insert)){
        echo "<script> alert('Candidate registeration sucessfully')</script>";
    }
}

}
else if($_POST["action"]=="PartyRegister"){
    $partyname=$_POST["partyname"];
    $partyid=$_POST["partyid"];
$select="SELECT * FROM `party` WHERE PartyID='$partyid' ";
$result=mysqli_query($conn,$select);
if(mysqli_num_rows($result)>0){
    echo "<script>alert('Party Number already exist!')</script>";
}
else{
$insert="INSERT INTO `party`(`PartyID`, `Name`) VALUES ('$partyid','$partyname')";
if(mysqli_query($conn,$insert)){
    echo "<script> alert('party registeration sucessfully')</script>";
}
}
}
else if($_POST["action"]=="venueregister"){
$venueNumber=$_POST["venuenumber"];
$venueaddress=$_POST["venueAddress"];
$select="SELECT * FROM `venue` WHERE VenueID='$venueNumber'";
$result=mysqli_query($conn,$select);
if(mysqli_num_rows($result)>0){
    echo "<script>alert('Venue Number already exist!')</script>";

}
else{
    $insert="INSERT INTO `venue`(`VenueID`, `VenueAddress`) VALUES ('$venueNumber','$venueaddress')";
    if(mysqli_query($conn,$insert)){
        echo "<script> alert('venue registeration sucessfully')</script>";
    }
}
}
else if($_POST["action"]=="pollregister"){
$title=$_POST["title"];
$startdate=$_POST["sdate"];
$enddate=$_POST["edate"];
$insertpoll="INSERT INTO `poll`(`Title`, `AdminID`,`StartDate`, `EndDate`) VALUES ('$title','$adminid','$startdate','$enddate')";
if(mysqli_query($conn,$insertpoll)){
    echo "<script> alert('Poll registeration sucessfully')</script>";
}
}
elseif ($_POST["action"] == "upollregister") {
    $pollid = $_POST["pollid"];  // Make sure this matches the form
    $startdate = $_POST["sdate"];
    $enddate = $_POST["edate"];

    
        $updatepoll = "UPDATE poll SET StartDate='$startdate', EndDate='$enddate' WHERE PollID='$pollid'";
        if (mysqli_query($conn, $updatepoll)) {
            echo "<script>alert('Poll updated successfully');</script>";
        } else {
            echo "<script>alert('Error updating poll');</script>";
        }
    
}
else if($_POST["action"]=="vcregister"){
    $usercnic=$_POST["usercnic"];
    $vid=$_POST["vid"];
    $pid=$_POST["pid"];
    $select="SELECT * FROM `venuecandidate` WHERE VenueID='$vid' and CandidateID='$usercnic'";
    $result=mysqli_query($conn,$select);
    if(mysqli_num_rows($result)>0){
        echo "<script> alert('candidate already registered in this venue')</script>";
    }
    else{
        $insert="INSERT INTO `venuecandidate`(`VenueID`, `CandidateID`,`PollID`) VALUES ('$vid','$usercnic','$pid')";
        if(mysqli_query($conn,$insert)){
            echo "<script> alert('candidate registered in this venue')</script>";
        }
    }
}
    }    
    //

}

else if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET["adminid"])){
    
        $adminid=$_GET["adminid"];
        $adminselect="SELECT * FROM `admin` WHERE AdminID='$adminid'";
    
        $adminresult=mysqli_query($conn,$adminselect);
        if(mysqli_num_rows($adminresult)>0){
            $adminrow=mysqli_fetch_assoc($adminresult);
        }

        $partyselection = "SELECT * FROM `party`";
        $partyResult = mysqli_query($conn, $partyselection);
        $venueselect="SELECT * FROM `venue`";
    $venueresult=mysqli_query($conn,$venueselect);
    $pollselection="SELECT * FROM `poll`";
    $pollresult=mysqli_query($conn,$pollselection);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polling</title>
    <link rel="stylesheet" href="indexstyle.css">
    <style>
 
  body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
            color: #333;
        }
       .cont h1 {
            color:  #043523;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            width: 300px;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }
        .card button {
            background: #6e9b9c; /* Muted Teal */
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .card button:hover {
            background: #478484;
        }
        .form-container {
    visibility: hidden;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.8);
    padding: 30px;
    border: 1px solid #ccc;
    border-radius: 10px;
    width: 90%;
    max-width: 600px;
    background-color: #ffffff;
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    opacity: 0;
    transition: all 0.3s ease-in-out;
}

.form-container.active {
    visibility: visible;
    transform: translate(-50%, -50%) scale(1);
    opacity: 1;
}

.form-container h2 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 1.5rem;
    color: #333;
    font-weight: 600;
}

.form-container .form-group {
    margin-bottom: 15px;
    position: relative;
}

.form-container label {
    display: block;
    margin-bottom: 5px;
    font-size: 0.9rem;
    font-weight: bold;
    color: #555;
}

.form-container input, 
.form-container select {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1rem;
    transition: border-color 0.3s ease-in-out;
    background-color: #f9f9f9;
}

.form-container input:focus, 
.form-container select:focus {
    border-color: #007bff;
    outline: none;
    background-color: #ffffff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

.form-container input[type="submit"], 
.form-container button {
    background-color: #007bff;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    padding: 10px 15px;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    transition: background-color 0.3s ease-in-out, transform 0.2s;
}

.form-container input[type="submit"]:hover, 
.form-container button:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
}

.form-container .close-btn {
    background-color: red;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 0.9rem;
    font-weight: bold;
    transition: background-color 0.3s ease-in-out;
}

.form-container .close-btn:hover {
    background-color: darkred;
}

.form-container .buttons {
    text-align: center;
    margin-top: 20px;
}

.form-container .error {
    color: red;
    font-size: 0.8rem;
    margin-top: 5px;
    display: block;
}

@media (max-width: 768px) {
    .form-container {
        width: 90%;
        padding: 20px;
    }

    .form-container h2 {
        font-size: 1.3rem;
    }

    .form-container input, 
    .form-container select {
        font-size: 0.9rem;
    }

    .form-container input[type="submit"], 
    .form-container button {
        font-size: 0.9rem;
}
}
        .overlay {
            visibility: hidden;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            transition-duration: 0.3s;
        }
        .overlay.active {
            visibility: visible;
            opacity: 1;
        }
        @media (max-width: 768px) {
            .card {
                width: 90%;
            }
        }
        .hero {
  background: linear-gradient(135deg, #1d362e, #6f918c); /* Dark Reddish Brown to Taupe */
  color: #fff;
  padding: 3rem 0;
  
  background-image: url('hero.jpg');
  background-size: cover;
  background-position: center;
}
@media (min-width: 1440px) {
  .header-container h1 {
    font-size: 50px;
  }
}
.hero-text p {
  font-size: 1.2rem;
  margin-bottom: 2rem;
  color: #043523;
  
}
button {
            background: #6e9b9c; /* Muted Teal */
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background: #478484;
        }
    </style>
</head>
<body>


<header>
    <div class="container header-container">
      <h1>Election Voting System</h1>
      <nav>
        <ul class="nav-links">
        <li><a href="index.html">Home</a></li>  
        <li><a href="adminlogin.php">Admin Dashboard</a></li>
          <li><a href="vote.php">Vote Now</a></li>
          <li><a href="count.php">Result</a></li>
          
        </ul>
        <button class="menu-toggle" id="menuToggle">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </nav>
    </div>
  </header>

  <main>
    <!-- Hero Section -->
    <section class="hero" >
      <div class="container hero-container">
        <div class="hero-text">
          <h2>Welcome Admin</h2>
          <b><p>Participate in free and fair elections with our secure online voting system. Every vote counts!</p></b>
          
        </div>
        <div class="hero-image">
         
        </div>
      </div>
    </section>


    <script src="indexscript.js"></script>

<?php if ($adminid != "" && !empty($adminrow)) { ?>
    <div class="cont">
    <center><h1><?php echo $adminrow['Name']; ?></h1></center>
    </div>
    <div class="card-container">
        <div class="card">
            <form method="get">
                <input type="hidden" name="adminid" value="<?php echo $adminid; ?>">
                <input type="hidden" name="action" value="registeruser">
                <button>Register User +</button>
            </form>
        </div>
        <div class="card">
            <form method="get">
                <input type="hidden" name="adminid" value="<?php echo $adminid; ?>">
                <input type="hidden" name="action" value="candidatereg">
                <button>Candidate Registration +</button>
            </form>
        </div>
        <div class="card">
            <form method="get">
                <input type="hidden" name="adminid" value="<?php echo $adminid; ?>">
                <input type="hidden" name="action" value="partyreg">
                <button>Party Registration +</button>
            </form>
        </div>
        <div class="card">
            <form method="get">
                <input type="hidden" name="adminid" value="<?php echo $adminid; ?>">
                <input type="hidden" name="action" value="venuereg">
                <button>Venue Registration +</button>
            </form>
        </div>
        <div class="card">
            <form method="get">
                <input type="hidden" name="adminid" value="<?php echo $adminid; ?>">
                <input type="hidden" name="action" value="pollreg">
                <button>POLL Registration +</button>
            </form>
        </div>
        <div class="card">
            <form method="get">
                <input type="hidden" name="adminid" value="<?php echo $adminid; ?>">
                <input type="hidden" name="action" value="upollreg">
                <button>POLL Update</button>
            </form>
        </div>
        <div class="card">
            <form method="get">
                <input type="hidden" name="adminid" value="<?php echo $adminid; ?>">
                <input type="hidden" name="action" value="vcreg">
                <button>Candidate Venue Registration +</button>
            </form>
        </div>
    </div>
<?php } ?>

<div class="overlay" id="overlay">
    <div class="form-container" id="registrationForm">
        <form action="adminpage.php" method="post">
        <input type="hidden" name="adminid" value="<?php echo $adminid; ?>">
        <button type="submit" class="close-btn">X</button>

        </form>
        <form onsubmit="return validation()" method="post" action="adminpage.php">
            
           
            <h2>User Registration</h2>
            <input type="hidden" name="adminid" value="<?php echo $adminid; ?>">
            <div class="form-group">
            <input type="hidden" name="action" value="register">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name">
                <span class="error" id="nameerror"></span>
            </div>
            <div class="form-group">
                <label for="cnic">CNIC:</label>
                <input type="text" id="cnic" name="cnic" maxlength="15" placeholder="12345-1234567-3">
                <span class="error" id="usererror"></span>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
                <span class="error" id="emailerror"></span>
            </div>
            <div class="form-group">
                <label for="vid">select Venue number</label>
                <select name="venue" id="venue" required>
                <?php
    
    while ($venueRow = mysqli_fetch_assoc($venueresult)) {
        echo "<option value='" . $venueRow['VenueID'] . "'>" . $venueRow['VenueID'] . "</option>";
    }
    ?>
                </select>
                <span class="error" id="venueerror"></span>
            </div>
            <div class="form-group">
                <label for="passwordReg">Password:</label>
                <input type="password" id="passwordReg" name="passwordReg">
                <span class="error" id="passerror"></span>
            </div>
            <div class="buttons">
                <button type="submit">Register</button>
            </div>
        </form>
    </div>

    <div class="form-container" id="candidateRegistrationForm">
    <form action="adminpage.php" method="post">
        <input type="hidden" name="adminid" value="<?php echo $adminid; ?>">
        <button type="submit" class="close-btn">X</button>
        </form>
        <form onsubmit="return candidateValidation()" method="post" action="adminpage.php">
            <input type="hidden" name="action" value="register_candidate">
            
            <h2>Candidate Registration</h2>
            <div class="form-group">
            <input type="hidden" name="adminid" value="<?php echo $adminid; ?>">
                <label for="candidateName">Name:</label>
                <input type="text" id="candidateName" name="name" >
                <span class="error" id="candidateNameError"></span>
            </div>
            <div class="form-group">
                <label for="candidateCnic">CNIC:</label>
                <input type="text" id="candidateCnic" name="cnic" maxlength="15" placeholder="12345-1234567-3" >
                <span class="error" id="candidateCnicError"></span>
            </div>
            <div class="form-group">
                <label for="candidateEmail">Email:</label>
                <input type="email" id="candidateEmail" name="email">
                <span class="error" id="candidateEmailError"></span>
            </div>
            <div class="form-group">
                <label for="party">Party:</label>
                <select name="partyid" id="partyid" >
    <?php
    
    while ($partyRow = mysqli_fetch_assoc($partyResult)) {
        echo "<option value='" . $partyRow['PartyID'] . "'>" . $partyRow['Name'] . "</option>";
    }
    ?>
</select>
                
                <span class="error" id="partyError"></span>
            </div>
            <div class="form-group">
                <label for="candidateposition">Position:</label>
                <select name="position" id="position">
                    <option value="MNA">MNA</option>
                    <option value="MPA">MPA</option>
                </select>
                <span class="error" id="candidatePasswordError"></span>
            </div>
            <BR></BR>
            <div class="buttons">
                <button type="submit">Register Candidate</button>
            </div>
        </form>
    </div>
    <div class="form-container" id="partyRegisterationForm">
    <form action="adminpage.php" method="post">
        <input type="hidden" name="adminid" value="<?php echo $adminid; ?>">
        <button type="submit" class="close-btn">X</button>
        </form>
        <form action="adminpage.php" method="post" onsubmit="return validatePartyForm()">
        <h2>Party Registration</h2>
        <input type="hidden" name="action" value="PartyRegister">
        <div class="form-group">
            <label for="partyid">Party Number:</label>
            <input type="text" id="partyid" name="partyid">
            <span class="error" id="partyiderror"></span>
        </div>
        <div class="form-group">
            <label for="partyname">Party Name:</label>
            <input type="text" id="partyname" name="partyname">
            <span class="error" id="partynameerror"></span>
        </div>
        <div class="buttons">
            <button type="submit">Register</button>
        </div>
  </form>
</div>
    <div class="form-container" id="venueRegister">
        <form action="adminpage.php" method="post">
        <input type="hidden" name="adminid" value="<?php echo $adminid; ?>">
        <button type="submit" class="close-btn">X</button>

        </form>
        <form onsubmit="return validation3()" method="post" action="adminpage.php">
            
           
            <h2>Venue Registeration</h2>
            <div class="form-group">
            <input type="hidden" name="action" value="venueregister">
            <input type="hidden" name="adminid" value="<?php echo $adminid; ?>">
                <label for="venuenumber">Venue Number:</label>
                <input type="number" id="venuenumber" name="venuenumber" >
                <span class="error" id="venuenumbererror"></span>
            </div>
            <div class="form-group">
                <label for="VenueAddress">Address:</label>
                <input type="text" id="venueaddress" name="venueAddress" >
                <span class="error" id="venueaddresserror"></span>
            </div>
            <div class="buttons">
                <button type="submit">Register</button>
            </div>
        </form>
    </div>

    <div class="form-container" id="pollRegister">
        <form action="adminpage.php" method="post">
        <input type="hidden" name="adminid" value="<?php echo $adminid; ?>">
        <button type="submit" class="close-btn">X</button>

        </form>
        <form onsubmit="return validation4()" method="post" action="adminpage.php">
            
           
            <h2>POLL Registeration</h2>
            <div class="form-group">
            <input type="hidden" name="action" value="pollregister">
            <input type="hidden" name="adminid" value="<?php echo $adminid; ?>">
                <label for="Title">Title:</label>
                <input type="text" id="title" name="title" >
                <span class="error" id="titleerror"></span>
            </div>
            <div class="form-group">
                <label for="sdate">Start Date:</label>
                <input type="datetime-local" id="sdate" name="sdate" >
                <span class="error" id="sdateerror"></span>
            </div>
            <div class="form-group">
                <label for="edate">End Date:</label>
                <input type="datetime-local" id="edate" name="edate" >
                <span class="error" id="edateerror"></span>
            </div>
            <div class="buttons">
                <button type="submit">Register</button>
            </div>
        </form>
    </div>

    <div class="form-container" id="upollRegister">
    <form action="adminpage.php" method="post">
        <input type="hidden" name="adminid" value="<?php echo $adminid; ?>">
        <button type="submit" class="close-btn">X</button>
    </form>
    <form method="post" action="adminpage.php">
        <h2>POLL Update</h2>
        <input type="hidden" name="action" value="upollregister">
        <input type="hidden" name="adminid" value="<?php echo $adminid; ?>">

        <div class="form-group">
            <label for="pollid">Title</label>
            <select name="pollid" id="pollid" required>
                <?php
                while ($pollRow = mysqli_fetch_assoc($pollresult)) {
                    echo "<option value='" . $pollRow['PollID'] . "'>" . $pollRow['Title'] . "</option>";
                }
                ?>
            </select>
            <span class="error" id="title"></span>
        </div>
        <div class="form-group">
            <label for="sdate">Start Date:</label>
            <input type="datetime-local" id="sddate" name="sdate" required>
            <span class="error" id="sddateerror"></span>
        </div>
        <div class="form-group">
            <label for="edate">End Date:</label>
            <input type="datetime-local" id="eddate" name="edate" required>
            <span class="error" id="eddateerror"></span>
        </div>
        <div class="buttons">
            <button type="submit">Update</button>
        </div>
    </form>
</div>

    <div class="form-container" id="vcRegister">
    <form action="adminpage.php" method="post">
        <input type="hidden" name="adminid" value="<?php echo $adminid; ?>">
        <button type="submit" class="close-btn">X</button>
    </form>
    <form onsubmit="return validation6()" method="post" action="adminpage.php">
        <h2>Candidate Venue Registration</h2>
        <div class="form-group">
            <input type="hidden" name="action" value="vcregister">
            <input type="hidden" name="adminid" value="<?php echo $adminid; ?>">
            <label for="usercnic">CNIC:</label>
            <input type="text" id="usercnic" name="usercnic" maxlength="15" placeholder="12345-1234567-3">
            <span class="error" id="usercnicerror"></span>
        </div>

        <!-- Re-run the Venue query -->
        <?php
        $venueselect = "SELECT * FROM venue";
        $venueresult = mysqli_query($conn, $venueselect);
        ?>

        <div class="form-group">
            <label for="vid">Select Venue number</label>
            <select name="vid" id="vid" required>
                <?php
                while ($venueRow = mysqli_fetch_assoc($venueresult)) {
                    echo "<option value='" . $venueRow['VenueID'] . "'>" . $venueRow['VenueID'] . "</option>";
                }
                ?>
            </select>
            <span class="error" id="venueerror"></span>
        </div>

        <!-- Re-run the Poll query -->
        <?php
        $pollselection = "SELECT * FROM poll";
        $pollresult = mysqli_query($conn, $pollselection);
        ?>

        <div class="form-group">
            <label for="pid">Select Vote For</label>
            <select name="pid" id="pid">
                <?php
                while ($pollRow = mysqli_fetch_assoc($pollresult)) {
                    echo "<option value='" . $pollRow['PollID'] . "'>" . $pollRow['Title'] . "</option>";
                }
                ?>
            </select>
            <span class="error" id="sdateerror"></span>
        </div>

        <br>
        <div class="buttons">
            <button type="submit">Register</button>
        </div>
    </form>
</div>








<script>
     
const registerBtn = document.getElementById('userregister');
const candidateRegisterBtn = document.getElementById('candidateregister');
const registrationForm = document.getElementById('registrationForm');
const candidateRegistrationForm = document.getElementById('candidateRegistrationForm');
const partyRegistrationForm = document.getElementById('partyRegisterationForm');
const venueRegisteraionForm=document.getElementById('venueRegister');
const pollRegisteraionForm=document.getElementById('pollRegister');
const upollRegisteraionForm=document.getElementById('upollRegister');
const vcRegisteraionForm=document.getElementById('vcRegister');
const overlay = document.getElementById('overlay');


if (window.location.search.includes('action=registeruser')) {
    registrationForm.classList.add('active');
    overlay.classList.add('active');
} else if (window.location.search.includes('action=candidatereg')) {
    candidateRegistrationForm.classList.add('active');
    overlay.classList.add('active');
} else if (window.location.search.includes('action=partyreg')) {
    partyRegistrationForm.classList.add('active');
    overlay.classList.add('active');
} 
else if (window.location.search.includes('action=venuereg')) {
    venueRegisteraionForm.classList.add('active');
    overlay.classList.add('active');
}
else if (window.location.search.includes('action=pollreg')) {
    pollRegisteraionForm.classList.add('active');
    overlay.classList.add('active');
}
else if (window.location.search.includes('action=upollreg')) {
    upollRegisteraionForm.classList.add('active');
    overlay.classList.add('active');
}
else if (window.location.search.includes('action=vcreg')) {
    vcRegisteraionForm.classList.add('active');
    overlay.classList.add('active');
} 
closeBtn.addEventListener('click', function() {
    registrationForm.classList.remove('active');
    overlay.classList.remove('active');
});



    //
    function validation() {
    const name = document.getElementById('name').value.trim();
    const cnic = document.getElementById('cnic').value.trim();
    const email = document.getElementById('email').value.trim();
    const pass = document.getElementById('passwordReg').value.trim();
const venue=document.getElementById('venue').value.trim();
    
    const cnicPattern = /^[0-9]{5}-[0-9]{7}-[0-9]$/;
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const passPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-[\]{};':"\\|,.<>\/?]).{8,}$/;

    let valid = true; 

    
    if (name === "") {
        document.getElementById('nameerror').innerHTML = "Please Enter your name!";
        valid = false;
    } else {
        document.getElementById('nameerror').innerHTML = "";
    }

    if (venue === "") {
        document.getElementById('venueerror').innerHTML = "Please Enter Venue!";
        valid = false;
    } else {
        document.getElementById('venueerror').innerHTML = "";
    }
    
    if (!cnicPattern.test(cnic)) {
        document.getElementById('usererror').innerHTML = "please enter valid CNIC.";
        valid = false;
    } else {
        document.getElementById('usererror').innerHTML = "";
    }

    
    if (!emailPattern.test(email)) {
        document.getElementById('emailerror').innerHTML = "Please enter a valid email!";
        valid = false;
    } else {
        document.getElementById('emailerror').innerHTML = "";
    }

    
    if (!passPattern.test(pass)) {
        document.getElementById('passerror').innerHTML = "Password must be at least 8 characters long, include uppercase, lowercase, a number, and a special character.";
        valid = false;
    } else {
        document.getElementById('passerror').innerHTML = "";
    }

    return valid; 
}
function validatePartyForm() {
    const partyId = document.getElementById('partyid').value.trim();
    const partyName = document.getElementById('partyname').value.trim();

    const partyIdPattern = /^\d{3,10}$/; // 3 to 10 digits allowed
    const partyNamePattern = /^[a-zA-Z\s]+$/; // Only letters and spaces allowed

    let valid = true;

    // Reset previous error messages
    document.getElementById('partyiderror').innerHTML = "";
    document.getElementById('partynameerror').innerHTML = "";

    // Validate Party Number
    if (partyId === "") {
        document.getElementById('partyiderror').innerHTML = "Please enter Party Number!";
        valid = false;
    } 

    // Validate Party Name
    if (partyName === "") {
        document.getElementById('partynameerror').innerHTML = "Please enter Party Name!";
        valid = false;
    } else if (!partyNamePattern.test(partyName)) {
        document.getElementById('partynameerror').innerHTML = "Party Name must contain only letters and spaces.";
        valid = false;
    } else if (partyName.length < 3 || partyName.length > 30) {
        document.getElementById('partynameerror').innerHTML = "Party Name must be between 3 and 50 characters.";
        valid = false;
    }

    return valid;

}


function candidateValidation() {
        // Get input values
        var candidateName = document.getElementById('candidateName').value.trim();
        var candidateCnic = document.getElementById('candidateCnic').value.trim();
        var candidateEmail = document.getElementById('candidateEmail').value.trim();
        var partyId = document.getElementById('partyid').value.trim();
        var position = document.getElementById('position').value.trim();

        // Get error span elements
        var candidateNameError = document.getElementById('candidateNameError');
        var candidateCnicError = document.getElementById('candidateCnicError');
        var candidateEmailError = document.getElementById('candidateEmailError');
        var partyError = document.getElementById('partyError');
        var candidatePasswordError = document.getElementById('candidatePasswordError');

        // Reset previous error messages
        candidateNameError.textContent = '';
        candidateCnicError.textContent = '';
        candidateEmailError.textContent = '';
        partyError.textContent = '';
        candidatePasswordError.textContent = '';

        // Validate Candidate Name
        if (candidateName === '') {
            candidateNameError.textContent = 'Candidate Name is required.';
            return false;
        } else if (!/^[a-zA-Z\s]+$/.test(candidateName)) {
            candidateNameError.textContent = 'Candidate Name must contain only letters and spaces.';
            return false;
        }

        if (candidateCnic === '') {
            candidateCnicError.textContent = 'CNIC is required.';
            return false;
        } else if (!/^\d{5}-\d{7}-\d{1}$/.test(candidateCnic)) {
            candidateCnicError.textContent = 'CNIC must be in the format 12345-1234567-3.';
            return false;
        }

        // Validate Email
        if (candidateEmail === '') {
            candidateEmailError.textContent = 'Email is required.';
            return false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(candidateEmail)) {
            candidateEmailError.textContent = 'Invalid email format.';
            return false;
        }

        // Validate Party
        if (partyId === '') {
            partyError.textContent = 'Party selection is required.';
            return false;
        }

        // Validate Position
        if (position === '') {
            candidatePasswordError.textContent = 'Position selection is required.';
            return false;
        }

        // If all validations pass, return true to submit the form
        return true;
    }
function validation3() {
    const venuenumber = document.getElementById('venuenumber').value.trim();
    const venueaddress = document.getElementById('venueaddress').value.trim();

    let valid = true;

    if (venuenumber === "") {
        document.getElementById('venuenumbererror').innerHTML = "Please enter the venue number!";
        valid = false;
    } else {
        document.getElementById('venuenumbererror').innerHTML = "";
    }

    if (venueaddress === "") {
        document.getElementById('venueaddresserror').innerHTML = "Please enter the venue address!";
        valid = false;
    } else {
        document.getElementById('venueaddresserror').innerHTML = "";
    }

    return valid;
}

function validation4() {
        const title = document.getElementById('title').value.trim();
        const sdate = document.getElementById('sdate').value.trim();
        const edate = document.getElementById('edate').value.trim();

        


        let valid = true;

        // Title validation
        if (title === "") {
            document.getElementById('titleerror').innerHTML = "Please enter a title!";
            valid = false;
        } else {
            document.getElementById('titleerror').innerHTML = "";
        }

        // Start date validation
        if (sdate=="") {
            document.getElementById('sdateerror').innerHTML = "Please enter a valid start date";
            valid = false;
        } else {
            document.getElementById('sdateerror').innerHTML = "";
        }

        // End date validation
        if (edate=="") {
            document.getElementById('edateerror').innerHTML = "Please enter a valid end date";
            valid = false;
        } else {
            document.getElementById('edateerror').innerHTML = "";
        }

        // Ensure start date is before end date
        if (sdate && edate && new Date(sdate) >= new Date(edate)) {
            document.getElementById('edateerror').innerHTML = "End date must be after start date!";
            valid = false;
        }

        return valid;
    }

function validation5() {
        const title = document.getElementById('title').value.trim();
        const sdate = document.getElementById('sddate').value.trim();
        const edate = document.getElementById('eddate').value.trim();

        


        let valid = true;

        // Title validation
        if (title === "") {
            document.getElementById('titleerror').innerHTML = "Please enter a title!";
            valid = false;
        } else {
            document.getElementById('titleerror').innerHTML = "";
        }

        // Start date validation
        if (sdate=="") {
            document.getElementById('sddateerror').innerHTML = "Please enter a valid start date";
            valid = false;
        } else {
            document.getElementById('sddateerror').innerHTML = "";
        }

        // End date validation
        if (edate=="") {
            document.getElementById('eddateerror').innerHTML = "Please enter a valid end date";
            valid = false;
        } else {
            document.getElementById('eddateerror').innerHTML = "";
        }

        // Ensure start date is before end date
        if (sdate && edate && new Date(sdate) >= new Date(edate)) {
            document.getElementById('eddateerror').innerHTML = "End date must be after start date!";
            valid = false;
        }

        return valid;
    }

function validation6() {
    const cnic = document.getElementById('usercnic').value.trim();
    const venue = document.getElementById('vid').value;
    const voteFor = document.getElementById('pid').value;

    const cnicPattern = /^[0-9]{5}-[0-9]{7}-[0-9]$/; // CNIC format: 12345-1234567-3

    let valid = true;

    // Validate CNIC
    if (cnic === "") {
        document.getElementById('usercnicerror').innerHTML = "Please enter CNIC!";
        valid = false;
    } else if (!cnicPattern.test(cnic)) {
        document.getElementById('usercnicerror').innerHTML = "Invalid CNIC format. Use 12345-1234567-3";
        valid = false;
    } else {
        document.getElementById('usercnicerror').innerHTML = "";
    }

    // Validate Venue selection
    if (venue === "") {
        document.getElementById('venueerror').innerHTML = "Please select a Venue!";
        valid = false;
    } else {
        document.getElementById('venueerror').innerHTML = "";
    }

    // Validate Vote selection
    if (voteFor === "") {
        document.getElementById('sdateerror').innerHTML = "Please select a voting option!";
        valid = false;
    } else {
        document.getElementById('sdateerror').innerHTML = "";
    }

    return valid;
}

</script>

</body>
</html>
