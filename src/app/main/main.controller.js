class MainController {
  constructor ($timeout, webDevTec, toastr, gallery) {
    'ngInject';

    this.awesomeThings = [];
    this.galleries = [];
    this.classAnimation = '';
    this.creationDate = 1438525681651;
    this.toastr = toastr;

    this.activate($timeout, webDevTec);
    this.activate($timeout, gallery);
  }

  activate($timeout, gallery) {
    this.getGalleries(gallery);
    $timeout(() => {
      this.classAnimation = 'rubberBand';
    }, 4000);
  }

  getGalleries(gallery) {
    this.galleries = gallery.getGalleries();
  }

  activate($timeout, webDevTec) {
    this.getWebDevTec(webDevTec);
    $timeout(() => {
      this.classAnimation = 'rubberBand';
    }, 4000);
  }

  getWebDevTec(webDevTec) {
    this.awesomeThings = webDevTec.getTec();

    angular.forEach(this.awesomeThings, (awesomeThing) => {
      awesomeThing.rank = Math.random();
    });
  }

  showToastr() {
    this.toastr.info('Fork <a href="https://github.com/Swiip/generator-gulp-angular" target="_blank"><b>generator-gulp-angular</b></a>');
    this.classAnimation = '';
  }
}

export default MainController;
