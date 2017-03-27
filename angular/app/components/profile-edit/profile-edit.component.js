class ProfileEditController{
    constructor($scope, $window, $stateParams, $state, API){
        'ngInject';

        this.API = API
        this.$state = $state
        this.$scope = $scope
        this.formSubmitted = false
        this.alerts = []
        this.flow = {}
        this.profile = {}

        this.profileService = API.all('profile')

        $scope.flowOptions = {
            target: '/api/profile/upload/',
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

        if ($stateParams.alerts) {
            this.alerts.push($stateParams.alerts)
        }

        this.reloadProfile();
    }

    reloadProfile() {
        this.profileService.one('1').get()
            .then((response) => {
                this.profile = this.API.copy(response)
            })
    }


    save(isValid) {
        if (isValid) {
            let $state = this.$state
            this.profile.put()
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
        this.profileService.one('1').get()
            .then((response) => {
                let profile = this.API.copy(response);
                this.profile.data.icon = profile.data.icon + '?' + new Date().getTime();
            })
    }

    $onInit(){
    }
}

export const ProfileEditComponent = {
    templateUrl: './views/app/components/profile-edit/profile-edit.component.html',
    controller: ProfileEditController,
    controllerAs: 'vm',
    bindings: {}
}
