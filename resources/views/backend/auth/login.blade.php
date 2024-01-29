<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>D & S POS</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-size: 16px;
        font-family: 'Poppins', sans-serif;
        width: 100%;
        height: 100vh;
        overflow-y: hidden;
    }

    .login {
        display: flex;
        width: 100%;
        height: 100vh;
    }

    .left-side {
        min-width: 50%;
        background: #5d74c0;
        color: white;
    }

    .left-content {
        position: absolute;
        top: 40%;
        left: 14%;
        display: flex;
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }

    .left-content h2  {
        font-size: 2.5rem
    }

    .left-content h4  {
        font-size: 1.5rem;
        margin-bottom: 14px;
    }

    .left-content p {
        font-weight: bold;
    }

    .right-side {
        width: 50%;
        position: relative;
        top: 34.5%;
    }

    .login_form {
        width: 45%;
        margin: 0 auto;
    }

    .form {
        display: flex;
        align-items: center;
        background: #ffffff;
        border: 1px solid #b9b9b9;
        box-sizing: border-box;
        border-radius: 3px;
        width: 100%;
        padding-left: 10px;
        padding-top: 2px;
        margin: 3px 3px 20px 3px;
    }

    .email-icon, .password-icon {
        margin-top: 8px;
    }

    input[type='email'], input[type='password'] {
        width: 100%;
        outline: none;
        padding: 12px;
        border: 0;
        font-size: 16px;
    }

    .remember-me {
        display: flex;
        align-items: center;
        margin-left: 7px;
    }

    input[type='checkbox'] {
        margin-right: 7px;
        accent-color: black;
    }

    .login {
        width: 100%;
    }

    .login button {
        width: 100%;
        outline: none;
        background: black;
        color: white;
        border: 0;
        font-size: 17px;
        padding: 12px 0;
        border-radius: 5px;
        margin-top: 16px;
    }

    .logo {
        max-width: 185px;
        max-height: 185px;
        margin: 0 auto;
    }

    .logo img {
        width: 100%;
        object-fit: contain;
    }

    .cursor {
        cursor: pointer;
    }

    .alert {
        width: 100%;
        background: rgb(204, 117, 117);
        color: white;
        border: 1px solid rgb(204, 117, 117);
        border-radius: 3px;
        text-align: center;
        padding: 10px 0;
        margin-bottom: 12px;
    }

    @media screen and (max-width: 992px) {
        .left-side {
            display: none;
        }

        .right-side {
            width: 100%;
        }

        .login_form {
            width: 70%;
        }
    } 
</style>
<body>
    <div class="login">
        <div class="left-side">
            <div class="left-content">
                <h2>Welcome Back</h2>
                <h4>D & S</h4>
            </div>
        </div>
        <div class="right-side">
            <form action="{{route('userLogin')}}" method="POST" class="login_form">
                @csrf
                @if(Session::get('fail'))
                    <div class="alert">
                        {{Session::get('fail')}}
                    </div>
                @endif
                <div class="form">
                    <div class="email-icon">
                        <svg fill="none" height="24" viewBox="0 0 24 24" width="21" xmlns="http://www.w3.org/2000/svg">
                          <path
                              d="M17 20.5H7C4 20.5 2 19 2 15.5V8.5C2 5 4 3.5 7 3.5H17C20 3.5 22 5 22 8.5V15.5C22 19 20 20.5 17 20.5Z"
                              stroke="#292D32"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-miterlimit="10"
                              stroke-width="1.5"
                          />
                          <path
                              d="M17 9L13.87 11.5C12.84 12.32 11.15 12.32 10.12 11.5L7 9"
                              stroke="#292D32"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-miterlimit="10"
                              stroke-width="1.5"
                          />
                        </svg>
                    </div>
                    <input type="email" placeholder="eg.example@gmail.com" name="email">
                </div>

                <div class="form">
                    <div class="password-icon">
                        <svg fill="none" height="24" viewBox="0 0 24 24" width="21" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M19.7901 14.93C17.7301 16.98 14.7801 17.61 12.1901 16.8L7.48015 21.5C7.14015 21.85 6.47015 22.06 5.99015 21.99L3.81015 21.69C3.09015 21.59 2.42015 20.91 2.31015 20.19L2.01015 18.01C1.94015 17.53 2.17015 16.86 2.50015 16.52L7.20015 11.82C6.40015 9.22001 7.02015 6.27001 9.08015 4.22001C12.0301 1.27001 16.8201 1.27001 19.7801 4.22001C22.7401 7.17001 22.7401 11.98 19.7901 14.93Z"
                                stroke="#292D32"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-miterlimit="10"
                                stroke-width="1.5"
                            />
                            <path
                                d="M6.89014 17.49L9.19014 19.79"
                                stroke="#292D32"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-miterlimit="10"
                                stroke-width="1.5"
                            />
                            <path
                                d="M14.5 11C15.3284 11 16 10.3284 16 9.5C16 8.67157 15.3284 8 14.5 8C13.6716 8 13 8.67157 13 9.5C13 10.3284 13.6716 11 14.5 11Z"
                                stroke="#292D32"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                            />
                          </svg>
                    </div>
                    <input type="password" placeholder="password" name="password">
                </div>

                <div class="remember-me">
                    <input type="checkbox" id="remember" class="checkbox me-2" name="remember">
                    <label for="remember">Remember Me</label>
                </div>

                <div class="login-btn">
                    <button class="cursor">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>