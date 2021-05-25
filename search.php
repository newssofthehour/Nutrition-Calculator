<?php
include("./includes/include.php");
session_start();
if(isset($_POST['search'])) {
	$ingredientList = array(); // Initiate array to store ingredient objects

	/* Get data from database using search key words */
	$db = new mysqli($servername, $username, $password, $dbname); 
	if ($db->connect_error) {die("Connection failed: " . $db->connect_error);} 
	$query = filter_var($_POST['search'],FILTER_SANITIZE_STRING); // Query = search results, filtered to prevent sql injection
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
	$output = $output . " LIMIT 10"; // Limit to 10 items
	$result = $db->query($output);
	
	/* Store results into array of ingredient objects */
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$ingredient = new Ingredient($row['Name'],$row['Calories'],$row['Fat'],$row['Carbs'],$row['Sodium']);
			array_push($ingredientList, $ingredient);
		}
	} 
	/*  Print ingredient objects out in table */ ?>
	<div style="overflow-x:auto; ">
		<table id="ingredientTable">
			<p id="tableP">Servings size : 100 grams</p>
			<tr>
				<th>Ingredient</th>
				<th>Calories</th>
				<th>Fat (g)</th>
				<th>Carbs (g)</th>
				<th>Sodium (mg)</th>
				<th>Serving Size (g)</th>
				<th>Add</th>
			</tr>
			<?php for($i = 0; $i < count($ingredientList); $i++) { ?>
			<tr> <!-- Print database results as a table row -->
				<td><?php echo $ingredientList[$i]->get_name(); ?></td>
				<td><?php echo $ingredientList[$i]->get_calories(); ?></td>
				<td><?php echo $ingredientList[$i]->get_fat(); ?></td>
				<td><?php echo $ingredientList[$i]->get_carbs(); ?></td>
				<td><?php echo $ingredientList[$i]->get_sodium(); ;?></td>
				<td style="width:45px; text-align: center"><input style="width:45px; text-align: center;" type="text" name="serving" Value="100" class="serving"/></td>
				<td><input type="submit" name="add" class="add" id="<?php echo $ingredientList[$i]; ?>" value="Add"/></td>
			</tr>
			<?php } ?>
		</table>
	</div>
	<script>
	$('.add').click(function(){
		$('#meal').html('');
		var ingredient = $(this).attr('id');
		ingredient += " " + $(this).closest('tr').find('.serving').val();
		var url = 'add.php',
		data =  {'add': ingredient };
		$.post(url, data, function (response) {
        	$('#meal').html(response);
        	//alert("action performed successfully");
        });
	});
	</script>
<?php } ?>
