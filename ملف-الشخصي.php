<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: الرئيسية.php');
    exit;
}


define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'database');
define('DB_USER', 'root');
define('DB_PASS', '');

$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    exit("Database connection failed: " . $e->getMessage());
}

$user_id = $_SESSION['user_id'];
$user_info = []; 
$message = ""; 


$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :user_id");
$stmt->execute(['user_id' => $user_id]);
$user_info = $stmt->fetch();

function calculateAge($birthday) {
    $birthDate = new DateTime($birthday);
    return (new DateTime())->diff($birthDate)->y;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = trim($_POST['phone']);
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'] ?? 'male'; 

    if (empty($name) || empty($email) || empty($phone) || empty($birthday) || !in_array($gender, ['male', 'female'])) {
        $message = "يرجى ملء جميع الحقول بشكل صحيح.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "البريد الإلكتروني غير صالح.";
    } elseif (calculateAge($birthday) < 18) {
        $message = "يجب أن تكون فوق 18 عامًا.";
    } else {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email AND id != :user_id");
        $stmt->execute(['email' => $email, 'user_id' => $user_id]);
        if ($stmt->fetchColumn() > 0) {
            $message = "البريد الإلكتروني موجود بالفعل.";
        } else {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE phone = :phone AND id != :user_id");
            $stmt->execute(['phone' => $phone, 'user_id' => $user_id]);
            if ($stmt->fetchColumn() > 0) {
                $message = "رقم الهاتف موجود بالفعل.";
            } else {
                $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email, phone = :phone, birthday = :birthday, gender = :gender WHERE id = :user_id");
                $stmt->execute([
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'birthday' => $birthday,
                    'gender' => $gender,
                    'user_id' => $user_id
                ]);


                $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :user_id");
                $stmt->execute(['user_id' => $user_id]);
                $user_info = $stmt->fetch();

                $message = "تم حفظ التغييرات بنجاح!";
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_FILES['idFront']) || isset($_FILES['idBack']) || isset($_FILES['faceImage']))) {
        $uploadDir = 'uploads/';
        $filePaths = [];
        $errorMessages = [];

        $uploadedFiles = ['idFront', 'idBack', 'faceImage']; 

        foreach ($uploadedFiles as $fileInputName) {
            if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES[$fileInputName]['tmp_name'];
                $fileName = basename($_FILES[$fileInputName]['name']);
                $filePath = $uploadDir . $fileName;

              
                if (move_uploaded_file($fileTmpPath, $filePath)) {
                    $filePaths[$fileInputName] = $filePath; 
                } else {
                    $errorMessages[] = "فشل في رفع الملف: " . $fileName;
                }
            } else {
                $errorMessages[] = "خطأ في رفع الملف: " . $fileInputName;
            }
        }

    
        header('Content-Type: application/json');
        if (empty($errorMessages)) {
          
            $stmt = $pdo->prepare("UPDATE users SET id_front = :idFront, id_back = :idBack, face_image = :faceImage, denial_reason = :denial_reason WHERE id = :user_id");
            $stmt->execute([
                'idFront' => $filePaths['idFront'] ?? null,
                'idBack' => $filePaths['idBack'] ?? null,
                'faceImage' => $filePaths['faceImage'] ?? null,
                'user_id' => $user_id,
                'denial_reason' => $reason
            ]);
            echo json_encode(['message' => "تم رفع الملفات وحفظ التغييرات بنجاح!"]);
        } else {
            echo json_encode(['message' => implode(", ", $errorMessages)]);
        }
        exit; 
    }
}

ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'path/to/error.log');
error_log("Debug message: " . print_r($variable, true));

?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعلم التداول</title>
    <link rel="stylesheet" href="styl.css">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://kit.fontawesome.com/6676f53229.js" crossorigin="anonymous"></script>
</head>
<body>
<header>
    <a href="الرئيسية.php">
        <img src="logo.png" alt="Logo" class="logo">
    </a>
    <div class="sps">
        <a href="تسجيل-الخروج.php">تسجيل الخروج<i class="fas fa-sign-out-alt"></i></a>
    </div>
    <div class="nav">
        <a href="الرئيسية.php">الرئيسية</a>
        <div class="nav-item">
            <a href="جميع-الخدمات.php">الخدمات</a>
            <div class="dropdown">
                <a href="جميع-الخدمات.php">جميع الخدمات</a>
                <a href="دروس-التدريبية.php">دروس تدريبية</a>
                <a href="توصيات-تداول.php">توصيات تداول</a>
                <a href="فتح-حساب-تداول.php">فتح حساب تداول</a>
                <a href="الاستثمار-وإدارة-المحافظ.php">الاستثمار وإدارة المحافظ</a>
            </div>
        </div>
        <div class="nav-item">
            <a href="منصات-التداول.php">منصات التداول</a>
            <div class="dropdown">
                <a href="MT4.php">MT4</a>
                <a href="MT5.php">MT5</a>
            </div>
        </div>
        <a href="بنك-المعلومات.php">بنك المعلومات</a>
        <a href="من-نحن.php">من نحن</a>
        <a href="اتصل-بنا.php">اتصل بنا</a>
    </div>
