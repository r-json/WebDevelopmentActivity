<?php
$passwords = ['test123', '', 'root', 'password', 'mysql', '12345', '123456', 'admin'];

foreach ($passwords as $pass) {
    try {
        $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', $pass);
        echo "SUCCESS! Password is: '$pass'\n";
        exit(0);
    } catch (Exception $e) {
        echo "Failed with password '$pass': " . $e->getMessage() . "\n";
    }
}

echo "\nNone of the common passwords worked.\n";
echo "Please check your MySQL root password.\n";
