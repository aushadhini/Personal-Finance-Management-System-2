<?php
session_start();

// Temporary sample data (replace this with DB query later)
$categories = [
    ["id"=>1, "name"=>"Salary", "type"=>"Income"],
    ["id"=>2, "name"=>"Food", "type"=>"Expense"],
    ["id"=>3, "name"=>"Transport", "type"=>"Expense"],
    ["id"=>4, "name"=>"Freelance", "type"=>"Income"],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PFMS</title>
  <link rel="icon" href="logo.jpeg" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      display: flex;
      margin: 0;
      background: linear-gradient(135deg, #eef2f3, #dfe9f3);
    }

    /* Sidebar */
    .sidebar {
      width: 250px;
      background: linear-gradient(180deg, #6a11cb, #2575fc);
      color: white;
      height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding-top: 30px;
      position: fixed;
      top: 0;
      left: 0;
      box-shadow: 4px 0 15px rgba(0,0,0,0.15);
      border-radius: 0 20px 20px 0;
    }

    .logo {
      display: flex;
      align-items: center;
      margin-bottom: 40px;
    }

    .logo img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      margin-right: 10px;
      border: 2px solid white;
    }

    .logo-text {
      font-size: 20px;
      font-weight: 600;
    }

    .nav-links {
      list-style: none;
      padding: 0;
      width: 100%;
      margin-top: 20px;
    }

    .nav-links li a {
      display: block;
      padding: 15px 30px;
      color: rgba(255,255,255,0.9);
      text-decoration: none;
      font-weight: 500;
      transition: 0.3s;
      border-left: 4px solid transparent;
    }

    .nav-links li a:hover,
    .nav-links li a.active {
      background: rgba(255,255,255,0.15);
      border-left: 4px solid #fff;
      color: #fff;
      backdrop-filter: blur(5px);
    }

    /* Main Content */
    .main-content {
      margin-left: 270px;
      padding: 40px;
      width: 100%;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }

    .header h2 {
      font-weight: 600;
      color: #2d3436;
    }

    .btn-add {
      background: linear-gradient(90deg, #00b894, #019fef);
      border: none;
      color: white;
      font-weight: 500;
      border-radius: 12px;
      padding: 10px 25px;
      transition: all 0.3s ease;
    }

    .btn-add:hover {
      transform: translateY(-2px);
      background: linear-gradient(90deg, #01a17d, #1280df);
    }

    /* Table Styling */
    table {
      width: 100%;
      background: rgba(255,255,255,0.5);
      backdrop-filter: blur(10px);
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    th {
      background: #2575fc;
      color: #fff;
      padding: 15px;
      font-weight: 600;
    }

    td {
      padding: 14px;
      color: #333;
      font-weight: 500;
    }

    tr:nth-child(even) {
      background-color: rgba(255,255,255,0.4);
    }

    tr:hover {
      background-color: rgba(37,117,252,0.1);
    }

    .action-btn {
      border: none;
      padding: 6px 14px;
      border-radius: 8px;
      font-size: 14px;
      cursor: pointer;
      color: #fff;
      transition: 0.3s;
    }

    .btn-edit {
      background-color: #00b894;
    }
    .btn-edit:hover {
      background-color: #019f7f;
    }
    .btn-delete {
      background-color: #ff4757;
    }
    .btn-delete:hover {
      background-color: #e84118;
    }

    /* Modal Styling */
    .modal-content {
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.15);
      border: none;
    }

    .modal-header {
      background: linear-gradient(90deg, #2575fc, #6a11cb);
      color: white;
      border-bottom: none;
    }

    .modal-footer {
      border-top: none;
    }

    @media (max-width: 768px) {
      .main-content {
        margin-left: 0;
        padding: 25px;
      }
      .sidebar {
        position: relative;
        width: 100%;
        height: auto;
        border-radius: 0;
        box-shadow: none;
      }
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="logo">
      <img src="logo.jpeg" alt="Logo">
      <span class="logo-text">PFMS</span>
    </div>
    <ul class="nav-links">
      <li><a href="dashboard.php">Dashboard</a></li>
      <li><a href="home.php">Home</a></li>
      <li><a href="categories.php" class="active">Categories</a></li>
      <li><a href="accounts.php">Accounts</a></li>
      <li><a href="transactions.php">Transactions</a></li>
      <li><a href="reports.php">Reports</a></li>
      <li><a href="sync.php">Backup</a></li>
      <li><a href="profile.php">Profile</a></li>
    </ul>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <div class="header">
      <h2>Manage Categories</h2>
      <button class="btn-add" data-bs-toggle="modal" data-bs-target="#addCategoryModal">➕ Add New Category</button>
    </div>

    <table class="table table-borderless align-middle">
      <thead>
        <tr>
          <th>ID</th>
          <th>Category Name</th>
          <th>Type</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($categories as $cat): ?>
          <tr>
            <td><?= $cat['id']; ?></td>
            <td><?= htmlspecialchars($cat['name']); ?></td>
            <td><?= $cat['type']; ?></td>
            <td>
              <button class="action-btn btn-edit" data-bs-toggle="modal" data-bs-target="#editCategoryModal"
                onclick="editCategory(<?= $cat['id']; ?>, '<?= $cat['name']; ?>', '<?= $cat['type']; ?>')">
                Edit
              </button>
              <button class="action-btn btn-delete" onclick="deleteCategory(<?= $cat['id']; ?>)">Delete</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Add Category Modal -->
  <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="addCategoryLabel">Add New Category</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="addCategoryForm">
            <div class="mb-3">
              <label class="form-label">Category Name</label>
              <input type="text" class="form-control" id="categoryName" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Type</label>
              <select id="categoryType" class="form-select" required>
                <option value="Income">Income</option>
                <option value="Expense">Expense</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Add Category</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Category Modal -->
  <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="editCategoryLabel">Edit Category</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="editCategoryForm">
            <input type="hidden" id="editCategoryId">
            <div class="mb-3">
              <label class="form-label">Category Name</label>
              <input type="text" class="form-control" id="editCategoryName" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Type</label>
              <select id="editCategoryType" class="form-select" required>
                <option value="Income">Income</option>
                <option value="Expense">Expense</option>
              </select>
            </div>
            <button type="submit" class="btn btn-success w-100">Save Changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function editCategory(id, name, type) {
      document.getElementById('editCategoryId').value = id;
      document.getElementById('editCategoryName').value = name;
      document.getElementById('editCategoryType').value = type;
    }

    function deleteCategory(id) {
      if (confirm('Are you sure you want to delete category ID ' + id + '?')) {
        alert('Category deleted (simulation)');
      }
    }

    document.getElementById('addCategoryForm').addEventListener('submit', function(e) {
      e.preventDefault();
      alert('New category added (simulation)');
    });

    document.getElementById('editCategoryForm').addEventListener('submit', function(e) {
      e.preventDefault();
      alert('Category updated (simulation)');
    });
  </script>
</body>
</html>
