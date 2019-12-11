<?php

require __DIR__ . '/LockClass.php';

$message = $_POST['message'];
$key = $_POST['key'];
$isUnlock = $_POST['unlock'];

$lock = new LockClass();

echo ($isUnlock == 'on') ? $lock->unlock($message, $key) : $lock->lock($message, $key);
