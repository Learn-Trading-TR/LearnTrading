<?php

$host = '127.0.0.1';
$db = 'database';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$message = '';
$redirect_url = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['signup'])) {
        $name = trim($_POST['name']);
        $country_code = trim($_POST['country_code']);
        $phone = trim($_POST['phone']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if (!empty($name) && !empty($country_code) && !empty($phone) && !empty($email) && !empty($password)) {
            $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? OR phone = ?');
            $stmt->execute([$email, $phone]);
            $existing_user = $stmt->fetch();

            if ($existing_user) {
                $message = "البريد الإلكتروني أو رقم الهاتف موجود بالفعل.";
            } else {
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                $stmt = $pdo->prepare('INSERT INTO users (name, country_code, phone, email, password, created_at) VALUES (?, ?, ?, ?, ?, NOW())');
                $stmt->execute([$name, $country_code, $phone, $email, $hashed_password]);
                $message = "تم إنشاء الحساب بنجاح!";
            }
        } else {
            $message = "يرجى ملء جميع الحقول.";
        }
    } elseif (isset($_POST['signin'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        
        if (!empty($email) && !empty($password)) {
            $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if (!$user) {
                $message = "المستخدم غير موجود.";
            } else {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    $message = "تسجيل الدخول ناجح! مرحبًا بك، " . htmlspecialchars($user['name']) . ".";
                } else {
                    $message = "البريد الإلكتروني أو كلمة المرور غير صحيحة.";
                }
            }
        } else {
            $message = "يرجى ملء جميع الحقول.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعلم التداول</title>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <style>
        .message {
            font-weight: bold;
            transition: opacity 0.5s ease;
        }
    </style>
    <script>
        function redirectAfterDelay(url) {
            if (url) {
                setTimeout(function() {
                    window.location.href = url;
                }, 3000);
            }
        }

        function hideMessageAfterDelay() {
            setTimeout(function() {
                const messageElement = document.getElementById('message');
                if (messageElement) {
                    messageElement.style.opacity = '0';
                    setTimeout(() => messageElement.style.display = 'none', 500);
                }
            }, 3000);
        }
    </script>
</head>
<body>
    <?php if ($message): ?>
        <div id="message" class="message <?php echo ($redirect_url ? 'success' : 'error'); ?>">
            <p><?php echo $message; ?></p>
        </div>
        <script>
            hideMessageAfterDelay();
            redirectAfterDelay('<?php echo $redirect_url; ?>');
        </script>
    <?php endif; ?>
</body>
</html>
