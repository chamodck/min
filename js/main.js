/**
 * AngularJS Tutorial 1
 * @author Nick Kaye <nick.c.kaye@gmail.com>
 */

/**
 * Main AngularJS Web Application
 */

var app = angular.module('tutorialWebApp', ['ngRoute','uiGmapgoogle-maps','ngResource','ui.bootstrap']);

/**
 * Configure the Routes
 */


app.config(['$routeProvider', function ($routeProvider, $routeParams) {
 
  $routeProvider
    // Home
    .when("/", {templateUrl: "partials/home.php", controller: "homeCtrl"})
    // Pages
    .when("/about", {templateUrl: "partials/about.html", controller: "aboutCtrl"})
    .when("/trip/:trip_id", {templateUrl: "partials/trip.html", controller: "tripCtrl"})
    .when("/pricing", {templateUrl: "partials/pricing.html", controller: "PageCtrl"})
    .when("/users", {templateUrl: "partials/users.php", controller: "UserCtrl"})
    .when("/trips", {templateUrl: "partials/trips.html", controller: "tripsCtrl"})
    // Blog
    .when("/change_password/:user_id/:code", {templateUrl: "partials/password_change.html", controller: "passwordChangeCtrl"})
    .when("/blog", {templateUrl: "partials/blog.html", controller: "BlogCtrl"})
    .when("/blog/post", {templateUrl: "partials/blog_item.html", controller: "BlogCtrl"})
    .when("/welcome", {templateUrl: "partials/welcome.html", controller: "WelcomeCtrl"})
    .when("/404", {templateUrl: "partials/404.html", controller: "PageCtrl"})
    .when("/forgot_password", {templateUrl: "partials/forgot_password.html", controller: "ForgotPasswordCtrl"});
    // else 404
    //.otherwise("/404", {templateUrl: "partials/404.html", controller: "PageCtrl"});
}

],

['uiGmapGoogleMapApiProvider', function(uiGmapGoogleMapApiProvider) {
    uiGmapGoogleMapApiProvider.configure({
            key: 'AIzaSyBhSKzfElSK1IBSQgF1kGr2Iv6-JqeVUUA',
        v: '3.20', //defaults to latest 3.X anyhow
        libraries: 'weather,geometry,visualization'
    });
}]

);

//controls the home
app.controller('homeCtrl', function ($scope, $window, $http) {
  $(document).ready(function(){
      $('.slider').slider({full_width: true});
    });
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

  $scope.forgotPassword=function(){
    $scope.success="";

    $scope.fail="";
    $scope.url='./php/forgot_password.php';
      $http.post($scope.url,{ "email" : $scope.forgotemail}).
      success(function(data) {
        if(data=="0"){
           $scope.fail="There is no account for this email.";
        }else if(data=="1"){
          $scope.success="Password change link was sent to your email.";
        }else if(data=="2"){
          $scope.fail="Email send failed.";
        }else{
          $scope.fail="Request failed,Try again.";
        }
        }).error(function(data) {
           $location.path('/404');
        });
  }
});

/**
 * Controls the Blog
 */
