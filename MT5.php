<?php
session_start();
include 'All.php';
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعلم التداول</title>
    <link rel="stylesheet" href="styl.css">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://kit.fontawesome.com/6676f53229.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

<header>
    <a href="الرئيسية.php ">
        <img src="logo.png" alt="Logo" class="logo">
    </a>
    <div class="sps">
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="ملف-الشخصي.php">الملف الشخصي <i class="fas fa-user"></i></a>
    <?php else: ?>
    </div>
    <div class="spsn">
        <a href="تسجيل-الدخول.php" data-toggle="modal" data-target="#loginModal">تسجيل الدخول <i class="fas fa-sign-in-alt"></i></a>
    <?php endif; ?>
</div>



    <div id="signinModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="signin-box">
                <h2>تسجيل الدخول</h2>
                <form id="signinForm" action="" method="post">
                    <div class="input-box">
                        <input type="email" name="email" required>
                        <label>البريد الإلكتروني</label>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" required>
                        <label>كلمة المرور</label>
                    </div>
                    <button type="submit" name="signin">تسجيل الدخول</button>
                </form>
                <p>ليس لديك حساب؟ <a href="#" id="switchToSignup">اشترك الآن</a></p>
                <hr class="divider">
                <div class="social-login">
                    <p>أو سجل الدخول باستخدام</p>
                    <a href="#" class="google-btn"><i class="fab fa-google"></i></a>
                    <a href="#" class="apple-btn"><i class="fab fa-apple"></i></a>
                </div>
            </div>


            <div class="signup-box" style="display: none;">
                <h2>اشترك الآن</h2>
                <form id="signupForm" action="" method="post">
                    <div class="input-box">
                        <input type="text" name="name" required>
                        <label>الاسم الكامل</label>
                    </div>
                    <div class="input-box">
                        <div class="phone-input">
                            <select name="country_code" id="countryCode" required>
    <option value="+93">أفغانستان (+93)</option>
    <option value="+355">ألبانيا (+355)</option>
    <option value="+213">الجزائر (+213)</option>
    <option value="+1">الولايات المتحدة (+1)</option>
    <option value="+376">أندورا (+376)</option>
    <option value="+244">أنغولا (+244)</option>
    <option value="+1">أنغويلا (+1)</option>
    <option value="+672">أنتاركتيكا (+672)</option>
    <option value="+1">أنتيغوا وبربودا (+1)</option>
    <option value="+54">الأرجنتين (+54)</option>
    <option value="+374">أرمينيا (+374)</option>
    <option value="+297">أروبا (+297)</option>
    <option value="+61">أستراليا (+61)</option>
    <option value="+43">النمسا (+43)</option>
    <option value="+994">أذربيجان (+994)</option>
    <option value="+1">باهاماس (+1)</option>
    <option value="+973">البحرين (+973)</option>
    <option value="+880">بنغلاديش (+880)</option>
    <option value="+1">باربادوس (+1)</option>
    <option value="+32">بلجيكا (+32)</option>
    <option value="+501">بليز (+501)</option>
    <option value="+229">بنين (+229)</option>
    <option value="+1">برمودا (+1)</option>
    <option value="+975">بوتان (+975)</option>
    <option value="+591">بوليفيا (+591)</option>
    <option value="+387">البوسنة والهرسك (+387)</option>
    <option value="+267">بوتسوانا (+267)</option>
    <option value="+55">البرازيل (+55)</option>
    <option value="+246">الأقاليم البريطانية في المحيط الهندي (+246)</option>
    <option value="+1">بروناي (+1)</option>
    <option value="+359">بلغاريا (+359)</option>
    <option value="+226">بوركينا فاسو (+226)</option>
    <option value="+257">بوروندي (+257)</option>
    <option value="+855">كمبوديا (+855)</option>
    <option value="+237">الكاميرون (+237)</option>
    <option value="+1">كندا (+1)</option>
    <option value="+238">الرأس الأخضر (+238)</option>
    <option value="+345">جزر كايمان (+345)</option>
    <option value="+236">جمهورية أفريقيا الوسطى (+236)</option>
    <option value="+61">أستراليا (+61)</option>
    <option value="+56">تشيلي (+56)</option>
    <option value="+86">الصين (+86)</option>
    <option value="+61">جزيرة كوك (+61)</option>
    <option value="+57">كولومبيا (+57)</option>
    <option value="+269">جزر القمر (+269)</option>
    <option value="+242">جمهورية الكونغو (+242)</option>
    <option value="+243">جمهورية الكونغو الديمقراطية (+243)</option>
    <option value="+225">كوت ديفوار (+225)</option>
    <option value="+385">كرواتيا (+385)</option>
    <option value="+53">كوبا (+53)</option>
    <option value="+357">قبرص (+357)</option>
    <option value="+420">التشيك (+420)</option>
    <option value="+45">الدنمارك (+45)</option>
    <option value="+253">جيبوتي (+253)</option>
    <option value="+1767">دومينيكا (+1767)</option>
    <option value="+1">جمهورية الدومينيكان (+1)</option>
    <option value="+593">الإكوادور (+593)</option>
    <option value="+20">مصر (+20)</option>
    <option value="+503">السلفادور (+503)</option>
    <option value="+240">غينيا الاستوائية (+240)</option>
    <option value="+291">إريتريا (+291)</option>
    <option value="+372">إستونيا (+372)</option>
    <option value="+251">إثيوبيا (+251)</option>
    <option value="+500">جزر فوكلاند (+500)</option>
    <option value="+298">فاروه (+298)</option>
    <option value="+679">فيجي (+679)</option>
    <option value="+358">فنلندا (+358)</option>
    <option value="+33">فرنسا (+33)</option>
    <option value="+241">الغابون (+241)</option>
    <option value="+220">غامبيا (+220)</option>
    <option value="+995">جورجيا (+995)</option>
    <option value="+49">ألمانيا (+49)</option>
    <option value="+233">غانا (+233)</option>
    <option value="+350">جبل طارق (+350)</option>
    <option value="+30">اليونان (+30)</option>
    <option value="+299">غرينلاند (+299)</option>
    <option value="+1473">غرينادا (+1473)</option>
    <option value="+1">غوام (+1)</option>
    <option value="+502">غواتيمالا (+502)</option>
    <option value="+224">غينيا (+224)</option>
    <option value="+245">غينيا بيساو (+245)</option>
    <option value="+592">غويانا (+592)</option>
    <option value="+509">هايتي (+509)</option>
    <option value="+504">هندوراس (+504)</option>
    <option value="+36">هنغاريا (+36)</option>
    <option value="+354">أيسلندا (+354)</option>
    <option value="+91">الهند (+91)</option>
    <option value="+62">إندونيسيا (+62)</option>
    <option value="+98">إيران (+98)</option>
    <option value="+964">العراق (+964)</option>
    <option value="+353">أيرلندا (+353)</option>
    <option value="+972">إسرائيل (+972)</option>
    <option value="+39">إيطاليا (+39)</option>
    <option value="+1876">جامايكا (+1876)</option>
    <option value="+81">اليابان (+81)</option>
    <option value="+962">الأردن (+962)</option>
    <option value="+7">كازاخستان (+7)</option>
    <option value="+254">كينيا (+254)</option>
    <option value="+996">قرغيزستان (+996)</option>
    <option value="+686">كيريباتي (+686)</option>
    <option value="+383">كوسوفو (+383)</option>
    <option value="+965">الكويت (+965)</option>
    <option value="+996">قرغيزستان (+996)</option>
    <option value="+856">لاوس (+856)</option>
    <option value="+371">لاتفيا (+371)</option>
    <option value="+961">لبنان (+961)</option>
    <option value="+266">ليسوتو (+266)</option>
    <option value="+352">لوكسمبورغ (+352)</option>
    <option value="+853">ماكاو (+853)</option>
    <option value="+389">مقدونيا (+389)</option>
    <option value="+261">مدغشقر (+261)</option>
    <option value="+265">مالاوي (+265)</option>
    <option value="+60">ماليزيا (+60)</option>
    <option value="+960">مالديف (+960)</option>
    <option value="+223">مالي (+223)</option>
    <option value="+356">مالطا (+356)</option>
    <option value="+692">جزر مارشال (+692)</option>
    <option value="+596">مارتينيك (+596)</option>
    <option value="+222">موريتانيا (+222)</option>
    <option value="+230">موريشيوس (+230)</option>
    <option value="+52">المكسيك (+52)</option>
    <option value="+691">ميكرونيزيا (+691)</option>
    <option value="+373">مولدافيا (+373)</option>
    <option value="+377">موناكو (+377)</option>
    <option value="+976">منغوليا (+976)</option>
    <option value="+1">مونتسيرات (+1)</option>
    <option value="+212">المغرب (+212)</option>
    <option value="+258">موزمبيق (+258)</option>
    <option value="+95">ميانمار (+95)</option>
    </select>
                            <input type="tel" name="phone" required placeholder="رقم الهاتف" pattern="[0-9]*" inputmode="numeric">
                        </div>
                        <label>رقم الهاتف</label>
                    </div>
                    <div class="input-box">
                        <input type="email" name="email" required>
                        <label>البريد الإلكتروني</label>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" required>
                        <label>كلمة المرور</label>
                    </div>
                    <button type="submit" name="signup">اشترك</button>
                </form>
                <p>لديك حساب؟ <a href="#" id="switchToSignin">تسجيل الدخول</a></p>
            </div>
        </div>
    </div>

    <div class="nav">
        <a href="الرئيسية.php ">الرئيسية</a>

        <div class="nav-item">
            <a href="جميع-الخدمات.php">الخدمات</a>
            <div class="dropdown">
                <a href="جميع-الخدمات.php ">جميع الخدمات</a>
                <a href="دروس-التدريبية.php">دروس تدريبية</a>
                <a href="توصيات-تداول.php">توصيات تداول</a>
                <a href="فتح-حساب-تداول.php">فتح حساب تداول</a>
                <a href="الاستثمار-وإدارة-المحافظ.php">الاستثمار وإدارة المحافظ</a>
            </div>
        </div>

        <div class="nav-item">
            <a href="منصات-التداول.php">منصات التداول</a>
            <div class="dropdown">
                <a href="MT4.php ">MT4</a>
                <a href="MT5.php ">MT5</a>
            </div>
        </div>

        <a href="بنك-المعلومات.php">بنك المعلومات</a>
        <a href="من-نحن.php">من نحن</a>
        <a href="اتصل-بنا.php">اتصل بنا</a>
    </div>
