class CategoriesViewController{
    constructor(Portfolio){
        'ngInject';

        this.Portfolio = Portfolio
        
    }

    $onInit(){
    }
}

export const CategoriesViewComponent = {
    templateUrl: './views/app/components/categories-view/categories-view.component.html',
    controller: CategoriesViewController,
    controllerAs: 'vm',
    bindings: {}
}
