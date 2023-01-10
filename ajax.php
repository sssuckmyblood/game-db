<?php
/*
    * Модуль обработки ajax запросов
    * Тут происходит запись и обновление данных в БД

 */

$response = array(
        "json" => true,
        "value" => true,
        "query" => true,

    );
# Получаем запрос на добавление студии
if (isset($_POST['new_studio'])) {

        # создаем массив для обработки данных
        $data = array(
            "new_studio" => []
        );
        # проверяем данные которые пришли в запросе на наличие всех полей
        if(count($_POST['new_studio']) < 4){
            $response["value"] = false;
            $response["query"] = false;
            if(isset($_SESSION['token']))
                $_SESSION['token'] = bin2hex(random_bytes(35));
            echo json_encode($response);
            exit;

        }
        # если условие выполненно тогда записываем данные в массив
        foreach ($_POST['new_studio'] as $key => $value) {

                        $data["new_studio"][] = $value;

          }

        # подготавливаем шаблон запроса в базу данных
        $insert_studio = pg_prepare($dbconn, "studio_query",
        "INSERT INTO studios (name,
                                    year,
                                    location,
                                    workers) VALUES 
            ( $1, 
              $2, 
              $3, 
              $4
             );
                ");
        # выполняем запрос в базу данных
        $insert_studio = pg_execute($dbconn, "studio_query", $data['new_studio']);
        if(!$insert_studio)
            $response["query"] = false;






} else if (isset($_POST['update_studio'])) {

    $data = array(
        "update_studio" => [] );
    if(count($_POST["update_studio"]) < 5) {
        $response["value"] = false;
        $response["query"] = false;
        if(isset($_SESSION['token']))
            $_SESSION['token'] = bin2hex(random_bytes(35));
        echo json_encode($response);
        exit;
    }
    foreach ($_POST['update_studio'] as $key => $value) {

                $data['update_studio'][$key] = $value;

    }


    $update_studio = pg_prepare($dbconn, "studio_query",
        "UPDATE studios SET ( name,
                                    year,
                                    location,
                                    workers ) =
            ( $2, 
              $3, 
              $4,
              $5
             ) WHERE id = $1;
                ");

    $update_studio = pg_execute($dbconn, "studio_query", $data['update_studio']);
    if(!$update_studio)
        $response["query"] = false;






} else if(isset($_POST['new_game'])){
    $data = array(
        "new_game" => []
    );
    if(count($_POST["new_game"]) < 6) {
        $response["value"] = false;
        $response["query"] = false;
        if(isset($_SESSION['token']))
            $_SESSION['token'] = bin2hex(random_bytes(35));
        echo json_encode($response);
        exit;
    }
    foreach ($_POST["new_game"] as $key => $value) {
            $data["new_game"][] = $value;

    }


    $insert_game = pg_prepare($dbconn, "game_query",
        "INSERT INTO games (id_studio, 
                                name,
                                year_release, 
                                category,
                                platform,
                                carrier) VALUES 
            ( $2, 
              $1, 
              $3, 
              $4,
              $5, 
              $6   
             );
                ");

    $insert_game = pg_execute($dbconn, "game_query", $data["new_game"]);
    if(!$insert_game) {
        $response["query"] = false;

    }


} else if (isset($_POST['update_game'])) {

    $data = array(
        "update_game" => []
    );
    if(count($_POST["update_game"]) < 7) {
        $response["value"] = false;
        $response["query"] = false;
        if(isset($_SESSION['token']))
            $_SESSION['token'] = bin2hex(random_bytes(35));
        echo json_encode($response);
        exit;
    }
    foreach ($_POST['update_game'] as $key => $value) {


        $data['update_game'][] = $value;

    }


    $update_game= pg_prepare($dbconn, "game_query",
        "UPDATE games SET (id_studio,
                                 name, 
                                 year_release, 
                                 category, 
                                 platform, 
                                 carrier) =
            ( $3, 
              $2, 
              $4, 
              $5, 
              $6,
              $7     
             ) WHERE id = $1;
                ");

    $update_game = pg_execute($dbconn, "game_query", $data['update_game']);
    if(!$update_game) {
        $response["query"] = false;

    }

} else {
    $response["json"] = false;
    $response["value"] = false;
    $response["query"] = false;
    echo header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
}

echo json_encode($response);

$_SESSION['token'] = bin2hex(random_bytes(35));










