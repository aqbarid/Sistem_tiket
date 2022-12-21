<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

  <div class="container py-5">
    <div class="row">
      <div class="col-md-3">
        <ul class="list-group">
          <li class="list-group-item">
            <a href="/admin" class="btn-link text-decoration-none">Dashboard</a>
          </li>
          <li class="list-group-item">
            <a href="/admin/places" class="btn-link text-decoration-none">Places</a>
          </li>
          <li class="list-group-item">
            <a href="/admin/rooms" class="btn-link text-decoration-none">Rooms</a>
          </li>
          <li class="list-group-item">
            <a href="/admin/transactions" class="btn-link text-decoration-none">Transactions</a>
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
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>