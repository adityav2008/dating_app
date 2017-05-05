<!DOCTYPE html>
<html lang="en">

<head>
  <title>{{env('APP_NAME_ADMIN')}}</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="{{Request::root()}}/assets/admin/css/bootstrap.min.css" />
  <link rel="stylesheet" href="{{Request::root()}}/assets/admin/css/bootstrap-responsive.min.css" />
  <link rel="stylesheet" href="{{Request::root()}}/assets/admin/css/matrix-login.css" />
  <link href="{{Request::root()}}/assets/admin/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
@yield('auth')
<script src="{{Request::root()}}/assets/admin/js/jquery.min.js"></script>
<script src="{{Request::root()}}/assets/admin/js/matrix.login.js"></script>
</body>
</html>
