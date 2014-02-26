<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" id="ng-app" ng-app="main"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" id="ng-app" ng-app="main"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" id="ng-app" ng-app="main"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" id="ng-app" ng-app="main"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Flex Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="http://code.angularjs.org/1.2.13/angular.min.js"></script>
    <script src="http://code.angularjs.org/1.2.13/angular-route.min.js"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
    <script src="{{asset('assets/js/modernizr-2.7.1.min.js')}}"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body class="container">
<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

{{--
<!-- Навигация -->
<ng-include src="'partials/navbar.html'"></ng-include>
--}}
<div ng-view="header"></div>
<div ng-view="content" ng-controller="container">@yield('content')</div>
{{--
<ng-include src="'partials/footer.html'"></ng-include>
--}}
{{--
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function (b, o, i, l, e, r) {
        b.GoogleAnalyticsObject = l;
        b[l] || (b[l] = function () {
            (b[l].q = b[l].q || []).push(arguments)
        });
        b[l].l = +new Date;
        e = o.createElement(i);
        r = o.getElementsByTagName(i)[0];
        e.src = '//www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e, r)
    }(window, document, 'script', 'ga'));
    ga('create', 'UA-XXXXX-X');
    ga('send', 'pageview');
</script>
--}}
</body>
</html>
