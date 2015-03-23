App = Ember.Application.create({
     LOG_TRANSITIONS: true, 
//     LOG_TRANSITIONS_INTERNAL: true
});

App.Router.map(function() {
   this.resource("news", function(){
   
  });
   this.route('index', { path: '/' });
   this.route("item", { path: "/item/:id" });
   this.route("edit", { path: "/edit/:id" });
   
});


var attr = DS.attr;
App.News = DS.Model.extend({
  //  id:  attr(),
  parent_id: attr(),
  title: attr('string'),
  about:attr(),
//  url: attr(),
//  meta:attr(),
//  meta_tags:attr(),
//  view:attr(),
//  pos:attr(),
//  show:attr(),
//  created:attr()
 
});

//App.News.FIXTURES = [
// {
//   id: 1,
//   title: 'Learn Ember.js',
//   about:'ember'
// },
// {
//   id: 2,
//   title: 'Come',
//  about:'About all'
// },
// {
//   id: 3,
//   title: 'Profit!',
//  about:'welldone'
// }
//];

App.ApplicationAdapter = DS.FixtureAdapter.extend();

App.ApplicationAdapter = DS.RESTAdapter.extend({
  
   host: 'http://sitedev.lv'

});

App.IndexController = Ember.ArrayController.extend({
    //filteredContent
    //arrangedContent
    sortProperties: ['title','about'],
    sortAscending: true,
    isFilter:false,
    filter:'',
    //content: [],
     
   actions: {
   sort: function(property) {
      
        this.toggleProperty('sortAscending');
       this.set('sortProperties', [property]);
       //this.set('sortAscending', !this.get('sortAscending'));

      },
    change: function() {
       console.log(this.get('filter'));
     }
   
 },
  Filtertitle: function() {
      var result;
       if(this.get('filter') === '') result = this.get('arrangedContent');
       else{
           return this.get('arrangedContent').filterBy('title',this.get('filter'));
       }
//       var sortedResult = Ember.ArrayProxy.createWithMixins(
//        Ember.SortableMixin, 
//        { content:result, sortProperties: this.sortProperties }
//
//         );
//
//       return sortedResult;
       
     }.property('content.@each','filter')
   
});

App.IndexRoute = Ember.Route.extend({

model: function() {
      
    // return this.store.find('news');
      
      return this.store.find('news',{
  limit: 10,
  offset: 0
});


   }
});

App.ItemRoute = Ember.Route.extend({
    
  model: function(params) {
     

      
       return this.store.find('news',params.id);
   }
});

App.EditRoute = Ember.Route.extend({
  isAgree:false,
  isFlag:false,
   actions: {
   
    edit :function(){
       this.toggleProperty('isAgree');
    },
     show: function() {
       // alert('work');
       
      this.controller.set('isAgree',true);
     // this.transitionTo('index');
    }
},
  model: function(params) {
     return this.store.find('news',params.id);
   }
});
