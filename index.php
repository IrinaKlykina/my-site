<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'model/User.php';


echo '<pre>';
var_dump($_POST);
echo '</pre>';

if (!isset ($_POST)) {
    include(__DIR__ . '/view/reg_form.html');
}
$dbh = new PDO('mysql:host=localhost;dbname=test', 'root', '');
$sth = $dbh->prepare('SELECT * from user');
$sth->execute();
$data = $sth->fetchAll();



$user = new \model\User($_POST);
var_dump ($user);


$number = strlen($user->password);

if($number >=6 && $user->age >=18)  {
    $sql = 'INSERT INTO user (password, login, name, age, gender) VALUES (:password, :login, :name, :age, :gender)';
    var_dump ($sql);
    $stmt= $dbh->prepare($sql);
    var_dump ($stmt);
    $result = $stmt -> execute ([
        'login' => $user->login,
        'name' => $user->name,
        'password' => $user->password,
        'age' => $user->age,
        'gender' => $user->gender,
    ]);
} else {
   if ($number <6) {
        echo "Пароль должен быть минимум 6 символов";
    }
    if ($number <6 || $user->password !== $user->confirmPassword) {
        include(__DIR__ . '/view/reg_form.html');
    }
    if ($user->age < 18) {
        echo "Сюда нельзя!";
    }
    if ($user->password !== $user->confirmPassword) {
        echo "Введенные пароли не совпадают!";
    }
}
?>