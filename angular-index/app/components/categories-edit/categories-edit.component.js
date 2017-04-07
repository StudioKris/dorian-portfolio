class CategoriesEditController {
    constructor($scope, $window, $stateParams, $state, API) {
        'ngInject';

        this.API = API
        this.$state = $state
        this.$scope = $scope
        this.formSubmitted = false
        this.alerts = []
        this.assets = undefined
        this.flow = {}
        this.category = {}

        this.categoriesService = API.all('categories')


        this.categoryId = $stateParams.categoryId

        $scope.flowOptions = {
            target: '/api/categories/upload/' + this.categoryId,
            permanentErrors: [500, 501],
            maxChunkRetries: 1,
            chunkRetryInterval: 5000,
            simultaneousUploads: 4,
            progressCallbacksInterval: 1,
            withCredentials: true,
            headers: {
                Authorization: 'Bearer ' + $window.localStorage.satellizer_token
            }
        };

        let assetsService = API.service('assets')
        assetsService.getList().then((response) => {
            this.assets = response.plain()
        })

        if ($stateParams.alerts) {
            this.alerts.push($stateParams.alerts)
        }

        this.reloadCategory();
    }

    reloadCategory() {
        this.categoriesService.one(this.categoryId).get()
            .then((response) => {
                this.category = this.API.copy(response)
            })
    }


    save(isValid) {
        if (isValid) {
            let $state = this.$state
            this.category.put()
                .then(() => {
                    let alert = {
                        type: 'success',
                        'title': 'Success!',
                        msg: 'Category has been updated.'
                    }
                    $state.go($state.current, {
                        alerts: alert
                    })
                }, (response) => {
                    let alert = {
                        type: 'error',
                        'title': 'Error!',
                        msg: response.data.message
                    }
                    $state.go($state.current, {
                        alerts: alert
                    })
                })
        } else {
            this.formSubmitted = true
        }
    }

    onUploadComplet() {
        this.flow.cancel();
        this.categoriesService.one(this.categoryId).get()
            .then((response) => {
                let category = this.API.copy(response);
                this.category.data.icon = category.data.icon + '?' + new Date().getTime();
            })
    }

    $onInit() {}
}

export const CategoriesEditComponent = {
    templateUrl: './views/app/components/categories-edit/categories-edit.component.html',
    controller: CategoriesEditController,
    controllerAs: 'vm',
    bindings: {}
}