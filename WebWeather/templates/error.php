
<?php 

$errorMsg = $_GET["msg"];
$errorDesc = $_GET["desc"];

?>

<html>
		<head>
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
				<link rel="stylesheet" type="text/css" href="../resources/css/main.css">
		</head>
		<body>

			<div class= "error-container">
				<h2>Please Try Replacing Api Key For Accuweather</h2>
				<h2> ERROR: "<?php print_r($errorMsg)?>"  </h2>
				<h2> Error Description : "<?php print_r($errorDesc)?>"  </h2>
			</div>
		</body>


<html>