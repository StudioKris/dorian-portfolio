export function RoutesConfig ($stateProvider, $urlRouterProvider) {
  'ngInject'

  var getLayout = (layout) => {
    return `./views/app/pages/index/layout/${layout}.page.html`
  }

  $urlRouterProvider.otherwise('/')

  $stateProvider
    .state('app', {
      abstract: true,
      views: {
        'layout': {
          templateUrl: getLayout('layout')
        },
        main: {}
      },
      data: {
        bodyClass: ''
      }
    })
    .state('app.landing', {
      url: '/',
      data: {
        auth: true
      },
      views: {
        'main@app': {
          template: '<categories-view></categories-view>'
        }
      }
    })
}
