<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tip Calculator</title>
    <link rel="stylesheet" type="text/css" href="StyleSheet1.css" />
</head>

<body>
    <div id="input_area">
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">

            <div class="container" id="input_money">
                <input class="form-control" type="number" name="input" min="1" max="10000" />
                <label for="input"><span></span> Enter Bill subtotal </label>
            </div>

            <hr />  
             
            <div class="container"  id="input_perc">
                <label>Tip percentage</label>
                <hr />
                <?php
            generate_radio();
                ?>
            </div>

          
            <hr />
            <input type="submit" class="btn btn-info" value="Submit" />

        </form>

        <table id="output_area">
            <?php
            generate_result();
            ?>
        </table>

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
        echo "<tr>";
        echo "<td>" . "The Money is:</td><td>" . $val . "</td>";
        echo "</tr>";
        $perc =m_input($_POST["percentage"]);
        echo "<tr>";
        echo "<td>" . "The percentage is:</td><td>" . $perc . "</td>";
        echo "</tr>";

        $tip = m_percentage($val, $perc);
        echo "<tr>";
        echo "<td>". "The Tip is:</td><td>" . $tip . "</td>";
        echo "</tr>";

    }

    else{
        if(!$bill_filled){
            echo "<tr><td>";
            echo "No number submitted";
            echo "</td></tr>";
        }
        if(!$percent_submitted){
            echo "<tr><td>";
            echo "No percentage selected";
            echo "</td></tr>";
        }
    }
}

?>