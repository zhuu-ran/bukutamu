<?php
session_start();

if (empty($_SESSION['logged_in'])) {
    $_SESSION['login_error'] = 'Silakan login terlebih dahulu untuk membuka dashboard.';
    header('Location: index.php');
    exit;
}

$username = htmlspecialchars($_SESSION['username'] ?? 'Administrator', ENT_QUOTES, 'UTF-8');
$loginTime = date('d F Y, H:i', $_SESSION['login_time'] ?? time());
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#9d1d35">
    <title>Dashboard | Buku Tamu</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <style>
        body.dashboard-page { background: radial-gradient(ellipse at 50% 28%, rgba(255,255,255,.92) 0, rgba(255,255,255,.48) 28%, transparent 65%), linear-gradient(145deg, #74172b, #b3263c 52%, #641326); }
        .dashboard-card { width: min(760px, 100%); border: 0; border-radius: 1.25rem; box-shadow: 0 24px 65px rgba(30,5,12,.34), 0 0 42px rgba(255,255,255,.2); }
        .success-panel { border-radius: 1rem; background: linear-gradient(135deg, #811a30, #b3263c); }
    </style>
</head>
<body class="dashboard-page">
    <main class="container min-vh-100 d-flex align-items-center justify-content-center py-4">
        <section class="card dashboard-card" aria-labelledby="welcome-title">
            <div class="card-body p-4 p-md-5">
                <header class="d-flex align-items-center justify-content-between gap-3 mb-4">
                    <div>
                        <div class="text-uppercase text-danger fw-semibold small">Buku Tamu</div>
                        <div class="text-secondary small">Portal administrator</div>
                    </div>
                    <form method="post" action="logout.php">
                        <button class="btn btn-outline-danger rounded-pill px-3" type="submit">Keluar</button>
                    </form>
                </header>

                <div class="success-panel text-white p-4 p-md-5 mb-4">
                    <div class="small text-uppercase fw-semibold mb-3">&#10003; Login berhasil</div>
                    <h1 id="welcome-title" class="h2 fw-bold mb-2">Selamat datang, <?= $username ?>.</h1>
                    <p class="mb-0 text-white-50">Anda berhasil masuk. Sesi administrator Buku Tamu kini aktif.</p>
                </div>

                <div class="row g-3">
                    <div class="col-12 col-sm-6">
                        <div class="border rounded-4 p-3 h-100">
                            <div class="small text-secondary mb-2">Akun aktif</div>
                            <div class="fw-semibold text-break"><?= $username ?></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="border rounded-4 p-3 h-100">
                            <div class="small text-secondary mb-2">Waktu login</div>
                            <div class="fw-semibold"><?= htmlspecialchars($loginTime, ENT_QUOTES, 'UTF-8') ?></div>
                        </div>
                    </div>
                </div>

                <div class="text-center text-secondary small mt-4">&copy; 2024 Buku Tamu</div>
            </div>
        </section>
    </main>
</body>
</html>
