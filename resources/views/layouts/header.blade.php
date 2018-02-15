<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="has-navbar-fixed-top">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/favicon.ico">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$title}} | {{ config('app.name', 'LaraBook') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>

<body>
    <section class="main-section">
        <div class="container is-fluid">
            <div id="app">  
                @include('layouts.nav')
                <div class="hero is-info">
                        <div class="hero-body is-success columns">
                            <div class="column is-8">
                                <h1 class="title">{{$title}}</h1>
                            </div>
                            <div class="column is-3 is-offset-2">
                                    @user
                                    <a href="/stream">My Stream</a> 
                                    |
                                    <a class="" href="/profile">
                                        My Profile
                                    </a>
                                    @enduser
                                    @guest
                                    Other Link
                                    @endguest
                            </div>
                        </div>
                    </div>