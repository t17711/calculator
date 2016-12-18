
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
                return "Percentage cannot be ngative";
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
            if($data>=0){
                return true;
            }
            else{
                return "Price is negative";
            }
        }

      return "Price cannot contain ". gettype($data);
    }


    // check if split is valid
    function m_valid_split($data){
        if(is_numeric($data)){ // check if enty is number
            if(is_int($data + 0)){ // check if number is integer

                if($data>=0){

                    return true;
                }
                else{
                    return "Split is negative";
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
        echo "<span class='badge'>" .$val . "</span>";
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