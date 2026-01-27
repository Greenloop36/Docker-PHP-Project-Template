<?php

error_reporting(E_ALL);
echo __FILE__;
include "../private/core.php";
include "$path/private/modules/database/table.php";
echo __FILE__;

$table = new Table($database, 'people');
$result = $table -> create([
    'first_name' => 'John',
    'last_name' => 'Doe'
]);

echo $result;

phpinfo();

