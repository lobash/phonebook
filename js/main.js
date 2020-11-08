$(document).ready(function () {

    $(document).on('click', '.js-add_new', function () {
        showForm();
    });

    $(document).on('submit', '#form_add', function (e) {
        e.preventDefault();
        addNewPhone.call(this);
    });

    $(document).on('click', '.js-remove', function () {
        removePhone.call(this);
    });


    function removePhone() {
        let needDelete = confirm('Удалить элемент?'),
            $this = $(this),
            id = $this.data('id'),
            csrf = $this.data('csrf');


        if (needDelete === true) {
            $.ajax({
                method: 'POST',
                url: '/phone/delete',
                data: {
                    'id': id,
                    'csrf': csrf
                },
                dataType: 'JSON',
                success: function () {
                    $this.parents('.js-item').hide('slow');
                },
                error: function (a, b) {
                    console.log(a, b);
                    alert('произошла ошибка, попробуйте в другой раз');
                }
            });
        }
    }


    function addNewPhone() {
        let form = $(this),
            formData = new FormData(form[0]),
            imageInput = form.find('#image');

        formData.delete('image');
        if (typeof imageInput[0].files !== 'undefined') {
            formData.append('image', imageInput[0].files[0]);
        }

        $.ajax({
            type: 'POST',
            url: 'phone/add',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $.fancybox.close(500);
                $('.js-list').prepend(response);
            },
            error: function () {
                alert("произошла ошибка, попробуйте позже");
            }
        });
    }

    function showForm() {
        $.fancybox.open({
            src: '#form_add_content',
            opts: {
                afterShow: function (instance, current) {
                    validateForm();
                }
            }
        });
    }
});