<?php
/*
    * Модуль обработки ajax запросов
    * Тут происходит запись и обновление данных в БД

 */

include "clean.php";
$response = array(
        "json" => true,
        "value" => true,
        "query" => true,



    );

if (isset($_POST['new_car'])) {

        $data = array(
            "new_car" => []
        );
        if(count($_POST['new_car']) < 10){
            $response["value"] = false;
            $response["query"] = false;
            if(isset($_SESSION['token']))
                $_SESSION['token'] = bin2hex(random_bytes(35));
            echo json_encode($response);
            exit;

        }
        foreach ($_POST['new_car'] as $key => $value) {

                        if (is_string($value))
                            $value = Clean::str($value);
                        else if (is_int($value))
                            $value = Clean::int($value);
                        else if (is_float($value))
                            $value = Clean::float($value);

                        $data["new_car"][] = $value;


          }




        $insert_automobile = pg_prepare($dbconn, "automobile_query",
        "INSERT INTO automobile.public.automobile (BRAND, 
                                                         MODEL, 
                                                         YEAR,
                                                         COMPLECTATION,
                                                         engine_volume, 
                                                         engine_type,
                                                         engine_power,
                                                         transmission,
                                                         carcase,
                                                         color) VALUES 
            ( $1, 
              $2, 
              $3, 
              $4,
              $5,
              $6,
              $7,
              $8,
              $9,
              $10
             );
                ");

        $insert_automobile = pg_execute($dbconn, "automobile_query", $data['new_car']);
        if(!$insert_automobile)
            $response["query"] = false;






} else if (isset($_POST['update_car'])) {

    $data = array(
        "update_car" => [] );
    if(count($_POST["update_car"]) < 11) {
        $response["value"] = false;
        $response["query"] = false;
        if(isset($_SESSION['token']))
            $_SESSION['token'] = bin2hex(random_bytes(35));
        echo json_encode($response);
        exit;
    }
    foreach ($_POST['update_car'] as $key => $value) {
        if ($key == "id")
            $id_car = Clean::int($value);
        else {
                if (is_string($value))
                    $value = Clean::str($value);
                else if (is_int($value))
                    $value = Clean::int($value);
                else if (is_float($value))
                    $value = Clean::float($value);
                $data["update_car"][$key] = $value;
            }



    }


    $update_automobile = pg_prepare($dbconn, "automobile_query",
        "UPDATE automobile.public.automobile SET ( BRAND, 
                                                         MODEL, 
                                                         YEAR,
                                                         COMPLECTATION,
                                                         engine_volume, 
                                                         engine_type,
                                                         engine_power,
                                                         transmission,
                                                         carcase,
                                                         color) =
            ( $1, 
              $2, 
              $3, 
              $4,
              $5,
              $6,
              $7,
              $8,
              $9,
              $10
             ) WHERE id_car = '$id_car';
                ");

    $update_automobile = pg_execute($dbconn, "automobile_query", $data['update_car']);
    if(!$update_automobile)
        $response["query"] = false;






} else if(isset($_POST['new_owner'])){
    $data = array(
        "new_owner" => []
    );
    if(count($_POST['new_owner']) < 4) {
        $response["value"] = false;
        $response["query"] = false;
        if(isset($_SESSION['token']))
            $_SESSION['token'] = bin2hex(random_bytes(35));
        echo json_encode($response);
        exit;
    }
    foreach ($_POST['new_owner'] as $key => $value) {
            if (is_string($value))
                $value = Clean::str($value);
            else if (is_int($value))
                $value = Clean::int($value);
            else if (is_float($value))
                $value = Clean::float($value);

            $data["new_owner"][] = $value;

    }




    $insert_owner = pg_prepare($dbconn, "owner_query",
        "INSERT INTO automobile.public.owners (id_car, fio, city, phone_number) VALUES 
            ( $2, 
              $1, 
              $3, 
              $4    
             );
                ");

    $insert_automobile = pg_execute($dbconn, "owner_query", $data['new_owner']);
    if(!$insert_automobile) {
        $response["query"] = false;

    }


} else if (isset($_POST['update_owner'])) {

    $data = array(
        "update_owner" => []
    );
    if(count($_POST["update_owner"]) < 5) {
        $response["value"] = false;
        $response["query"] = false;
        if(isset($_SESSION['token']))
            $_SESSION['token'] = bin2hex(random_bytes(35));
        echo json_encode($response);
        exit;
    }
    foreach ($_POST['update_owner'] as $key => $value) {

        if (is_string($value))
            $value = Clean::str($value);
        else if (is_int($value))
            $value = Clean::int($value);
        else if (is_float($value))
            $value = Clean::float($value);

        $data["update_owner"][] = $value;

    }


    $update_owner= pg_prepare($dbconn, "owner_query",
        "UPDATE automobile.public.owners SET (id_car, fio, city, phone_number) =
            ( $3, 
              $2, 
              $4, 
              $5    
             ) WHERE id = $1;
                ");

    $update_owner = pg_execute($dbconn, "owner_query", $data['update_owner']);
    if(!$update_owner) {
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










