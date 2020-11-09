<?php /** @var string $sCsrf */ ?>
<link href="/assets/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="/assets/dist/css/signin.css" rel="stylesheet">
<script type="application/javascript" src="/assets/jquery/jquery-3.5.1.min.js"></script>
<script src="/assets/jquery/jquery.validate.js"></script>
<script src="/js/auth.js"></script>

<div class="container">
    <div class="row">
        <div class="col-sm">
        </div>
        <div class="col-sm">
            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <form class="form-signin" action="/auth/login" method="post" id="auth_form">
                    <img class="mb-4" src="/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
                    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                    <label for="inputLogin" class="sr-only">Login</label>
                    <input type="text" id="inputLogin" name="login" class="form-control" placeholder="Login" required autofocus>
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                    <input type="hidden" name="csrf" class="form-control" value="<?= $sCsrf ?>">
                    <div class="checkbox mb-3"></div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                    <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
                    <small class="align-content-center">
                        <a href="/register">Регистрация</a>
                    </small>
                </form>
            </div>
        </div>
        <div class="col-sm">
        </div>
    </div>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>
