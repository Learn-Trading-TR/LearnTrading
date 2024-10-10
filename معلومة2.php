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
<div class="BMA-container">
<img src="https://www.forextraders.com/wp-content/uploads/2016/11/Forex-Market-Participants.jpg">
    <h2>سوق تداول العملات هو أكبر سوق مالي في العالم</h2>
    <p>تحتوي على 190 عملة مختلفة. 85٪ من جميع تداولات العملات الأجنبية تتم على 7 أزواج عملات فقط - EURUSD ، USDJPY ، GBPUSD ، AUDUSD ، NZDUSD ، USDCAD ، USDCHF. 90٪ من جميع معاملات سوق الفوركس تشمل الدولار الأمريكي. 66٪ من العملة الأمريكية محتفظ بها في الخارج من قبل أفراد وحكومات ومؤسسات أجنبية. يتم إجراء 41٪ من جميع معاملات الفوركس في المملكة المتحدة. 44% من متداولي الفوركس أعمارهم بين 25-34 سنة. السوق غير منظم حيث يتم تنظيم سوق الصرف الأجنبي من خلال الطلب والعرض العالميين للعملة التي تتداول بها. يمكن لأي شخص لديه اتصال بالإنترنت أن يقوم بتداول العملات الأجنبية. معظم عمليات تداول الفوركس تتم بواسطة الأفراد فقط.</p>
    
    <h3>حقائق أخرى عن الفوركس</h3>
    <p>أدى العدد الكبير من المشاركة في تداول العملات الأجنبية إلى العديد من الأساطير حول تداول الفوركس في الماضي. إنه يجعل من السهل الدخول ولكن لكي تكون ناجحًا يجب أن تتقن حيل التجارة. تحتاج إلى القيام بتداول الفوركس بمساعدة وسيط. لا يمكنك فعل ذلك بدونهم. ومع ذلك ، فإن جميع الوسطاء ليسوا متماثلين. كل واحد مختلف وله مصداقيته. يجب عليك اختيار وسيط بناءً على سمعته وما إذا كان يمكنك التعامل معه. لقد ناقشنا كيف يمكنك اختيار وسيط موثوق به في مقالاتنا السابقة. سوف يتقاضى السماسرة منك سمسرة. يجب أن ترى الأنظمة الأساسية التي يقدمها الوسيط وكذلك الخدمات.</p>
    
    <h3>استراتيجيات التداول</h3>
    <p>أفضل الاستراتيجيات في تداول العملات الأجنبية هي استراتيجيات بسيطة. عليك أن تحصل على الإستراتيجية التي تناسبك أكثر وتستخدمها لكسب المال. سوف تصادف الكثير من المصطلحات والاستراتيجيات بينما تتعلم تداول العملات الأجنبية. الإستراتيجية البسيطة هي تلك التي يمكنك شرحها لطالب ثانوي. إذا لم يفهم الطالب الإستراتيجية فستكون استراتيجية سيئة. يجب ألا تحاول أبدًا المبالغة في التجارة. التداول المفرط سيؤدي بالتأكيد إلى الفشل. يحاول معظم المتداولين الجدد الإفراط في التداول في الإثارة. هذا خطأ جدا ويجب تجنبه. يرى بعض المتداولين الجدد الأموال التي يكسبونها ويشعرون أن كل دقيقة يقضونها بعيدًا عن سوق الفوركس هي فرصة ضائعة. حسنًا ، هذا ليس كذلك. لذلك إذا حاولت المبالغة في التجارة فإن فرصك في تحقيق المزيد من الخسائر ستزداد فقط. فقط تداول بقدر ما تستطيع.</p>

    <h3>تاريخ الفوركس</h3>
    <p>إذا نظرت إلى تاريخ تداول الفوركس ، ستلاحظ أن المتداولين الذين يضاعفون المكاسب الصغيرة يبقون لفترة أطول في تداول الفوركس. حلل السوق ولا تنظر إلى المكاسب الضخمة على الفور. حقق مكاسب صغيرة وقم بزيادة رقم الكسب ببطء. يجب استثمار هذه المكاسب الصغيرة في تداول العملات الأجنبية عبر الإنترنت وستتمكن ببطء من رؤية الأرباح التي تحققها. سيضمن ذلك أنك تخسر أقل وستحصل على استراتيجيتك بشكل صحيح. سيعطيك هذا أيضًا فرصة جيدة لفهم سوق الفوركس. عندما تبدأ تداول الفوركس ، تأكد من أن لديك وظيفة في متناول اليد. كلما أصبحت أكثر ثقة في تداول العملات الأجنبية ، يمكنك ترك وظيفتك والبدء في تداول الفوركس كمهنة رئيسية.</p>

    <h3>دور البنوك في الفوركس</h3>
    <p>تلعب البنوك الدور الأكثر أهمية في تداول العملات الأجنبية. يفعلون حوالي سبعين بالمائة من تداول العملات الأجنبية في يوم واحد. يمتلك دويتشه بنك 14٪ من حصة سوق تداول العملات الأجنبية. ويلي ذلك سيتي بنك وباركليز. تستخدم البنوك أموال عملائها لغرض تداول العملات الأجنبية.</p>

    <h3>أهم بلدين في تداول الفوركس</h3>
    <p>ما يقرب من خمسين في المائة من تداول العملات الأجنبية العالمي يحدث في بلدين. إنه سوق عالمي ويمكن للمستثمرين من أي جزء من العالم الاستثمار في تداول العملات الأجنبية. ومع ذلك ، فإن المملكة المتحدة هي الدولة التي يحدث فيها خمسة وثلاثون بالمائة من تجارة الفوركس العالمية. تمتلك الولايات المتحدة الأمريكية ستة عشر في المائة من تجارة الفوركس العالمية والباقي من الأسهم العالمية فقط خمسون في المائة من تجارة الفوركس العالمية. يعتقد الخبراء أنه مع اكتساب المزيد والمزيد من الناس الوعي حول تداول الفوركس ، قد يتغير السيناريو قريبًا وقد نرى بعض اللاعبين العالميين في سوق تداول العملات الأجنبية.</p>

    <h3>صفات المتداول الناجح</h3>
    <p>يجب أن تتساءل عما يتطلبه النجاح في تداول الفوركس. حسنًا ، إن الانضباط هو بلا شك أكبر سمة لمتداول فوركس. عليك التحلي بالهدوء وفهم نبض السوق. سوف يستغرق الأمر ما يقرب من عام لإتقان مهارات تداول العملات الأجنبية. هذا كل ما هو مطلوب. لا تتسرع وتداول ببطء. لا بأس إذا كنت تحقق أرباحًا صغيرة. إنه أفضل بكثير من تكبد خسائر فادحة. تأكد دائمًا من تدوين كل ما تتعلمه. اقرأ بقدر ما تستطيع عن تداول العملات الأجنبية. قم بعمل دفتر يوميات يسجل فيه جميع الصفقات التي قمت بها. ستكون هذه المجلة مفيدة للغاية في معرفة المزيد عن تداول الفوركس.</p>

    <h3>حقائق مثيرة للاهتمام حول تداول الفوركس</h3>
    <p>آخر ما ورد في قائمة الحقائق المثيرة للاهتمام حول تداول العملات الأجنبية هو أنه بلا شك أكبر سوق. يتم تداول حوالي أربعة تريليونات دولار أمريكي من العملات في السوق على أساس يومي. سيساعدك هذا على فهم مدى ضخامة سوق تداول العملات الأجنبية في الواقع وإمكاناته لكسب المال. حوالي أربعين في المائة من هذه تأتي من مقايضات الفوركس. خمسة وعشرون في المئة تأتي من التداول الفوري. خمسة عشر بالمائة تأتي من معاملات التجار وعشرة بالمئة من المعاملات الآجلة. حوالي خمسة بالمئة من تداول العملات الأجنبية يأتي من الفجوات.</p>
    
    <p>نأمل أن تكون قد وجدت هذه المقالة حول الحقائق المثيرة للاهتمام حول تداول الفوركس ستساعدك على فهم مفهوم تداول العملات الأجنبية بشكل أفضل. هذه بعض الحقائق التي اعتقدنا أنه يجب أن نشاركها مع القراء. سوف يساعدونك على فهم الحجم والمخاطر المرتبطة بتداول الفوركس بشكل أفضل.</p>
