<form action="action.php" method="post">
 	<p>Bill subtotal: <input type="text" name="input" /></p>
 	<p>Tip percentage</p>
	
	<p>
	<?php
	for ($x = 10; $x<=20; $x+=5){
		echo"<input type=\"radio\" name = \"per$x\" /> $x% "; 
	}
	?>
	</p>
	<p><input type="submit" /></p>
</form>
