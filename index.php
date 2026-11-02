<?php
session_start();
$loginError = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#9d1d35">
    <title>Masuk | Buku Tamu</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <style>
        body.login-page { background: radial-gradient(ellipse at center, rgba(255,255,255,.92) 0, rgba(255,255,255,.55) 22%, rgba(255,255,255,0) 62%), linear-gradient(145deg, #74172b, #b3263c 52%, #641326); }
        .login-card { width: min(420px, 100%); border: 0; border-radius: 1.25rem; box-shadow: 0 24px 65px rgba(30,5,12,.34), 0 0 42px rgba(255,255,255,.2); }
        .password-wrap { position: relative; }
        .password-wrap .form-control { padding-right: 88px; }
        .password-toggle { position: absolute; top: 50%; right: 12px; padding: 6px; transform: translateY(-50%); border: 0; background: transparent; color: #a52a3d; font-size: .75rem; font-weight: 600; }
        .form-control:focus { border-color: #b3263c; box-shadow: 0 0 0 .2rem rgba(179,38,60,.15); }
    </style>
</head>
<body class="login-page">
    <main class="container min-vh-100 d-flex align-items-center justify-content-center py-4">
        <section class="card login-card shadow-lg" aria-labelledby="login-title">
            <div class="card-body p-4 p-sm-5">
                <div class="text-uppercase text-danger fw-semibold small mb-2">Buku Tamu · Admin</div>
                <h1 id="login-title" class="h2 fw-bold mb-2">Masuk</h1>
                <p class="text-secondary small mb-4">Masuk untuk melanjutkan.</p>

                <?php if ($loginError !== ''): ?>
                    <div class="alert alert-danger py-2 small" role="alert">
                        <?= htmlspecialchars($loginError, ENT_QUOTES, 'UTF-8') ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="validasi.php">
                    <div class="mb-3">
                        <label for="username" class="form-label small fw-semibold">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                               placeholder="Masukkan username" autocomplete="username" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label small fw-semibold">Password</label>
                        <div class="password-wrap">
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="Masukkan password" autocomplete="current-password" required>
                            <button class="password-toggle" type="button" aria-controls="password" aria-label="Tampilkan password" aria-pressed="false">Tampilkan</button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger w-100 rounded-pill py-2 fw-semibold" name="submit">Masuk</button>
                </form>

                <div class="border-top text-secondary text-center small mt-4 pt-3">Portal administrator Buku Tamu</div>
            </div>
        </section>
    </main>

    <script>
        const passwordInput = document.getElementById('password');
        const passwordToggle = document.querySelector('.password-toggle');

        passwordToggle.addEventListener('click', () => {
            const isVisible = passwordInput.type === 'text';
            passwordInput.type = isVisible ? 'password' : 'text';
            passwordToggle.textContent = isVisible ? 'Tampilkan' : 'Sembunyikan';
            passwordToggle.setAttribute('aria-label', isVisible ? 'Tampilkan password' : 'Sembunyikan password');
            passwordToggle.setAttribute('aria-pressed', String(!isVisible));
        });
    </script>
</body>
</html>
