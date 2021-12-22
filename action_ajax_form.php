<?php

require_once 'ResultContainer.php';
require_once 'Database.php';

if (isset($_POST["name"]) && isset($_POST["age"]) && isset($_POST["email"])
    && isset($_POST["password"]) && isset($_POST["repeatpassword"])) {

    $resultConraineroop = new ResultContainer();

    $result = array(
        'name' => $_POST["name"],
        'age' => $_POST["age"],
        'email' => $_POST["email"],
        'password' => $_POST["password"],
        'repeatpassword' => $_POST["repeatpassword"]
    );

    if($result['password'] != $result['repeatpassword']) {
        $resultConraineroop->addError('repeatpassword', 'Пароли не совпадают');
    }

    $result['email'] = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    if (! $result['email']) {
        $resultConraineroop->addError('email', 'Введите правильный email');
    }

    if ($resultConraineroop->isEmpty() === false) {
        $a = json_encode(array('result' => 'error', 'text_error' => $resultConraineroop->getErrors()));
        $whireLog = fopen('log.txt', "a");
        fwrite($whireLog, $a . PHP_EOL);
        echo $a;
        exit();
    }


    $database = new Database();

    try {
        foreach ($database->getAllEmails() as $row) {
            if ($result['email'] == $row['email']) {
                //$resultContainer['name'] = 'Юзер уже существует';
                $resultConraineroop->addError('name', 'Юзер уже существует');
                setcookie("user", $_POST["name"], time() + (86400 * 30), '/');
//                if(isset($_COOKIE['user'])) {
//                    echo "Hello, " . $_COOKIE['user'];
//                }
                break;
            }
        }
    }
    catch (\Throwable $exception) {
        //Узнать у Миши зачем черточка
        $resultConraineroop->addError('database', 'Возникли проблемы с базой данных');
        $whireLog = fopen('log.txt', "a");
        fwrite($whireLog, $exception->getMessage() . PHP_EOL);
    }

    if ($resultConraineroop->isEmpty()) {
        $database->saveUsers($_POST["name"], $_POST["email"]);
        $a = json_encode(array('result' => 'success', ''));
    }
}

if ($resultConraineroop->isEmpty() === false) {
    $a = json_encode(array('result' => 'error', 'text_error' => $resultConraineroop->getErrors()));
}
$whireLog = fopen('log.txt', "a");
fwrite($whireLog, $a . PHP_EOL);
echo $a;




