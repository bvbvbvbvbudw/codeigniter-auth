<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Bootstrap Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 60px;
        }
        .content-section {
            margin-top: 20px;
        }
        .footer {
            margin-top: 30px;
            padding: 10px;
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="/">Bootstrap Page</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <?php if (session()->get('username')) { ?>
                <li class="nav-item">
                    <p class="nav-link">Welcome, <?= session()->get('username') ?>!</p>
                </li>
                <li>
                    <a href="/profile">Profile</a>
                </li>
                <li class="nav-item">
                    <form action="auth/logout" method="post" style="display: inline;">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-link nav-link" style="display: inline; cursor: pointer;">Logout</button>
                    </form>
                </li>
            <?php } else { ?>
                <li class="nav-item active">
                    <a class="nav-link" href="auth/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="auth/register">Register</a>
                </li>
            <?php } ?>
        </ul>
    </div>

</nav>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="mt-5">Welcome to Bootstrap Page</h1>
            <p class="lead">This is a simple example page using Bootstrap for layout and styling. You can modify the content as per your requirements.</p>
            <hr>
        </div>
    </div>

    <div class="row content-section">
        <div class="col-lg-4">
            <div class="card">
                <img src="https://via.placeholder.com/150" class="card-img-top" alt="Image 1">
                <div class="card-body">
                    <h5 class="card-title">Card title 1</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <img src="https://via.placeholder.com/150" class="card-img-top" alt="Image 2">
                <div class="card-body">
                    <h5 class="card-title">Card title 2</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <img src="https://via.placeholder.com/150" class="card-img-top" alt="Image 3">
                <div class="card-body">
                    <h5 class="card-title">Card title 3</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer text-center">
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore eveniet labore maiores nemo nobis omnis quod quos totam veniam vero!
        Assumenda, fuga, quidem? Cupiditate doloribus nemo non quod sapiente voluptatibus!</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
