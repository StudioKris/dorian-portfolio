import {PortfolioService} from './services/portfolio.service';
import { APIService } from './services/API.service'

angular.module('app.services')
  .service('Portfolio', PortfolioService)
  .service('API', APIService)
