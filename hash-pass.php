<?php

$num = '1212';
$hash = password_hash($num, PASSWORD_DEFAULT);
echo $hash;

?>