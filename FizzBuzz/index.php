<!--Напишите программу, которая выводит на экран числа от 1 до 100. При этом,-->
<!--вместо чисел, кратных 3, программа должна выводить слово "Fizz", а вместо-->
<!--чисел, кратных 5 - слово "Buzz". Если число кратно и 3, и 5, то программа должна выводить-->
<!--слово "FizzBuzz".-->
<!--Основные условия: KISS DRY, читаемость и не повоторяемость, наличие двух
проверок типа $i % 3 == 0 или <br> уже считается, как повтор.-->


<?php

spl_autoload_register(function ($classname) {
    require_once ($classname.'.php');
});

function checkNum() {
    for ($i=1; $i<=100; $i++) {
        $result = '';
        $num = new CheckThree(new CheckFive(new EchoNum()));
        $result = $num->show($i, $result);
        echo $result;
    }
}

checkNum();

