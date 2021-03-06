
<?php

// this gets input from radio button
	function m_input($data) {
        if(!empty($data)) return $data;
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
	    return $data;
	}

    // check if percentage is between 0 - 100 and is number
    function m_valid_perc($data){
        if(is_numeric($data)){
            if($data<0){
                return "Percentage cannot be negative";
            }
            else if ($data > 100){
                return "Percentage cannot be bigger than 100%";
            }
            else{
                return true;
            }
        }
        return "Percentage cannot contain ". gettype($data);

    }

    // check if price is number and is bugger than 0
    function m_valid_price($data){
        if(is_numeric($data)){
            if($data>0){
                return true;
            }
            else{
                if ($data == 0) return "Subtotal cannot be 0";
                return "Subtotal cannot be negative";
            }
        }

        return "Subtotal cannot contain ". gettype($data);
    }


    // check if split is valid
    function m_valid_split($data){
        if(is_numeric($data)){ // check if entry is number
            if(is_int($data + 0)){ // check if number is integer

                if($data>0){

                    return true;
                }
                else{
                    if ($data == 0) return "Cannot split 0 ways";
                    return "cannot split negative ways";
                }
            }
            return "split number must be integer";
        }
        return "Split cannot contain ". gettype($data);

    }

    // calculate percentage
	function m_percentage($money, $percentage){
		$val = $percentage/100;
		$val = $val*$money;
		return $val;
	}

    // displays list of item
    function m_display_list_groups($statement,$val){
        echo "<li class='list-group-item'>";
        if(is_numeric($val))
            echo "<span class='badge'> $" .number_format($val,2) . "</span>";
        echo $statement;
        echo "</li>";
    }

    // prints error
    function m_print_error($data){
        echo "<li class='list-group-item'>";
        echo $data;
        echo "</li>";
    }

?>
