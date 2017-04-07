class PortfolioHeaderController{
    constructor(Portfolio){
        'ngInject';

        this.Portfolio = Portfolio
    }

    $onInit(){
    }
}

export const PortfolioHeaderComponent = {
    templateUrl: './views/app/components/portfolio-header/portfolio-header.component.html',
    controller: PortfolioHeaderController,
    controllerAs: 'vm',
    bindings: {}
}
