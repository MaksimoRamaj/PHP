<?php
declare(strict_types=1);

$root = dirname(__DIR__).DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

require APP_PATH . "app.php";
require APP_PATH . 'helpers.php';

$files = getFilePathsFromDirectory(FILES_PATH);
$fileData = [];
foreach ($files as $file){
    $fileData = array_merge($fileData,getFileData($file,'transactionHandler'));
}
$total = calculateTotal($fileData);

require VIEWS_PATH . 'transactions.php';