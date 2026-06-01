<?php

session_start();
include("conexao.php");

if(isset($_POST['email'])){

    $email = $_POST['email'];
    $senha = md5($_POST['password']);

    $sql = "SELECT * FROM usuarios
            WHERE email='$email'
            AND senha='$senha'";

    $resultado = mysqli_query($conexao, $sql);

    if(mysqli_num_rows($resultado) == 1){

        $_SESSION['usuario'] = $email;

        header("Location: index.php");
        exit;

    } else {

        echo "Usuário ou senha inválidos";

    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>S.A.G.E. | Login</title>
<link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/base.css">
<link rel="stylesheet" href="assets/css/layout.css">
<link rel="stylesheet" href="assets/css/components.css">
<link rel="stylesheet" href="assets/css/pages.css">
<link rel="stylesheet" href="assets/css/auth.css">
</head>
<body class="auth-page">
    <button class="login-theme-toggle" type="button" data-login-theme-toggle aria-label="Alternar tema">
        <span data-login-theme-icon>☾</span>
    </button>

    <main class="login-shell">
        <section class="login-container" aria-labelledby="login-title">
            <header class="login-brand">
                <span class="login-brand-icon" data-login-logo></span>
                <h1 class="login-brand-title">S.A.G.E.</h1>
                <p class="login-brand-subtitle">Gerenciamento de Estoque</p>
            </header>

            <article class="login-card">
                <div class="login-card-body">
                    <h2 class="login-title" id="login-title">Bem-vindo de volta</h2>
                    <p class="login-subtitle">Acesse sua conta para continuar</p>

                    <form id="loginForm" action="/auth/login" method="post" novalidate>
                        <div class="login-field">
                            <label class="login-label" for="email">E-mail corporativo</label>

                            <div class="login-control">
                                <span class="login-control-icon" data-login-email-icon></span>
                                <input class="login-input" id="email" name="email" type="email" placeholder="admin@oficina.com.br" autocomplete="email" required>
                            </div>
                        </div>

                        <div class="login-field">
                            <div class="login-label-row">
                                <label class="login-label" for="password">Senha</label>
                                <button class="login-field-link" type="button" aria-label="Recuperar senha">
                                    Esqueceu a senha?
                                </button>
                            </div>

                            <div class="login-control">
                                <span class="login-control-icon" data-login-lock-icon></span>
                                <input class="login-input" id="password" name="password" type="password" placeholder="••••••••••" autocomplete="current-password" required>
                            </div>
                        </div>

                        <button class="login-submit" type="submit">
                            Entrar no Sistema →
                        </button>

                        <div class="login-feedback" data-login-feedback></div>
                    </form>
                </div>

                <footer class="login-card-footer">
                    <span>Problemas para acessar? <span class="login-footer-link">Fale com o suporte</span></span>
                </footer>
            </article>

            <div class="login-progress" aria-hidden="true">
                <span class="login-progress-dot is-active"></span>
                <span class="login-progress-dot"></span>
            </div>

            <p class="login-copy">© 2026 S.A.G.E. · Todos os direitos reservados</p>
        </section>
    </main>

    <script src="assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/js/core/utils.js"></script>
    <script src="assets/js/components/icons.js"></script>
    <script src="assets/js/core/api.js"></script>
    <script src="assets/js/pages/login.js"></script>
</body>
</html>
