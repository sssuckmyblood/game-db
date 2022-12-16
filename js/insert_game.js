$("form").submit(function (event) {

    var $inputs = $('form :input');
    var is_empty = false;

    data = { "new_game":{}
    };

        for (var i = 0; i < $inputs.length - 1; i++) {

                if ($inputs[i].value !== "")

                    data["new_game"][$inputs[i].name] = $inputs[i].value;

                else {

                    swal.fire({
                        type: "error",
                        title: "Ошибка добавления записи",
                        text: "Заполните все поля формы",
                        confirmButtonColor: "#29c75f",
                        confirmButtonText: "Продолжить",

                    });
                    is_empty = true;

                }

        }

    if(!is_empty) {
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: "/ajax",
            async: false,
            data: data,

            success: function (result_data) {
                var response = $.parseJSON(result_data);

                if(response["value"] === false) {
                    Swal.fire({
                        icon: "error",
                        title: "Ошибка записи в БД",
                        html: "Вы заполнили не все поля",
                        confirmButtonColor: "#C177FF",
                    }).then(function() {
                        window.location.reload();
                    });

                } else if(response["query"] === false) {
                    Swal.fire({
                        icon: "error",
                        title: "Ошибка записи в БД",
                        html: "Данная игра уже есть в базе",
                        confirmButtonColor: "#C177FF",
                        confirmButtonText: "Перезагрузить",
                    }).then(function() {
                        window.location.reload();
                    });

                } else {
                    Swal.fire({
                        icon: "success",
                        title: "Запись успешно добавлена!",
                        html: "",
                        confirmButtonColor: "#C177FF",
                        confirmButtonText: "Перейти к таблице",
                    }).then(function() {
                        window.location = "/games";
                    });
                }
            },
            statusCode: {
                405: function () {
                    swal.fire({
                        type: "error",
                        title: "Ошибка добавления записи",
                        text: "Форма заблокирована!",
                        confirmButtonColor: "#29c75f",
                        confirmButtonText: "Разблокировать",

                    }).then (function () {

                        window.location.reload();

                    });
                }
            }
        });
    }

    event.preventDefault();

});