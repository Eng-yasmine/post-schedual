<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Post Schedual - @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('User/assets/favicon.ico') }}" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    @include('user.layouts.links')
</head>

<body>
    <!-- Navigation-->
    @include('user.layouts.navbar')
    <!-- Page Header-->
   @include('user.layouts.header')
    <!-- Main Content-->
    @yield('user_content')
    <!-- Footer-->
   @include('user.layouts.footer')
    <!-- Bootstrap core JS-->
  @include('user.layouts.scripts')
  @yield('scripts')
    <!-- Core theme JS-->

</body>

</html>
