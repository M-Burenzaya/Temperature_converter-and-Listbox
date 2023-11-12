<html>

<head>
    <meta charset="UTF-8">
    <title>Температур хөрвүүлэгч</title>
</head>

<body>
    <?php if ($_SERVER['REQUEST_METHOD'] == 'GET') { ?>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            Фаренгейтын температур:
            <input type="text" name="F" /><br />
            <input type="submit" value="Цельс-рүү хөрвүүл!" />
        </form>
        
    <?php } else if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            Фаренгейтын температур:
            <input type="hidden" name="indicator" value="1" />
            <input type="text" name="F" /><br />
            <input type="submit" value="Цельс-рүү хөрвүүл!" />
        </form>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            Цельсын температур:
            <input type="hidden" name="indicator" value="0" />
            <input type="text" name="C" /><br />
            <input type="submit" value="Фарангейт-рүү хөрвүүл!" />
        </form>

        <?php
        if($_POST['indicator']){
            $F = $_POST['F'];
            $C = ($F - 32) * 5 / 9;
            printf("%.2fF is %.2fC", $F, $C);
        }
        else{
            $C = $_POST['C'];
            $F = ($C * (9 / 5)) + 32;
            printf("%.2fC is %.2fF", $C, $F);
        }
        ?>
        

    <?php } else {
        die("This script only works with GET and POST requests.");
    } ?>
</body>

</html>