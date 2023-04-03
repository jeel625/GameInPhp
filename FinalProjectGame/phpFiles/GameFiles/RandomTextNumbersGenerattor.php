<?php
function generateRandomString() {
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString=' ';
    $myArray=array();
    for ($i = 0; $i < 6; $i++)
    {
        $randomString =$characters[random_int(0, $charactersLength - 1)];

        if(!in_array($randomString,$myArray))
            $myArray[$i]=$randomString;
    }
    return $myArray;
}
function generateRandomNumbers() {
    $numbers = array();

    while (count($numbers) < 6) 
    {
        $number = rand(0, 100);
        if (!in_array($number, $numbers))
         {
            $numbers[] = $number;
        }
    }
    return $numbers;
}

?>