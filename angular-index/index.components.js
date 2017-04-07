import {PortfolioFooterComponent} from './app/components/portfolio-footer/portfolio-footer.component';
import {PortfolioHeaderComponent} from './app/components/portfolio-header/portfolio-header.component';
import {CategoriesViewComponent} from './app/components/categories-view/categories-view.component';

angular.module('app.components')
	.component('portfolioFooter', PortfolioFooterComponent)
	.component('portfolioHeader', PortfolioHeaderComponent)
	.component('categoriesView', CategoriesViewComponent)