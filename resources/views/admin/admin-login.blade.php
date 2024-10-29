<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resource</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .container
        {
            width: 50%;
            height: auto;
            margin-top: 42px;
        }
    </style>
</head>
<body>
  
  <div class="container">
    <div class="row justify-content-center">
      @if (Session::has('error'))
      <p class="text-danger">{{Session::get('error')}}</p>
   @endif 
        <div class="clo-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Admin Login
                    </h1>
                </div>
                
                <div class="card-body">  
            <form action="" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
           
            <div class="mb-3">
              <label for="exampleInputTitle" class="form-label mt-1">Email</label>
              <input type="email" class="form-control" name="email" id="exampleInputTitle">
               @error('email')
                   <div class="text-danger">{{$message}}</div>
               @enderror
            </div>

            <div class="mb-3">
              <label for="exampleInputTitle" class="form-label mt-1">Password</label>
              <input type="password" class="form-control" name="password" id="exampleInputTitle">
               @error('password')
                   <div class="text-danger">{{$message}}</div>
               @enderror
                                   
            </div>
           
            <button type="submit" class="btn btn-primary mb-3">Login</button>
           
          </form>
        </div>
      </div>
  </div>
</div>
</div>

</body>
</html>