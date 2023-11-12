<?php
session_start();

$fruits = array("Apple", "Banana", "Orange", "Grapes", "Mango");

// Check if session variables are set, initialize them if not
if (!isset($_SESSION['fruitList1'])) {
    $_SESSION['fruitList1'] = array(1, 1, 1, 1, 1);
}

if (!isset($_SESSION['fruitList2'])) {
    $_SESSION['fruitList2'] = array(0, 0, 0, 0, 0);
}

// Initialize selectedFruitIndex
$selectedFruitIndex1 = null;
$selectedFruitIndex2 = null;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the "fruits1" and "fruits2" keys are set in $_POST
    $selectedFruitIndex1 = isset($_POST["fruits1"]) ? $_POST["fruits1"] : null;
    $selectedFruitIndex2 = isset($_POST["fruits2"]) ? $_POST["fruits2"] : null;

    // Check if the "fruitList1" and "fruitList2" keys are set in $_POST
    $fruitList1 = isset($_POST["fruitList1"]) ? unserialize(base64_decode($_POST["fruitList1"])) : $_SESSION['fruitList1'];
    $fruitList2 = isset($_POST["fruitList2"]) ? unserialize(base64_decode($_POST["fruitList2"])) : $_SESSION['fruitList2'];

    // Move the selected fruit from the first list to the second list
    if ($selectedFruitIndex1 !== null && isset($fruitList1[$selectedFruitIndex1]) && $fruitList1[$selectedFruitIndex1] === 1) {
        $fruitList1[$selectedFruitIndex1] = 0;
        $fruitList2[$selectedFruitIndex1] = 1;
    }

    // Move the selected fruit from the second list to the first list
    if ($selectedFruitIndex2 !== null && isset($fruitList2[$selectedFruitIndex2]) && $fruitList2[$selectedFruitIndex2] === 1) {
        $fruitList2[$selectedFruitIndex2] = 0;
        $fruitList1[$selectedFruitIndex2] = 1;
    }

    // Update session variables
    $_SESSION['fruitList1'] = $fruitList1;
    $_SESSION['fruitList2'] = $fruitList2;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruit Selection</title>
</head>

<body>

    <h2>Fruit List 1:</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <select name='fruits1'>
            <?php
            for ($i = 0; $i < count($_SESSION['fruitList1']); $i++) {
                if ($_SESSION['fruitList1'][$i] === 1) {
                    echo "<option value='$i'>$fruits[$i]</option>";
                }
            }
            ?>
        </select>
        <input type="hidden" name="fruitList1" value="<?php echo base64_encode(serialize($_SESSION['fruitList1'])); ?>">
        <input type="hidden" name="fruitList2" value="<?php echo base64_encode(serialize($_SESSION['fruitList2'])); ?>">
        <input type="submit" value="Move to List 2">
    </form>

    <h2>Fruit List 2:</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <select name='fruits2'>
            <?php
            for ($i = 0; $i < count($_SESSION['fruitList2']); $i++) {
                if ($_SESSION['fruitList2'][$i] === 1) {
                    echo "<option value='$i'>$fruits[$i]</option>";
                }
            }
            ?>
        </select>
        <input type="hidden" name="fruitList1" value="<?php echo base64_encode(serialize($_SESSION['fruitList1'])); ?>">
        <input type="hidden" name="fruitList2" value="<?php echo base64_encode(serialize($_SESSION['fruitList2'])); ?>">
        <input type="submit" value="Move to List 1">
    </form>

</body>

</html>