<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tip Calculator</title>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <div class="container">
        <div class="form-group">
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                <div class="container">
                    <div class="col-xs-5">
                        <p>
                            <h1>
                                <label class="label label-default">Bill subtotal:</label>
                            </h1>
                            <input class="form-control" type="number" name="input" min="1" max="10000"/>
                        </p>
                    </div>
                </div>

                <div class="container">
                    <div class="col-xs-10">
                        <h1>
                            <label class="label label-default">Tip percentage:</label>
                        </h1>
                        <div>
                            <p>
                                <?php
                            generate_radio();
                                ?>
                            </p>
                        </div>

                        <div class="col-xs-10">
                            <p>
                                <input type="submit" class="btn btn-info" value="Submit" />
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="w3-container">
        <div class="col-xs-10">
            <p>
                <?php
            generate_result();
                ?>
            </p>
        </div>
    </div>

</body>

</html>

<?php
function generate_radio(){

    // import functions
    include 'action.php';
    // display radio button

    for ($x = 10; $x<=20; $x+=5){
        echo "<div class=\"radio\">
              <label>
                <input type=\"radio\" name = \"percentage\" value=\"$x\"  /> $x%
                </label>
                <div>" ;
    }


}

function generate_result(){

    $bill_filled = !empty($_POST["input"]);
    $percent_submitted =!empty($_POST["percentage"]);

    if($bill_filled && $percent_submitted) {
        $val = htmlspecialchars($_POST['input']);
        echo "<h4> <label class=\"label label-default\">" . "The Money is:" . $val . "</label></h2>";

        $perc =m_input($_POST["percentage"]);
        echo "<h4> <label class=\"label label-default\">" . "The percentage is:" . $perc . "</label></h2>";

        $tip = m_percentage($val, $perc);

        echo "<h4> <label class=\"label label-default\">" . "The Tip is:" . $tip . "</label></h2>";


    }
}

?>