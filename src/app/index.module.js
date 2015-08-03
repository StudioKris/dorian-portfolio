/* global toastr:false, moment:false */
import config from './index.config';

import routerConfig from './index.route';

import runBlock from './index.run';
import MainController from './main/main.controller';
import GithubContributorService from '../app/components/githubContributor/githubContributor.service';
import WebDevTecService from '../app/components/webDevTec/webDevTec.service';
import GalleryService from '../app/components/gallery/gallery.service';
import NavbarDirective from '../app/components/navbar/navbar.directive';

angular.module('dorianPortfolio', ['ngAnimate', 'ngCookies', 'ngTouch', 'ngSanitize', 'ngResource', 'ui.router'])
  .constant('toastr', toastr)
  .constant('moment', moment)
  .config(config)

  .config(routerConfig)

  .run(runBlock)
  .service('githubContributor', GithubContributorService)
  .service('webDevTec', WebDevTecService)
  .service('gallery', GalleryService)
  .controller('MainController', MainController)
  .directive('acmeNavbar', () => new NavbarDirective());
