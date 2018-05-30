<html>
    <head>
	<title>Задание 1</title>
    </head>
    <body>
        <form method="post" action="zadanie1.php">
            <p>Введите количество необходимых Вам чисел:</p>
            <input type="text" name="kol">
            <input type="submit" value="Вычислить">
        </form>
    </body>
</html>

<?php
if (isset($_POST["kol"]))
{
    $kolich = htmlentities($_POST["kol"]);
    vychislenie($kolich);
}

function vychislenie($kolich)
{
    $n=0; // число необходимых элементов
    $k=0; // число от 0 до бесконечности

    while ($kolich!=$n)
    {
        if (($k%strlen($k)) ==0)
        {
            echo $k,", "; 
            $n=$n+1;
            $k=$k+1;
        }
        else 
        {$k+=1;}

    }
}
?>





