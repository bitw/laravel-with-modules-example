<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" id="ng-app" ng-app="App"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" id="ng-app" ng-app="App"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" id="ng-app" ng-app="App"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" id="ng-app" ng-app="App"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Form</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <!--link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css"-->
    <style>
        form.ng-valid {
            /* стили для формы прошедшей проверку */
        }
        form.ng-invalid {
            /* стили для формы не прошедшей проверку */
        }
        input.ng-valid {
            /* стиди для полей прошедших проверку */
            border: 1px solid grey;
        }
        input.ng-invalid {
            /* стиди для полей не прошедших проверку */
            border: 1px solid red;
        }
    </style>
</head>
<body class="container">
    <!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
        your browser</a> to improve your experience.</p>
    <![endif]-->
    <div ng-controller="ctrlHome"><div ng-view></div></div>
    <hr/>
    <div>Developed by <a href="http://wbtm.ru">wbtm.ru</a></div>
    <script src="http://code.angularjs.org/1.2.13/angular.min.js"></script>
    <script src="http://code.angularjs.org/1.2.13/angular-sanitize.min.js"></script>
    <script src="http://code.angularjs.org/1.2.13/angular-route.min.js"></script>
    <script src="<%asset('assets/js/app.js')%>"></script>
</body>
</html>
