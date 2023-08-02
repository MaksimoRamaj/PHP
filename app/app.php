<?php

//merr pathet e fileve nga direktoria dhe ruaji ne nje array files

declare(strict_types=1);

function getFilePathsFromDirectory(string $DIR_PATH):array{
    $files = [];
    foreach (scandir($DIR_PATH) as $fPath){
        if (is_dir($fPath)){
            continue;
        }
        $files[] = $DIR_PATH . $fPath;
    }
    return $files;
}

//pasi morem filet na duhet qe te marrim te dhenat
//rikthejm nje array key => value me te dhenat tona

function getFileData(string $fileName,?callable $transactionHandler = null):array{
    if (! file_exists($fileName)) {
    trigger_error('File "' . $fileName . '" does not exist.', E_USER_ERROR);
}

    $file = fopen($fileName, 'r');

    fgetcsv($file);

    $transactions = [];

    while (($transaction = fgetcsv($file)) !== false) {
        if ($transactionHandler !== null) {
            $transaction = $transactionHandler($transaction);
        }

        $transactions[] = $transaction;
    }
    return $transactions;
}

function transactionHandler(array $transaction):array{
    [$date , $check , $description , $amount] = $transaction;

    $amount = (float) str_replace(['$',','],'',$amount);

    return ['date' => $date,
            'check' => $check,
            'description' => $description,
            'amount' => $amount,
        ];
}

function calculateTotal(array $transactions):array{
    $total = ['total'=>0,'income'=>0,'expenses'=>0];
    foreach ($transactions as $t){
        $total['total']+=$t['amount'];
        if ($t['amount']>=0){
            $total['income'] += $t['amount'];
        }
        else{
            $total['expenses'] += $t['amount'];
        }
    }
    return $total;
}
