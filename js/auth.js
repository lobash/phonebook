$(document).ready(function () {

    function sendRegisterForm() {
        let form = $(this),
            formData = new FormData(form[0]);

        $.ajax({
            method: 'POST',
            url: '/register/add',
            data: formData,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.error === '') {
                    window.location.href = '/';
                }
            },
            error: function () {
                alert('Ошибка, попробуйте ещё раз');
            }
        });
    }

    function sendAuthForm() {
        let form = $(this),
            formData = new FormData(form[0]);

        $.ajax({
            method: 'POST',
            url: '/auth/login',
            data: formData,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                if (typeof response.error !== 'undefined' || response.error !== '') {
                    alert(response.error)
                }
                window.location.reload();
            },
            error: function () {
                alert('Ошибка, попробуйте ещё раз');
            }
        });
    }

    $(document).on('submit', '#register_form', function (e) {
        e.preventDefault();
        sendRegisterForm.call(this);
    });

    $(document).on('submit', '#auth_form', function (e) {
        e.preventDefault();
        sendAuthForm.call(this);
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
});

$.validator.addMethod("pwcheck", function (value) {
    return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // содержит только эти символы
        && /[a-z]/.test(value) // имеет нижнее подчеркивание
        && /[A-Z]/.test(value) // имеет верхнее подчеркивание
        && /\d/.test(value) // имеет числа
});