<?php

    function isAllNumbers($numbers,$inputNumber)
    {
        $counter=0;
        for($i=0;$i<count($numbers);$i++)
        {
            for($j=0;$j<count($inputNumber);$j++)
            {
                if($numbers[$i]==$inputNumber[$j])
                {
                    $counter++;
                    break;
                }   
            }
        }
        return (count($numbers)==$counter)?true:false;
    }
    function isAllLetters($randomString,$input_letters)
    {
        return true;
    }
    function isNumbersInAscOrder($randomNumber,$input_numbers)
    {
        sort($randomNumber);
        if($randomNumber===$input_numbers)
        {
            return  true;
        }
        else
            return false;
    }
    function isNumbersInDescOrder($randomNumber,$input_numbers)
    {
        rsort($randomNumber);
        if($randomNumber===$input_numbers)
        {
            return  true;
        }
        else
            return false;
    }
    function isLettersInAscList($randomString,$input_letters)
    {    
        sort($randomString);
        if($randomString===$input_letters)
        {
            return  true;
        }
        else
            return false;
    }
    function isLettersInDescList($randomString,$input_letters)
    {
        rsort($randomString);
        if($randomString===$input_letters)
        {
            return  true;
        }
        else
            return false;
    }
    function isFirstAndLastOfSet($randomString,$fLetter,$lLetter)
    {
        sort($randomString);
        $first = $randomString[0];
        $last = end($randomString);

        return (($fLetter==$first)&&($last==$lLetter))?true:false;
    }
    function isMinAndMax($randomString,$min,$max)
    {
        sort($randomString);
        $fLetter = $randomString[0];
        $lLetter = end($randomString);

        return (($fLetter==$min)&&($lLetter==$max))?true:false;
    }
?>
