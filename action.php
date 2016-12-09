Your money is
<?php
	$val = htmlspecialchars($_POST['input'])
	$per = 0;
	echo("$val");
	$perc = "";
	 for ($x = 10; $x<=20; $x+=5){
		if(empty($_POST["percentage"])){
			$perc +="";
		}
		else{
			$perc +=_input($_POST["percentage"]);		}
	 }
	echo("$perc");
?>
