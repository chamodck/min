/**
 * AngularJS Tutorial 1
 * @author Nick Kaye <nick.c.kaye@gmail.com>
 */

/**
 * Main AngularJS Web Application
 */
var app = angular.module('tutorialWebApp', ['ngRoute']);

/**
 * Configure the Routes
 */
app.config(['$routeProvider', function ($routeProvider) {
  $routeProvider
    // Home
    .when("/", {templateUrl: "partials/home.php", controller: "homeCtrl"})
    // Pages
    .when("/about", {templateUrl: "partials/about.html", controller: "PageCtrl"})
    .when("/faq", {templateUrl: "partials/faq.html", controller: "PageCtrl"})
    .when("/pricing", {templateUrl: "partials/pricing.html", controller: "PageCtrl"})
    .when("/users", {templateUrl: "partials/users.php", controller: "UserCtrl"})
    .when("/contact", {templateUrl: "partials/contact.html", controller: "PageCtrl"})
    // Blog
    .when("/blog", {templateUrl: "partials/blog.html", controller: "BlogCtrl"})
    .when("/blog/post", {templateUrl: "partials/blog_item.html", controller: "BlogCtrl"})
    // else 404
    .otherwise("/404", {templateUrl: "partials/404.html", controller: "PageCtrl"});
}]);

//controls the home
app.controller('homeCtrl', function ($scope, $window, $http) {
  $scope.url = './php/login.php'; // The url of our login
  // The function that will be executed on button click (ng-click="login()")
 
  $scope.login = function() {
  
  // Create the http post request
  // the data holds the keywords
  // The request is a JSON request.
  var x="0";
  if(document.getElementById("test5").checked){
    x="1";
  }

  $http.post($scope.url,{ "email" : document.getElementById("email").value ,"password":document.getElementById("password").value,"remember":x}).
  success(function(data) {

    if(data=="0"){
      $scope.message ="The Email and Password you entered,don't match."; 

    }else{
      $window.location='';//refresh
      //$scope.message =data; 
    }
  }).error(function(data) {
      $scope.message = "Request fail";    
    });
  };
});

/**
 * Controls the Blog
 */
app.controller('BlogCtrl', function (/* $scope, $location, $http */) {
  console.log("Blog Controller reporting for duty.");
});

/**
 * Controls all other Pages
 */
app.controller('PageCtrl', function (/* $scope, $location, $http */) {
  console.log("Page Controller reporting for duty.");

  // Activates the Carousel
  $('.carousel').carousel({
    interval: 5000
  });

  // Activates Tooltips for Social Links
  $('.tooltip-social').tooltip({
    selector: "a[data-toggle=tooltip]"
  })
});

//#######################This is user reg form part#############################

app.controller('UserCtrl', function ($scope,$location, $http) {
   $(document).ready(function() {
    $('select').material_select();  
    $('ul.tabs').tabs();

    $scope.url = './php/getUsers.php';//get users for load user table
      $http.get($scope.url).
      success(function(data) {
        $scope.users=data.table;

      }).error(function(data) {
        $scope.tableState="Request fail.";
      });
  });
   setInterval(loadTable, 3000);

    function loadTable() {
      $scope.url = './php/getUsers.php';//get users for load user table
      $http.get($scope.url).
      success(function(data) {
        $scope.users=data.table;

      }).error(function(data) {
        $scope.tableState="Request fail.";
      });
    }
  //This is method of singup.
  $scope.signup = function() {
  	$scope.url = './php/checkEmail.php';
    $http.post($scope.url,{ "email":$scope.email}).
    success(function(data) {
    
      if(data=="0"){
        $scope.emailError ="Email already exist."; 

      }else{
          $scope.url = './php/signup.php';
          $http.post($scope.url,{ "email":$scope.email,"fname":$scope.fname,"lname":$scope.lname,"password":$scope.password,"usertype":document.getElementById("usertype").value,"telephone":$scope.telephone}).
          success(function(data) {
          
            if(data=="0"){
              $scope.message ="User Registration is Failed"; 

            }else{
              $scope.message ="OK";
            }
          }).error(function(data) {
              $scope.message = "Request fail..";    
            });
      }
    }).error(function(data) {
      $scope.message = "Request fail.";    
    });
//bellow name is text field name. WE call singp.php file in heare
  };
});

app.controller('Ctrl', function ($scope, $window, $http) {
    $scope.a="dgfd";
    $('.dropdown-button').dropdown({
      inDuration: 300,
      outDuration: 225,
      constrain_width: false, // Does not change width of dropdown to that of the activator
      hover: true, // Activate on hover
      gutter: 0, // Spacing from edge
      belowOrigin: false, // Displays dropdown below the button
      alignment: 'right' // Displays dropdown with edge aligned to the left of button
    }
  );
});