</header>
<h1 class="pu">الملف الشخصي</h1>
<section class="user-info">
    <form id="userForm" method="POST">
        <div class="info">
            <label for="name">الاسم</label>
            <input type="text" name="name" id="name" value="<?php echo isset($user_info['name']) ? htmlspecialchars($user_info['name']) : ''; ?>" readonly required>

            <label for="email">البريد الإلكتروني</label>
            <input type="text" name="email" id="email" value="<?php echo isset($user_info['email']) ? htmlspecialchars($user_info['email']) : ''; ?>" readonly required>

            <label for="phone">رقم الهاتف</label>
            <input type="text" name="phone" id="phone" value="<?php echo isset($user_info['phone']) ? htmlspecialchars($user_info['phone']) : ''; ?>" readonly required>

            <label for="birthday">تاريخ الميلاد</label>
            <input type="date" name="birthday" id="birthday" value="<?php echo isset($user_info['birthday']) ? htmlspecialchars($user_info['birthday']) : ''; ?>" readonly min="1900-01-01" max="2024-12-31" required>

            <label for="gender">الجنس</label>
            <select name="gender" id="gender" disabled>
                <option value="male" <?php if (isset($user_info['gender']) && $user_info['gender'] == 'male') echo 'selected'; ?>>ذكر</option>
                <option value="female" <?php if (isset($user_info['gender']) && $user_info['gender'] == 'female') echo 'selected'; ?>>أنثى</option>
            </select>

            

            <?php if (isset($user_info['email_verified']) && $user_info['email_verified'] == 1): ?>
    <div style="color: green; font-weight: bold;" class="info-status">
        <p style="margin-bottom: 5px; text-align:center; margin-top: 10px; cursor: default;">لقد تم قبول طلبك بنجاح من قبل الإدارة</p>
        <span>موثوق</span>
        <i class="fas fa-check-circle"></i>
    </div>
<?php elseif (isset($user_info['email_verified'])): ?>
    <div style="color: red; font-weight: bold;" class="info-status">
        <?php if (empty($user_info['face_image'])): ?>
            <p>
                لإتمام توثيق حسابك، قم برفع هويتك وانتظر للموافقة من الإدارة 
                <a href="#" onclick="openUploader()">اضغط هنا</a>
            </p>
        <?php else: ?>
            <p>
                <?php 
                if (!empty($user_info['denial_reason'])) {
                    echo 'تم رفض طلبك بسبب ' . htmlspecialchars($user_info['denial_reason']);
                } else {
                    echo 'طلبك قيد المراجعة، سنقوم بإبلاغك بالتحديثات قريباً';
                }
                ?>
            </p> 
        <?php endif; ?>
        <span>غير موثوق</span>
        <i class="fas fa-times-circle"></i>
    </div>
<?php endif; ?>






        </div>

        <button type="button" class="edit" onclick="editUserInfo()">تعديل</button>
        <button type="submit" class="save" style="display: none;">حفظ</button>

        <br>
        <?php
if (isset($user_info['email_verified']) && $user_info['email_verified'] == 1): 
    $buttons = [
        ['url' => 'حساب-تداول.php', 'text' => 'فتح حساب تداول'],
        ['url' => 'قناة-التوصيات.php', 'text' => 'اشتراك قناة التوصيات'],
        ['url' => 'كورس-تعليمي.php', 'text' => 'تسجيل كورس تعليمي'],
        ['url' => 'محفظة-استثمارية.php', 'text' => 'افتح محفظة استثمارية']
    ];

    foreach ($buttons as $button): ?>
        <a href="<?= $button['url'] ?>"> 
            <button id="verifiedButton" style=" margin-top:10px;" type="button">
                <?= $button['text'] ?>
            </button>
        </a>
    <?php endforeach; 
endif;
?>



    </form>
    <?php if ($message): ?>
    <div class="message" id="message"><?php echo $message; ?></div>
<?php endif; ?>

