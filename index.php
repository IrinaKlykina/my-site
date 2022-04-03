<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


echo '<pre>';
var_dump($_POST);
echo '</pre>';

if (!isset ($_POST)) {
	include(__DIR__ . '/index.html');
}	
$dbh = new PDO('mysql:host=localhost;dbname=test', 'root', '');
$sth = $dbh->prepare('SELECT * from user');
$sth->execute();
$data = $sth->fetchAll(); 

/*require_once 'User.php'; 
$user = new User;*/

$password = $_POST['password']; 
$confirmPassword = $_POST['confirmPassword'];
$age = $_POST['age'];
$name = $_POST['name'];
$login = $_POST['login'];
$gender = $_POST['gender'];

$number = strlen($password);
	//var_dump ($number);

if($number >=6 && $age >=18)  {
	$sql = 'INSERT INTO user (password, login, name, age, gender) VALUES (:password, :login, :name, :age, :gender)';
	var_dump ($sql);
	$stmt= $dbh->prepare($sql);
	var_dump ($stmt);
	$result = $stmt -> execute ([
    'login' => $login,
	'name' => $name,
	'password' => $password,
	'age' => $age,
	'gender' => $gender,
	]);
	} else {
		if ($number <6) {
			echo "Пароль должен быть минимум 6 символов";
		}
		if ($number <6 || $password !== $confirmPassword) {
			include(__DIR__ . '/index.html');
		}
		if ($age < 18) {
			echo "Сюда нельзя!";
		}
		if ($password !== $confirmPassword) {
			echo "Введенные пароли не совпадают!";
		}
	}
?>	