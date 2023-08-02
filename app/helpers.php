<?php
declare(strict_types=1);
function dateFormatter(string $date )
{
    return date("F j, Y",strtotime($date));
}

function amountFormmater(float $amount):string{
    $isNegative = $amount < 0;

    return ($isNegative ? '-' : '') . '$' . number_format(abs($amount), 2);
}
