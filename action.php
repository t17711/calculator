
<?php
	function m_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
	     	return $data;
	}

	function m_percentage($money, $percentage){
		$val = $percentage/100;
		$val = $val*$money;
		return $val;
	}
?>
