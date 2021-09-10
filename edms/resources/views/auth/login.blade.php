<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDMS | Login</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <style>
        .columns{
            
            /* max-width: 40%; */
            margin-top: 100px;
            box-shadow: 5px 10px 15px #888888;
        }
        .aside{
            background-color: teal;
            margin-top: 100px;
            box-shadow: 5px 10px 15px #888888;
            margin-left: 10%;
        }
        .container{
            display: grid;
            grid-template-columns: 50% 40%;
            gap: 0%;
        }
    </style>
</head>
<body class="bg-light">


<div class="container">
    <div class="aside row">
    <div class="text-white p-5 column">
        <h3 class="text-center mt-4">Employee Database Managment System</h3><br>
        <p class="text-light text-center pt-1">Welcome Back !!! Login to access your user account.</p>
    </div>
    </div>
    <div class="row">
        <div class="bg-dark text-white p-5 columns">
            <form action="{{route('auth.check')}}" method="POST">
                @csrf
                <div class="results">
                    @if(Session::get('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                    @endif
                    @if(Session::get('fail'))
                    <div class="alert alert-danger">
                            {{Session::get('fail')}}
                    </div>
                    @endif
                </div>
                <h3>Login</h3>
                <hr>
                <div class="form-group mb-3 col-md-12">
                    <label for="email">Email</label>
                    <input type="email" name="email"class="form-control" placeholder="Enter email" value="{{old('email')}}">
                    <span class="text-danger">@error('email'){{$message }} @enderror</span>
                </div>
                <div class="form-group mb-3 col-md-12">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter Password">
                    <span class="text-danger">@error('password'){{$message }} @enderror</span>
                </div>
                <div class="form-group mt-4">
                    <button type="submit" class="btn col-md-12 text-white" style="background-color: teal;">Login</button>
                </div>
            </form>
        </div>    
    </div>
</div>
<br>
<footer class="text-center mt-5"> ©2021 copyright.All right reserved | Designed by Thewavecoder</footer>
</body>
</html>