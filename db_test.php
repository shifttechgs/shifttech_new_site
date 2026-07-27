<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '');
    $pdo->exec('CREATE DATABASE IF NOT EXISTS shifttech_crm CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    file_put_contents(__DIR__ . '/db_test_result.txt', 'SUCCESS: MySQL connected and DB created');
} catch (Exception $e) {
    file_put_contents(__DIR__ . '/db_test_result.txt', 'ERROR: ' . $e->getMessage());
}

