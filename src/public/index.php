<?php

error_reporting(E_ALL);
include "../private/core.php";
include "$path/private/modules/database/table.php";
echo __FILE__;

$table = new Table($database, 'people');
$result = $table -> create([
    'first_name' => 'John',
    'last_name' => 'Doe'
]);

// echo $result;
echo "<h1>hi</h1>";
echo bin2hex(random_bytes(32));

phpinfo();

