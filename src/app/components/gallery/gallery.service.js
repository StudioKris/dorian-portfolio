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
            'index': 0
          },
          {
            'url': 'assets/images/2.png',
            'title': 'picture 2',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 1
          },
          {
            'url': 'assets/images/3.jpg',
            'title': 'picture 3',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 2
          },
          {
            'url': 'assets/images/4.jpg',
            'title': 'picture 4',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 3
          },
          {
            'url': 'assets/images/5.png',
            'title': 'picture 5',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 4
          }
        ]
      },
      {
        'title': 'Gallery 2',
        'index': 1,
        'contents': [
          {
            'url': 'assets/images/1.jpg',
            'title': 'picture 1',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 0
          },
          {
            'url': 'assets/images/2.png',
            'title': 'picture 2',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 1
          },
          {
            'url': 'assets/images/3.jpg',
            'title': 'picture 3',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 2
          },
          {
            'url': 'assets/images/4.jpg',
            'title': 'picture 4',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 3
          }
        ]
      },
      {
        'title': 'Gallery 3',
        'index': 2,
        'contents': [
          {
            'url': 'assets/images/1.jpg',
            'title': 'picture 1',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 0
          },
          {
            'url': 'assets/images/2.png',
            'title': 'picture 2',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 1
          },
          {
            'url': 'assets/images/3.jpg',
            'title': 'picture 3',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 2
          }
        ]
      },
      {
        'title': 'Gallery 4',
        'index': 3,
        'contents': [
          {
            'url': 'assets/images/1.jpg',
            'title': 'picture 1',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 0
          },
          {
            'url': 'assets/images/2.png',
            'title': 'picture 2',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 1
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
