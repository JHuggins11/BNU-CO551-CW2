<?php
	$conn = mysqli_connect("localhost", "root", "", "co551cw2_jhuggins11");

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
?>
