<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .register-now{
            font-size: 3.5rem;
            font-weight: 800;
            color: rgb(0, 0, 0);
        }
        .rounded-lg {
            border-radius: 20px;
        }
        .btn{
            padding: 10px 25px;
            font-size: 15px;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="mb-3 text-start">
            <p class="register-now">Login</p>
        </div>
        <form action="" method="" class="bg-white shadow-lg rounded-lg px-4 pt-4 pb-4 mb-4">
            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label fw-bold">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
