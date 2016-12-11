<!DOCTYPE html>
<html>
<head>
	<title>Tip Calculator</title>
</head>

<body>

<form action="calculator.php" method="post">
 	<p>Bill subtotal: <input type="number" name="input" min = "1" /></p>
 	<p>Tip percentage</p>

	<p>
	<?php

	// import functions
	include 'action.php';

	// display radio button
	for ($x = 10; $x<=20; $x+=5){
		echo"<input type=\"radio\" name = \"percentage\" value=\"$x\" /> $x% ";
	}
	
	$bill_filled = !empty($_POST["input"]);
       	$percent_submitted =!empty($_POST["percentage"]);
	
	if($bill_filled && $percent_submitted) {
		$val = htmlspecialchars($_POST['input']);
		
		echo("<p>The Money is $val");
		
		$perc =m_input($_POST["percentage"]);	
		echo("<p>The percentage is: $perc</p>");
		
		$tip = m_percentage($val, $perc);
		echo("<p>The tip is $tip");
	}

	?>
	</p>
	<p><input type="submit" /></p>
</form>
</body>