app.controller('tripCtrl', function ($scope,$routeParams,$http,$route,$window) {
  var trip_id=$routeParams.trip_id;
  
  var array;
    $scope.url = './php/getTripPath.php';//get lat ,lon for trip
    $http.post($scope.url,{"trip_id":trip_id}).
      success(function(data) {
        array=data.table;
        var mapOptions = {
        zoom: 9,
        center: new google.maps.LatLng(array[0].lat,array[0].lon),
        mapTypeId: google.maps.MapTypeId.TERRAIN
        }

        $scope.map = new google.maps.Map(document.getElementById('tripmap'), mapOptions);

        var myTripPath=[];
        var image = {url: 'http://icons.iconarchive.com/icons/aha-soft/transport/32/sailing-ship-icon.png'};
        var fish = {url: 'http://icons.iconarchive.com/icons/iconsmind/outline/32/Shark-icon.png'};
        

        for(var i=0;i<array.length;i++){
          
          var a=new google.maps.LatLng(array[i].lat,array[i].lon);
          if(array[i].image>0){
            var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({position: a,icon:fish,map: $scope.map,animation:google.maps.Animation.BOUNCE});
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
              return function() {
                var t = array[i].datetime.split(" ");
                var content='<div class="card" style="width:200px;height:auto"><div class="card-image waves-effect waves-block waves-light"><img class="activator" src="img/bycatch/'+array[i].tripid+'/'+array[i].image+'.jpg" title="more" style="width:100%"></div><span class="card-title activator grey-text text-darken-4">'+array[i].fishname+'<i class="material-icons right">more_vert</i></span><div class="card-reveal"><span class="card-title grey-text text-darken-4">'+array[i].fishname+'<i class="material-icons right">close</i></span><i class="fa fa-calendar"></i> '+t[0]+'</br><i class="fa fa-clock-o"></i>'+t[1]+'</br>Weight (kg) : '+array[i].weight+'</br>Length : '+array[i].length+'</div></div>';
                
                infowindow.setContent(content);
                infowindow.open($scope.map, marker);
              }
            })(marker, i));
            
          }else{
            var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({position: a,icon:image,map: $scope.map});
            google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
              return function() {
                var t = array[i].datetime.split(" ");
                
                infowindow.setContent("<i class='fa fa-calendar'></i> "+t[0]+"</br><i class='fa fa-clock-o'></i>"+t[1]);
                infowindow.open($scope.map, marker);
              }
            })(marker, i));
            google.maps.event.addListener(marker, 'mouseout', function() {
              infowindow.close();
            });
          }

          marker.setMap($scope.map);
          myTripPath.push(a);
        }
        var flightPath=new google.maps.Polyline({
          path:myTripPath,
          strokeColor:"#000000",
          strokeOpacity:0.8,
          strokeWeight:2,
          icons: [{
                    icon: {
                        path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW
                    },
                    offset: '25px',
                    repeat: '100px'
                }]
        });

        flightPath.setMap($scope.map);
        
    }).error(function(data) {
        console.log("Request fail.");
    });
    
});

app.controller('tripsCtrl', function ($scope,$http,$window) {
  console.log("trip");
  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
  $(document).ready(function() {
    $('select').material_select();
  });

  loadTripTable();
  setInterval(loadTripTable, 3000);
  $scope.currentPage=1;
    function loadTripTable() {
      
      $scope.url = './php/getTripList.php';//get users for load user table
      $http.get($scope.url).
      success(function(data) {
        $scope.predicate = 'name';  
         $scope.reverse = true;  
         //$scope.currentPage = 1;  
         $scope.order = function (predicate) {  
           $scope.reverse = ($scope.predicate === predicate) ? !$scope.reverse : false;  
           $scope.predicate = predicate;  
         };

        $scope.trips=data.table;

         $scope.totalItems = $scope.trips.length;  
         $scope.numPerPage = 10;  
         $scope.paginate = function (value) {  
           var begin, end, index;  
           begin = ($scope.currentPage - 1) * $scope.numPerPage;  
           end = begin + $scope.numPerPage;  
           index = $scope.trips.indexOf(value);  
           return (begin <= index && index < end);  
         };

      }).error(function(data) {
        $scope.tableState="Request fail.";
      });
    }

    $scope.loadTrip =function(trip_id){
      $window.location='#/trip/'+trip_id;
    }

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
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal({
      dismissible: false, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      in_duration: 300, // Transition in duration
      out_duration: 200, // Transition out duration
    });
    //$scope.names = ["Emil", "Tobias", "Linus"];
    loadTable();
  });
   
   setInterval(loadTable, 3000);
    $scope.currentPage=1;
    function loadTable() {
      $scope.url = './php/getUsers.php';//get users for load user table
      $http.get($scope.url).
      success(function(data) {
        $scope.predicate = 'name';  
         $scope.reverse = true;  
         //$scope.currentPage = 1;  
         $scope.order = function (predicate) {  
           $scope.reverse = ($scope.predicate === predicate) ? !$scope.reverse : false;  
           $scope.predicate = predicate;  
         };

        $scope.users=data.table;

         $scope.totalItems = $scope.users.length;  
         $scope.numPerPage = 10;  
         $scope.paginate = function (value) {  
           var begin, end, index;  
           begin = ($scope.currentPage - 1) * $scope.numPerPage;  
           end = begin + $scope.numPerPage;  
           index = $scope.users.indexOf(value);  
           return (begin <= index && index < end);  
         };
      }).error(function(data) {
        $scope.tableState="Request fail.";
      });
    }


  //This is method of singup.
  $scope.signup = function() {
   // $('#modalNewUser').openModal();
    $scope.fail =""; 
    $scope.success ="";
  	$scope.url = './php/checkEmail.php';
    $http.post($scope.url,{ "email":$scope.email}).
    success(function(data) {
    
      if(data=="0"){
        $scope.emailError ="Email already exist."; 
        $('#modalNewUser').openModal();
      }else{
          $scope.url = './php/signup.php';
          $http.post($scope.url,{ "email":$scope.email,"fname":$scope.fname,"lname":$scope.lname,"password":$scope.password,"usertype":document.getElementById("usertype").value,"telephone":$scope.telephone}).
          success(function(data) {
          
            if(data=="0"){
              $scope.fail ="User Registration failed"; 

            }else if(data=="1"){
              //$('#modal1').closeModal();
              $scope.success ="User Registration successful";

            }else{
              $scope.success ="User Registration successful,Email send failed(Send it manualy)";
            }
          }).error(function(data) {
              $scope.fail = "Request fail..";    
            });
      }
    }).error(function(data) {
      $scope.fail = "Request fail.";    
    });
//bellow name is text field name. WE call singp.php file in heare
  };

  $scope.editModal=function(id){
    //$scope.fail1 =""; 
    //$scope.success1 ="";
    $scope.url='./php/get_user_for_id.php';
      $http.post($scope.url,{ "id" : id }).
      success(function(data) {
        $scope.editfname=data.fname;
        $scope.editlname=data.lname;
        $scope.editemail=data.email;
        $scope.editcontact=data.contact_no;
        //$scope.usertype="gfdg";
        $scope.hiddenid=id;
        document.getElementById('editusertype').value = data.type;
        console.log(data.type);
        $('#userEditModal').openModal();
      }).error(function(data) {
        $location.path('/404');
      });
  }

  $scope.updateUser=function(){
    $scope.fail1 =""; 
    $scope.success1 ="";

    $scope.url='./php/updateUser.php';
      $http.post($scope.url,{ "id" : $scope.hiddenid,"fname":$scope.editfname,"lname":$scope.editlname,"usertype":document.getElementById("editusertype").value,"telephone":$scope.editcontact}).
      success(function(data) {
        if(data=="1"){
          $scope.success1 ="Successfully updated";
        }else{
          $scope.fail1 ="Request Failed,Try again";
        }
        //$('#userEditModal').openModal();
      }).error(function(data) {
        $scope.fail1 ="Request Failed,Try again";
      });
  }
  
});

