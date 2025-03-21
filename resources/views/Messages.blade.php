<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>واجهة المستخدم</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #3b5998; /* اللون الأزرق الخلفي */
      color: white;
    }
    .card {
      background-color: white;
      color: black;
      margin-bottom: 20px;
    }
    .header-section {
      background-color: #333;
      padding: 20px;
      text-align: center;
    }
    .footer {
      background-color: #333;
      color: white;
      padding: 10px;
      text-align: center;
    }
    .profile-pic {
      width: 100px;
      height: 100px;
      border-radius: 50%;
    }
    .emoji {
      font-size: 24px;
    }
    .btn-custom {
      background-color: #ff6b6b;
      color: white;
    }
  </style>
</head>
<body>

  <!-- Header Section -->
  <div class="header-section">
    <img src="profile-picture.jpg" alt="Profile" class="profile-pic">
    <h3>yousef reda</h3>
    <p>0 منشورات | 0 أصدقاء | 0 نتائج</p>
  </div>

  <!-- Main Section -->
  <div class="container my-5">
    <!-- First Card -->
    <div class="card p-3">
      <h5 class="card-title">قم بمتابعة الأشخاص على صارحني</h5>
      <p class="card-text">قم بمتابعة الأشخاص على صارحني لرؤية رسائلهم التي يرغبون في عرضها العامة هنا.</p>
    </div>

    <!-- Second Card -->
    <div class="card p-3">
      <h5 class="card-title">أشخاص قد تعرفهم</h5>
      <p class="card-text">لا توجد اقتراحات في الوقت الحالي.</p>
    </div>

    <!-- Emoji Section -->
    <div class="card p-3 text-center">
      <textarea class="form-control mb-3" rows="3" placeholder="اكتب رسالتك هنا..."></textarea>
      <div class="d-flex justify-content-around mb-3">
        <span class="emoji">😊</span>
        <span class="emoji">😂</span>
        <span class="emoji">😢</span>
        <span class="emoji">❤️</span>
      </div>
      <button class="btn btn-custom">إرسال الآن</button>
    </div>
  </div>

  <!-- Footer Section -->
  <div class="footer">
    <p>جميع الحقوق محفوظة © 2024</p>
    <div>
      <a href="#" class="text-white mx-2">Facebook</a>
      <a href="#" class="text-white mx-2">Twitter</a>
      <a href="#" class="text-white mx-2">Instagram</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
