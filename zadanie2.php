<?php
echo <<<_END
<html>
    <head>
	<title>Задание 2</title>
    </head>
    <body align='center'>
        <p>
            1. Сократить ссылку: скопируйте длинную ссылку в <b>'поле ввода'</b> и нажмите <b>'Сократить'</b> <br>
            2. Сделать собственную ссылку: скопируйте длинную ссылку в поле, заполните имя новой ссылки и нажмите <b>'Установить самому'</b> <br>          
        </p>
        <form method="post" action="dopzad.php">
            Введите ссылку:
            <input type="text"   name="url" placeholder='поле ввода'>
            <input type="submit" name='cut' value="Сократить">          <br><br>
            <input type="submit" name='set' value="Установить самому">
            <input type="text"   name="new" placeholder='новая ссылка'>
        </form>
         
    </body>
</html>
_END;

//переход по сокращенной ссылке
if (isset($_GET['id']))
{
    if (strlen($_GET['id'])==0) die ("Неверный параметр!<br>");
    $id=$_GET['id'];
    $query="SELECT url FROM links WHERE id='$id'";
    сonnectToDB();
    $result=$connection->query($query);
    if (!$result) die($connection->error);
    $row=$result->fetch_array(MYSQLI_ASSOC);
    header("Location: ". $row['url']);
    exit;
}

//сокращение длинной ссылке
if (isset($_POST['url']))
{  
    if (isset($_POST['cut'])) //установка имени новой ссылки программой
    {
        $rand=chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122)).chr(rand(97,122));
    }
    elseif (isset($_POST['set'])) // установка имени новой ссылки пользователем
    {
        if (strlen($_POST['new'])==0) die ("Ошибка: Введите новую ссылку<br>");
        $rand=$_POST['new'];
    }
    
    if (strlen($_POST['url'])==0) die ("Поле не может быть пустым!<br>");
    {
        $url=$_POST['url'];
        $query="INSERT INTO links VALUES('$rand', '$url')"; 
        сonnectToDB();
        $result=$connection->query($query);
        if (!$result) die("Сбой при доступе к базе данных: ".$connection->error);

        echo 'Ссылка сокращена <br> <a href=http://localhost:8080/Project1/zadanie2.php?id='.$rand.'> '
                . 'http://localhost:8080/Project1/zadanie2.php?id='.$rand.'</a>';
        exit;
    }
}

function сonnectToDB()
{
    $db_user='root';
    $db_pass='';
    $db_host='localhost';
    $db_name='test';
    global $connection;
    $connection= new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($connection->connect_error) die("Ошибка подключения к БД: ".$connection->connect_error);
}
?>