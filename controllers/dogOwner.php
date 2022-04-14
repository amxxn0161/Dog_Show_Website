<?php
// establishes connection to database
include 'dbConnect.php';

// establish json headers
header('Content-Type: application/json; charset=utf-8');

// empty data json array
$data = [];

// if no owner id is set, redirect
if (!isset($_GET['owner_id'])) {
    header("location:/index.php");
    exit;
}

function findOwner($conn, $owner_id) {
    // details of the owners will be fetched using the owner ID
    $stmt = $conn->prepare("SELECT * FROM owners WHERE id = :id");
    $stmt->bindParam(':id', $owner_id);
    $stmt->execute();
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch();

    // returns the row for the owner
    return $result;
}

$data = findOwner($conn, $_GET['owner_id']);

// final json data outputted
echo json_encode($data, JSON_PRETTY_PRINT);