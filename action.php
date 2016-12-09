Your money is
<?php
	$val = htmlspecialchars($_POST['input'])
	$per = 0;
	echo("$val");
	$perc = "";
	 for ($x = 10; $x<=20; $x+=5){
		if(empty($_POST["per$x"])){
			$perc +="";
		}
		else{
			$perc +=$x;
		}
	}	
	echo("$perc");
?>

