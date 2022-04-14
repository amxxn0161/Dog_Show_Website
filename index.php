<?php
    include 'controllers/dbConnect.php';
?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>u2053315_cw3</title>
</head>
<body>

<style>
    h1 {
        color: black;
        font-family: Helvetica Neue;
        font-size: 300%;
    }

    h2{
        color: black;
        font-family: Helvetica Neue;
    }

    th{
       font-family: Helvetica Neue;
    }

</style>

<h1 id="header1">loading...</h1>

<h2>Top 10 Dogs Leaderboard</h2>

<table id="leaderboard">
    <tr>
        <th>Name</th>
        <th>Breed</th>
        <th>Score Average</th>
        <th>Name Of Owner</th>
        <th>Email Address</th>
    </tr>
</table>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/index.js"></script>

</html>

<!DOCTYPE html>
<html>
<body>
<style>
    p{
        font-family: Helvetica Neue;
    }
</style>

<h2>Dogs</h2>

<p>Below are some images of dogs
    similar to those in the leaderboard:</p>

<img src="images/cute-dog.png" alt="Cute Dog" width="215" height="320">
<img src ="images/cute-dog.jpg" alt="Cute Dog(2)" width="300" height="320"

</body>
</html>

