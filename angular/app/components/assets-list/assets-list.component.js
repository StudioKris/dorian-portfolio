class AssetsListController {
    constructor($scope, $state, $window, API) {
        'ngInject'
        this.API = API
        this.$state = $state
        this.assets = undefined
        this.flow = {}

        this.assetsService = this.API.service('assets')

        $scope.flowOptions = {
            target: '/api/assets/upload',
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

        this.reloadAsset();
    }

    reloadAsset() {
        this.assetsService.getList().then((response) => {
            this.assets = response.plain()
        })
    }

    onUploadComplet() {
        this.flow.cancel();
        this.reloadAsset();
    }

    delete(assetId) {
        let API = this.API
        let me = this;
        let $state = this.$state

        swal({
            title: 'Are you sure?',
            text: 'You will not be able to recover this data!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            API.one('assets', assetId).remove()
                .then(() => {
                    swal({
                        title: 'Deleted!',
                        text: 'Asset has been deleted.',
                        type: 'success',
                        confirmButtonText: 'OK',
                        closeOnConfirm: true
                    }, function() {
                        me.reloadAsset();
                    })
                })
        })
    }



    $onInit() {}
}

export const AssetsListComponent = {
    templateUrl: './views/app/components/assets-list/assets-list.component.html',
    controller: AssetsListController,
    controllerAs: 'vm',
    bindings: {}
}