<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <style>
        :root {
            --blue: #003049;
            --red: #D62828;
            --orange: #F77F00;
            --yellow: #FCBF49;
            --miniWhite: #EAE2B7;
            --white: #FFFFFF;
            --black: #000000;
            --green: #049624;
            --gray: #808080;
            
            --interFont: 'Inter', sans-serif;
            --poppinsFont: 'Poppins', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: var(--poppinsFont);
        }

        body {
            height: 768px;
            width: 1352px;
        }

        .container {
            display: flex;

            height: 100%;
            width: 100% ;
            background-color: red;
        }

        .container .left-box {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            background-color: #F5F5F5;
        }

        .logo {
            height: 400px;
            width: 400px;
            background-color: var(--gray);
            background-image: url('../public/assets/images/logo-icon.png');
        }

        .container .right-box {
            width: 100%;
            background-color: var(--blue);
        }
        
        .right-box {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .content-header {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: var(--white);
        }

        .content-header .logo-icon {
            height: 52px;
            width: 52px;
            background-image: url(../public/assets/images/logo.png);
            margin-bottom: 24px;
        }

        .content-header h2 {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .content-header p {
            margin-bottom: 12px;
        }

        .form-block {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .input-block {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        .input-block .input-row {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            gap: 6px;
        }

        .input-block .input-row label {
            font-size: 14px;
            color: #48505E;
        }

        .input-block .input-row input {
            padding: 14px 16px;
            width: 360px ;
            border-radius: 8px;
            border: 1px solid #D0D5DD;
        }

        .rem-for {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .button-block {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .button-block .btn {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 14px 16px;
            border-radius: 8px;
            border: none;
            background-color: transparent;
        }

        .button-block .btn-bg {
            background-color: var(--orange);
            color: var(--white);
        }

        .button-block .btn-nbg {
            border: 1px solid #D0D5DD;
        }

        .signup-block {
            margin-top: 32px;
            color: #667085;
        }

        .signup-block a, .rem-for a  {
            color: var(--orange);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-box">
            <div class="logo">
                
            </div>
        </div>

        <div class="right-box">
            <div class="content-header">
                <h2>Login to your Account</h2>
                <p>Welcome back! Please enter your details.</p>
            </div>
            
            <form class="form-block" method="post">
                <div class="input-block">
                    <div class="input-row">
                        <label for="username">Username</label>
                        <input type="text" name="username" placeholder="Enter your username" required>
                    </div>
                    
                    <div class="input-row">
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>
                </div>

                <div class="button-block">
                    <button class="btn btn-bg" type="submit" name="login">signin</button>
                </div>
                
            </form>

            <p class="signup-block">Don't have an account? <a href="/signup">Sign up</a></p>
        </div>
    </div>
</body>
</html>