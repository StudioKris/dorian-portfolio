class GalleryService {
  constructor () {
    'ngInject';

    this.data = [
      {
        'title': 'Gallery 1',
        'index': 0,
        'contents': [
          {
            'url': 'http://img15.deviantart.net/21a1/i/2015/209/2/f/the_wild_collective_by_kelogsloops-d9362em.jpg',
            'title': 'picture 1',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 0
          },
          {
            'url': 'http://orig00.deviantart.net/f27a/f/2015/195/4/3/fades_like_a_photograph____by_nanomortis-d91975k.png',
            'title': 'picture 2',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 1
          },
          {
            'url': 'http://orig08.deviantart.net/06d7/f/2015/135/c/6/berserk__2_by_tiger1313-d8tj830.jpg',
            'title': 'picture 3',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 2
          },
          {
            'url': 'http://orig10.deviantart.net/96de/f/2015/188/8/f/showtime__bounty__by_tiger1313-d90baom.jpg',
            'title': 'picture 4',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 3
          }
        ]
      },
      {
        'title': 'Gallery 2',
        'index': 1,
        'contents': [
          {
            'url': 'http://img15.deviantart.net/21a1/i/2015/209/2/f/the_wild_collective_by_kelogsloops-d9362em.jpg',
            'title': 'picture 1',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 0
          },
          {
            'url': 'http://orig00.deviantart.net/f27a/f/2015/195/4/3/fades_like_a_photograph____by_nanomortis-d91975k.png',
            'title': 'picture 2',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 1
          },
          {
            'url': 'http://orig08.deviantart.net/06d7/f/2015/135/c/6/berserk__2_by_tiger1313-d8tj830.jpg',
            'title': 'picture 3',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 2
          },
          {
            'url': 'http://orig10.deviantart.net/96de/f/2015/188/8/f/showtime__bounty__by_tiger1313-d90baom.jpg',
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
            'url': 'http://img15.deviantart.net/21a1/i/2015/209/2/f/the_wild_collective_by_kelogsloops-d9362em.jpg',
            'title': 'picture 1',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 0
          },
          {
            'url': 'http://orig00.deviantart.net/f27a/f/2015/195/4/3/fades_like_a_photograph____by_nanomortis-d91975k.png',
            'title': 'picture 2',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 1
          },
          {
            'url': 'http://orig08.deviantart.net/06d7/f/2015/135/c/6/berserk__2_by_tiger1313-d8tj830.jpg',
            'title': 'picture 3',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 2
          },
          {
            'url': 'http://orig10.deviantart.net/96de/f/2015/188/8/f/showtime__bounty__by_tiger1313-d90baom.jpg',
            'title': 'picture 4',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 3
          }
        ]
      },
      {
        'title': 'Gallery 4',
        'index': 3,
        'contents': [
          {
            'url': 'http://img15.deviantart.net/21a1/i/2015/209/2/f/the_wild_collective_by_kelogsloops-d9362em.jpg',
            'title': 'picture 1',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 0
          },
          {
            'url': 'http://orig00.deviantart.net/f27a/f/2015/195/4/3/fades_like_a_photograph____by_nanomortis-d91975k.png',
            'title': 'picture 2',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 1
          },
          {
            'url': 'http://orig08.deviantart.net/06d7/f/2015/135/c/6/berserk__2_by_tiger1313-d8tj830.jpg',
            'title': 'picture 3',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 2
          },
          {
            'url': 'http://orig10.deviantart.net/96de/f/2015/188/8/f/showtime__bounty__by_tiger1313-d90baom.jpg',
            'title': 'picture 4',
            'creation_date': 525976200,
            'description': 'toto tutu',
            'index': 3
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
