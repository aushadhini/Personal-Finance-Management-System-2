<?php include "connection.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PFMS | Home</title>

  <link rel="stylesheet" href="bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="icon" href="resource/logo.svg" />

  <style>
    body {
      font-family: "Poppins", sans-serif;
      background: linear-gradient(135deg, #f9f0ff, #e3f2ff);
      min-height: 100vh;
      color: #333;
    }

    .navbar {
      background: rgba(255, 255, 255, 0.4);
      backdrop-filter: blur(15px);
      box-shadow: 0 2px 15px rgba(0,0,0,0.05);
      padding: 15px 40px;
      border-radius: 20px;
      margin: 20px;
    }

    .navbar-brand {
      font-weight: 700;
      color: #6a11cb !important;
      font-size: 1.5rem;
    }

    .nav-link {
      color: #333 !important;
      font-weight: 500;
      transition: 0.3s;
    }

    .nav-link:hover {
      color: #6a11cb !important;
    }

    .search-section {
      margin-top: 50px;
      text-align: center;
    }

    .search-box {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 10px;
      margin-top: 20px;
    }

    .form-control, .form-select {
      border-radius: 12px;
      padding: 12px;
      box-shadow: 0 3px 6px rgba(0,0,0,0.05);
    }

    .btn-primary {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      border: none;
      border-radius: 12px;
      padding: 10px 25px;
      font-weight: 600;
      transition: 0.3s;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 10px rgba(106, 17, 203, 0.3);
    }

    .advanced-link {
      color: #6a11cb;
      font-weight: 600;
      text-decoration: none;
      transition: 0.3s;
    }

    .advanced-link:hover {
      text-decoration: underline;
    }

    .carousel-section {
      margin: 60px auto;
      width: 80%;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .category-section {
      margin-top: 80px;
      text-align: center;
    }

    .category-title {
      font-size: 2rem;
      font-weight: 700;
      color: #333;
    }

    .see-all {
      color: #2575fc;
      font-size: 1rem;
      font-weight: 600;
      text-decoration: none;
    }

    footer {
      margin-top: 100px;
      text-align: center;
      color: #777;
      padding-bottom: 30px;
      font-size: 0.9rem;
    }
  </style>
</head>

<body>

  <!-- Header -->
  <nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="#">PFMS</a>
    <div class="ms-auto d-flex gap-3">
      <a href="signIn.php" class="nav-link">Sign In</a>
      <a href="#" class="nav-link">Help</a>
      <a href="#" class="nav-link">Contact</a>
    </div>
  </nav>

  <!-- Search Section -->
  <div class="search-section">
    <h2 class="fw-bold">Search Your Financial Records</h2>
    <div class="search-box">
      <input type="text" class="form-control w-50" placeholder="Search..." id="basic_search_txt">
      <select class="form-select w-auto" id="basic_search_select">
        <option value="0">All Categories</option>
      </select>
      <button class="btn btn-primary" onclick="basicSearch(0);">Search</button>
    </div>
    <div class="mt-3">
      <a href="advancedSearch.php" class="advanced-link">Advanced Search</a>
    </div>
  </div>

  <!-- Carousel -->
  <div class="carousel-section">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="resource/banner1.jpg" class="d-block w-100" alt="banner1">
        </div>
        <div class="carousel-item">
          <img src="resource/banner2.jpg" class="d-block w-100" alt="banner2">
        </div>
        <div class="carousel-item">
          <img src="resource/banner3.jpg" class="d-block w-100" alt="banner3">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  </div>

  <!-- Categories Section -->
  <div class="category-section">
    <div class="category-title">
      <?php echo $category_data2["cat_name"]; ?>
      <a href="#" class="see-all ms-3">See All →</a>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    © <?php echo date("Y"); ?> PFMS | All rights reserved
  </footer>

  <script src="bootstrap.bundle.js"></script>
  <script src="script.js"></script>

</body>
</html>
