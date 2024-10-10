<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: الرئيسية.php');
    exit;
}

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

$stmt = $pdo->prepare("SELECT name, email, phone, country_code FROM users WHERE id = :user_id");
$stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(); 
if (!$user) {
    echo "User not found!";
    exit;
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
       @import url('https://fonts.googleapis.com/css2?family=El+Messiri:wght@400..700&display=swap');  
        header {
            border: none;
            box-shadow: none;
            background-color: transparent;
        }

        ::-webkit-scrollbar {
    width: 12px;
    height: 12px;
}
::-webkit-scrollbar-thumb {
    background-color: #1e9d0e;
    border-radius: 3px;
}
::-webkit-scrollbar-thumb:hover {
    background-color: #16800b;
}
::-webkit-scrollbar-track {
    background-color: #aaa;
    border-radius: 3px;
}
    h1 {
    color: #00a000;
    font-size: 40px;
    text-align: center;
    font-family: 'El Messiri', sans-serif;
    margin-bottom: 20px;
    cursor:default;
}

body {
    background-color: #121212;
    display: flex;
    flex-direction: column;
    justify-content: center; 
    align-items: center; 
    height: 100vh;
    margin: 0; 
    position: relative;
}

.form-container {
    background-color: #1e1e1e;
    padding: 20px;
    border-radius: 10px;
    width: 100%;
    max-width: 400px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
    color: #fff;
    font-family: 'El Messiri', sans-serif;
}

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            text-align: right;
            font-size: 15px;
        }

        input[type="text"] {
            width: 95%;
            padding: 10px;
            background: #333;
            border: 1px solid #444;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            outline: none;
            transition: 0.3s;
            text-align: right;
            margin-bottom: 10px;
            font-family: 'El Messiri', sans-serif;
            cursor: default;
        }

        input[type="text"]:focus {
            border-color: #00b300;
            box-shadow: 0 0 8px rgba(0, 179, 0, 0.5);
        }

        .send-button {
            width: 100%;
            padding: 10px;
            background-color: #00b300;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            font-family: 'El Messiri', sans-serif;
        }

        .send-button:hover {
            background-color: #00a000;
        }

        .message {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #222;
            color: #16800b;
            padding: 15px;
            border-radius: 5px;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            width: auto;
            text-align: center;
            font-weight: bold;
            transition: opacity 0.5s ease-in-out;
            font-size: 15px;
            display: none; 
        }

        .logo {
            width: 130px;
            height: auto;
            position: absolute;
            top: 0;
            left: 0;
        }

        .radio-label {
        display: block;
        position: relative;
        padding-right: 30px;
        margin-bottom: 10px;
        cursor: pointer;
        font-size: 15px;
        color: #fff;
        user-select: none;
        text-align: right;
    }

    .radio-label input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    .radio-custom {
        position: absolute;
        top: 0;
        right: 0;
        height: 20px;
        width: 20px;
        background-color: #444;
        border-radius: 50%;
        transition: background-color 0.3s;
    }

    .radio-label input:checked ~ .radio-custom {
        background-color: #00b300;
    }

    .radio-custom::after {
        content: "";
        position: absolute;
        display: none;
    }

    .radio-label input:checked ~ .radio-custom::after {
        display: block;
    }

    .radio-label .radio-custom::after {
        top: 6px;
        left: 6px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: white;
    }
    </style>
</head>
<a href="الرئيسية.php">
    <img src="logo.png" alt="Logo" class="logo">
</a>
<h1>فتح حساب تداول</h1>
<body>
<div id="message" class="message">إرسال</div>
<div class="form-container">
    <form id="tradingForm" action="">
        <label for="name">الاسم</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" readonly>

        <label for="email">البريد الإلكتروني</label>
        <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>

        <label for="phone">رقم الهاتف</label>
        <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($user['country_code']); ?> <?php echo htmlspecialchars($user['phone']); ?>" readonly>

        <label for="quantity">المبلغ المحدد</label>
        <input type="text" name="quantity" id="quantity" placeholder="أدخل المبلغ هنا" required style="cursor:text;">

        <label for="Deposit-method">طريقة الايداع</label>
        <div class="timeframe-options">
            <label class="radio-label">
                <input type="radio" id="Iban" name="Deposit-method" value="Bank transfer via IBAN" required>
                <span class="radio-custom"></span>
                Iban حوالة بنكية عبر الـ
            </label>
            <label class="radio-label">
                <input type="radio" id="Office" name="Deposit-method" value="Office transfer" required>
                <span class="radio-custom"></span>
                حوالة مكتبية
            </label>
            <label class="radio-label">
                <input type="radio" id="USDT" name="Deposit-method" value="USDT digital currencies" required>
                <span class="radio-custom"></span>
                USDT عملات رقمية
            </label>
        </div>

        <button type="submit" class="send-button">إرسال</button>
    </form>
</div>

<script>
document.getElementById('tradingForm').onsubmit = function(event) {
    event.preventDefault(); 

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const quantity = document.getElementById('quantity').value;
    const depositMethod = document.querySelector('input[name="Deposit-method"]:checked').value;

    const subject = `Creating Trading Account From ${name}`;
    const body = `Name: ${name}\nEmail: ${email}\nPhone: ${phone}\nQuantity: $${quantity}\nDeposit method: ${depositMethod}`;
    const mailtoLink = `mailto:info@learntrading-tr.com?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;

    const sendingMessage = document.getElementById('message');
    sendingMessage.style.display = 'block';
    setTimeout(function() {
        sendingMessage.style.display = 'none';
        document.getElementById('tradingForm').reset(); 
        window.location.href = mailtoLink;
    }, 2000);
};
</script>


</body>
</html>
