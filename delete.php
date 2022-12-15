<?php
include "clean.php";
$id_car = Clean::int($_GET["id_car"]);
$token = Clean::str($_GET["token"]);
$id_owner = Clean::int($_GET["id_owner"]);

if (hash_equals(hash_hmac('sha256', $_SERVER["HTTP_REFERER"].$id_car, $_SESSION['token']), $token) or
    hash_equals(hash_hmac('sha256', $_SERVER["HTTP_REFERER"].$id_owner, $_SESSION['token']), $token)) {
    if(isset($_SESSION['token']))
        $_SESSION['token'] = bin2hex(random_bytes(35));

    if (!empty($id_car)) {
        pg_query($dbconn, "Delete from automobile.public.automobile where automobile.public.automobile.id_car = '$id_car'");
        echo header("Location: $_SERVER[HTTP_REFERER]");


    }

    if(!empty($id_owner)){
        pg_query($dbconn, "Delete from automobile.public.owners where automobile.public.owners.id = '$id_owner'");
        echo header("Location: $_SERVER[HTTP_REFERER]");
    }



} else echo header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed'), json_encode(array('delete' => 'false'));


