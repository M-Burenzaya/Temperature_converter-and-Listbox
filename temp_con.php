<html>

<head>
    <meta charset="UTF-8">
    <title>Температур хөрвүүлэгч</title>
    <style>
        body {
            font-family: 'Courier New'; font-size: 20px;
            text-align: center;
        }

        form {
            width: 300px;
            margin: 20px; padding: 20px;
            border: 1px solid #ccc; border-radius: 8px;
            display: inline-block; text-align: center;
        }

        label {
            font-family: 'Courier New'; font-size: 20px;
            margin-bottom: 5px;
            display: block;
        }

        input {
            font-family: 'Courier New'; font-size: 20px;
            margin-bottom: 10px; padding: 5px;
            width: calc(100% - 20px);
        }

        input[type="submit"] {
            font-family: 'Courier New'; font-size: 18px; color: white;
            background-color: #4caf50;
            padding: 10px 15px;
            border: none; border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .result {
            font-size: 30px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php if ($_SERVER['REQUEST_METHOD'] == 'GET') { ?>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <input type="hidden" name="indicator" value="1" />
            <input type="hidden" name="F" value="0" />
            <input type="submit" value="Температур хөрвүүлэгч" />
        </form>

    <?php } else if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <label for="F">Фаренгейтын температур</label>
            <input type="hidden" name="indicator" value="1" />
            <input type="text" name="F" /><br />
            <input type="submit" value="Цельс-рүү хөрвүүл!" />
        </form>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <label for="C">Цельсын температур</label>
            <input type="hidden" name="indicator" value="0" />
            <input type="text" name="C" /><br />
            <input type="submit" value="Фарангейт-рүү хөрвүүл!" />
        </form>

        <?php
        if ($_POST['indicator']) {
            $F = $_POST['F'];
            $C = ($F - 32) * 5 / 9;
            printf("<p class='result'>%.2fF = %.2fC</p>", $F, $C);
        } else {
            $C = $_POST['C'];
            $F = ($C * (9 / 5)) + 32;
            printf("<p class='result'>%.2fC = %.2fF</p>", $C, $F);
        }
        ?>

    <?php } else {
        die("Зөвхөн Post болон Get хүсэлт авна.");
    } ?>
</body>

</html>
