<?php
function logic1(){
    $num = readline("Введите число строк: ");
    $lines = [];
    $words = ["out", "output", "puton", "in", "input", "one"];
    for ($i = 0; $i < $num; $i++){
        $line = readline("Введите строку:");
        array_push($lines, $line); 

    }
    foreach($lines as $line){
        $flag = true;
        for($i = 0; $i < strlen($line); $i++){
            if(!$flag){
                echo $line . " | NO\n";
                break;
            }
            for($j = 1; $j < 7; $j++){
                $word = substr($line, $i, $j);
                if(in_array($word, ["out", "in"]) and substr($line, $i + $j, 1) == "p"){
                    continue;
                }
                if(in_array($word, $words)){
                    $i = $i + $j - 1;
                    break;
                }
                if($j == 6){
                    $flag = false;
                }
            }
        }
        if($flag){
            echo $line . " | YES\n";
        }
    }

}

function logic2(){
    $line = readline("Введите строку: ");
    $sum = 0;
    $tempInt = 0;
    for($i = 0; $i < strlen($line); $i++){
        if(is_numeric($line[$i])){
            $tempInt =  $tempInt *10 + (int)$line[$i];
            if($i == strlen($line) -1 and is_numeric($line[$i])){
                $sum += $tempInt;
            }
        }else{
            $sum += $tempInt;
            $tempInt = 0;
        }
    }
    echo "Сумма чисел: " . $sum; 
}

function logic3(){
    $lunchBreakMS = readline("Введите обеденный перерыв Гомера в мс: ");
    $hamburgerMS = readline("Введите за сколько мс Гомер съедает гамбургер: ");
    $cheeseburgerMS = readline("Введите за сколько мс Гомер съедает чизбургер: ");
    echo $hamburgerMS > $cheeseburgerMS ? 
    (int)($lunchBreakMS / $cheeseburgerMS) : 
    (int)($lunchBreakMS / $hamburgerMS);
}