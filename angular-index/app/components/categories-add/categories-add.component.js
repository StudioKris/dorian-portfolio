class CategoriesAddController{
    constructor(API, $state, $stateParams){
        'ngInject';

    this.$state = $state
    this.formSubmitted = false
    this.API = API
    this.alerts = []

    if ($stateParams.alerts) {
      this.alerts.push($stateParams.alerts)
    }
    }

  save (isValid) {
    this.$state.go(this.$state.current, {}, { alerts: 'test' })
    if (isValid) {
      let Categories = this.API.service('categories')
      let $state = this.$state

      Categories.post({
        'name': this.name,
        'description': this.description,
        'position': this.position
      }).then(function () {
        let alert = { type: 'success', 'title': 'Success!', msg: 'Category has been added.' }
        $state.go($state.current, { alerts: alert})
      }, function (response) {
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

export const CategoriesAddComponent = {
    templateUrl: './views/app/components/categories-add/categories-add.component.html',
    controller: CategoriesAddController,
    controllerAs: 'vm',
    bindings: {}
}
