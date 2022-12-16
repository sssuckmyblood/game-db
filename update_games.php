<?php

/*
    * Форма обновления в бд данных о игре
 */


$token = $_GET["token"];
$id_game = $_GET["id_game"];

if (hash_equals(hash_hmac('sha256', $_SERVER["HTTP_REFERER"].$id_game, $_SESSION['token']), $token)) {

    
    $url  = "http://";
    $url .= $_SERVER['HTTP_HOST'];

    $url .= $_SERVER['REQUEST_URI'];

    if (!empty($id_game)) {
        $query_game = pg_query($dbconn, "SELECT * from games where id = $id_game;");


        if (pg_num_rows($query_game)) {
            $data_game = pg_fetch_assoc($query_game);
            $query_studio = pg_query($dbconn, "SELECT id, name from studios order by id asc;");
            if (pg_num_rows($query_studio))
                while ($data = pg_fetch_assoc($query_studio))
                    $game_array[] = array(
                        $data['id'],
                        $data['name'],

                    );
        } else echo header("Location: /games");


    }
} else {
    echo header("Location: /games");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Игры</title>
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
        <a href="/games"> БАЗА ДАННЫХ РОССИЙСКИХ ИГР </a>
    </div>

</div>
<div class="content">

    <div class="input">
        <div class="big__text">
            <h2> Изменить данные игры </h2>
        </div>
        <form name="insert_f">
            <input class="form-control" value="<?=$id_game?>" name = "id" type="hidden">
            <div class="text__form input__item">
                ФИО:
            </div>
            <div class="login__form input__item">
                <input class="form-control" type="text" name="fio" id="fio" maxlength="64" value="<?=$data_game["name"]?>"
                       placeholder="ВВЕДИТЕ ФИО">
            </div>

            <div class="text__form input__item">
                Студия:
            </div>

            <select name="id_studio" id="id_studio" size="1" class="input__item form-control">
                    <?php
                    foreach ($game_array as $val)
                        if($val[0] == $data_game["id_studio"])
                            echo '<option value="'.$val[0].'" selected>'.$val[1].' </option>';
                        else
                            echo '<option value="'.$val[0].'">'.$val[1].'</option>';
                    ?>
                </select>


            <div class="text__form input__item">
                Год выпуска:
            </div>
            <div class="login__form input__item">
                <input class="form-control"  type="number" name="year" id="year" MIN="1980" max="2023" step="1" value="<?=$data_game["year_release"]?>"
                       placeholder="ВВЕДИТЕ ГОД ВЫПУСКА">
            </div>

            <div class="text__form input__item">
                Жанр:
            </div>
            <div class="login__form input__item">
                <input class="form-control" type="text" name="category" id="category" maxlength="64" value="<?=$data_game["category"]?>"
                       placeholder="ВВЕДИТЕ ЖАНР">
            </div>
            <div class="text__form input__item">
                Платформа:
            </div>
            <div class="login__form input__item">
                <input class="form-control" type="text" name="platform" id="platform" maxlength="64" value="<?=$data_game["platform"]?>"
                       placeholder="ВВЕДИТЕ ПЛАТФОРМУ">
            </div>
            <div class="text__form input__item">
                Носитель:
            </div>
            <div class="login__form input__item">
                <input class="form-control" type="text" name="carrier" id="carrier" maxlength="64" value="<?=$data_game["carrier"]?>"
                       placeholder="ВВЕДИТЕ НОСИТЕЛЬ">
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

