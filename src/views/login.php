<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/comum.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/icofont.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <title>In 'n Out</title>
</head>

<body>
    <form class="form-login" action="#" method="POST">
        <div class="login-card card">
            <div class="card-header">
                <i class="icofont-travelling mr-2"></i>
                <span class="font-weight-light">In</span>
                <span class="font-weight-bold mx-2">'N</span>
                <span class="font-weight-light">Out</span>
                <i class="icofont-runner-alt-1 ml-2"></i>
            </div>
            <div class="card-body">
                <?php include(TEMPLATE_PATH . "/messages.php"); ?>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control <?= $errors['email'] ? 'is-invalid' : '' ?>" type="email" name="email" id="email" placeholder="Digite seu e-mail" value="
                    <?= isset($_POST['email']) ? $_POST['email'] : null ?> " autofocus autocomplete="off">
                    <div class="invalid-feedback">
                        <?= $errors['email'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input class="form-control <?= $errors['password'] ? 'is-invalid' : '' ?>" type="password" name="password" id="password" placeholder="Digite sua senha">
                    <div class="invalid-feedback">
                        <?= $errors['password'] ?>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button class="btn btn-lg btn-primary">Entrar</button>
            </div>
        </div>
    </form>
</body>

</html>