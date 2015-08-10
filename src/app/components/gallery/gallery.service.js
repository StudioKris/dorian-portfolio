class GalleryService {
  constructor () {
    'ngInject';

    this.data = [
      {
        'title': 'Gallery 1',
        'index': 0,
        'contents': [
          {
            'url': 'assets/images/1.jpg',
            'title': 'picture 1',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 0,
            'width': 800,
            'height': 894
          },
          {
            'url': 'assets/images/2.png',
            'title': 'picture 2',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 1,
            'width': 800,
            'height': 796
          },
          {
            'url': 'assets/images/6.jpg',
            'title': 'picture 6',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 2,
            'width': 600,
            'height': 900
          },
          {
            'url': 'assets/images/4.jpg',
            'title': 'picture 4',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 3,
            'width': 960,
            'height': 960
          }
        ]
      },
      {
        'title': 'Gallery 2',
        'index': 1,
        'contents': [
          {
            'url': 'assets/images/5.png',
            'title': 'picture 5',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 0,
            'width': 1366,
            'height': 838
          },
          {
            'url': 'assets/images/3.jpg',
            'title': 'picture 3',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 1,
            'width': 1000,
            'height': 1000
          }
        ]
      }
    ];
  }

  getGalleries() {
    return this.data;
  }
}

export default GalleryService;
