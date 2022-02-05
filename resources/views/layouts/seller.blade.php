<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

  <div class="container py-5">
    <div class="row">
      <div class="col-md-3">
        <ul class="list-group">
          <li class="list-group-item">
            <a href="/seller" class="btn-link text-decoration-none">Dashboard</a>
          </li>
          <li class="list-group-item">
            <a href="/seller/place" class="btn-link text-decoration-none">
              My Places</a>
          </li>
          <li class="list-group-item">
            <a href="/seller/room" class="btn-link text-decoration-none">My Rooms</a>
          </li>
          <li class="list-group-item">
            <a href="/logout" class="btn-link text-decoration-none">Logout</a>
          </li>
        </ul>
      </div>
      <div class="col-md-9">
        @error
        @success
        @yield('content')
      </div>
    </div>
  </div>
  
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>