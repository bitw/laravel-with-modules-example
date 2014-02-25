/**
 * Created by alexandr on 26.02.14.
 */

Main.config(function($stateProvider, $urlRouterProvider) {
	$urlRouterProvider.otherwise("/");
	$stateProvider
		.state('index', { url:'/',
			views: {
				'header' :{ templateUrl: 'signin',  controller: HeaderCtrl },
				'content':{ templateUrl: 'partials/main/content.html', controller: ContentCtrl }
			}
		}).state('install', { url:'/install',
			views: {
				'header' :{ templateUrl: 'partials/install/header.html',  controller: HeaderCtrl },
				'content':{ templateUrl: 'partials/install/content.html', controller: ContentCtrl }
			}
		});
});