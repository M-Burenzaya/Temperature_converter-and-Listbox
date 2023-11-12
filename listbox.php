<?php
session_start();

$fruits = array("Алим", "Гадил", "Жүрж", "Тарвас", "Манго");

if (!isset($_SESSION['fruitList1'])) {
    $_SESSION['fruitList1'] = array(1, 1, 1, 1, 1);
}

if (!isset($_SESSION['fruitList2'])) {
    $_SESSION['fruitList2'] = array(0, 0, 0, 0, 0);
}

$selectedFruitIndex1 = null;
$selectedFruitIndex2 = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {            //Форм илгээгдсэн үед

    $selectedFruitIndex1 = isset($_POST["fruits1"]) ? $_POST["fruits1"] : null;         //аль нэг лист өөрчлөгдсөн эсэх
    $selectedFruitIndex2 = isset($_POST["fruits2"]) ? $_POST["fruits2"] : null;

    $fruitList1 = isset($_POST["fruitList1"]) ? unserialize(base64_decode($_POST["fruitList1"])) : $_SESSION['fruitList1'];
    $fruitList2 = isset($_POST["fruitList2"]) ? unserialize(base64_decode($_POST["fruitList2"])) : $_SESSION['fruitList2'];

    if ($selectedFruitIndex1 !== null && isset($fruitList1[$selectedFruitIndex1]) && $fruitList1[$selectedFruitIndex1] === 1) {
        $fruitList1[$selectedFruitIndex1] = 0;                                          //2 дахь лист өөрчлөгдсөн үед
        $fruitList2[$selectedFruitIndex1] = 1;
    }

    if ($selectedFruitIndex2 !== null && isset($fruitList2[$selectedFruitIndex2]) && $fruitList2[$selectedFruitIndex2] === 1) {
        $fruitList2[$selectedFruitIndex2] = 0;                                          //эхний лист өөрчлөгдсөн үед
        $fruitList1[$selectedFruitIndex2] = 1;
    }

    $_SESSION['fruitList1'] = $fruitList1;
    $_SESSION['fruitList2'] = $fruitList2;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Жимсний - listbox</title>
    <style>
        body {
            font-family: 'Courier New'; font-size: 20px;
            text-align: center;
        }

        .container {
            display: flex; justify-content: center;
            margin: 20px;
        }

        form {
            width: 300px;
            padding: 20px; margin: 20px;
            border: 1px solid #ccc; border-radius: 8px;
            text-align: center;
        }

        select {
            font-family: 'Courier New'; font-size: 20px;
            margin-bottom: 10px; width: calc(100% - 20px);
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

        h2 {
            font-family: 'Courier New'; font-size: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

            <h2>Жимсний жагсаалт 1:</h2>

            <select name='fruits1' multiple size="<?php echo count($_SESSION['fruitList1']); ?>">
                <?php
                for ($i = 0; $i < count($_SESSION['fruitList1']); $i++) {
                    if ($_SESSION['fruitList1'][$i] === 1) {
                        echo "<option value='$i'>$fruits[$i]</option>";
                    }
                }
                ?>
            </select>

            <br>
            <input type="hidden" name="fruitList1" value="<?php echo base64_encode(serialize($_SESSION['fruitList1'])); ?>">
            <input type="hidden" name="fruitList2" value="<?php echo base64_encode(serialize($_SESSION['fruitList2'])); ?>">
            <input type="submit" value="Жагсаалт 1 - рүү">
        </form>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

            <h2>Жимсний жагсаалт 2:</h2>

            <select name='fruits2' multiple size="<?php echo count($_SESSION['fruitList2']); ?>">
                <?php
                for ($i = 0; $i < count($_SESSION['fruitList2']); $i++) {
                    if ($_SESSION['fruitList2'][$i] === 1) {
                        echo "<option value='$i'>$fruits[$i]</option>";
                    }
                }
                ?>
            </select>
            
            <br>
            <input type="hidden" name="fruitList1" value="<?php echo base64_encode(serialize($_SESSION['fruitList1'])); ?>">
            <input type="hidden" name="fruitList2" value="<?php echo base64_encode(serialize($_SESSION['fruitList2'])); ?>">
            <input type="submit" value="Жагсаалт 2 - руу">
        </form>
    </div>

</body>

</html>

