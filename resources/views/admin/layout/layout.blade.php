<!DOCTYPE html>
<html lang="en">
<head>
<title>{{env('APP_NAME_ADMIN')}}</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="{{Request::root()}}/assets/admin/css/bootstrap.min.css" />
<link rel="stylesheet" href="{{Request::root()}}/assets/admin/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="{{Request::root()}}/assets/admin/css/uniform.css" />
<link rel="stylesheet" href="{{Request::root()}}/assets/admin/css/select2.css" />
<link rel="stylesheet" href="{{Request::root()}}/assets/admin/css/fullcalendar.css" />
<link rel="stylesheet" href="{{Request::root()}}/assets/admin/css/matrix-style.css" />
<link rel="stylesheet" href="{{Request::root()}}/assets/admin/css/matrix-media.css" />
<link href="{{Request::root()}}/assets/admin/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="{{Request::root()}}/assets/admin/css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

@include('admin/common/header')

@include('admin/common/sidebar')

@yield('content')

@include('admin/common/footer')


</body>
</html>
