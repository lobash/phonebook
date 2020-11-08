<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-sm">
        </div>
        <div class="col-sm">
            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <form class="form-signin">
                    <img class="mb-4" src="../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
                    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                    <label for="inputLogin" class="sr-only">Login</label>
                    <input type="email" id="inputLogin" class="form-control" placeholder="Login" required autofocus>
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                    <div class="checkbox mb-3"></div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                    <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
                    <small class="align-content-center">
                        <a href="#">Регистрация</a>
                    </small>
                </form>
            </div>
        </div>
        <div class="col-sm">
        </div>
    </div>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>
