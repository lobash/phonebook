<?php /** @var string $sCsrf */ ?>
<div id="form_add_content" class="my-3 p-3 bg-white rounded shadow-sm" style="display: none">
    <form id="form_add" name="add_new" method="post" action="#" >
        <h4>Заполните данные:</h4>
        <div class="form-group">
            <label for="last_name">Фамилия</label>
            <input name="last_name" type="text" class="form-control" id="last_name" aria-describedby="Фамилия"
                   placeholder="Введите фамилию">
        </div>
        <div class="form-group">
            <label for="first_name">Имя</label>
            <input type="text" name="first_name" class="form-control" id="first_name" aria-describedby="Имя"
                   placeholder="Введите имя" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="email"
                   placeholder="Введите email" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Номер телефона</label>
            <input type="tel" name="phone_number" class="form-control" id="phone_number"
                   aria-describedby="phone_number" placeholder="Введите номер телефона" required>
        </div>
        <div class="form-group">
            <label for="image">Изображение</label>
            <input name="image" type="file" class="form-control" id="image" value="">
        </div>
        <input name="csrf" type="hidden" value="<?= $sCsrf ?>" class="form-control">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>