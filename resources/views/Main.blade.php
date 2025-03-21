<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة مشابهة لـ صارحني</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #343a40;
            color: #ffffff;
        }
        .profile-header {
            background-color: #495057;
            padding: 2rem;
            text-align: center;
            color: white;
        }
        .profile-header h2 {
            margin-top: 1rem;
        }
        .content-section {
            background-color: #1e3d73;
            padding: 2rem;
        }
        .card {
            margin-bottom: 1rem;
            background-color: #f8f9fa;
            border: none;
            border-radius: 15px;
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        .footer a {
            color: #ffffff;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">صارحني</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">الإشعارات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">الرسائل</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">الإعدادات</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Profile Section -->
    <section class="profile-header">
        <img src="profile_image_placeholder.png" alt="User Profile" class="rounded-circle" width="100">
        <h2>yousef reda</h2>
        <div class="row mt-3">
            <div class="col">
                <p>0<br><small>المنشورات</small></p>
            </div>
            <div class="col">
                <p>0<br><small>متابعون</small></p>
            </div>
            <div class="col">
                <p>0<br><small>نتائج</small></p>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="content-section">
        <div class="container">
            <div class="card p-3 text-center">
                <p>قم بمتابعة الأشخاص على صارحني لرؤية الرسائل التي يتركون في عرضها العامة هنا.</p>
            </div>
            <div class="card p-3 text-center">
                <p>لا توجد اقتراحات في الوقت الحالي.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>المساعدة - القوانين - اتصل بنا - المدونة - البحث</p>
        <p>&copy; جميع الحقوق محفوظة 2024</p>
        <div>
            <a href="#"><img src="facebook_icon_placeholder.png" alt="Facebook" width="30"></a>
            <a href="#"><img src="twitter_icon_placeholder.png" alt="Twitter" width="30"></a>
            <a href="#"><img src="instagram_icon_placeholder.png" alt="Instagram" width="30"></a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
