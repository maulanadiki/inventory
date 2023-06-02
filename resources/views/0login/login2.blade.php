<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href='{{ asset("font/css/font-awesome.css") }}'>
    <link rel="stylesheet" href='{{ asset("font/css/font-awesome.min.css") }}'>

<style>
    body {
   margin: 0;
   padding: 0;
   background-image: url('{{ asset("defa/welcome.jpg") }}');
   background-size:100%;
   /* background-size: cover; */
   background-position: center;
   background-repeat: no-repeat;
   background-attachment: fixed;
   font-family: sans-serif;
 }
 .login {
   position: fixed;
   top: 50%;
   left: 45%;
   transform: translate(-30%, -50%);
   background: rgba(4, 29, 23, 0.5);
   padding: 50px;
   width: 300px;
   box-shadow: 0px 0px 25px 10px black;
   border-radius: 15px;
   color:white;
 }
 .avatar {
   font-size: 30px ;
   background:#E59866;
   width: 50px;
   height: 50px;
   line-height: 50px;
   position: fixed;
   left: 50%;
   top: 0;
   transform: translate(-50%, -50%);
   text-align: center;
   border-radius: 50%;
 }
 .login h2 {
   text-align: center;
   color: white;
   font-size: 30px;
   font-family: sans-serif;
   letter-spacing: 3px;
   padding-top: 0;
   margin-top: -20px;
 }
 .box-login {
   display: flex;
   justify-content:space-between;
   margin: 10px;
   border-bottom: 2px solid white;
   padding: 8px 0;
 }
 .box-login i {
   font-size: 23px;
   color: white;
   padding: 5px 0;
 }
 .box-login input {
   width: 85%;
   padding: 5px 0;
   background: none;
   border: none;
   outline: none;
   color: white;
   font-size: 18px;
 }
 .box-login input::placeholder {
   color: white;
 }
 .btn-login
 .box-login input:hover{
   background: rgba(10, 10, 10,s 0.5);
 }
 .btn-login {
   margin-left: 10px;
   margin-bottom: 20px;
   background: none;
   border: 1px solid white;
   width: 92.5%;
   padding: 10px;
   color: white;
   font-size: 18px;
   letter-spacing: 3px;
   cursor: pointer;
   }
 .btn-login:hover{
   background: rgba(12, 30, 15, 0.5);
 }
 .bottom {
   margin-left: 10px;
   margin-right: 10px;
   display: flex;
   justify-content: space-between;
 }
 .bottom a {
   color: white;
   font-size: 15px;
   text-decoration: none;
 }
 .bottom a:hover {
 text-decoration: underline;
 }
</style>
</head>
<body>
<form action="{{Route ('authenticate') }}" method="post" autocomplete="off">
@csrf
<div class="login">

          <div class="avatar">
            <div style="margin-top:5px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                </svg>
               
            </div>

          </div>

          <h2>Login Form</h2>

          <div class="box-login">
            <div style="margin-top:3px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                </svg>
            </div>
            <input type="email" placeholder="Email" name="email" value="{{old('email') }}" required>
            
          </div>
          @if (Session::get('fail'))
          <span style="color:red; width: 250px; margin-left:10px;" >{{Session::get('fail')}} </span>
          @endif
         
   
        

          <div class="box-login">
          <div style="margin-top:3px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
            </svg></div>
            <input type="password" placeholder="Password" name="password" value="{{old('password') }}"required>
          </div>
          @if (Session::get('fail'))
          <span style="color:red; width: 250px; margin-left:10px;" > {{Session::get('fail')}} </span>
          @endif

          <button type="submit" name="login" class="btn-login">Login</button>
          <div class="bottom">
          <p style="margin-left:10%;">Created By Diki Maulana © 2022</p>
          </div>
      </div>
</form>  
</body>
</html>