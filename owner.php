<?php
	if (!isset($_GET['owner_id'])) {
    	// redirect back to index
		header("location:index.php");
	}

    include 'controllers/dbConnect.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>cw3</title>
</head>
<body>
	<p id="owner_id">Owner ID: <?php echo $_GET['owner_id']; ?></p>
	<p id="owner_name">loading...</p>
	<p id="owner_address">loading...</p>
	<p id="owner_email">loading....</p>
	<p id="owner_phone">loading...</p>

	<a href="index.php">BACK TO HOME</a>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
	let owner_id = <?php echo $_GET['owner_id']; ?>
</script>
<script src="js/owner.js"></script>
</html>