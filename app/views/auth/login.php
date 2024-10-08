<?php

$title = 'Authorization';
ob_start();
?>

<h1 class="mb-4">Авторизация</h1>
<form method="POST" action="/auth/authenticate">
    <div class="mb-3">
        <label for="email" class="form-label">Почта</label>
        <input type="email" class="form-control" id="email" name="email" required />
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" class="form-control" id="password" name="password" required />
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remember" name="remember" />
        <label class="form-check-label" for="remember">Запомнить меня</label>
    </div>
    <button type="submit" class="btn btn-primary">Войти</button>
</form>
<div class="mt-4">
    Нет аккаунта? <a href="/auth/register"><?=htmlspecialchars("Зарегистрироваться")?></a>
</div>

<?php $content = ob_get_clean();
include 'app/views/layout.php';
?>