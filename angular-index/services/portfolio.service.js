export class PortfolioService{
    constructor($rootScope, API){
        'ngInject';

    	this.API = API
    	this.$rootScope = $rootScope
    	this.categories = undefined
    	this.profile = undefined

        let categoriesService = API.service('categories')
        categoriesService.getList().then( (response) => 
            { 
                this.categories = response.plain()
            }
        )

        let profileService = API.service('profile')
        profileService.one('1').get().then( (response) => 
            { 
                this.profile = response.plain().data
            }
        )
    }
}

