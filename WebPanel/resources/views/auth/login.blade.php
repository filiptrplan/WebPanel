<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <script src="{{mix('js/app.js')}}"></script>
    <title>Document</title>
</head>
<body>
    <div class="container-fluid row" style="height: 100vh;">
        <div class="col-md-3"></div>
        <div id="login-card" class="card align-middle" class="col-md-6">
            <div class="card-body" style="width: 30rem;">
                <h5 class="card-title">Login</h5>
                <form action="{{url('/authenticate')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="rememberCheckbox" id="rememberCheckbox">
                        <label class="form-check-label" for="rememberCheckbox">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</body>
</html>
