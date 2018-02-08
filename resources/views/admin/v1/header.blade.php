<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <title>@yield('page_title' , __('simple.no_page_title'))</title>
    {{--<meta name="description" content="Philbert is a Dashboard & Admin Site Responsive Template by hencework." />--}}
    {{--<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Philbert Admin, Philbertadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />--}}
    {{--<meta name="author" content="hencework"/>--}}

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('fa-admin-panel/favicon.ico')}}">
    <link rel="icon" href="{{asset('fa-admin-panel/favicon.ico')}}" type="image/x-icon">

    <!-- Data table CSS -->
    <link href="{{asset('fa-admin-panel/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>

    <!-- Custom CSS -->
    <link href="{{asset('fa-admin-panel/dist/css/style.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
