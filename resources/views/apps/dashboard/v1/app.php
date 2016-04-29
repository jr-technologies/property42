<html ng-app="dashboard">
<head>

    <title>{{html_title}}</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link media="all" rel="stylesheet" href="<?= \App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version']) ?>/css/main.css">
	<link media="all" rel="stylesheet" href="<?= \App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version']) ?>/css/select2.css">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>

	<!-- Angularjs Libs -->
        <script src="<?= url('/') ?>/javascripts/firebase.js"></script>
        <script src="<?= url('/') ?>/javascripts/angular/angular.min.js"></script>
        <script src="<?= url('/') ?>/javascripts/angularfire.min.js"></script>
        <script src="<?= url('/') ?>/javascripts/angular-route/angular-route.min.js"></script>
        <script src="<?= url('/') ?>/javascripts/ui-router/angular-ui-router.min.js"></script>

        <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/models/Model.js"></script>
        <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/app.js"></script>
        <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/services/AuthService.js"></script>
        <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/services/RouteHelper.js"></script>
        <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/services/ResourceLoader.js"></script>
        <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/ParentController.js"></script>
        <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/LoginController.js"></script>
            <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/HeaderController.js"></script>
                <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/ContentContainerController.js"></script>
                    <!--        Custoemrs Controllers       -->
                    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/ContentHeaderController.js"></script>
                    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/ShowCustomersController.js"></script>
                    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/AddCustomersController.js"></script>

                    <!--        Users Controllers       -->
                    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/UserController.js"></script>

                    <!--        Home Controllers       -->
                    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/HomeController.js"></script>
        <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/routes.js"></script>


</head>
<body class="sideBar-active">
	<!-- main container of all the page elements -->

	<div class="" ng-controller="ParentController">
        <ui-view></ui-view>
    </div>

	<!-- include jQuery library -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" defer></script>
	<script type="text/javascript">window.jQuery || document.write('<script src="<?= \App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version']) ?>/js/jquery-1.11.2.min.js" defer><\/script>')</script>
	<script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version']) ?>/js/select2.full.js" defer></script>
	<!-- include custom JavaScript -->
	<script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version']) ?>/js/tabset-plugin.js" defer></script>
	<script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version']) ?>/js/helper.js" defer></script>
	<script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version']) ?>/js/add-propertyFrom.js" defer></script>
	<script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version']) ?>/js/dashboard.js" defer></script>
	<script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version']) ?>/js/jquery.main.js" defer></script>
</body>
</html>
