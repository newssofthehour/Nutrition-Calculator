<?php 	
include("./includes/include.php");
session_start();
/* $_POST['add'] is set when a user adds an ingredient to their meal */
if(isset($_POST['add'])) {
	$name = preg_replace('/\d+\.*\d*+/u', '', $_POST['add']); 
	preg_match_all('!\d+\.*\d*!',$_POST['add'],$matches);
	$_SESSION['meal']->add(new Ingredient($name,$matches[0][0],$matches[0][1],$matches[0][2],$matches[0][3]),$matches[0][4]); 
}
/* $_POST['remove'] is set when a user removes an ingredient from their meal */
if(isset($_POST['remove'])) {
	$name = preg_replace('/\d+\.*\d*+/u', '', $_POST['remove']);
	preg_match_all('!\d+\.*\d*!',$_POST['remove'],$matches);
	$_SESSION['meal']->remove(new Ingredient($name,$matches[0][0],$matches[0][1],$matches[0][2],$matches[0][3])); 
} 
if(isset($_POST['add']) || isset($_POST['remove'])) { 
	$meal = $_SESSION['meal']; ?>
<div style="overflow-x:auto">
	<table id="ingredientTable">
		<tr>
			<th>Ingredient</th>
			<th>Calories</th>
			<th>Fat (g)</th>
			<th>Carbs (g)</th>
			<th>Sodium (mg)</th>
			<th>Serving (g)</th>
			<th>Remove</th>
		</tr>
		<?php for($i = 0; $i < $_SESSION['meal']->get_size(); $i++) { 
			$ingredient = $_SESSION['meal']->get_ingredients()[$i];
			$serving = $_SESSION['meal']->get_ingredientAmount()[$i];
			$servingRatio = $serving / 100;
		?>
		<tr> <!-- Print database results as a table row -->
			<td><?php echo $_SESSION['meal']->get_ingredients()[$i]->get_name(); ?></td>
			<td><?php echo round($ingredient->get_calories() * $servingRatio); ?></td>
			<td><?php echo round($ingredient->get_fat() * $servingRatio,2); ?></td>
			<td><?php echo round($ingredient->get_carbs() * $servingRatio,2); ?></td>
			<td><?php echo round($ingredient->get_sodium() * $servingRatio); ?></td>
			<td><?php echo $serving; ?></td>
			<td><input type="submit" name="remove" class="remove" id="<?php echo $_SESSION['meal']->get_ingredients()[$i]; ?>" value="Remove"/></td>
		</tr>
		<?php } ?>
		<tr style="	background: rgb(67, 170, 139); background: rgba(67, 170, 130, .6);">
			<td style="font-weight:400">Total</td>
			<td><?php echo $meal->get_calories(); ?></td>
			<td><?php echo $meal->get_fat(); ?></td>
			<td><?php echo $meal->get_carbs(); ?></td>
			<td><?php echo $meal->get_sodium(); ?></td>
			<td></td>
			<td></td>
		</tr>
	</table>
</div>
<script>
$('.remove').click(function(){
	$('#meal').html('');
	var ingredient = $(this).attr('id');
	var url = 'add.php',
	data =  {'remove': ingredient };
	$.post(url, data, function (response) {
    	$('#meal').html(response);
    	//alert("action performed successfully");
    });
});
</script>
<?php } ?>
