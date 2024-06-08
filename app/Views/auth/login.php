<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3 class="text-center mt-5">Login</h3>
            <form id="loginForm">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                <div class="form-group">
                    <label for="loginEmail">Email</label>
                    <input type="email" class="form-control" id="loginEmail" name="email" required>
                </div>
                <div class="form-group">
                    <label for="loginPassword">Password</label>
                    <input type="password" class="form-control" id="loginPassword" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <div id="loginMessage" class="mt-3"></div>
        </div>
    </div>
</div>

<script>
    $(document).ajaxSend(function(event, xhr, settings) {
        if (!/^(GET|HEAD|OPTIONS|TRACE)$/i.test(settings.type) && !settings.crossDomain) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        }
    });

    $(document).ready(function() {
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '/auth/login',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if(response.redirect){
                        window.location.href = response.redirect;
                    } else {
                        $('#loginMessage').html('<div class="alert alert-danger">' + response.msg + '</div>');
                    }
                    if(response.csrfToken) {
                        $('meta[name="csrf-token"]').attr('content', response.csrfToken);
                        $('input[name="<?= csrf_token() ?>"]').val(response.csrfToken);
                    }
                },
                error: function(response) {
                    console.log(response)
                    var newCsrfToken = response.responseJSON.messages.csrfToken;
                    if(newCsrfToken) {
                        $('meta[name="csrf-token"]').attr('content', newCsrfToken);
                        $('input[name="<?= csrf_token() ?>"]').val(newCsrfToken);
                    }
                    var errorHtml = `<div class="alert alert-danger"><p>${response.responseJSON.messages.msg}</p></div>`;
                    $('#loginMessage').html(errorHtml);
                }
            });
        });
    });

</script>
</body>
</html>
