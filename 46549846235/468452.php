<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "127.0.0.1"; 
$username = "root";
$password = "";
$dbname = "database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];

        if (isset($_POST['reason'])) {
            $reason = $_POST['reason'];
            $update_sql = "UPDATE users SET denial_reason = ? WHERE id = ?";
            $stmt = $conn->prepare($update_sql);
            
            if ($stmt) {
                $stmt->bind_param("si", $reason, $user_id);
                if ($stmt->execute()) {
                } else {
                    echo "خطأ في تنفيذ الاستعلام: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "خطأ في إعداد العبارة: " . $conn->error;
            }
        } else {
            $update_sql = "UPDATE users SET email_verified = 1 WHERE id = ?";
            $stmt = $conn->prepare($update_sql);
            
            if ($stmt) {
                $stmt->bind_param("i", $user_id);
                if ($stmt->execute()) {
                } else {
                    echo "خطأ في تنفيذ الاستعلام: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "خطأ في إعداد العبارة: " . $conn->error;
            }
        }
    }

    header("Location: 468452.php");
    exit;
}

$result = $conn->query("SELECT * FROM users WHERE email_verified = 0 AND denial_reason IS NULL");
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الإدارة - تعلم التداول</title>
    <link rel="stylesheet" href="Admin.css">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://kit.fontawesome.com/6676f53229.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="logo-container">
        <a href="https://learntrading-tr.com" target="_blank">
            <img src="logo.png" alt="الشعار" class="logo-image">
        </a>
    </div>
    <h1 id="greeting" class="head">أهلاً بعودتك أحمد حسان</h1>
    <div class="users">
        <div class="user-container">
        <?php
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row["name"] ?? "غير متوفر";
        $phone_number = $row["phone"] ?? "غير متوفر";
        $country_code = $row["country_code"] ?? "غير متوفر";
        $birthday = $row["birthday"] ?? "غير متوفر";
        $gender = $row["gender"] ?? "غير متوفر";

        $id_front_blob = $row["id_front"];
        $id_back_blob = $row["id_back"];
        $face_image_blob = $row["face_image"];

        $id_front_base64 = !is_null($id_front_blob) ? base64_encode($id_front_blob) : null;
        $id_back_base64 = !is_null($id_back_blob) ? base64_encode($id_back_blob) : null;
        $face_image_base64 = !is_null($face_image_blob) ? base64_encode($face_image_blob) : null;

        echo "<div class='user-card'>";
        echo "<div class='user-info'>";
        echo "$name الاسم <br>";
        echo $row["email"] . " البريد الإلكتروني <br>";
        echo "$country_code $phone_number الهاتف <br>";
        echo "تاريخ الميلاد $birthday <br>";
        echo "الجنس $gender <br>";

        if ($face_image_base64) {
            echo "<img src='data:image/jpeg;base64,$face_image_base64' alt='صورة الوجه' class='user-image'><br>";
        } else {
            echo "<span>لا توجد صورة للوجه متاحة</span><br>";
        }

        if ($id_front_base64) {
            echo "<strong>واجهة الهوية:</strong> <img src='data:image/jpeg;base64,$id_front_base64' alt='واجهة الهوية' class='user-image'><br>";
        } else {
            echo "<span>لا توجد صورة لواجهة الهوية</span><br>";
        }

        if ($id_back_base64) {
            echo "<strong>خلفية الهوية:</strong> <img src='data:image/jpeg;base64,$id_back_base64' alt='خلفية الهوية' class='user-image'><br>";
        } else {
            echo "<span>لا توجد صورة لخلفية الهوية</span><br>";
        }

        echo "</div>";
        echo "<div class='user-buttons'>";
        echo "<form method='POST' action=''>";
        echo "<input type='hidden' name='user_id' value='" . $row['id'] . "'>";
        echo "<button class='accept-button' type='submit'>قبول</button>";
        echo "</form>";
        echo "<button class='decline-button' onclick='showModal(\"" . $row['id'] . "\")'>رفض</button>";
        echo "</div>";
        echo "</div>";
    }

            } else {
                echo "<div class='no-users-message'>لا توجد مستخدمون غير موثوقين.</div>";
            }
            ?>
        </div>
    </div>

    <div id="declineModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>اختر سبب الرفض</h2>
            <form id="declineForm" method="POST" action="">
                <input type="hidden" name="user_id" id="modalUserId">
                <select name="reason" required>
                    <option value="">اختر سببًا...</option>
                    <option value="معلومات غير مكتملة">معلومات غير مكتملة</option>
                    <option value="حساب مكرر">حساب مكرر</option>
                    <option value="الأقل من 18 عامًا">الأقل من 18 عامًا</option>
                </select>
                <button type="submit">إرسال</button>
            </form>
        </div>
    </div>

    <script>
        function hideHeading() {
            setTimeout(function() {
                const heading = document.getElementById('greeting');
                heading.classList.add('hidden');
            }, 2000);
        }

        window.onload = hideHeading;

        function showModal(userId) {
            document.getElementById('modalUserId').value = userId; 
            document.getElementById('declineModal').style.display = "block"; 
        }

        function closeModal() {
            document.getElementById('declineModal').style.display = "none"; 
        }

        window.onclick = function(event) {
            const modal = document.getElementById('declineModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
    <script src="Admin.js"></script>
</body>
</html>

<?php
$conn->close();
?>
