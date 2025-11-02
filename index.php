<?php
include "config/env.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PFMS</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="icon" href="logo.jpeg" />

<style>
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    background: linear-gradient(135deg, #eef2f3, #dfe9f3);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container-card {
    background: rgba(255,255,255,0.5);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    padding: 40px;
    max-width: 900px;
    width: 100%;
}

.title-main {
    text-align: center;
    font-size: 26px;
    font-weight: 600;
    margin-bottom: 30px;
    color: #2d3436;
}

.row-form {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.row-form .col-6, .row-form .col-12 {
    flex: 1;
}

.form-control {
    border-radius: 10px;
    border: 1px solid #ccc;
    padding: 10px;
    transition: 0.3s;
}

.form-control:focus {
    border-color: #2575fc;
    box-shadow: 0 0 8px rgba(37,117,252,0.3);
    outline: none;
}

.btn-primary, .btn-dark {
    border-radius: 10px;
    padding: 10px 20px;
    font-weight: 500;
    transition: 0.3s;
}

.btn-primary:hover { background-color: #0652c5; }
.btn-dark:hover { background-color: #343a40; }

.modal-content {
    border-radius: 15px;
    backdrop-filter: blur(10px);
}

.modal-header, .modal-footer {
    border: none;
}

.modal-title {
    font-weight: 600;
}

.input-group .btn-outline-secondary {
    border-radius: 0 10px 10px 0;
    transition: 0.3s;
}

.input-group .btn-outline-secondary:hover {
    background-color: #2575fc;
    color: white;
}

@media (max-width: 768px) {
    .row-form {
        flex-direction: column;
    }
}
</style>
</head>

<body>

<div class="container-card">

    <p class="title-main">Welcome to Personal Finance Management System</p>

    <div id="signUpBox">
        <p class="h5 mb-4">Create New Account</p>

        <div id="msgdiv" class="alert alert-danger d-none" role="alert" id="msg"></div>

        <div class="row row-form">
            <div class="col-6">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control" placeholder="John" id="fname" />
            </div>

            <div class="col-6">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" placeholder="Doe" id="lname" />
            </div>

            <div class="col-12">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="john@gmail.com" id="email" />
            </div>

            <div class="col-12">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="**********" id="password" />
            </div>

            <div class="col-6">
                <label class="form-label">Mobile</label>
                <input type="text" class="form-control" placeholder="0771234568" id="mobile" />
            </div>

            <div class="col-6">
                <label class="form-label">Gender</label>
                <select class="form-control" id="gender">
                    <?php
                    $rs = Database::search("SELECT * FROM `gender`");
                    $num = $rs->num_rows;
                    for ($x = 0; $x < $num; $x++) {
                        $data = $rs->fetch_assoc();
                    ?>
                        <option value="<?php echo $data["gender_id"]; ?>">
                            <?php echo $data["gender_name"]; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="col-12 col-lg-6 d-grid">
                <button class="btn btn-primary" onclick="signup();">Sign Up</button>
            </div>

            <div class="col-12 col-lg-6 d-grid">
                <button class="btn btn-dark" onclick="changeView();">Already have an account? Sign In</button>
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div class="modal" tabindex="-1" id="fpmodal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Forgot Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label">New Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="np"/>
                                <button id="npb" class="btn btn-outline-secondary" type="button" onclick="showPassword1();">Show</button>
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="form-label">Re-type Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="rnp"/>
                                <button id="rnpb" class="btn btn-outline-secondary" type="button" onclick="showPassword2();">Show</button>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Verification Code</label>
                            <input type="text" class="form-control" id="vcode"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>

</body>
</html>
