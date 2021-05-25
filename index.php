<!-- Nutritional Calculator - index.php -->

<!-- PHP include files -->
<?php include("./includes/include.php"); ?>

<!doctype html>

<html lang="en" class="html" id="b1">
	<head>
  		<meta charset="utf-8">
  		<title>Nutrition Calculator</title>
  		<meta name="description" content="A nutrition calculator">
  		<meta name="keywords" content="Nutrition,Lamar,Student,University,Project,CS4360">
  		<meta name="author" content="Lamar University Students">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
  		<link rel="stylesheet" type="text/css" href="css/styles.css">
  		<script type="text/javascript" src="js/function_lib.js"></script>
  		<!-- swap_background(x,y) - swaps background in x time (millis) over y intervals -->
  		<script>swap_background(15000, 3);</script>
	</head>
	<body>
		<div id="center">
			<div id="info">
				<h2>Nutrition Calculator</h2>
				<img src="images/icon.png">
				<p>Find nutritional info on ingredients and meals</p>
			</div>
			<div id="buttons">
				<button style="margin-left: 0" onclick="window.location.href='search_ingredients.php'">Search Ingredients</button>
				<button style="margin-right: 0" onclick="window.location.href='create_meal.php'">Create meal</button>
			</div>
		</div> 		
	</body>
</html>



