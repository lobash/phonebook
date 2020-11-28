$(document).ready(function () {
    $('#register_form').validate({
        rules: {
            login: {
                required: true
            },
            password: {
                required: true,
                minlength: 6,
                pwcheck: true
            }
        }, messages: {
            login: {
                required: "обязательно для заполнения"
            },
            password: {
                required: "обязательно для заполнения",
                minlength: "минимальная длина пароля 6 символов",
                pwcheck: "пароль должен состоять из как минимум 6 символов, латинских символов нижнего и верхнего регистра и чисел"
            },
        }
    });


    $('#auth_form').validate({
        rules: {
            login: {
                required: true
            },
            password: {
                required: true,
            }
        }, messages: {
            login: {
                required: "обязательно для заполнения"
            },
            password: {
                required: "обязательно для заполнения",
            },
        }
    });
});



$.validator.addMethod("pwcheck", function (value) {
    return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // содержит только эти символы
        && /[a-z]/.test(value) // имеет нижнее подчеркивание
        && /[A-Z]/.test(value) // имеет верхнее подчеркивание
        && /\d/.test(value) // имеет числа
});