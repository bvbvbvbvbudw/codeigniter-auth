<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3 class="text-center">Dashboard</h3>
            <form action="/auth/logout" method="post">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
            <p>Welcome, <?= session()->get('username') ?>!</p>
        </div>
    </div>
</div>
</body>
</html>
