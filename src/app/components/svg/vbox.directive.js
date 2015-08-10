class VBoxDirective {
  constructor() {
    'ngInject';

    let directive = {
      link: function(scope, element, attrs) {
        attrs.$observe('vbox', function(value) {
          element.get(0).setAttribute("viewBox", value);
        });
      }
    };

    return directive;
  }
}


export default VBoxDirective;