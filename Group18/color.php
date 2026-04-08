<?php
/* links to things i used to make the jav axcript and excemptions/errors 
https://www.w3schools.com/php/php_forms.asp
https://www.w3schools.com/php/php_form_validation.asp
https://www.w3schools.com/js/js_events.asp

*/
$table = "";
$colors = "";
$excemption= [];
$options =["Red","Orange","Yellow","Green","Blue","Purple","Grey","Brown","Black","Teal"];

 if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $table = $_POST["boxes"] ??"";
    $colors = $_POST["color"] ?? "";
    if ($table <1|| $tabe >26){
        $excemption[] ="supposed to be between 1 and 26. pleaes pick again";
    }
    if($colors <1|| $colors>10){
        $excemption[] ="supposed to be between 1 and 10 colors";
    }
 }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Color Selections</title>
    <meta name= "author" content="Adrian Nieves, Miguel Mejia, Sandra Madrigal">
    <link rel = "stylesheet" href = "style.css">
</head>
<body>
    <header>
        <h1>
            Horizon Labs
        </h1>
        <p> The Event Horizon of color selection, for no color can escape our pull.</p>
        <nav>
            <a href="index.php"> Home</a>
            <a href= "about.php"> About</a>
            <a href = "color.php"> Color Select</a>
        </nav>
    </header>
    <main class= "Selection">
        <section>
            <h2> Table maker</h2>
            <p> Please choose the amount of rows and collumns you want.
                Then the colors you wish to use.
            </p>
            <form action= "color.php" method = "post">
                <lable for = "table"> Rows and Collumns(1 to 26):</lable><br>
                <input type ="number" id="table" name="table" min="1" max="26" value= "<?php echo htmlspecialcharts($table);?>"><br><br>
                <lable for = "colors"> colors(1 to 10):</lable><br>
                <input type ="number" id="colors" name="colors" min="1" max="10" value= "<?php echo htmlspecialcharts($colors);?>"><br><br>
                <input type= "submit" value="generate">
            </form>
            <?php
            if (!empty($excemption)){
                echo "<div class = 'errors'>";
                foreach ($excemption as $Excempt){
                    echo "<p>" . htmlspecialchars($Excempt) . "</p>";
                }
                echo "</div>";
            }
            ?>

        </section>
        
    </main>
</body>
</html>