</div>

<div class="BM-container">
   <div class="BM-box">
            <img src="https://www.forextraders.com/wp-content/uploads/2023/01/How-to-Use-Futures-Open-Interest-in-Forex-Trading.jpg">
            <p>أهم مصطلحات الفوركس</p>
            <span>فيما يلي المصطلحات الأكثر شيوعاً في عالم التحليل الاقتصادي، حيث يستخدمها العديد</span>
            <a href="معلومة3.php">المزيد من التفاصيل</a>
        </div>    <div class="BM-box">
            <img src="https://static.vecteezy.com/system/resources/thumbnails/014/174/645/small_2x/finance-and-business-investment-concept-stock-and-crypto-investment-funds-businessman-analyzing-or-trading-forex-graphs-of-financial-data-candlestick-chart-photo.jpg">
            <p>أهم فوائد الفوركس الرئيسية</p>
            <span>سنتطرق إلى فوائد الفوركس لكل من يفكر في التداول. فهذا السوق هو الأكثر سيولة</span>
            <a href="معلومة4.php">المزيد من التفاصيل</a>
        </div>
        <div class="BM-box">
            <img src="https://www.forex.academy/wp-content/uploads/2019/10/The-Forex-Markets.jpg">
            <p>ما هو الفوركس وكيف يعمل؟</p>
            <span>هل أنت مهتم بمعرفة ما هو الفوركس؟ الفوركس هو تداول العملات الأجنبية</span>
            <a href="معلومة5.php">المزيد من التفاصيل</a>
    </div>
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
