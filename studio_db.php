<?php

/*
    * Форма записи в бд данных о авто
 */

include "clean.php";

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
    <title>Автомобили</title>
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
        <a href="/"> БАЗА ДАННЫХ АВТОМОБИЛЕЙ </a>
    </div>

</div>
<div class="content">

    <div class="input">
        <div class="big__text">
            <h2> Добавить запись в таблицу автомобилей </h2>
        </div>
        <form name="insert_f">

            <div class="text__form input__item">
                Марка машины:
            </div>
            <div class="login__form input__item">
                <input class="form-control" type="text" name="brand" id="brand" maxlength="64"
                       placeholder="ВВЕДИТЕ МАРКУ МАШИНЫ">
            </div>

            <div class="text__form input__item">
                Модель машины:
            </div>
            <div class="login__form input__item">
                <input class="form-control"  type="text" name="mark" id="mark" maxlength="64"
                       placeholder="ВВЕДИТЕ МОДЕЛЬ МАШИНЫ">
            </div>

            <div class="text__form input__item">
                Год выпуска:
            </div>
            <div class="login__form input__item">
                <input class="form-control"  type="number" name="year" id="year" MIN="1980" max="2023" step="1"
                       placeholder="ВВЕДИТЕ ГОД ВЫПУСКА МАШИНЫ">
            </div>

            <div class="text__form input__item">
                Комплектация машины:
            </div>
            <div class="login__form input__item">
                <input class="form-control"  type="text" name="complectation" id="complectation" maxlength="64"
                       placeholder="ВВЕДИТЕ КОМПЛЕКТАЦИЮ МАШИНЫ">
            </div>
            <div class="big__text" style="font-size: 30px; margin-top: 5%;">
                 Характеристики машины
            </div>

            <div class="text__form input__item">
                Объем двигателя в литрах:
            </div>
            <div class="login__form input__item">
                <input class="form-control"  type="number" step="0.1" name="engine_volume" id="engine_volume" min="0" max="15"
                       placeholder="ВВЕДИТЕ ОБЪЕМ ДВИГАТЕЛЯ МАШИНЫ (Л)">
            </div>

            <div class="text__form input__item">
                Тип двигателя:
            </div>
                <select  name="engine_type"  id="engine_type" size="1" class="input__item form-control">
                    <option value="бензин" selected>Бензин</option>
                    <option value="дизель">Дизель</option>
                    <option value="электро">Электро</option>
                    <option value="гибрид">Гибрид</option>
                </select>


            <div class="text__form input__item">
                Мощность двигателя в л.с:
            </div>
            <div class="login__form input__item">
                <input class="form-control" " type="number" step="0.1" name="engine_power" id="engine_power" min="1" max="3000"
                       placeholder="ВВЕДИТЕ МОЩНОСТЬ ДВИГАТЕЛЯ МАШИНЫ">
            </div>

            <div class="text__form input__item">
                Тип коробки передач:
            </div>
            <select name="transmission"  id="transmission"  size="1" class="input__item form-control">
                <option value="механическая" selected>Механическая (МКПП)</option>
                <option value="автомат">Автомат (АКПП)</option>
                <option value="робот">Робот</option>
                <option value="вариативная">Вариативная (бесступенчатая)</option>
            </select>

            <div class="text__form input__item">
               Тип кузова:
            </div>
            <div class="login__form input__item">
                <input class="form-control"  type="text" name="carcase" id="carcase"  maxlength="64"
                       placeholder="ВВЕДИТЕ ТИП КУЗОВА МАШИНЫ">
            </div>

            <div class="text__form input__item">
                 Цвет:
            </div>
            <div class="login__form input__item">
                <input class="form-control"  type="text" name="color" id="color"  maxlength="64"
                       placeholder="ВВЕДИТЕ ЦВЕТ МАШИНЫ">
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
