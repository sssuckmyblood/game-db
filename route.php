<?php

/*
    * Главный модуль системы
    * Тут происходит подключение к БД (строка 15)
    * Проверка межсайтового токена при выполнении ajax запроса (строка 33)
    * Роутинг всех исполняемых и не только файлов

 */

if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js|wofffont|ttf|woff2|)$/', $_SERVER["REQUEST_URI"]))
    return false;

else {

    session_start();
    $dbconn = pg_connect(
        "host=localhost
                     dbname=game
                     user=postgres
                     password=");

if ($dbconn) {

    if ($_SERVER['REQUEST_URI'] === '/')
        $page = 'index';
    else
        $page = substr($_SERVER['REQUEST_URI'], 1);


    if (file_exists("$page.html")) include "$page.html";


    else if ($_SERVER['REQUEST_URI'] === '/ajax') {

        foreach (getallheaders() as $name => $req_token)
            if ($name === "X-CSRF-TOKEN" || $name === "X-Csrf-Token") break;

        if (hash_equals(hash_hmac('sha256', $_SERVER["HTTP_REFERER"], $_SESSION['token']), $req_token)) {

            include "ajax.php";


        } else echo header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed'), json_encode(array('json' => 'false'));


    } else if (file_exists("$page.php"))
           include "$page.php";

      else if (file_exists(parse_url($page, PHP_URL_PATH) . ".php"))
         include parse_url($page, PHP_URL_PATH) . ".php";


} else echo header($_SERVER['SERVER_PROTOCOL'] . ' 500 Ошибка подключения базы данных'), "
        <html>
            <link rel=\"stylesheet\" href=\"css/sweetalert2.min.css\">
            <script src=\"js/jquery.min.js\"></script>
            <script src=\"js/sweetalert2.min.js\"></script>  
            
            <body>
            <script>
                        Swal.fire({
                                    icon: \"error\",
                                    title: \"Ошибка БД\",
                                    html: \"Проверьте что база данных работает и <br> повторите попытку позже\", 
                                    confirmButtonColor: \"#2e82c3\",                          
                                    });
                       </script>
            </body>
            
        </html>
";

}






