function validateForm() {

    function setRules() {
        $('#form_add').validate({
            rules: {
                first_name: "required",
                email: {
                    required: true,
                    email: true
                },
                phone_number: {
                    required: true,
                },
            },
            messages: {
                first_name: "Это поле обязательно для заполнения",
                email: "Это поле обязательно для заполнения",
                phone_number: "Это поле обязательно для заполнения",
            }
        });
    }


    function setMasks() {
        $('#phone_number').mask('(000) 000-0000');
    }


    setMasks();
    setRules();
}