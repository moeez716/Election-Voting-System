<?php
include "connection.php";
$select="SELECT * FROM `venue`";
$result=mysqli_query($conn,$select);
$resultuser="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
if(isset($_POST["action"])){
    if($_POST["action"]=="details"){
        $cnic=$_POST["cnic"];
        
        $selecuser="SELECT * FROM `users` WHERE cnic='$cnic'";
        $resultuser=mysqli_query($conn,$selecuser);
if(!mysqli_num_rows($resultuser)>0){
    echo "<script>alert('you are not registered!')</script>";
}
else{
    $rerow=mysqli_fetch_assoc($resultuser);
$venue=$rerow["VenueID"];
$selectpoll="SELECT * FROM `poll`";
$resultpoll=mysqli_query($conn,$selectpoll);

}
    }

    if($_POST["action"]=="voting"){
$pollid=$_POST["pollid"];
$venue=$_POST["venue"];
$candidateid=$_POST["candidate"];
$cnic=$_POST["cnic"];
$selecuser="SELECT * FROM `users` WHERE cnic='$cnic'";
        $resultuser=mysqli_query($conn,$selecuser);
$selectpoll="SELECT * FROM `poll`";
$resultpoll=mysqli_query($conn,$selectpoll);
$selectvote="SELECT * FROM `vote` WHERE UserID='$cnic' and PollID='$pollid'";
$resultvote=mysqli_query($conn,$selectvote);
if(mysqli_num_rows($resultvote)>0){
    echo "<script>alert('you already vote here!')</script>";
}
else{
    $insertvote="INSERT INTO `vote`(`PollID`, `UserID`, `VenueID`, `CandidateID`) VALUES ('$pollid','$cnic','$venue','$candidateid')";
    if(mysqli_query($conn,$insertvote)){
        echo "<script>alert('vote caste sucessfully!')</script>";
    }
}

    }

}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting System</title>
    <link rel="stylesheet" href="indexstyle.css">
    <style>
       

        .container1 {
            background: #ffffff;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            max-width: 450px;
            width: 100%;
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .container2 {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    justify-content: center;
    padding: 2rem;
    margin-top: 2rem;
    
}

.poll {
    background: #ffffff;
    padding: 1.5rem;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    width: 40%;
    text-align: left;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.poll:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
}

.poll h2 {
    color: #043523;
    margin-bottom: 1rem;
    font-size: 1.5rem;
}

.poll p {
    color: #555;
    font-weight: bold;
    margin-bottom: 0.75rem;
}

.radio-option {
    display: block;
    margin-bottom: 1rem;
    
}

label {
    display: block;
    margin-bottom: 0.5rem;
    color: #444;
    font-weight: bold;
}

input[type="text"],
select {
    width: 100%;
    padding: 0.75rem;
    margin-bottom: 1.5rem;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 1rem;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
}

input[type="radio"] {
    margin-right: 0.5rem;
}

input[type="submit"] {
    background: #6e9b9c; /* Muted Teal */
  color: #fff;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

input[type="submit"]:hover {
    background: #6e9b9c; /* Muted Teal */
  color: #fff;
    transform: scale(1.05);
}

.footer {
    margin-top: 1rem;
    color: #666;
    font-size: 0.85rem;
    text-align: center;
}

.top-container {
    position: static;
    margin: 1rem auto;
    transform: none;
}

@media (max-width: 768px) {
    .container2 {
        padding: 1rem;
        
    }

    .poll {
        width: 100%;
    }

    input[type="text"],
    input[type="submit"] {
        font-size: 0.9rem;
    }

    h2 {
        font-size: 1.5rem;
    }
}
@media (min-width: 1440px) {
  .header-container h1 {
    font-size: 50px;
  }
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
<script src="indexscript.js"></script>
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

<br><br><br>
    <div class="container1" id="cnic-container">
        <h2>Enter Your Details</h2>
        <form method="POST" action="vote.php">
            <input type="hidden" name="action" value="details">
            <label for="cnic">CNIC:</label>
            <input type="text" id="cnic" name="cnic" maxlength="15" placeholder="Enter your CNIC" required>

            <input type="submit" name="submit_cnic" value="Submit">
        </form>
    </div>
    <div class="container2">
    <?php 
if($resultuser && mysqli_num_rows($resultuser)>0){
    echo '<script>document.getElementById("cnic-container").className = "container1 top-container";</script>';
    while($pollrow=mysqli_fetch_assoc($resultpoll)){
        if($pollrow['Status']=="Active"){
?>
        <div class="poll">
            <h2><?php echo $pollrow['Title']; ?></h2>
            <?php $pollid=$pollrow['PollID'] ?>
            <form method="POST" action="vote.php">
                <input type="hidden" name="venue" value="<?php echo $venue ?>">
                <input type="hidden" name="pollid" id="pollid" value="<?php echo $pollrow['PollID']; ?>">
                <input type="hidden" name="action" id="" value="voting">
                <input type="hidden" name="cnic" value="<?php echo $cnic ?>">
                <?php
                $selectquery = "
                SELECT c.cnic AS candidate_cnic, c.Name AS candidate_name, p.Name AS party_name
                FROM party p 
                JOIN candidate c ON p.PartyID = c.PartyID 
                JOIN venuecandidate v ON c.cnic = v.CandidateID 
                WHERE v.VenueID = '$venue' AND v.PollID = '$pollid'
                ";
                $resultquery = mysqli_query($conn, $selectquery);
                if(mysqli_num_rows($resultquery)>0){
                ?>
                <p>Select your candidate:</p>
                <?php while ($mnarow = mysqli_fetch_assoc($resultquery)) { ?>
                
                <label class="radio-option">
                    <input type="radio" name="candidate" value="<?php echo $mnarow['candidate_cnic']; ?>" required>
                    <?php echo $mnarow['candidate_name'] . " (" . $mnarow['party_name'] . ")"; ?>
                </label>
                <?php } ?>
                <input type="submit" name="submit_vote" value="Vote">
                <?php } else{
                    ?>
            </form>
            <?php echo '<p> Candidate no available </p>';
                }?>
        </div>
<?php 
        } else if($pollrow['Status']=="Draft"){
?>
        <div class="poll">
            <h2><?php echo $pollrow['Title']; ?></h2>
            <p>Please Wait. Poll starts on <?php echo $pollrow['StartDate']; ?></p>
        </div>
<?php 
        } else {
?>
        <div class="poll">
            <h2><?php echo $pollrow['Title']; ?></h2>
            <p>Poll is closed.</p>
        </div>
<?php 
        }
    } 
}
?>
    </div>
    <div class="footer">
        <p>&copy; 2025 Voting System. All Rights Reserved.</p>
    </div>
    
</body>
</html>
