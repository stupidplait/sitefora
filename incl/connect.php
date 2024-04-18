<?php
try {
    $connect = new PDO('mysql:host=sql11.freemysqlhosting.net;port=3306;charset=utf8;dbname=sql11698699', 'sql11698699', 'MwAI8LYPCH');
} catch (PDOException $e) {
    echo $e;
}
