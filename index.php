<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Телефонный справочник</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="icon" type="image/x-icon" href="favicon.png">
</head>
<body>
<?php
$host = 'localhost';
$user = 'haraim6m_phone';
$pass = 'v&cNYHs7';
$db_name = 'haraim6m_phone';
$link = mysqli_connect($host, $user, $pass, $db_name);

if (isset($_POST["Name"])) {
    if (isset($_GET['red'])) {
        $sql = mysqli_query($link, "UPDATE `products` SET `Name` = '{$_POST['Name']}',`Price` = '{$_POST['Price']}', `about` = '{$_POST['about']}' WHERE `ID`={$_GET['red']}");
    } else {
        $sql = mysqli_query($link, "INSERT INTO `products` (`Name`, `Price`, `about`) VALUES ('{$_POST['Name']}', '{$_POST['Price']}', '{$_POST['about']}')");
    }
}
if (isset($_GET['del'])) {
    $sql = mysqli_query($link, "DELETE FROM `products` WHERE `ID` = {$_GET['del']}");
}
if (isset($_GET['red'])) {
    $sql = mysqli_query($link, "SELECT `ID`, `Name`, `Price`, `about` FROM `products` WHERE `ID`={$_GET['red']}");
    $product = mysqli_fetch_array($sql);
}
?>
<main>
    <div class="add-field">
        <p>Добавить контакт в справочник</p>
        <a href="#openModal"><button>Добавить</button></a>
        <div id="openModal" class="modalDialog">
            <div class="windows">
                <a href="#close" title="Закрыть" class="close">X</a>
                <form action="" method="post">
                    <input type="text" name="Name" value="<?= isset($_GET['red']) ? $product['Name'] : ''; ?>" placeholder="Введите ваши ФИО"><br>
                    <input type="tel" name="Price"  value="<?= isset($_GET['red']) ? $product['Price'] : ''; ?>" placeholder="Введите ваш телефон"><br>
                    <input type="text" name="about" value="<?= isset($_GET['red']) ? $product['about'] : ''; ?>" placeholder="Кем приходитесь"><br>
                    <input type="submit" value="Добавить">
                </form>
            </div>
        </div>
    </div>
    <div class="telephoneDirectory">
        <h3>Телефонный справочник</h3>
        <table>
            <tr>
                <th>ФИО</th>
                <th>Телефон</th>
                <th>Кем приходитесь</th>
                <th>Кнопки действия</th>
            </tr>
            <?php
            $sql = mysqli_query($link, 'SELECT `ID`, `Name`, `Price`, `about` FROM `products`');
            while ($result = mysqli_fetch_array($sql)) {
                echo "<tr><td>{$result['Name']}</td> 
                          <td>{$result['Price']}</td>
                          <td>{$result['about']}</td>
                          <td><a href='?del={$result['ID']}'>Удалить</a><br> 
                              <a href='?red={$result['ID']}'>Редактировать</a></td></tr>";
            }
            ?>
        </table>
    </div>
</main>
</body>
</html>
