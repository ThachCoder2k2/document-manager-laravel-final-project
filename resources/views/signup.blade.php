
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

        <link href="{{ asset('css/signup.css') }}" rel="stylesheet" type="text/css" media="all">
        <link href="{{ asset('css/fontawesome/css/all.min.css')}}" rel="stylesheet" type="text/css" media="all">

        <title>Singup</title>
    </head>

    <body>
        <form action="{{route('postRegister')}}" method="POST">
            @csrf
            <div class="form">
                <div class="header_form">
                    <h3 class="header_form_content">Create Account Your</h3>
                </div>
    
                <div class="form_container">
                    <div class="form_input">
                        <input type="text" class="form_input_username" placeholder="Your username" name="username" required="">
                    </div>
                    <div class="form_input">
                        <input type="text" class="form_input_username" placeholder="Name" name="name" required="">
                    </div>
                    <div class="form_input">
                        <input type="password" class="form_input_password" placeholder="Password" name="password" required="">
                    </div>
                    <div class="form_input">
                        <input type="password" class="form_input_password_confirm" placeholder="Confirm Password" required="">
                    </div>
                </div>
    
                <div class="form_controls">
                    <a href="{{route('index')}}" class="btn-back">Return</a>
                    <input type="submit" name="submit" class="btn-login" value="CREATE">
                </div>
    
                <div class="form_socials">
                    <a href="" class="auth-form_socials-fb btn btn_with-icon">
                        <i class="fa-brands fa-square-facebook fa-lg"></i>
                        <span class="auth-form_socials-texticon-fb">Login with Facebook</span>
                    </a>
                    <a href="" class="auth-form_socials-gg btn btn_with-icon">
                        <i class="fa-brands fa-google fa-lg"></i>
                        <span class="auth-form_socials-texticon-gg">Login with Google</span>
                    </a>
                </div>
            </div>
        </form>
        
    </body>
</html>