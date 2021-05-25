<!-- Nutritional Calculator - search_ingredients.php -->

<!-- PHP include files -->
<?php include("./includes/include.php"); 
session_start();
$_SESSION['meal'] = new Meal("Dinner");

/* Test news code 
$news = News::get_instance();
$news->add_article("Title","Url");
$news->add_article("A title","A Url");
$news->remove_article(0);
echo $news->get_articles()[0]->get_title(); // Prints the title of the first article */

?>

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
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
  		<script>swap_background(15000, 3);</script>
	</head>
	<body>
		<a href="./"><img id="back_icon" src="images/back.png"></a>
		<div id="search_ingredients">
			<h2>Create a meal by adding ingredients. We'll show the nutritional information for that meal.</h2>
			<div class="search" style="display: flex" id="input">
				<input type="text" placeholder="Search for an ingredient here..." name="search" id="search">
			</div>
			<div id="search_results"></div>
			<div id="meal"></div>
		</div>
	</body>
</html>
<script>
$("input").keyup(function () {
    $('#search_results').html('');
    var search = $("#search").val();
    var url = 'search.php',
	data =  {'search': search };
	$.post(url, data, function (response) {
        $('#search_results').html(response);
        //alert("action performed successfully");
    });
});
</script>
