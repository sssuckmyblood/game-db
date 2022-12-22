<?php

/*
    * Форма записи в бд данных о студии
 */



if(isset($_SESSION['token']))
    $_SESSION['token'] = bin2hex(random_bytes(35));



$url = "http://";

$url.= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL
$url.= $_SERVER['REQUEST_URI'];





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Студии</title>
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
        <a href="/"> БАЗА ДАННЫХ РОССИЙСКИХ ИГР </a>
    </div>

</div>
<div class="content">

    <div class="input">
        <div class="big__text">
            <h2> Добавить запись в таблицу студий </h2>
        </div>
        <form name="insert_f">

            <div class="text__form input__item">
                Название:
            </div>
            <div class="login__form input__item">
                <input class="form-control" type="text" name="name" id="name" maxlength="64"
                       placeholder="ВВЕДИТЕ НАЗВАНИЕ">
            </div>

            <div class="text__form input__item">
                Год основания:
            </div>
            <div class="login__form input__item">
                <input class="form-control"  type="number" name="year" id="year" MIN="1980" max="2023" step="1"
                       placeholder="ВВЕДИТЕ ГОД ОСНОВАНИЯ">
            </div>

            <div class="text__form input__item">
                Расположение:
            </div>
            <div class="login__form input__item">
                <input class="form-control"  type="text" name="location" id="location" maxlength="64"
                       placeholder="ВВЕДИТЕ РАСПОЛОЖЕНИЕ">
            </div>

            <div class="text__form input__item">
                Штат сотрудников (кол-во):
            </div>
            <div class="login__form input__item">
                <input class="form-control"  type="number" step="1" name="workers" id="workers" min="1"
                       placeholder="ВВЕДИТЕ ШТАТ СОТРУДНИКОВ">
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
<script src="js/insert_studio.js"></script>



</body>
</html>
