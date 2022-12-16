<?php
/*
    * Форма обновления в бд данных о студиях
 */

$token = $_GET["token"];
$id_studio = $_GET["id"];

if (hash_equals(hash_hmac('sha256', $_SERVER["HTTP_REFERER"].$id_studio, $_SESSION['token']), $token)) {

    
    $url = "http://";
    $url .= $_SERVER['HTTP_HOST'];

    $url .= $_SERVER['REQUEST_URI'];

    if (!empty($id_studio)) {
        $query_studio = pg_query($dbconn, "SELECT * from studios where id = $id_studio;");

        if (pg_num_rows($query_studio))
            $data = pg_fetch_assoc($query_studio);
        else echo header("Location: /");



    }
} else {
   echo header("Location: /");

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Студии</title>
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
        <a href="/"> БАЗА ДАННЫХ РОССИЙСКИХ ИГР </a>
    </div>

</div>
<div class="content">

    <div class="input">
        <div class="big__text">
            <h2> Изменить данные студии </h2>
        </div>
        <form name="insert_f">
            <input class="form-control" value="<?=$id_studio?>" name = "id" type="hidden">

            <div class="text__form input__item">
                Название:
            </div>
            <div class="login__form input__item">
                <input class="form-control" type="text" name="name" id="name" maxlength="64" value="<?=$data["name"]?>"
                       placeholder="ВВЕДИТЕ НАЗВАНИЕ">
            </div>

            <div class="text__form input__item">
                Год основания:
            </div>
            <div class="login__form input__item">
                <input class="form-control"  type="number" name="year" id="year" MIN="1980" max="2023" step="1" value="<?=$data["year"]?>"
                       placeholder="ВВЕДИТЕ ГОД ОСНОВАНИЯ">
            </div>

            <div class="text__form input__item">
                Расположение:
            </div>
            <div class="login__form input__item">
                <input class="form-control"  type="text" name="location" id="location" maxlength="64" value="<?=$data["location"]?>"
                       placeholder="ВВЕДИТЕ РАСПОЛОЖЕНИЕ">
            </div>

            <div class="text__form input__item">
                Штат сотрудников (кол-во):
            </div>
            <div class="login__form input__item">
                <input class="form-control"  type="number" step="1" name="workers" id="workers" min="1" value="<?=$data["workers"]?>"
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
<script src="js/update_studio.js"></script>


</body>
</html>
