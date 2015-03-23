var Starterapp = angular.module('Starterapp', [
 'ngRoute',
  'StarterController',
  'ui.bootstrap',
  'starterServices'
//  'phonecatFilters',
//  'phonecatServices',
//  'phonecatAnimations'
]);
Starterapp.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/list', {
        templateUrl: 'template/list.html',
        controller: 'Index'
      }).
   
      otherwise({
        redirectTo: '/list'
      });
  }]);
//Starterapp.config(['$httpProvider', function($httpProvider) {
//    $httpProvider.defaults.withCredentials = true;
//    $httpProvider.defaults.useXDomain = true;
//    delete $httpProvider.defaults.headers.common['X-Requested-With'];
//
//    }
//]);

Starterapp.factory('DataSore', function() {  
	return {
		data: {}
	};
});
var  StarterController =angular.module('StarterController',[]);
StarterController.controller('Action',['$scope','News',function($scope,News){
      
   $scope.saveNews =function(val){
     
      console.log(val);

      News.save({datas:val});
     // DataSore.data.push({"id":20,"title":"create","post":"news","show":1,"valid":1,"created_at":"2015-01-27 23:22:24","updated_at":"2015-01-27 23:22:24"});
//      $scope.items = News.query();
     // $scope.$apply();
     
  }; 
      
}]);
  

StarterController.controller('Index',['$scope','DataSore','News',function($scope,DataSore,News){
    
    $scope.title="hello";
    DataSore.data =News.query();
    $scope.items = DataSore.data;
  

    
      
  //$scope.hide=true;
   $scope.showbar =function(news){
     
      
       if(news.id === news.id){
                 $scope.status= true;
      
       }
     //  return false;
   };
    $scope.closebar =function(val){
        $scope.status=false;
       
   };
   $scope.update = true;
   $scope.isCollapsed = true;
   $scope.checkModel = {
    left: false,
    middle: true,
   
  };
  $scope.deletePost  = function(val){
      News.url="validate";
      News.delete({id:val});
     
  };
  

}]);

