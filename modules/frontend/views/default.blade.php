<!doctype html>
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
	<title>Laravel Modules Example</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script src="/assets/angular/angular.min.js"></script>
	<script src="/assets/angular/angular-route.min.js"></script>

	<script src="//modernizr.com/downloads/modernizr-latest.js"></script>

	<script src="//code.jquery.com/jquery-1.10.1.min.js"></script>

	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">

	<script src="/assets/modules/main/app.js"></script>
	<script src="/assets/modules/main/config.js"></script>
	<script src="/assets/modules/main/directives.js"></script>

</head>
<body>
<div class="container" ng-controller="Container">
	<!--[if lt IE 7]>
	<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
		your browser</a> to improve your experience.</p>
	<![endif]-->

	@include('frontend::header')

	<div style="width:100px;height:100px;background: #FF9900;" ng-click="click()"></div>

	<div ui-view="header"></div>
	<div ui-view="content"></div>

	<hr>

	<footer>
		<p>&copy; 2013 Boris Strahija, Creo</p>
	</footer>
</div>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
	(function (b, o, i, l, e, r) { b.GoogleAnalyticsObject = l; b[l] || (b[l] = function () {
		(b[l].q = b[l].q || []).push(arguments) });
		b[l].l = +new Date; e = o.createElement(i); r = o.getElementsByTagName(i)[0]; e.src = '//www.google-analytics.com/analytics.js';
		r.parentNode.insertBefore(e, r) }(window, document, 'script', 'ga')); ga('create', 'UA-XXXXX-X'); ga('send', 'pageview');
</script>
</body>
</html>