<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3 class="text-center">Register</h3>
            <form id="registerForm">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
            <div id="registerMessage" class="mt-3"></div>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        var isValid = true;
        var username = $('#username').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var errorMessage = '';

        if (username.length < 3 || username.length > 20) {
            errorMessage += '<p>Username must be between 3 and 20 characters.</p>';
            isValid = false;
        }

        var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(email)) {
            errorMessage += '<p>Invalid email format.</p>';
            isValid = false;
        }

        if (password.length < 8) {
            errorMessage += '<p>Password must be at least 8 characters long.</p>';
            isValid = false;
        }

        if (!isValid) {
            $('#registerMessage').html('<div class="alert alert-danger">' + errorMessage + '</div>');
        }

        return isValid;
    }

    $(document).ajaxSend(function(event, xhr, settings) {
        if (!/^(GET|HEAD|OPTIONS|TRACE)$/i.test(settings.type) && !settings.crossDomain) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        }
    });

    $(document).ready(function() {
        $('#registerForm').on('submit', function(e) {
            e.preventDefault();

            if (validateForm()) {
                $.ajax({
                    url: '/auth/register',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        window.location.href = response.redirect;
                    },
                    error: function(response) {
                        console.log(response)
                        var newCsrfToken = response.responseJSON.messages.csrfToken;
                        if (newCsrfToken) {
                            $('meta[name="csrf-token"]').attr('content', newCsrfToken);
                            $('input[name="<?= csrf_token() ?>"]').val(newCsrfToken);
                        }

                        var errors = response.responseJSON.messages.errors;
                        var errorHtml = '<div class="alert alert-danger">';
                        $.each(errors, function(key, value) {
                            errorHtml += '<p>' + value + '</p>';
                        });
                        errorHtml += '</div>';
                        $('#registerMessage').html(errorHtml);
                    }
                });
            }
        });
    });
</script>
</body>
</html>
