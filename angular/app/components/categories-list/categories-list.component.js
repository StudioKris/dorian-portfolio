class CategoriesListController{
    constructor($scope, $state, $compile, DTOptionsBuilder, DTColumnBuilder, API){
        'ngInject';
        this.API = API
        this.$state = $state
        this.categories = undefined

        this.dtInstance = {};

        let categoriesService = API.service('categories')
        categoriesService.getList().then( (response) => 
            { 
                this.categories = response.plain()

                this.dtOptions = DTOptionsBuilder.newOptions()
                  .withOption('data', this.categories)
                  .withOption('createdRow', createdRow)
                  .withOption('responsive', true)
                  .withOption('aaSorting', [3, 'asc'])
                  .withBootstrap()

                this.dtColumns = [
                  //DTColumnBuilder.newColumn('id').withTitle('ID').notSortable(),
                  DTColumnBuilder.newColumn('name').withTitle('Name').notSortable(),
                  DTColumnBuilder.newColumn('description').withTitle('Description').notSortable(),
                  DTColumnBuilder.newColumn('assetsCount').withTitle('Assets').notSortable(),
                  DTColumnBuilder.newColumn('position').withTitle('Position').notSortable(),
                  DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
                    .renderWith(actionsHtml)
                ]

                this.displayTable = true
            } 
        )

        let createdRow = (row) => {
          $compile(angular.element(row).contents())($scope)
        }

        let actionsHtml = (data) => {
          return `
                    <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-info" ng-click="vm.increase(${data.id})"><i class="fa fa-arrow-down"></i></button>
                      <button type="button" class="btn btn-xs btn-info" ng-click="vm.decrease(${data.id})"><i class="fa fa-arrow-up"></i></button>
                    </div>
                    &nbsp
                    <a class="btn btn-xs btn-warning" ui-sref="app.categoriesedit({categoryId: ${data.id}})">
                        <i class="fa fa-edit"></i>
                    </a>
                    &nbsp
                    <button class="btn btn-xs btn-danger" ng-click="vm.delete(${data.id})">
                        <i class="fa fa-trash-o"></i>
                    </button>`
        }
    }

    delete (categoryId) {
    let API = this.API
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
    }, function () {
      API.one('categories', categoryId).remove()
        .then(() => {
          swal({
            title: 'Deleted!',
            text: 'Category has been deleted.',
            type: 'success',
            confirmButtonText: 'OK',
            closeOnConfirm: true
          }, function () {
            $state.reload()
          })
        })
    })
  }

      increase (categoryId) {
        let API = this.API
        let $state = this.$state
        let $scope = this.$scope
        let me = this

        let dtInstance = this.dtInstance

        let categoriesService = API.all('categories')
        categoriesService.one(categoryId.toString()).get()
          .then((response) => {
            let category = API.copy(response)
            category.data.position = '+';
            category.put()
            .then(() => {
              $state.reload()
            })
          })
      }
      

      decrease (categoryId) {
        let API = this.API
        let $state = this.$state
        let $scope = this.$scope

        let dtInstance = this.dtInstance

        let categoriesService = API.all('categories')
        categoriesService.one(categoryId.toString()).get()
          .then((response) => {
            let category = API.copy(response)
            category.data.position = '-';
            category.put()
            .then(() => {
            $state.reload()
            })
          })
        }

    $onInit(){
    }
}

export const CategoriesListComponent = {
    templateUrl: './views/app/components/categories-list/categories-list.component.html',
    controller: CategoriesListController,
    controllerAs: 'vm',
    bindings: {}
}
