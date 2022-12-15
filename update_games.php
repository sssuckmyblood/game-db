<?php

/*
    * Форма обновления в бд данных о владельце
 */

include "clean.php";
$token = Clean::str($_GET["token"]);
$id_owner = Clean::int($_GET["id_owner"]);

if (hash_equals(hash_hmac('sha256', $_SERVER["HTTP_REFERER"].$id_owner, $_SESSION['token']), $token)) {

    
    $url = "http://";
    $url .= $_SERVER['HTTP_HOST'];

    $url .= $_SERVER['REQUEST_URI'];

    if (!empty($id_owner)) {
        $query_owner = pg_query($dbconn, "SELECT * from owners where id = $id_owner;");


        if (pg_num_rows($query_owner)) {
            $data_owner = pg_fetch_assoc($query_owner);
            $query_auto = pg_query($dbconn, "SELECT id_car, brand, model, complectation from automobile order by id_car asc;");
            if (pg_num_rows($query_auto))
                while ($data = pg_fetch_assoc($query_auto))
                    $auto_array[] = array(
                        $data['id_car'],
                        $data['brand'],
                        $data['model'],
                        $data['complectation'],

                    );
        } else echo header("Location: /owners");


    }
} else {
    echo header("Location: /owners");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Владельцы</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?=hash_hmac('sha256', $url, $_SESSION['token'])?>">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<div class="header">
    <div class="logo" style="text-align: center; float:none !important; padding-left: 0;">
        <a href="/owners"> БАЗА ДАННЫХ АВТОМОБИЛЕЙ </a>
    </div>

</div>
<div class="content">

    <div class="input">
        <div class="big__text">
            <h2> Добавить запись в таблицу владельцев </h2>
        </div>
        <form name="insert_f">
            <input class="form-control" value="<?=$id_owner?>" name = "id" type="hidden">
            <div class="text__form input__item">
                ФИО:
            </div>
            <div class="login__form input__item">
                <input class="form-control" type="text" name="fio" id="fio" maxlength="64" value="<?=$data_owner["fio"]?>"
                       placeholder="ВВЕДИТЕ ФИО">
            </div>

            <div class="text__form input__item">
                Машина:
            </div>

                <select name="id_car" id="id_car" size="1" class="input__item form-control">
                    <?php
                    foreach ($auto_array as $val)
                        if($val[0] == $data_owner["id_car"])
                            echo '<option value="'.$val[0].'" selected>'.$val[1].' '.$val[2].' Комплектации: '.$val[3].'</option>';
                        else
                            echo '<option value="'.$val[0].'">'.$val[1].' '.$val[2].' Комплектации: '.$val[3].'</option>';
                    ?>
                </select>


            <div class="text__form input__item">
                Город:
            </div>
            <div class="login__form input__item">
                <input class="form-control" type="text" name="city" id="city"  maxlength="64" value="<?=$data_owner["city"]?>"
                       placeholder="ВВЕДИТЕ ВАШ ГОРОД">
            </div>

            <div class="text__form input__item">
                Номер телефона:
            </div>
            <div class="login__form input__item">
                <input class="form-control" type="tel" pattern="\+7\d{3}\d{3}\d{2}\d{2}" name="phone_number" id="phone_number" maxlength="64" value="<?=$data_owner["phone_number"]?>"
                      value="+7" placeholder="+7">
            </div>


            <button type="submit" name="submit" class="input__item submit">
                Сохранить
            </button>
        </form>
        <br>
        <br>
    </div>
</div>


<script src="js/jquery.min.js"></script>
<script src="js/popper.js+bootstrap.min.js+main.js.pagespeed.jc.FXDrpGsQRf.js"></script>
<script>eval(mod_pagespeed_dPzXbWK7Ii);</script>
<script>eval(mod_pagespeed_JViKMxoawf);</script>
<script>eval(mod_pagespeed_hzR5PsIGo5);</script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194"
        integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw=="
        data-cf-beacon='{"rayId":"75f2d5efeef2164b","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2022.10.3","si":100}'
        crossorigin="anonymous"></script>

<script src="js/sweetalert2.min.js"></script>
<script src="js/update_game.js"></script>



</body>