<div id="uploader" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeUploader()">&times;</span>
        <h2>رفع الهوية</h2>
        <form id="uploadForm" method="POST" enctype="multipart/form-data">
            <div class="file-upload">
                <label for="idFront" class="custom-file-upload">صورة لجهة الأمامية للهوية</label>
                <input type="file" id="idFront" name="idFront" accept="image/*" required onchange="updateFileName('idFront', 'idFrontFileName')">
                <span id="idFrontFileName" class="file-name"></span>
            </div>

            <div class="file-upload">
                <label for="idBack" class="custom-file-upload">صورة لجهة الخلفية للهوية</label>
                <input type="file" id="idBack" name="idBack" accept="image/*" required onchange="updateFileName('idBack', 'idBackFileName')">
                <span id="idBackFileName" class="file-name"></span>
            </div>

            <div class="file-upload">
                <label for="faceImage" class="custom-file-upload">صورة لوجهك</label>
                <input type="file" id="faceImage" name="faceImage" accept="image/*" required onchange="updateFileName('faceImage', 'faceImageFileName')">
                <span id="faceImageFileName" class="file-name"></span>
            </div>

            <button type="submit">رفع</button>
        </form>
    </div>
</div>
<?php
$stmt = $pdo->prepare("SELECT id_front, id_back, face_image FROM users WHERE id = :user_id");
$stmt->execute(['user_id' => $user_id]);
$uploads = $stmt->fetch();

if ($uploads && $uploads['id_front'] && $uploads['id_back'] && $uploads['face_image']) {
    echo '<style>#uploadBtn { display: none; }</style>';
}
?>

</section>


<script>
function editUserInfo() {
    document.getElementById('name').removeAttribute('readonly');
    document.getElementById('email').removeAttribute('readonly');
    document.getElementById('phone').removeAttribute('readonly');
    document.getElementById('birthday').removeAttribute('readonly');
    document.getElementById('gender').removeAttribute('disabled'); 
    document.querySelector('.save').style.display = 'inline-block';
    document.querySelector('.edit').style.display = 'none';
}
    const messageElement = document.getElementById('message');
    if (messageElement) {
        setTimeout(() => {
            messageElement.style.display = 'none';
        }, 3000);
    }

    const emailVerified = <?php echo isset($user_info['email_verified']) && $user_info['email_verified'] == 1 ? 'true' : 'false'; ?>;
    const verifiedButton = document.getElementById('verifiedButton');

    if (emailVerified && verifiedButton) {
        verifiedButton.style.display = 'inline-block'; 
    }

    function openUploader() {
    document.getElementById('uploader').style.display = 'block';
}

function closeUploader() {
    document.getElementById('uploader').style.display = 'none';
}

document.getElementById('uploadForm').onsubmit = function(event) {
    event.preventDefault();
    
    closeUploader();

};
function updateFileName(inputId, spanId) {
    const input = document.getElementById(inputId);
    const fileNameSpan = document.getElementById(spanId);

    if (input.files.length > 0) {
        const fileName = input.files[0].name;
        fileNameSpan.textContent = `${fileName} تم رفع`;
    } else {
        fileNameSpan.textContent = '';
    }
}

document.getElementById('uploadForm').onsubmit = function(event) {
    event.preventDefault(); 

    const formData = new FormData(this); 
    const xhr = new XMLHttpRequest(); 

    xhr.open("POST", "ملف-الشخصي.php", true); 
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);
                alert(response.message);
            } catch (e) {
                console.error(e);
            }
        } else {
            alert("تم رفع الملفات بنجاح");
        }
        closeUploader(); 
        location.reload(); 
    };

    xhr.send(formData); 
};





</script>

<footer>
    <div class="footer-container">
        <div class="footer-logo">
            <img src="logo.png" alt="تعلم التداول Logo" class="footer-logo-img">
        </div>
        <div class="footer-links">
            <h4>روابط سريعة</h4>
            <ul>
                <li><a href="الرئيسية.php">الرئيسية</a></li>
                <li><a href="جميع-الخدمات.php">الخدمات</a></li>
                <li><a href="من-نحن.php">من نحن</a></li>
                <li><a href="اتصل-بنا.php">اتصل بنا</a></li>
            </ul>
        </div>
        <div class="footer-contact">
            <h4>تواصل معنا</h4>
            <a href="mailto:info@learntrading-tr.com"><p>info@learntrading-tr.com :البريد الإلكتروني</p></a>
            <a href="https://wa.me/+905312921932"><p>الهاتف: 905312921932</p></a>
        </div>
        <div class="footer-social">
            <h4>تابعنا</h4>
            <a href="https://wa.me/+905312921932"><i class="fa-solid fa-phone"></i></a>
            <a href="https://wa.me/+447846502765"><i class="fa-brands fa-whatsapp"></i></a>
            <a href="http://t.me/Learntranding"><i class="fa-brands fa-telegram"></i></a>
            <a href="https://www.facebook.com/profile?id=61561309606508&mibextid=ZbWKwL"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/learntrading.tr?igsh=MWRieTg4bXBvZW9odQ=="><i class="fab fa-instagram"></i></a>
            <a href="https://www.tiktok.com/@learntrading.tr?_t=8pk3PuGU00s&_r=1"><i class="fa-brands fa-tiktok"></i></a>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© 2024 تعلم التداول. جميع الحقوق محفوظة.</p>
    </div>
</footer>
</body>
</html>
