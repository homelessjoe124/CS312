<?php 
$table = $_POST["table"] ?? "";
$colors = $_POST["colors"] ?? "";
$selectedColors = $_POST["selectedColors"] ?? [];
?>

<!DOCTYPE html>
<html lang="en"> 
<head> 
    <meta charset="UTF-8">
    <title>Printable View</title>

    /* i will make aseparate stylesheet later im just too tired right now*/ 

    <style> 

        @media print{

            body {
                background: white;
            }

            .page{
                width: 100%;
                margin: 20px auto;
                padding: 0.4in;
                background: white;
                box-sizing: border-box;
            }

            .back-button {
                display: none;
            }
        }

        body {
            background-color: #e9e9e9;
            color: #222;
            margin: 0;
            padding: 0;
        }

        .page {
            width: 760px;
            margin: 0 auto;
            background-color: #f3f3f3;
            padding: 24px 28px 32px 28px;
            box-sizing: border-box;
        }

        .subtitle {
            font-size: 12px;
            color: #666;
            margin: 0 0 10px 0;
        }

        .back-button {
            display: inline-block;
            background-color: #333;
            color: white;
            text-decoration: none; 
            font-size: 12px;
            font-weight: bold;
            padding: 6px 14px;
            margin-bottom: 16px;
        }

        .divider {
            border: none;
            border-top: 2px solid #444;
            margin: 0 0 16px 0;
        }

        table {
            border-collapse: collapse;
        }

        .grid-table {
            margin-top: 4px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin: 14px 0 6px 0;
            padding-bottom: 3px;
            border-bottom: 1px solid #bdbdbd;
        }

        .company-title {
            font-size: 34px;
            font-weight: bold;
            margin: 0 0 2px 0;
        }

        .color-list {
            width: 100%;
            margin-bottom: 14px;
        }

        .color-list td {
            border: 1px solid #c8c8c8;
            height: 28px;
            padding: 0 8px;
            font-size: 13px;
        }

        .color-list td:first-child {
            width: 20%;
            background-color: #dddd;
            font-weight: bold;
        }

        .color-list td:last-child {
            width: 80%;
            background-color: #f5f5f5;
        }

        .grid-table {
            margin-top: 4px;

        }

        .grid-table th, .grid-table td {
            border: 1px solid #c8c8c8;
            height: 26px;
            width: 26px;
            vertical-align: middle;
            text-align: center;
            font-size: 12px;
            padding: 0;
        }

        .grid-table th {
            background-color: #dddddd;
            font-weight: bold;
        }

        .grid-table .blank {
            background-color: #f3f3f3;
            border: none;
        }

    </style>

</head>


<body>
    <div class="page">
        <a href="color.php" class="back-button"> <- back to the color coordinator </a>

        <h1 class="company-title"> ColorCraft Studio</h1>
        
        <h2 class="subtitle"> Professional Color Coordination Tools - Printable View </h2>

        <hr class="divider">

        <div class="section-title"> Color Selection </div>

        <table class="color-list">

            <?php for ($i = 0; $i < count($selectedColors); $i++): ?>

                <tr>
                    <td><?php echo htmlspecialchars($selectedColors[$i]); ?></td>
                    <td></td>
                </tr>

            <?php endfor; ?>
        </table>


        <div class="section-title"> Coordinate Grid </div>
        <table class="grid-table">
            <tr>
                <td class="blank"></td>

                <?php for ($col = 0; $col < $table; $col++): ?>

                    <th><?php echo chr(65 + $col); ?></th>

                <?php endfor; ?>
            </tr>

            <?php for ($row = 1;  $row <= $table; $row++): ?>
                <tr>
                    <th><?php echo $row; ?></th>

                    <?php for ($col = 0; $col < $table; $col++): ?>

                        <td></td>

                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>

        </table>
    </div>
</body>
</html>