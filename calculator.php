<!DOCTYPE html>
<html lang="en">
<head>
   
    <!-- BOOTSTRAP -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- BOOTSTRAP -->

        <title>Tip Calculator</title>
        <link rel="stylesheet" type="text/css" href="StyleSheet1.css" />
</head>

<body>
    <div id="input_area">
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">

            <input class="form-control" type="text" name="input" value="<?php echo !empty($_POST['input']) ? $_POST['input'] : '0' ?>" />
                <label for="input"><span></span> Enter Bill subtotal </label>

            <hr />  
             
            <div class="panel panel-default" id="input_perc">
                <div class="panel-heading">Tip percentage</div>
                <div class="panel-body">
                    <?php
            generate_radio();
                    ?>
                </div>
                
                <div class="panel-body">
     
                    <input id="radio" type="radio" name="percentage" value="custom" <?php
                            if(!empty($_POST["percentage"]) && m_input($_POST["percentage"]) == "custom"){
                                echo "checked=\"checked\"";
                            }
                                                                                    ?> 
                            /> <label for="percentage"><span></span> custom </label>


                    <input class="form-control" type="text" name="custom" 
                           value="<?php echo !empty($_POST['custom']) ? $_POST['custom'] : '0' ?>" />
                    <label for="input">
                        <span></span>Enter Bill subtotal
                    </label>
                </div>

            </div>
          
            <input type="submit" class="btn btn-info" value="Submit" />

        </form>
        <hr />
        <ul class="list-group">
            <?php
            generate_result();
            ?>
        </ul>

    </div>

</body>

</html>

<?php



function generate_radio(){
    // import functions
    include 'action.php';

    // display radio button
    $percent_submitted =!empty($_POST["percentage"]);
    for ($x = 10; $x<=20; $x+=5){
         echo "<input id=\"radio\" type=\"radio\" name = \"percentage\" value=\"$x\"";
        if($percent_submitted && m_input($_POST["percentage"]) == $x)
            echo "checked=\"checked\"";
         echo "/> <label for=\"percentage\"><span></span> $x% </label> " ;
    }




}

function generate_result(){

    $bill_filled = !empty($_POST["input"]);
    $percent_submitted =!empty($_POST["percentage"]);
    $custom_perc_entered =!empty($_POST["custom"]);

    $text_input_error = $custom_input_error ="error";
    $valid_price = true;
    $valid_perc = true;
    $custom_selected =false;
    $val = 0;
    $perc = 0;
    if($bill_filled){
        $val = ($_POST['input']);
        $text_input_error =m_valid_price($val);
        $valid_price = is_bool($text_input_error);
    }

    if ($percent_submitted){
        $perc =m_input($_POST["percentage"]);
        if($perc == "custom"){
            $custom_selected =true;
            $valid_perc = false;
            if($custom_perc_entered){
                $temp = $_POST["custom"];
                $custom_input_error = m_valid_perc($temp);
                $valid_perc = is_bool($custom_input_error);
                if($valid_perc)
                    $perc = $temp;
            }

        }
        else{
            $valid_perc = true;
        }

    }



    if($bill_filled && $percent_submitted && $valid_price && $valid_perc) {

        $tip = m_percentage($val, $perc);
        m_display_list_groups("The Money is:",$val);
        m_display_list_groups( "The percentage is:",$perc);
        m_display_list_groups( "The Tip is:",$tip);
    }

    // errors
    if(!$bill_filled){
        m_print_error( "No number submitted");
    }
    if($percent_submitted){
        if($custom_selected){
            if($custom_perc_entered)
                 m_print_error($custom_input_error);
            else
                m_print_error("No Custom Percentage Entered");
        }

    }
    else{
        m_print_error("No percentage selected");
    }


    if(!$valid_price){
        m_print_error($text_input_error);
    }

}

?>