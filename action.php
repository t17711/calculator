
<?php
	function m_input($data) {
        if(!empty($data)) return $data;
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
	    return $data;
	}

    function m_valid_perc($data){
        if(is_numeric($data)){
            if($data<0){
                return "Percentage cannot be ngative";
            }
            else if ($data > 100){
                return "Percentage cannot be bigger than 100%";
            }
            else{
                return true;
            }
        }
        else{
            return "Percentage cannot contain ". gettype($data);
        }
    }

    function m_valid_price($data){
        if(is_numeric($data)){
            if($data>=0){
                return true;
            }
            else{
                return "Price is negative";
            }
        }
        else{
            return "Price cannot contain ". gettype($data);
        }
    }

	function m_percentage($money, $percentage){
		$val = $percentage/100;
		$val = $val*$money;
		return $val;
	}

    function m_display_list_groups($statement,$val){
        echo "<li class=\"list-group-item\">";
        echo "<span class=\"badge\">" .$val . "</span>";
        echo $statement;
        echo "</li>";
    }

    function m_print_error($data){
        echo "<li class=\"list-group-item\">";
        echo $data;
        echo "</li>";
    }

?>
