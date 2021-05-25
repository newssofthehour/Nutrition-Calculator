<?php 	
include("./includes/include.php");
session_start();
if(isset($_POST['remove'])) {
	$name = preg_replace('/\d+\.*\d*+/u', '', $_POST['remove']);
	preg_match_all('!\d+\.*\d*!',$_POST['remove'],$matches);
	$_SESSION['meal']->remove(new Ingredient($name,$matches[0][0],$matches[0][1],$matches[0][2],$matches[0][3])); ?>

	<table id="ingredientTable">
		<tr>
			<th>Ingredient</th>
			<th>Calories</th>
			<th>Fat (g)</th>
			<th>Carbs (g)</th>
			<th>Sodium (mg)</th>
			<th>Remove</th>
		</tr>
		<?php for($i = 0; $i < $_SESSION['meal']->get_size(); $i++) { ?>
		<tr> <!-- Print database results as a table row -->
			<td><?php echo $_SESSION['meal']->get_ingredients()[$i]->get_name(); ?></td>
			<td><?php echo $_SESSION['meal']->get_ingredients()[$i]->get_calories(); ?></td>
			<td><?php echo $_SESSION['meal']->get_ingredients()[$i]->get_fat(); ?></td>
			<td><?php echo $_SESSION['meal']->get_ingredients()[$i]->get_carbs(); ?></td>
			<td><?php echo $_SESSION['meal']->get_ingredients()[$i]->get_sodium(); ;?></td>
			<td><input type="submit" name="remove" class="remove" id="<?php echo $_SESSION['meal']->get_ingredients()[$i]; ?>" value="Remove"/></td>
		</tr>
		<?php } ?>
		<tr style="	background: rgb(67, 170, 139); background: rgba(67, 170, 130, .6);">
			<td style="font-weight:400">Total</td>
			<td><?php echo $_SESSION['meal']->get_calories(); ?></td>
			<td><?php echo $_SESSION['meal']->get_fat(); ?></td>
			<td><?php echo $_SESSION['meal']->get_carbs(); ?></td>
			<td><?php echo $_SESSION['meal']->get_sodium(); ?></td>
			<td></td>
		</tr>
	</table>
<?php } ?>