</header>

<div class="MTA-container">
<img src="https://upload.wikimedia.org/wikipedia/commons/2/27/MetaTrader_5.png" alt="MT5">
    <h2>MetaTrader 5</h2>
    <p>مع تطور الأسواق المالية، يزداد الطلب على المنصات التي توفر أدوات وميزات أكثر تقدماً وقوة. هنا يأتي دور منصة MetaTrader 5 (MT5)، التي طورتها MetaQuotes Software كخلف للمنصة الشهيرة MetaTrader 4 (MT4). لكن ما هي الفروقات بين MT4 وMT5؟ ولماذا يمكن أن يفضل بعض المتداولين استخدام MT5 على MT4؟</p>
    
    <h3>MT5 ما هو</h3>
    <p>MT5 هو برنامج تداول عبر الإنترنت ومنصة تحليل مالي تتيح للمستخدمين تداول الأسهم، العقود الآجلة، والفوركس، بالإضافة إلى العديد من أدوات الأسواق الأخرى. تم تطوير MT5 ليكون أكثر مرونة وقوة من MT4، مع ميزات جديدة تساعد المتداولين على تحقيق أفضل النتائج.</p>
    
    <h3>MT4 و MT5 الفروقات بين</h3>
    <p>في حين أن MT4 و MT5 يشتركان في العديد من الميزات، هناك بعض الاختلافات الهامة تجعل كل منصة فريدة:</p>
    
    <h3>الأسواق</h3>
    <p>ربما تكون هذه هي الفروق الأكبر بين الاثنين. بينما تتركز MT4 أساسًا على تداول الفوركس، توفر MT5 القدرة على تداول الأسواق الأخرى، مثل الأسهم والعقود الآجلة، بالإضافة إلى الفوركس.</p>
    
    <h3>أدوات التحليل</h3>
    <p>يوفر MT5 مجموعة أكبر من الأدوات التحليلية مقارنة بـ MT4. يضم MT5 أكثر من 38 مؤشرًا تقنيًا و44 أداة رسم بياني، بالمقارنة مع 30 مؤشرًا تقنيًا و31 أداة رسم بياني في MT4.</p>
    
    <h3>التداول الآلي</h3>
    <p>كلا المنصتين يتيحان التداول الآلي باستخدام الروبوتات التجارية. ولكن، MT5 يستخدم لغة MQL5، والتي هي أكثر تقدماً ومرونة من لغة MQL4 المستخدمة في MT4.</p>
    
    <h3>فترات الزمنية</h3>
    <p>تتيح MT5 للمتداولين استخدام حتى 21 فترة زمنية مختلفة، بالمقارنة مع 9 فترات زمنية في MT4. هذا يمكن أن يوفر للمتداولين نظرة أكثر دقة ومرونة على الأسواق.</p>
    
    <h3>في الختام</h3>
    <p>يمكن القول أن MT5 هي تطور طبيعي لـ MT4، تم تطويره لتلبية احتياجات الأسواق المالية المتطورة والمتداولين الأكثر تطوراً. حتى أنها تحافظ على العديد من الميزات التي جعلت MT4 ناجحًا، مثل الاستخدام السهل والتداول الآلي، بينما تضيف ميزات جديدة تعزز القدرات التحليلية والتنفيذية للمتداولين.</p>
