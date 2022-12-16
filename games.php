<?php

/*
    *Таблица игр

 */


if(!isset($_SESSION['token']))
    $_SESSION['token'] = bin2hex(random_bytes(35));


$url = "http://";
$url.= $_SERVER['HTTP_HOST'];

$url.= $_SERVER['REQUEST_URI'];

$id_studio = $_GET["id_studio"];

if (!empty($id_studio)) {
    $query_studio = pg_query($dbconn, "SELECT name from studios where id = $id_studio;");
    if (pg_num_rows($query_studio))
        $data_studio = pg_fetch_assoc($query_studio);

    $query = pg_query($dbconn, "SELECT * from games WHERE id_studio = $id_studio ORDER BY ID ASC ");
    if (pg_num_rows($query)) {

        while ($data = pg_fetch_assoc($query))
            $game_array[] = array(
                $data['id'],
                $data['name'],
                $data['year_release'],
                $data['category'],
                $data['platform'],
                $data['carrier']
            );


    }


} else {
    $query = pg_query($dbconn, "SELECT * from games ORDER BY ID ASC ");

    if (pg_num_rows($query)) {

        while ($data = pg_fetch_assoc($query))
            $game_array[] = array(
                $data['id'],
                $data['id_studio'],
                $data['name'],
                $data['year_release'],
                $data['category'],
                $data['platform'],
                $data['carrier']
            );

        foreach ($game_array as $val) {
            $query_studio = pg_query($dbconn, "SELECT name from studios where id = '$val[1]'");
            if (pg_num_rows($query_studio))
                $studio[] = pg_fetch_assoc($query_studio);
        }

    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Игры</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<div class="header">
    <div class="logo">
        <a href="/"> БАЗА ДАННЫХ РОССИЙСКИХ ИГР </a>
    </div>
    <ul class="list">
        <li class="link">
            <a href="/games" class="link__text">Таблица игр</a>
        </li>
        <li class="link">
            <a href="/" class="link__text">Таблица студий</a>
        </li>
    </ul>


    </ul>
</div>
<div class="content">
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrap">
                             <button class="input__item create">
                                 <?php
                                 if (!empty($id_studio))
                                     echo 'ТАБЛИЦА ИГР СТУДИИ ' . $data_studio["name"];
                                 else echo 'ТАБЛИЦА ИГР';


                                 ?>
                            </button>

                        <table class="table">
                            <thead class="thead-blue">
                            <?php
                           if(!empty($id_studio)) {
                               echo '
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Дата выпуска</th>
                                <th>Жанр</th>
                                <th>Платформа</th>
                                <th>Носитель</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th> 
                              
                             
                                ';
                           } else {
                               echo '
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Студия</th>
                                <th>Дата выпуска</th>
                                <th>Жанр</th>
                                <th>Платформа</th>
                                <th>Носитель</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th> 
                                
                                ';
                           }
                           ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($id_studio)){

                                foreach ($game_array as $val) {
                                    echo '
                            <tr class="alert" role="alert">
                                <td scope="row">' . $val[0] . '</td>
                                <td>' . $val[1] . '</td>
                                <td>' . $val[2] . '</td>
                                <td>' . $val[3] . '</td>
                                <td>' . $val[4] . '</td>
                                <td>' . $val[5] . '</td>
                       
                                <td>
                                    <a href="" class="edit"  aria-label="edit">
                                        <span aria-hidden="true"><a class="edit" href="update_games?id_game='.$val[0].'&token='.hash_hmac('sha256', $url.$val[0], $_SESSION['token']).'"><i class="fa fa-edit"></i></a></span>
                                    </a>
                                </td>
                                <td>
                                    <a href="" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><a class="close" href="delete?id_game='.$val[0].'&token='.hash_hmac('sha256', $url.$val[0], $_SESSION['token']).'"><i class="fa fa-close"></i></a></span>
                                    </a>
                                </td>
                            </tr> ';
                                }

                            } else {
                                $i = 0;

                                foreach ($game_array as $val) {
                                    echo '
                            <tr class="alert" role="alert">
                                <td scope="row">' . $val[0] . '</td>
                                <td>' . $val[2] . '</td>
                               <td>' . $studio[$i]["name"] . '</td>
                               <td>' . $val[3] . '</td>
                               <td>' . $val[4] . '</td>
                               <td>' . $val[5] . '</td>
                               <td>' . $val[6] . '</td>
                              
                                <td>
                                    <a href="" class="edit"  aria-label="edit">
                                        <span aria-hidden="true"><a class="edit" href="update_games?id_game='.$val[0].'&token='.hash_hmac('sha256', $url.$val[0], $_SESSION['token']).'"><i class="fa fa-edit"></i></a></span>
                                    </a>
                                </td>
                                <td>
                                    <a href="" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><a class="close" href="delete?id_game='.$val[0].'&token='.hash_hmac('sha256', $url.$val[0], $_SESSION['token']).'"><i class="fa fa-close"></i></a></span>
                                    </a>
                                </td>
                            </tr> ';
                                    $i++;
                                }
                            }
                            ?>


                            </tbody>
                        </table>
                        <?php
                        if(empty($id_studio))
                            echo '
                             <a href="games_db"><button type="create" name="create" class="input__item create">
                            Добавить новую запись
                            </button></a>
                            ';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
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



</body>
</html>

