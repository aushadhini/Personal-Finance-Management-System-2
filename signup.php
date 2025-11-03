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

        .signup-container {
            background: linear-gradient(135deg, #74b9ff, #a29bfe);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            max-width: 650px;
            width: 100%;
            color: #fff;
            backdrop-filter: blur(10px);
        }

        .title02 {
            text-align: center;
            font-weight: 600;
            font-size: 26px;
            margin-bottom: 20px;
        }

        label {
            font-weight: 500;
            margin-bottom: 5px;
        }

        input, select {
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-size: 15px;
            transition: 0.3s;
        }

        input:focus, select:focus {
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

        .alert {
            background-color: rgba(255, 0, 0, 0.8);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px;
        }

        .form-control::placeholder {
            color: #b2bec3;
        }

        @media (max-width: 768px) {
            .signup-container {
                padding: 25px;
                margin: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="signup-container">
        <div class="row g-3">

            <div class="col-12">
                <p class="title02">Create New Account</p>
            </div>

            <div class="col-12 d-none" id="msgdiv">
                <div class="alert alert-danger" role="alert" id="msg"></div>
            </div>

            <div class="col-6">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control" placeholder="Ex: John" id="fname">
            </div>

            <div class="col-6">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" placeholder="Ex: Doe" id="lname">
            </div>

            <div class="col-12">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="Ex: john@gmail.com" id="email">
            </div>

            <div class="col-12">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="*********" id="password">
            </div>

            <div class="col-6">
                <label class="form-label">Mobile</label>
                <input type="text" class="form-control" placeholder="Ex: 0771234568" id="mobile">
            </div>

            <div class="col-6">
                <label class="form-label" for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender">
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function signup() {
            window.location.href = "signup.php";
        }

        function changeView() {
            window.location.href = "signin.php";
            window.location.href = "signin.php";
        }
    </script>
</body>
</html>
