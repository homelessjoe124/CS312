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
    $table = $_POST["table"] ??"";
    $colors = $_POST["colors"] ?? "";
    if ($table <1|| $table >26){
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
                <label for = "table"> Rows and Collumns(1 to 26):</label><br>
                <input type ="number" id="table" name="table" min="1" max="26" value= "<?php echo htmlspecialchars($table);?>"><br><br>
                <label for = "colors"> colors(1 to 10):</label><br>
                <input type ="number" id="colors" name="colors" min="1" max="10" value= "<?php echo htmlspecialchars($colors);?>"><br><br>
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
        <?php
        if ($_SERVER["REQUEST_METHOD"]== "POST" && empty($excemption)): 
        ?>
        <section>
            <h2> Color selection</h2>
            <table>
                <?php 
                 for ($i=0; $i < $colors; $i++) : 
                ?>
                <tr>
                    <td>
                        COLOR <?php echo $i +1;?>
                    </td>
                    <td>
                        <select name ="color<?php echo $i;?>" class ="color-dropdown">
                            <?php foreach ($options as $index => $colorOptions):?>
                                <option value="<?php echo $colorOptions; ?>" <?php if  ($index==$i) echo "selected"; ?>>
                                    <?php
                                    echo $colorOptions;
                                    ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <?php endfor;?>
            </table>
            <p id="color-message"></p>
        </section>
        <section>
            <h2> Table</h2>
            <table class= "color-table">
                <tr>
                    <th></th>
                    <?php for ($col =0; $col<$table; $col++): ?>
                        <th> <?php echo chr(65 +$col); ?></th>
                    <?php endfor;?>
                </tr>
                <?php for ($row =1; $row<= $table; $row++): ?>
                    <tr>
                        <th> <?php echo $row; ?></th>
                        <?php for ($col=0; $col < $table; $col++): ?>
                            <td></td>
                        <?php endfor; ?>
                    </tr>
                    <?php endfor; ?>
            </table>
        </section>
        <section>
            <form action= "print.php" method="post">
                <input type="hidden" name="table" value="<?php echo htmlspecialchars($table);?>">
                <input type="hidden" name="colors" value="<?php echo htmlspecialchars($colors);?>">

                <?php for ($i = 0; $i < $colors; $i++): ?>
                    <input type="hidden" name="selectedColors[]" id="hidden-color-<?php echo $i; ?>" value="<?php echo htmlspecialchars($_POST["color$i"] ?? $options[$i]); ?>">
                <?php endfor; ?>

                <input type="submit" value= "Printable Version">
            </form>
        </section>
        <?php endif; ?>
    </main>
    <footer>
        <p>CS 312 Project. Created by group 18(Adrian Nieves, Miguel Mejia, Sandra Madrigal ) </p>
    </footer>
    <script>
        /*
        used this lecture
         https://colostate-my.sharepoint.com/:p:/g/personal/arefin_colostate_edu/IQBZRDyzJzy8RIUP7imPsO09AYpcBvfpj35-AkmTtzOj6XY?e=onyeX9
        and these websites we where given
        https://www.w3schools.com/js/js_events.asp
         */
        document.addEventListener("DOMContentLoaded", function () {
        let dropdowns = document.querySelectorAll(".color-dropdown");
        let message = document.getElementById("color-message");

        dropdowns.forEach(function(dropdown, index) {
            let hiddenInput = document.getElementById("hidden-color-" + index);
            dropdown.dataset.previous = dropdown.value;

            dropdown.addEventListener("focus", function() {
                this.dataset.previous = this.value;
            });

            dropdown.addEventListener("change", function() {
                let currentValue = this.value;
                let duplicateFound = false;

                dropdowns.forEach(function(otherDropdown) {
                    if (otherDropdown !== dropdown && otherDropdown.value === currentValue) {
                        duplicateFound = true;
                    }
                });

                if (duplicateFound) {
                    message.textContent = "That color is already being used. Please choose a different one.";
                    dropdown.value = dropdown.dataset.previous;
                } else {
                    message.textContent = "";
                    dropdown.dataset.previous = currentValue;
                }
                if (hiddenInput) {
                    hiddenInput.value = dropdown.value;
                }
            });
        });
    });
    </script>

    /* added a pipeline connecting to print.php (sending the selected colors as hiddenInput mainly)- Miguel */

</body>
</html>