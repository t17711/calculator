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

                <input class="form-control" type="number" name="input" min="1" max="10000" />
                <label for="input"><span></span> Enter Bill subtotal </label>

            <hr />  
             
            <div class="panel panel-default" id="input_perc">
                <div class="panel-heading">Tip percentage</div>
            
                <?php
            generate_radio();
                ?>
            </div>

          
            <hr />
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

    for ($x = 10; $x<=20; $x+=5){
        echo "<input id=\"radio\" type=\"radio\" name = \"percentage\" value=\"$x\"  /> <label for=\"percentage\"><span></span> $x% </label> " ;
    }


}

function generate_result(){

    $bill_filled = !empty($_POST["input"]);
    $percent_submitted =!empty($_POST["percentage"]);

    if($bill_filled && $percent_submitted) {
        $val = htmlspecialchars($_POST['input']);
        echo "<li class=\"list-group-item\">";
        echo "<span class=\"badge\">" .$val . "</span>";
        echo "The Money is:";
        echo "</li>";
        $perc =m_input($_POST["percentage"]);
        echo "<li class=\"list-group-item\">";
        echo "<span class=\"badge\">" .$perc . "</span>";
        echo "The percentage is:";
        echo "</li>";

        $tip = m_percentage($val, $perc);
        echo "<li class=\"list-group-item\">";
        echo "<span class=\"badge\">" .$tip . "</span>";
        echo "The Tip is:";
        echo "</li>";

    }

    else{
        if(!$bill_filled){
            echo "<li class=\"list-group-item\">";
            echo "No number submitted";
            echo "</li>";
        }
        if(!$percent_submitted){
            echo "<li class=\"list-group-item\">";
            echo "No percentage selected";
            echo "</li>";
        }
    }
}

?>