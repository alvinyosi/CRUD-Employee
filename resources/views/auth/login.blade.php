<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .card {
            animation: fadeIn 0.8s ease-in-out;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .header {
            background: linear-gradient(45deg, #28a745, #218838);
            color: white;
            padding: 15px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            text-align: center;
        }
        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
            transform: scale(1.05);
        }
        .form-control {
            transition: 0.3s;
        }
        .form-control:focus {
            box-shadow: 0 0 10px rgba(40, 167, 69, 0.5);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h1>Login</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a href="{{ route('register') }}" class="btn btn-secondary btn-sm">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