</div>




<footer>
    <div class="footer-container">
        <div class="footer-logo">
            <img src="logo.png" alt="تعلم التداول Logo" class="footer-logo-img">
        </div>
        <div class="footer-links">
            <h4>روابط سريعة</h4>
            <ul>
                <li><a href="الرئيسية.php ">الرئيسية</a></li>
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
            <a href="https://www.facebook.com/profile ?id=61561309606508&mibextid=ZbWKwL"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/learntrading.tr?igsh=MWRieTg4bXBvZW9odQ=="><i class="fab fa-instagram"></i></a>
            <a href="https://www.tiktok.com/@learntrading.tr?_t=8pk3PuGU00s&_r=1"><i class="fa-brands fa-tiktok"></i></a>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© 2024 تعلم التداول. جميع الحقوق محفوظة.</p>
    </div>
</footer>

<script>
    function handleSignIn() {

    if (<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>) {
        const signinBtn = document.getElementById("signinBtn");

       
        signinBtn.innerHTML = 'الملف الشخصي <i class="fas fa-user"></i>';
        signinBtn.setAttribute("href", "ملف-الشخصي.php"); 
    }
}

window.onload = function() {
    handleSignIn(); 
};

function openSigninModal() {
            const modal = document.getElementById('signinModal');
            modal.style.display = 'block';
        }
</script>
<script src="scrip.js"></script>
</body>
</html>
