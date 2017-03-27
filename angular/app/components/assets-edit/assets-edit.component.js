class AssetsEditController{
    constructor($stateParams, $state, API){
        'ngInject';

    this.$state = $state
    this.formSubmitted = false
    this.alerts = []

    if ($stateParams.alerts) {
      this.alerts.push($stateParams.alerts)    }


    let assetId = $stateParams.assetId
    let assetsService = API.all('assets')
    assetsService.one(assetId).get()
      .then((response) => {
        this.asset = API.copy(response)
      })

    }

    save (isValid) {
        if (isValid) {
          let $state = this.$state
          this.asset.put()
            .then(() => {
              let alert = { type: 'success', 'title': 'Success!', msg: 'Asset has been updated.' }
              $state.go($state.current, { alerts: alert})
            }, (response) => {
              let alert = { type: 'error', 'title': 'Error!', msg: response.data.message }
              $state.go($state.current, { alerts: alert})
            })
        } else {
          this.formSubmitted = true
        }
      }

    $onInit(){
    }
}

export const AssetsEditComponent = {
    templateUrl: './views/app/components/assets-edit/assets-edit.component.html',
    controller: AssetsEditController,
    controllerAs: 'vm',
    bindings: {}
}
