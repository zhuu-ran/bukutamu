<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    $_SESSION['login_error'] = 'Username dan password wajib diisi.';
    header('Location: index.php');
    exit;
}

try {
    require_once __DIR__ . '/koneksi.php';

    $stmt = $koneksi->prepare(
        'SELECT `username`, `password` FROM `user` WHERE `username` = ? LIMIT 1'
    );
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($matchedUsername, $storedPassword);
    $userFound = $stmt->fetch();
    $stmt->close();
} catch (Throwable $error) {
    $_SESSION['login_error'] = 'Login belum dapat diproses. Silakan coba kembali.';
    header('Location: index.php');
    exit;
}

$storedPassword = $userFound ? (string) $storedPassword : '';
$passwordInfo = password_get_info($storedPassword);
$passwordMatches = $userFound && (
    !empty($passwordInfo['algo'])
        ? password_verify($password, $storedPassword)
        : hash_equals($storedPassword, $password)
);

if (!$passwordMatches) {
    $_SESSION['login_error'] = 'Username atau password yang Anda masukkan salah.';
    header('Location: index.php');
    exit;
}

session_regenerate_id(true);
$_SESSION['logged_in'] = true;
$_SESSION['username'] = $matchedUsername;
$_SESSION['login_time'] = time();

header('Location: dashboard.php');
exit;