app.controller('Ctrl', function ($scope, $window, $http) {
    //$scope.a="dgfd";
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

app.controller('passwordChangeCtrl', function($scope,$routeParams,$http,$location,$window) {
  
  var user_id=$routeParams.user_id;
  var type="",email="",fname="";

  start();

  function start(){
    if( $routeParams.code != ""){
      $scope.url='./php/get_user_for_id.php';
      $http.post($scope.url,{ "id" : $routeParams.user_id }).
      success(function(data) {
        if(data.password_change_code!=$routeParams.code){
          $location.path('/404');
          //$window.location='#/404';
        }else{
          //set parameters values,
          type=data.type;
          email=data.email;
          fname=data.fname;

          $scope.url='./php/remove_password_code.php';
          $http.post($scope.url,{ "id" : $routeParams.user_id }).
          success(function(data) {
            if(data=="0"){
               $location.path('/404');
            }
          }).error(function(data) {
             $location.path('/404');
          });
        }
      }).error(function(data) {
        $location.path('/404');
      });
    }else{
      $location.path('/404');
    }
  }
  
  $scope.changePassword=function(){
    $scope.message='';
    if($scope.new_password==$scope.new_password_again){
      $scope.url='./php/password_change.php';
          $http.post($scope.url,{ "id" : $routeParams.user_id,"password":$scope.new_password,"type":type,"email":email,"fname":fname}).
          success(function(data) {
            if(data=="1"){
              if(type =='Scientific Observer'){
                $location.path('/welcome');
                //$scope.message=1;
              }else{
                $window.location='#/';
                //$scope.message=2;
              }
            }else{
               $location.path('/404');
               //$scope.message=3;
            }
          }).error(function(data) {
            //$scope.message=4;
             $location.path('/404');
          });
    }else{
      $scope.message='Passwords do not match';
    }
  }

});

app.controller('ForgotPasswordCtrl', function ($scope,$location,$http) {
  
});

app.controller('aboutCtrl', function ($scope) {
  var map;
  var qtrArray = [];
  var linesArray = [];
  var Startlatlng;
  var llOffset = 1;//0.0666666666666667;

  var drawGridBox = false;
  var gridline;
  var polylinesquare;
  var latPolylines = [];
  var lngPolylines = [];
  var bounds = new google.maps.LatLngBounds();
  init();
  function init(){
  map = new google.maps.Map(document.getElementById('gridmap'), {
        center: new google.maps.LatLng(8, 81),
        zoom: 7,
        streetViewControl: true,
        mapTypeId: google.maps.MapTypeId.TERRAIN,
        scaleControl: true
    });

    var oLat = 8;
    var oLon = 81;

    var gridlocator = [new google.maps.LatLng(oLat, oLon)];

    google.maps.event.addListener(map, 'click', function (event) {


        /*                  google.maps.event.addListener(map, 'bounds_changed', DrawLine); */

        // var eventPos = mArray.getPosition();

        createGridBox(event.latLng);
    });
    DrawGridOn();
    google.maps.event.addListener(map, 'bounds_changed', function () {
        createGridLines(map.getBounds());
    });
  }
  function DrawGridOn() {
      drawGridBox = true;
  }

  function DrawGridOff() {
      drawGridBox = false;
  }


  function ClearLastGrid() {
      polyline.setMap(null);
  }

  function createGridLines(bounds) {
      for (var i=0; i< latPolylines.length; i++) {
              latPolylines[i].setMap(null);
      }
      latPolylines = [];
      for (var i=0; i< lngPolylines.length; i++) {
              lngPolylines[i].setMap(null);
      }
      lngPolylines = [];
      if (map.getZoom() <= 6) return; 
      var north = bounds.getNorthEast().lat();
      var east = bounds.getNorthEast().lng();
      var south = bounds.getSouthWest().lat();
      var west = bounds.getSouthWest().lng();

      // define the size of the grid
      var topLat = Math.ceil(north / llOffset) * llOffset;
      var rightLong = Math.ceil(east / llOffset) * llOffset;

      var bottomLat = Math.floor(south / llOffset) * llOffset;
      var leftLong = Math.floor(west / llOffset) * llOffset;

      for (var latitude = bottomLat; latitude <= topLat; latitude += llOffset) {
          // lines of latitude
          latPolylines.push(new google.maps.Polyline({
              path: [
              new google.maps.LatLng(latitude, leftLong),
              new google.maps.LatLng(latitude, rightLong)],
              map: map,
              geodesic: true,
              strokeColor: '#0000FF',
              strokeOpacity: 0.5,
              strokeWeight: 1
          }));
      }
      for (var longitude = leftLong; longitude <= rightLong; longitude += llOffset) {
          // lines of longitude
          lngPolylines.push(new google.maps.Polyline({
              path: [
              new google.maps.LatLng(topLat, longitude),
              new google.maps.LatLng(bottomLat, longitude)],
              map: map,
              geodesic: true,
              strokeColor: '#0000FF',
              strokeOpacity: 0.5,
              strokeWeight: 1
          }));
      }
  }

  function createGridBox(point) {
      // Square limits
      var bottomLeftLat = Math.floor(point.lat() / llOffset) * llOffset;
      var bottomLeftLong = Math.floor(point.lng() / llOffset) * llOffset;

      var i;

      var gridLineSquare = [
      new google.maps.LatLng(bottomLeftLat, bottomLeftLong), //lwr left
      new google.maps.LatLng(bottomLeftLat, bottomLeftLong + llOffset), //lwr right
      new google.maps.LatLng(bottomLeftLat + llOffset, bottomLeftLong + llOffset), //upr right
      new google.maps.LatLng(bottomLeftLat + llOffset, bottomLeftLong),
      new google.maps.LatLng(bottomLeftLat, bottomLeftLong)];


      for (i = 0; i < gridLineSquare.length; i++) {
          bounds.extend(gridLineSquare[i]);
      }

      // external.getData(event.latLng);
      if (drawGridBox == true) {
          polyline = new google.maps.Polyline({
              path: gridLineSquare,
              geodesic: true,
              strokeColor: '#0000FF',
              strokeOpacity: 0.5,
              strokeWeight: 1
          });

          polyline.setMap(map);
          qtrArray.push(polyline);
      }
  }
  
});