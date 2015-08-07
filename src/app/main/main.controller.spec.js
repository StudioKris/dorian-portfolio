(function() {
  'use strict';

  describe('controllers', function(){

    beforeEach(module('dorianPortfolio'));

    it('should define more than 0 gallery', inject(function($controller) {
      var vm = $controller('MainController');

      expect(angular.isArray(vm.galleries)).toBeTruthy();
      expect(vm.galleries.length > 0).toBeTruthy();
    }));
  });
})();
