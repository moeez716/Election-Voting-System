<?php
include "connection.php";

$select = "SELECT * FROM `venue`";
$result = mysqli_query($conn, $select);
$resultpoll = null; 
$venue="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $venue = $_POST["venue"];
    $selectpoll = "SELECT * FROM `poll`";
    $resultpoll = mysqli_query($conn, $selectpoll);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counting</title>
    <link rel="stylesheet" href="indexstyle.css">
    <style>
        .container2 {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container2 h1 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 600px;
            margin-bottom: 30px;
        }

        label {
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
        }

        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
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

        /* Existing CSS for .results */
        .results {
    display: flex;
   
    gap: 20px;
    justify-content: center; /* Center the items */
    align-items: flex-start;
}

.poll {
    flex: 1 1 300px; /* Allow flexible sizing */
    min-width: 250px; /* Ensure they don’t get too small */
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    background-color: #f9f9f9;
    display: flex;
    flex-direction: column;
    align-items: center; /* Center content */
}


/* Media Query for smaller screens */
@media (max-width: 768px) {
    .results {
        flex-direction: column; /* Stack items vertically on smaller screens */
        align-items: center; /* Center items horizontally */
    }

    .poll {
        width: 100%; /* Make each poll take full width on smaller screens */
        margin-bottom: 20px; /* Add some space between stacked polls */
    }

    .winner {
        width: 100%; /* Make winner section take full width */
    }
}

/* Media Query for even smaller screens (e.g., mobile phones) */
@media (max-width: 480px) {
    .results {
        padding: 10px; /* Reduce padding for smaller screens */
    }

    .poll h1 {
        font-size: 1.2rem; /* Reduce font size for smaller screens */
    }

    .poll h2 {
        font-size: 1rem; /* Reduce font size for smaller screens */
    }

    .count {
        width: 70px; /* Reduce size of count circle */
        height: 70px;
        line-height: 70px;
        font-size: 1.2rem; /* Reduce font size for count */
    }

    .winner h2 {
        font-size: 1.5rem; /* Reduce font size for winner's name */
    }

    .winner .count {
        width: 80px; /* Adjust size of winner's count circle */
        height: 80px;
        line-height: 80px;
        font-size: 1.5rem; /* Adjust font size for winner's count */
    }
}

        

        .poll h1 {
            font-size: 1.5rem;
            margin: 0;
            flex: 1 1 100%;
        }

        .poll h2 {
            font-size: 1.2rem;
            margin: 10px 0;
        }

        .count {
            font-size: 1.5rem;
            color: #fff;
            width: 90px;
            height: 90px;
            line-height: 90px;
            text-align: center;
            border-radius: 50%;
            background: linear-gradient(135deg, #3498db, #2ecc71);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin: 10px 0;
            display: inline-block;
            position: relative;
            font-weight: bold;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            }
            50% {
                transform: scale(1.2);
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            }
        }
        .winner {
    background: linear-gradient(135deg, #f39c12, #f1c40f);
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    margin-top: 20px;
    animation: pulse 2s infinite;
}

.winner h2 {
    font-size: 2rem;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
    margin-bottom: 10px;
    animation: glowing 1.5s infinite alternate;
}

.count {
    font-size: 2rem;
    color: #fff;
    width: 100px;
    height: 100px;
    line-height: 100px;
    text-align: center;
    border-radius: 50%;
    background: #e74c3c;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    margin: 10px 0;
    display: inline-block;
    position: relative;
    font-weight: bold;
    animation: scaleUp 1.5s ease-out;
}

/* Glowing effect for the winner's name */
@keyframes glowing {
    0% {
        text-shadow: 0 0 10px #f39c12, 0 0 20px #f39c12, 0 0 30px #f39c12;
    }
    50% {
        text-shadow: 0 0 20px #f39c12, 0 0 30px #f39c12, 0 0 40px #f39c12;
    }
    100% {
        text-shadow: 0 0 30px #f39c12, 0 0 40px #f39c12, 0 0 50px #f39c12;
    }
}

/* Pulse animation for the winner section */
@keyframes pulse {
    0% {
        transform: scale(1);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    50% {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    }
    100% {
        transform: scale(1);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
}

/* Scale-up effect for the vote count */
@keyframes scaleUp {
    0% {
        transform: scale(0);
    }
    100% {
        transform: scale(1);
    }
}
@media (min-width: 1440px) {
  .header-container h1 {
    font-size: 50px;
  }
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
<div class="container2">
    <h1>Results</h1>
    <form action="count.php" method="post">
        <label for="venue">Select Venue</label>
        <select name="venue" id="venue" required>
            <?php
            while ($venueRow = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $venueRow['VenueID'] . "'>" . $venueRow['VenueID'] . "</option>";
            }
            ?>
        </select>
        <button type="submit">Click To Check Counting</button>
    </form>

    <?php
if ($resultpoll) {
    echo '<div class="results">';
    while ($pollrow = mysqli_fetch_assoc($resultpoll)) {
        echo '<div class="poll">';
        echo '<h1>' . $pollrow['Title'] . '</h1>';
        $pollid = $pollrow['PollID'];
        $status = $pollrow['Status']; // Fetch poll status

        $selectquery = "
            SELECT c.cnic AS candidate_cnic, c.Name AS candidate_name, p.Name AS party_name
            FROM party p 
            JOIN candidate c ON p.PartyID = c.PartyID 
            JOIN venuecandidate v ON c.cnic = v.CandidateID 
            WHERE v.VenueID = '$venue' AND v.PollID = '$pollid'
        ";
        $resultquery = mysqli_query($conn, $selectquery);

        // Initialize variables to track winner
        $winners = [];
            $max_votes = 0;
if(mysqli_num_rows($resultquery)>0){
            while ($resultrow = mysqli_fetch_assoc($resultquery)) {
                echo '<h2>' . $resultrow['candidate_name'] . ' (' . $resultrow['party_name'] . ')</h2>';
                $cnic = $resultrow['candidate_cnic'];
                $selectcount = "SELECT COUNT(*) AS count FROM `vote` WHERE VenueID='$venue' AND CandidateID='$cnic'";
                $resultcount = mysqli_query($conn, $selectcount);

                if ($resultcount) {
                    $row = mysqli_fetch_assoc($resultcount);
                    $count = $row['count'];
                    echo "<div class='count'>$count</div>";

                    if ($count > $max_votes) {
                        $max_votes = $count;
                        $winners = [[$resultrow['candidate_name'], $resultrow['party_name']]];
                    } elseif ($count == $max_votes) {
                        $winners[] = [$resultrow['candidate_name'], $resultrow['party_name']];
                    }
                }
            }
echo '<br><br>';
            // Show winner if poll is closed
            if ($status == "Closed") {
                echo '<div class="winner">';
                if (count($winners) > 1) {
                    echo '<h2>It\'s a Tie!</h2>';
                    foreach ($winners as $winner) {
                        echo '<h2>' . $winner[0] . ' (' . $winner[1] . ')</h2>';
                    }
                } else {
                    echo '<h2>Winner: ' . $winners[0][0] . ' (' . $winners[0][1] . ')</h2>';
                }
                echo "<div class='count'>$max_votes</div>";
                echo '</div>';
            }

            echo '</div>';
        }
        echo '</div>';
    }
}
    ?>
</div>

</body>
</html>