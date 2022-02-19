<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset mail otp</title>
    <style>
        .container{
            border: 2px solid black;
            justify-content: center;
        }
    </style>
</head>
<body>
    <h5>Reset Your Password</h5>
    <div class="container">
        <h6>Reset your account password</h6>
        <P>This is your confirmation OTP for password change please fill this otp in the given input filed..</P>
        <p>OTP:{{$details['otp']}}</p>

        <p>Thank you..</p>
    </div>    
</body>
</html>