var app = angular.module('portfolioAdmin', ['ngUpload']);

app.controller('AppCtrl', function($scope, $http) {

  $scope.data = {};
  $scope.notChange = true;
  $scope.uploadError = false;
  $scope.deletedMedia = [];

  $scope.getData = function() {
    $http({
      method: 'GET',
      url: 'data.php',
      data: $scope.data
    }).
    success(function(data, status, headers, config) {
      $scope.data = data;
    }).
    error(function(data, status, headers, config) {
      // called asynchronously if an error occurs
      // or server returns response with an error status.
    });
  };
  $scope.saveData = function() {
    if ($scope.notChange == false) {
      $http({
        method: 'POST',
        url: 'data.php',
        data: $scope.data
      }).
      success(function(data, status, headers, config) {
        $scope.notChange = true;
        if ($scope.deletedMedia.lenght > 0) {
          $http({
            method: 'POST',
            url: 'delete.php',
            data: $scope.deletedMedia
          }).
          success(function(data, status, headers, config) {
            $scope.deletedMedia = [];
          });
        }
      }).error(function(data, status, headers, config) {
        // called asynchronously if an error occurs
        // or server returns response with an error status.
      });
    }
  };


  $scope.addCategory = function() {
    $scope.data.categories.push({
      name: $scope.newCategoryName
    });
    $scope.newCategoryName = '';
    $scope.notChange = false;
  };
  $scope.removeCategory = function(item) {
    var index = $scope.data.categories.indexOf(item);
    $scope.data.categories.splice(index, 1);
    $scope.notChange = false;
  };
  $scope.addCategoryMedia = function(category, media, row, column) {
    if (typeof category.items == 'undefined') {
      category.items = [];
    }
    category.items.push({
      media: media,
      row: row,
      column: column
    });
    $scope.notChange = false;
  };
  $scope.removeCategoryItem = function(category, item) {
    var index = category.items.indexOf(item);
    category.items.splice(index, 1);
    $scope.notChange = false;
  };

  $scope.addMedia = function(content, completed) {
    if (completed && content) {
      $scope.response = content;
      if ($scope.response.error == 0) {
        $scope.data.medias.push({
          name: $scope.response.name,
          path: $scope.response.path,
        });
        $scope.name = '';
        $scope.notChange = false;
        $scope.uploadError = false;
      } else {
        $scope.uploadError = true;
      }
    }
  };
  $scope.removeMedia = function(item) {
    var index = $scope.data.medias.indexOf(item);
    $scope.deletedMedia.push(item);
    $scope.data.medias.splice(index, 1);
    $scope.notChange = false;
  };

  $scope.getData();
});