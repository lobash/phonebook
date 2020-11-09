<?php /** @var string $sCsrf */ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Signin Template · Bootstrap</title>
    <script src="/assets/jquery/jquery-3.5.1.min.js" type="application/javascript"></script>
    <script src="/assets/jquery/jquery.validate.js" type="application/javascript"></script>
    <script src="/js/auth.js" type="application/javascript"></script>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="/assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/assets/bootstrap/dist/css/signin.css" rel="stylesheet">
</head>
<body class="text-center">
<form class="form-signin" action="/register/add" method="post" id="register_form">
    <img class="mb-4" src="/assets/bootstrap/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Please register now</h1>
    <label for="inputEmail" class="sr-only">Email</label>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
    <label for="inputLogin" class="sr-only">Login</label>
    <input type="text" id="inputLogin" name="login" class="form-control" placeholder="Login" required>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
    <input type="hidden" name="csrf" class="form-control" value="<?= $sCsrf ?>">
    <div class="checkbox mb-3"></div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
    <small class="align-content-center">
        <a href="/">Зарегестрированы? Авторизуйтесь</a>
    </small>
</form>
</body>
</html>
