<?php
/*
    * Форма обновления в бд данных о авто
 */

include "clean.php";
$token = Clean::str($_GET["token"]);
$id_car = Clean::int($_GET["id_car"]);

if (hash_equals(hash_hmac('sha256', $_SERVER["HTTP_REFERER"].$id_car, $_SESSION['token']), $token)) {


    
    $url = "http://";
    $url .= $_SERVER['HTTP_HOST'];

    $url .= $_SERVER['REQUEST_URI'];

    if (!empty($id_car)) {
        $query_auto = pg_query($dbconn, "SELECT * from automobile where id_car = $id_car;");

        if (pg_num_rows($query_auto))
            $data_auto = pg_fetch_assoc($query_auto);
        else echo header("Location: /");



    }
} else {
   echo header("Location: /");

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Автомобили</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?= hash_hmac('sha256', $url, $_SESSION['token']) ?>">
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
            <h2> Изменить данные автомобиля</h2>
        </div>
        <form name="insert_f">
            <input class="form-control" value="<?=$id_car?>" name = "id" type="hidden">

            <div class="text__form input__item">
                Марка машины:
            </div>
            <div class="login__form input__item">
                <input class="form-control" data_group="main" value="<?=$data_auto["brand"]?>" type="text" name="brand" id="brand" maxlength="64"
                       placeholder="ВВЕДИТЕ МАРКУ МАШИНЫ">
            </div>

            <div class="text__form input__item">
                Модель машины:
            </div>
            <div class="login__form input__item">
                <input class="form-control" data_group="main" value="<?=$data_auto["model"]?>" type="text" name="mark" id="mark" maxlength="64"
                       placeholder="ВВЕДИТЕ МОДЕЛЬ МАШИНЫ">
            </div>

            <div class="text__form input__item">
                Год выпуска:
            </div>
            <div class="login__form input__item">
                <input class="form-control" data_group="main" value="<?=$data_auto["year"]?>" type="number" name="year" id="year" MIN="1980" max="2023"
                       step="1"
                       placeholder="ВВЕДИТЕ ГОД ВЫПУСКА МАШИНЫ">
            </div>

            <div class="text__form input__item">
                Комплектация машины:
            </div>
            <div class="login__form input__item">
                <input class="form-control" data_group="main" value="<?=$data_auto["complectation"]?>" type="text" name="complectation" id="complectation"
                       maxlength="64"
                       placeholder="ВВЕДИТЕ КОМПЛЕКТАЦИЮ МАШИНЫ">
            </div>
            <div class="big__text" style="font-size: 30px; margin-top: 5%;">
                Характеристики машины
            </div>

            <div class="text__form input__item">
                Объем двигателя в литрах:
            </div>
            <div class="login__form input__item">
                <input class="form-control" data_group="common_char" value="<?=$data_auto["engine_volume"]?>" type="number" step="0.1" name="engine_volume"
                       id="engine_volume" min="0" max="10"
                       placeholder="ВВЕДИТЕ ОБЪЕМ ДВИГАТЕЛЯ МАШИНЫ (Л)">
            </div>

            <div class="text__form input__item">
                Тип двигателя:
            </div>
                <select  name="engine_type" data_group = "common_char" id="engine_type" size="1" class="input__item form-control">
                    <option value="бензин"  <?php if($data_auto["engine_type"] == "бензин") echo "selected";?>>Бензин</option>
                    <option value="дизель"  <?php if($data_auto["engine_type"] == "дизель") echo "selected";?>>Дизель</option>
                    <option value="электро" <?php if($data_auto["engine_type"] == "электро") echo "selected";?>>Электро</option>
                    <option value="гибрид"  <?php if($data_auto["engine_type"] == "гибрид") echo "selected";?>>Гибрид</option>
                </select>


            <div class="text__form input__item">
                Мощность двигателя в л.с:
            </div>
            <div class="login__form input__item">
                <input class="form-control" data_group="common_char" value="<?=$data_auto["engine_power"]?>" type="number" step="0.1" name="engine_power" id="engine_power"
                       min="1" max="3000"
                       placeholder="ВВЕДИТЕ МОЩНОСТЬ ДВИГАТЕЛЯ МАШИНЫ">
            </div>

            <div class="text__form input__item">
                Тип коробки передач:
            </div>
            <select name="transmission" data_group="common_char"id="transmission" size="1"
                    class="input__item form-control">
                <option value="механическая"<?php if($data_auto["transmission"] == "механическая") echo "selected";?>>Механическая (МКПП)</option>
                <option value="автомат" <?php if($data_auto["transmission"] == "автомат") echo "selected";?>>Автомат (АКПП)</option>
                <option value="робот" <?php if($data_auto["transmission"] == "робот") echo "selected";?>>Робот</option>
                <option value="вариативная" <?php if($data_auto["transmission"] == "вариативная") echo "selected";?>>Вариативная (бесступенчатая)</option>
            </select>

            <div class="text__form input__item">
                Тип кузова:
            </div>
            <div class="login__form input__item">
                <input class="form-control" data_group="common_char" value="<?=$data_auto["carcase"]?>" type="text" name="carcase" id="carcase"
                       maxlength="64"
                       placeholder="ВВЕДИТЕ ТИП КУЗОВА МАШИНЫ">
            </div>

            <div class="text__form input__item">
                Цвет:
            </div>
            <div class="login__form input__item">
                <input class="form-control" data_group="common_char"  value="<?=$data_auto["color"]?>" type="text" name="color" id="color" maxlength="64"
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
<script src="js/update_studio.js"></script>


</body>
</html>
