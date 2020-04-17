

<html>

	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../resources/css/main.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	</head>

	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header logo">
					<a class="" href="#"><img src="../resources/image/logo-main.png"></a>
				</div>
				<div class="search-container col-sm-3 col-md-6"">
					<form action="./display_content.php?" method="GET">
						<input type="text" placeholder="City Name.." name= "city" >
						<button type="submit" id="cn"><i class="fa fa-search"></i></button>
					</form>
				</div>
				<div class="dropdown-container">	
				 <div class="dropdown">
					<button id="unitbtn" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span class="ulabel">Units :˚C/˚F
					</span> <span class="caret"></span></button>
						<ul class="dropdown-menu">
						  <li><a id="fahreneit">Fahrenheit</a></li>
						  <li><a id="celcius">Celsius</a></li>	
						</ul>
				 </div>
				</div>
				
					
			</div>
			
		</nav>
	</body>


</html>
