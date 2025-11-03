<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PFMS</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('images/finance-bg.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: linear-gradient(135deg, #74b9ff, #a29bfe);
            padding: 45px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            max-width: 420px;
            width: 100%;
            color: #fff;
            text-align: center;
            backdrop-filter: blur(8px);
        }

        .title02 {
            text-align: center;
            font-weight: 600;
            font-size: 28px;
            margin-bottom: 20px;
        }

        label {
            font-weight: 500;
            margin-bottom: 5px;
        }

        input {
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-size: 15px;
            transition: 0.3s;
        }

        input:focus {
            outline: none;
            box-shadow: 0 0 8px rgba(255,255,255,0.8);
        }

        .btn-primary {
            background-color: #0984e3;
            border: none;
            font-weight: 600;
            border-radius: 10px;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background-color: #74b9ff;
            transform: scale(1.05);
        }

        .btn-dark {
            background-color: #2d3436;
            border: none;
            font-weight: 500;
            border-radius: 10px;
            transition: 0.3s;
        }

        .btn-dark:hover {
            background-color: #636e72;
            transform: scale(1.05);
        }

        .form-control::placeholder {
            color: #b2bec3;
        }

        .alert {
            background-color: rgba(255, 0, 0, 0.8);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px;
        }

        @media (max-width: 768px) {
            .login-container {
                padding: 30px;
                margin: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <p class="title02">Welcome Back!</p>
        <p style="margin-top: -10px;">Sign in to your account</p>

        <div class="col-12 d-none" id="msgdiv">
            <div class="alert alert-danger" role="alert" id="msg"></div>
        </div>

        <div class="text-start mt-4">
            <label class="form-label">Email</label>
            <input type="email" class="form-control mb-3" placeholder="Ex: john@gmail.com" id="email">
        </div>

        <div class="text-start">
            <label class="form-label">Password</label>
            <input type="password" class="form-control mb-4" placeholder="*********" id="password">
        </div>

        <div class="d-grid mb-3">
            <button class="btn btn-primary" onclick="signin();">Sign In</button>
        </div>

        <div class="d-grid">
            <button class="btn btn-dark" onclick="changeView();">Create New Account</button>
        </div>

        <p style="margin-top: 20px; font-size: 14px;">Forgot Password? <a href="#" style="color: #fff; text-decoration: underline;">Click here</a></p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function signin() {
             window.location.href = "dashboard.php";
        }

        function changeView() {
            window.location.href = "dashboard.php";
            window.location.href = "dashboard.php";
        }
    </script>
</body>
</html>
