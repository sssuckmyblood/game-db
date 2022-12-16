<?php
/*
    *Таблица студий

 */

if(!isset($_SESSION['token']))
    $_SESSION['token'] = bin2hex(random_bytes(35));


$url = "http://";
$url.= $_SERVER['HTTP_HOST'];

$url.= $_SERVER['REQUEST_URI'];

    $query = pg_query($dbconn, "SELECT * from studios ORDER BY id ASC");

    if (pg_num_rows($query)) {

        while ($data = pg_fetch_assoc($query))
            $studios_array[] = array($data['id'],
                                     $data['name'],
                                     $data['year'],
                                     $data['location'],
                                     $data['workers'],

                                        );
}





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Студии</title>
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
        <a href="/"> БАЗА ДАННЫХ РОССИЙСКИХ ИГР</a>
    </div>
    <ul class="list">
        <li class="link">
            <a href="/games" class="link__text">Таблица игр</a>
        </li>
        <li class="link">
            <a href="/" class="link__text">Таблица студий</a>
        </li>
    </ul>
</div>
<div class="content">
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrap">
                        <button class="input__item create">
                            ТАБЛИЦА СТУДИЙ
                            </button>
                        <table class="table">
                            <thead class="thead-blue">
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Год основания</th>
                                <th>Расположение</th>
                                <th>Штат</th>
                                <th>Игры</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>

                           <?php foreach ($studios_array as $val)

                               echo '
                               <tr class="alert" role="alert">
                                <td scope="row"> '.$val[0].' </td>
                                <td> '.$val[1].' </td>
                                <td> '.$val[2].' </td>
                                <td> '.$val[3].' </td>
                                <td> '.$val[4].' </td>
                                <td><a href="games?id_studio='.$val[0].'">Игры</a></td>
                                
                                <td>
                                    <a href="" class="edit"  aria-label="edit">
                                        <span aria-hidden="true"><a class="edit" href="update_studio?id='.$val[0].'&token='.hash_hmac('sha256', $url.$val[0], $_SESSION['token']).'"><i class="fa fa-edit"></i></a></span>
                                    </a>
                                </td>
                                <td>
                                    <a href="" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><a class="close" href="delete?id_studio='.$val[0].'&token='.hash_hmac('sha256', $url.$val[0], $_SESSION['token']).'"><i class="fa fa-close"></i></a></span>
                                    </a>
                                </td>
                                
                             </tr>
                               
                               '; ?>



                            </tbody>
                        </table>
                        <a href="studio_db"><button type="create" name="create" class="input__item create">
                                Добавить новую запись
                            </button></a>
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

