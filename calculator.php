<!DOCTYPE html>
<html lang="en">
<head>

    <!-- BOOTSTRAP -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />

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
            <div id="input_price" class="input-group input-group-lg">
                <span class="input-group-addon">$</span>
                <input class="form-control" type="text" name="input" value="<?php echo isset($_POST['input']) ? $_POST['input'] : '' ?>" />
            </div>
            <div class="panel-footer">Enter Bill subtotal </div>

            <hr />
            <div class="panel panel-default" id="input_perc">
                <div class="panel-heading">Tip percentage</div>
                <div class="panel-body">
                    <?php  generate_radio();   ?>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon">
                            <input id="radio" type="radio" name="percentage" value="custom"
                                <?php if(isset($_POST["percentage"]) && m_input($_POST["percentage"]) == "custom"){echo "checked='checked'";}?> />
                            custom
                        </span>

                        <input class="form-control" type="text" name="custom" value="<?php echo isset($_POST['custom']) ? $_POST['custom'] : '' ?>" />

                        <span class="input-group-addon">%</span>

                    </div>


                </div>

            </div>

            <div id="input_split" class="input-group input-group-lg">
                <span class="input-group-addon">Split</span>
                <input class="form-control" type="text" name="split" value="<?php echo isset($_POST['split']) ? $_POST['split'] : '1' ?>" />
            </div>

            <hr />
            <input type="submit" class="btn btn-info" value="Submit" />

        </form>
        <hr />
        <ul class="list-group">
            <?php  generate_result();   ?>
        </ul>

    </div>

</body>

</html>

<?php

    function generate_result(){

        // checks all the form fields validates input and outputs result
        $bill_filled = isset($_POST["input"]);
        $percent_submitted =isset($_POST["percentage"]);
        $custom_perc_entered =isset($_POST["custom"]);
        $split_submitted =isset($_POST["split"]);

        $text_input_error = $custom_input_error = $split_input_error = "error";
        $valid_price = true;
        $valid_perc = false;
        $valid_split = false;
        $custom_selected =false;
        $val = 0;
        $perc = 0;
        $split = 0;

        // check split value
        if($split_submitted){
            $split= $_POST['split'];
            $split_input_error = m_valid_split($split);
            $valid_split = is_bool($split_input_error); // if return is bool then valid
        }
        else {
            $split =1;
            $valid_split = true;
        }


        // if bill area filled check value
        if($bill_filled){
            $val = ($_POST['input']);
            $text_input_error =m_valid_price($val); // returns true if valid else returns error description string
            $valid_price = is_bool($text_input_error); // if return is bool then valid
        }

        // if percent selected get percent value
        if ($percent_submitted){
            $perc =m_input($_POST["percentage"]);

            // if custom button selected then get custom value by reading custom field
            if($perc == "custom"){
                $custom_selected =true; // so we have custom value selected

                // check custom values
                if($custom_perc_entered){
                    $temp = $_POST["custom"];
                    $custom_input_error = m_valid_perc($temp); // returns true if valid else returns error description string
                    $valid_perc = is_bool($custom_input_error);
                    if($valid_perc)
                        $perc = $temp;
                }

            }
            else{ // if custom not selected then radio gives valid
                $valid_perc = true;
            }

        }


        // if bill is filled and price is valid, percent is selected and is valid then get tip
        if($bill_filled && $percent_submitted && $valid_price && $valid_perc && $valid_split) {

            $tip = m_percentage($val, $perc);
            m_display_list_groups("The Subtotal ". $val . " and tip ". $perc . "%","");
            m_display_list_groups( "The Tip is:",$tip);
            if($split>1){
                m_display_list_groups( "Tip split ". $split . " ways is : ",$tip/$split);
            }
        }

        // errors
        if(!$bill_filled){ // if bill not filled
            m_print_error( "No number submitted");
        }


        if($percent_submitted){
            if($custom_selected){ // custom percentage error check, if it is selected
                if($custom_perc_entered){// if custom value is entered
                    if(!$valid_perc){ // and entered value is not valid print errors
                        m_print_error($custom_input_error);
                    }
                }
                else{// if nothing entered show this
                    m_print_error("No Custom Percentage Entered");
                }
            }

        }
        else{ // percent not submitted
            m_print_error("No percentage selected");
        }


        if(!$valid_price){ // price submitted but not valid
            m_print_error($text_input_error);
        }

        if(!$valid_split){
            m_print_error($split_input_error);
        }
    }


    function generate_radio(){

        // import functions
        include 'action.php';

        // display radio button
        $percent_submitted =isset($_POST["percentage"]);
        for ($x = 10; $x<=20; $x+=5){
            // three number button
            echo "<input id='radio' type='radio' name = 'percentage' value='$x'";
            if($percent_submitted && m_input($_POST["percentage"]) == $x)
                echo "checked='checked'";
            echo "/> <label for='percentage'><span></span> $x% </label> " ;
        }

    }

?>