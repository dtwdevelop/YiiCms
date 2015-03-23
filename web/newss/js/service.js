var starterServices = angular.module('starterServices', ['ngResource']);

starterServices.factory('News', ['$resource',
  function($resource){
    return $resource('http://apps.lv/articles', {}, {
      query: {method:'GET', params:{articles:1}, isArray:true},
       save: {method:'POST', params:{}, },
      //  params: {id: '@id', action: '@action'}
       delete:{method:'DELETE',action:"smike" ,url: 'http://apps.lv/articles/:id/'}
    });
  }]);


