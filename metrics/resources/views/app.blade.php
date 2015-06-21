<!doctype html>
<html lang="en" ng-app="app">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title>Metrics</title>

        <base href="/">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="/builds/vendor.css"/>
        <link rel="stylesheet" type="text/css" href="/builds/app.css"/>
        <link href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,300italic,100italic,400italic,500,500italic,700,700italic,900,900italic"
              rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic"
              rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,800,700,400,600,300"
              rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic"
              rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Oswald:400,300,700" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Dancing+Script:400,700" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Allan:400,700" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Corben:400" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Nobile" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Lekton" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Molengo" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Cardo" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Crimson+Text" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Allerta" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet" type="text/css">
    </head>

    <body id="body" style="display: block; font-family: Nobile, Molengo, 'Josefin Sans', Arial, Cardo;">

        <div class="site-wrapper" id="home" style="box-shadow: rgba(0, 0, 0, 0.760784) 0px 0px 130px inset;">
            <div class="before" style="background-image: url(/resources/images/bg.jpg);"></div>
            <div class="navbar masthead clearfix top" id="navigation" style="background: rgba(42, 62, 132, 0);">
                <div class="inner">
                    <a href="#home" style="color: rgb(255, 255, 255);">
                        <h3 class="masthead-brand" id="logo"
                            style="text-transform: capitalize; letter-spacing: -1.1px; font-size: 1.9em; font-family: 'Source Sans Pro', Lato, Corben, Allerta, 'Kaushan Script';">
                            <i class="glyphicon glyphicon-cloud-upload"></i> Metrics</h3>
                    </a>
                    <nav>
                        <ul class="nav masthead-nav">
                            <li class="active"><a href="http://github.com/kz/angelhack-london-metrics"
                                                  style="color: rgb(255, 255, 255);"><i class="fa fa-github"></i>
                                    http://github.com/kz/angelhack-london-metrics</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <ui-view>

            </ui-view>

        </div>

        <script src="/builds/vendor.js"></script>
        <script src="/builds/app.js"></script>
        <script src="/builds/templates.js"></script>

    </body>
</html>