<?php
// connect to db
include 'dbConnect.php';

// establish json headers
header('Content-Type: application/json; charset=utf-8');

// empty data json array
$data = [];

function findDog($conn, $dog_id) {
    $stmt = $conn->prepare("SELECT * FROM dogs WHERE id = :id");
    $stmt->bindParam(':id', $dog_id);
    $stmt->execute();
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch();
    return $result;
}

function findDogBreed($conn, $breed_id) {
    $stmt = $conn->prepare("SELECT * FROM breeds WHERE id = :id");
    $stmt->bindParam(':id', $breed_id);
    $stmt->execute();
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch();
    return $result['name'];
}

function findOwnerFromDogID($conn, $dog_id) {
    $stmt = $conn->prepare("SELECT * FROM dogs WHERE id = :id");
    $stmt->bindParam(':id', $dog_id);
    $stmt->execute();
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch();

    $result = findOwner($conn, $result['owner_id']);

    // returns the whole row for owners
    return $result;
}

function findOwner($conn, $owner_id) {
    // fetches the details of an owner through the use of an ID
    $stmt = $conn->prepare("SELECT * FROM owners WHERE id = :id");
    $stmt->bindParam(':id', $owner_id);
    $stmt->execute();
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch();

    // returns the whole row for owners
    return $result;
}

try {

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // retrieves the number of owners
    $stmt = $conn->prepare("SELECT COUNT(id) FROM owners");
    $stmt->execute();
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch();

    $data['owners'] = $result["COUNT(id)"];

    // finds the number of dogs
    $stmt = $conn->prepare("SELECT COUNT(id) FROM dogs");
    $stmt->execute();
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch();

    $data['dogs'] = $result["COUNT(id)"];

    // finds the number of events
    $stmt = $conn->prepare("SELECT COUNT(id) FROM events");
    $stmt->execute();
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch();

    $data['events'] = $result["COUNT(id)"];

    // finds the top 10 dogs and displays them in descending order
    $stmt = $conn->prepare("SELECT dog_id, AVG(score) AS score FROM entries GROUP BY dog_id having count(distinct competition_id) > 1 ORDER BY AVG(score) DESC LIMIT 10");
    $stmt->execute();
    // set the resulting array to associative
    $results = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $results = $stmt->fetchAll();

    $updatedResults = [];

    // for each dog in the top 10, the name & breed of the dog as well as the owners details will be added to the updated results array
    foreach ($results as $result) {
        $dog = findDog($conn, $result['dog_id']);
        $breed = findDogBreed($conn, $dog['breed_id']);
        $owner = findOwnerFromDogID($conn, $result['dog_id']);
        $result['owner_name'] = $owner['name'];
        $result['owner_email'] = $owner['email'];
        $result['owner_id'] = $owner['id'];
        $result['breed'] = $breed;
        $result['name'] = $dog['name'];
        array_push($updatedResults, $result);
    }

    $data['top10'] = $updatedResults;


} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}


// output final json data
echo json_encode($data, JSON_PRETTY_PRINT);