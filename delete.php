<?php
/*
    * Модуль удаления данных из бд


 */
$id_studio = $_GET["id_studio"];
$token = $_GET["token"];
$id_game = $_GET["id_game"];

if (hash_equals(hash_hmac('sha256', $_SERVER["HTTP_REFERER"].$id_studio, $_SESSION['token']), $token) or
    hash_equals(hash_hmac('sha256', $_SERVER["HTTP_REFERER"].$id_game, $_SESSION['token']), $token)) {
    if(isset($_SESSION['token']))
        $_SESSION['token'] = bin2hex(random_bytes(35));

    if (!empty($id_studio)) {
        pg_query($dbconn, "Delete from studios where id = '$id_studio'");
        echo header("Location: $_SERVER[HTTP_REFERER]");


    }

    if(!empty($id_game)){
        pg_query($dbconn, "Delete from games where id = '$id_game'");
        echo header("Location: $_SERVER[HTTP_REFERER]");
    }



} else echo header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed'), json_encode(array('delete' => 'false'));


