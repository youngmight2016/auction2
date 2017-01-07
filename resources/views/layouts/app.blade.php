<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <style>
        .container-with-sidebar-margin-left {margin-left: 15%;}
    </style>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}" style="font-size: 40px">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ URL::to('indexItem') }}">View all items</a></li>   
                        <li><a href="{{ URL::to('aboutPage') }}">About</a></li>
                        @if(Auth::user())
                            <li><a href=" {{ URL::to('home') }}">Home</a></li>
                        @endif 
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/createItem') }}">
                                            Add item
                                        </a>
                                        <a href="{{ url('/userItems') }}">
                                            Show my items
                                        </a>
                                        <a href="{{ url('/userWins') }}">
                                            Show won auctions
                                        </a>
                                    

                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div id="sidebar">
            <ul id="sidebar_ul">
              <li id="sidebar_li"><a id="sidebar_a" href="{{ url('/itemsByCategory', ['category' => 'Transportation']) }}">Transportation</a></li>
                <ul>
                    <li id="sidebar_li"><a id="subcategory_sidebar_a" href="{{ url('/itemsByCategory', ['category' => 'Cars']) }}">Cars</a></li>
                    <li id="sidebar_li"><a id="subcategory_sidebar_a" href="{{ url('/itemsByCategory', ['category' => 'Bicycles']) }}">Bicycles</a></li>
                    <li id="sidebar_li"><a id="subcategory_sidebar_a" href="{{ url('/itemsByCategory', ['category' => 'Parts']) }}">Parts</a></li>
                </ul> 
              <li id="sidebar_li"><a id="sidebar_a" href="{{ url('/itemsByCategory', ['category' => 'Electronics']) }}">Electronics</a></li>
                <ul>
                    <li id="sidebar_li"><a id="subcategory_sidebar_a" href="{{ url('/itemsByCategory', ['category' => 'Computers']) }}">Computers</a></li>
                    <li id="sidebar_li"><a id="subcategory_sidebar_a" href="{{ url('/itemsByCategory', ['category' => 'Hardware']) }}">Hardware</a></li>
                    <li id="sidebar_li"><a id="subcategory_sidebar_a" href="{{ url('/itemsByCategory', ['category' => 'Software']) }}">Software</a></li>
                </ul> 
              <li id="sidebar_li"><a id="sidebar_a" href="{{ url('/itemsByCategory', ['category' => 'Entertainment']) }}">Entertainment</a></li>
                <ul>
                    <li id="sidebar_li"><a id="subcategory_sidebar_a" href="{{ url('/itemsByCategory', ['category' => 'Books']) }}">Books</a></li>
                    <li id="sidebar_li"><a id="subcategory_sidebar_a" href="{{ url('/itemsByCategory', ['category' => 'Games']) }}">Games</a></li>
                    <li id="sidebar_li"><a id="subcategory_sidebar_a" href="{{ url('/itemsByCategory', ['category' => 'Music']) }}">Music</a></li>
                </ul> 
              <li id="sidebar_li"><a id="sidebar_a" href="{{ url('/itemsByCategory', ['category' => 'Clothes']) }}">Clothes</a></li>
                <ul>
                    <li id="sidebar_li"><a id="subcategory_sidebar_a" href="{{ url('/itemsByCategory', ['category' => 'Women']) }}">Women</a></li>
                    <li id="sidebar_li"><a id="subcategory_sidebar_a" href="{{ url('/itemsByCategory', ['category' => 'Men']) }}">Men</a></li>
                    <li id="sidebar_li"><a id="subcategory_sidebar_a" href="{{ url('/itemsByCategory', ['category' => 'Accessories']) }}">Accessories</a></li>
                </ul> 
              <li id="sidebar_li"><a id="sidebar_a" href="{{ url('/itemsByCategory', ['category' => 'Household']) }}">Household</a></li>
                <ul>
                    <li id="sidebar_li"><a id="subcategory_sidebar_a" href="{{ url('/itemsByCategory', ['category' => 'Furniture']) }}">Furniture</a></li>
                    <li id="sidebar_li"><a id="subcategory_sidebar_a" href="{{ url('/itemsByCategory', ['category' => 'Tools']) }}">Tools</a></li>
                    <li id="sidebar_li"><a id="subcategory_sidebar_a" href="{{ url('/itemsByCategory', ['category' => 'Bedding']) }}">Bedding</a></li>
                </ul> 
            </ul>
        </div>

        <style type="text/css">
            #sidebar{
                background:#151718;
                width: 15%;
                height: 100%;
                display: block;
                position: absolute;
                left: 0px;
                top: 50px;
                font-family: "Helvetica Neue", Helvetica, Arial;
            }

            ul#sidebar_ul{
                margin: 0px;
                padding: 0px;
            }

            ul li#sidebar_li{
                list-style: none;
            }

            ul li a#sidebar_a{
                background: #1C1E1F;
                color: #ccc;
                border-bottom: 1px solid #111;
                display: block;
                padding: 10px;
                text-decoration: none;
            }

            ul li a#subcategory_sidebar_a{
                color: #ccc;
                display: block;
                padding: 2px;
                text-decoration: none;
            }

            ul li a#subcategory_sidebar_a:hover, .offcanvas a:focus{
                color: #f1f1f1;
            }

            ul li a#sidebar_a:hover, .offcanvas a:focus{
                color: #f1f1f1;
            }
        </style>

        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
