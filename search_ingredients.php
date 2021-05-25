<!-- Nutritional Calculator - search_ingredients.php -->

<!-- PHP include files -->
<?php include("./includes/include.php"); ?>

<!doctype html>

<html lang="en" class="html" id="b1">
	<head>
  		<meta charset="utf-8">
  		<title>Search Ingredients</title>
  		<meta name="description" content="A nutrition calculator">
  		<meta name="keywords" content="Nutrition,Lamar,Student,University,Project,CS4360">
  		<meta name="author" content="Lamar University Students">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
  		<link rel="stylesheet" type="text/css" href="css/styles.css">
  		<script type="text/javascript" src="js/function_lib.js"></script>
  		
  		<script>swap_background(15000, 3);</script>
	</head>

	<body>
		<a href="./"><img id="back_icon" src="images/back.png"></a>
		<div id="search_ingredients">
			<h2>Search for an ingredient in our database to find nutritional information 
			about it</h2>
			<form action="search_ingredients.php" method="get">
				<div class="search" style="display: flex" id="input">
					<input type="text" placeholder="Search here..." name="search" class="typeahead" id="search" data-provide="typeahead" data-items="4">
					<input type="submit" value="Search" name="submit">
				</div>
			</form>

			<!-- If search form if filled out, show table -->
			<?php if(isset($_REQUEST['search'])) { 
			// Make connection to database
			$db = new mysqli($servername, $username, $password, $dbname);
			if ($db->connect_error) {die("Connection failed: " . $db->connect_error);}
				$query = $_REQUEST['search']; // Query = search results
				//Split query into array of words.
				$string = multiexplode(array(",","."," ","|",":"),$query); 
				// Create $output query string 
				$output = "SELECT * FROM ingredient WHERE ";
				// Loop through each $string[item] and add to query string
				for($i = 0; $i < count($string); $i++) {
					$output = $output . "(Name LIKE '%" . $string[$i] . "%')";
					if($i != (count($string)-1)) { // If not last item
						$output = $output . " AND ";
					}
				}
				$output = $output . " LIMIT 15"; // Limit to 15 items
				$result = $db->query($output);
				// If there are 1 or more items found show table
				if ($result->num_rows > 0) { ?> 
				<div style="overflow-x:auto;">
					<table id="ingredientTable">
						<p id="tableP">Servings size : 100 grams</p>
						<tr>
							<th>Ingredient</th>
							<th>Calories</th>
							<th>Fat (g)</th>
							<th>Carbs (g)</th>
							<th>Sodium (mg)</th>
						</tr>
						<?php while($row = $result->fetch_assoc()) { ?>
        				<tr> <!-- Print database results as a table row -->
							<td><?php echo $row['Name']; ?></td>
							<td><?php echo $row['Calories'];?></td>
							<td><?php echo $row['Fat'];?></td>
							<td><?php echo $row['Carbs'];?></td>
							<td><?php echo $row['Sodium'];?></td>
						</tr>
        				<?php } ?>
					</table>
				</div>
				<?php } else { echo "<br><p id='tableP'>No ingredients found for search: '" . $_REQUEST['search'] . "'"; }
				$db->close(); } // Close connection to database ?>
				<!-- End of table -->
		</div>
	</body>
</html>