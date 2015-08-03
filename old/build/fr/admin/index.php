<html ng-app="portfolioAdmin">
	<head>
		<title>Admin</title>
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
		<link href="css/admin.css" rel="stylesheet" type="text/css">
		<link href="css/colorpicker.css" rel="stylesheet" type="text/css">
		<link href="css/bootstrap-slider.min.css" rel="stylesheet" type="text/css">
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	</head>
	<body ng-controller="AppCtrl">

		<div class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Admin</a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#settings">Paramétres</a></li>
						<li><a href="#categories">Categories</a></li>
						<li><a href="#medias">Medias</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<button type="button" class="btn btn-lg btn-primary" ng-disabled="notChange" ng-click="saveData()">Enregistrer</button>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>

		<div class="container">
			<div class="bs-docs-section">
				<div class="page-header">
					<h1 id="settings">Paramétres</h1>
				</div>
				<div class="row">
					<form class="form-horizontal" role="form">
					<?php
						$settings = array(

							'title.title' => array('name' => 'Titre','kind' => 'text'),
							'subtitle.title' => array('name' => 'Sous-Titre','kind' => 'text'),
							'page.keywords' => array('name' => 'Mots clés','kind' => 'text'),

							'section.header' => array('name' => 'En-tête :','kind' => 'section'),
							'header.background.path' => array('name' => '','kind' => 'media'),
							'header.height' => array('name' => 'Hauteur','kind' => 'int'),
							'header.background.position' => array('name' => 'Y','kind' => 'int'),

							'section.logo' => array('name' => 'Logo :','kind' => 'section'),
							'logo.path' => array('name' => 'Logo','kind' => 'media'),
							'logo.height' => array('name' => 'Hauteur','kind' => 'int'),
							'logo.width' => array('name' => 'Largeur','kind' => 'int'),
							'logo.top' => array('name' => 'Y','kind' => 'int'),
							'logo.left' => array('name' => 'X','kind' => 'int'),

							'section.title' => array('name' => 'Titre :','kind' => 'section'),
							'title.width' => array('name' => 'Largeur','kind' => 'int'),
							'title.size' => array('name' => 'Taille','kind' => 'int'),
							'title.color' => array('name' => 'Couleur','kind' => 'color'),
							'title.top' => array('name' => 'Y','kind' => 'int'),
							'title.left' => array('name' => 'X','kind' => 'int'),
							
							'section.subtitle' => array('name' => 'Sous-titre :','kind' => 'section'),
							'subtitle.size' => array('name' => 'Taille','kind' => 'int'),
							'subtitle.color' => array('name' => 'Couleur','kind' => 'color'),

							'section.menu' => array('name' => 'Menu :','kind' => 'section'),
							'menu.size' => array('name' => 'Taille','kind' => 'int'),
							'menu.color' => array('name' => 'Couleur','kind' => 'color'),
							'menu.color_hover' => array('name' => 'Couleur Survole','kind' => 'color'),
							'menu.top' => array('name' => 'Y','kind' => 'int'),
							'menu.left' => array('name' => 'X','kind' => 'int'),
							'menu.gap' => array('name' => 'Espace','kind' => 'int'),

							'section.categories' => array('name' => 'Categories','kind' => 'section'),
							'categories.size' => array('name' => 'Taille','kind' => 'int'),
							'categories.color' => array('name' => 'Couleur','kind' => 'color'),
							'categories.left' => array('name' => 'X','kind' => 'int'),
							'categories.right' => array('name' => 'Espace Horizontal','kind' => 'int'),
							'content.padding_left' => array('name' => 'Marge gauche du premier element: ','kind' => 'int'),
							'categories.vertical_align' => array('name' => 'Alignement Vertical','kind' => 'int'),
							
							'section.items' => array('name' => 'Tuiles :','kind' => 'section'),
							'row' => array('name' => 'Lignes','kind' => 'int'),
							'column' => array('name' => 'Collones','kind' => 'int'),
							'items.height' => array('name' => 'Hauteur','kind' => 'int'),
							'items.width' => array('name' => 'Largeur','kind' => 'int'),
							'items.top' => array('name' => 'Espace Vertical','kind' => 'int'),
							'items.left' => array('name' => 'Espace Horizontal','kind' => 'int'),
							'items.position' => array('name' => 'Y','kind' => 'int'),

							'section.contact' => array('name' => 'Page de contact :','kind' => 'section'),
							'contact.title' => array('name' => 'Titre','kind' => 'text'),
							'contact.size' => array('name' => 'Taille','kind' => 'int'),
							'contact.color' => array('name' => 'Couleur','kind' => 'color'),
							'contact.content' => array('name' => 'Contenu','kind' => 'textarea'),

							'section.page' => array('name' => 'Style de la page :','kind' => 'section'),
							'page.height' => array('name' => 'Hauteur','kind' => 'int'),
							'page.bg_color' => array('name' => 'Couleur','kind' => 'color'),
							'page.shadow.size' => array('name' => 'Taille','kind' => 'int'),
							'page.shadow.color' => array('name' => 'Couleur','kind' => 'rgba'),
							'footer.bg_color' => array('name' => 'Couleur du pied','kind' => 'color'),
							'page.scroll_duration' => array('name' => 'Durée du Scroll','kind' => 'int'),
							'page.scroll_acceleration' => array('name' => 'Vitesse de déplacement à la roulette','kind' => 'float', 'min' => .1, 'max' => 50, 'step' => .1)
						);

						foreach ($settings as $key => $data) {
							$key_escaped = str_replace('.', '-', $key);

							if($data['kind'] == 'section') {
								?>
					</form>
				</div>
				<h3><?php echo $data['name']; ?></h3>
				<div class="row">
					<form class="form-horizontal" role="form">
								<?php
							}
							else {
								?>
									<div class="form-group col-md-4">
										<label for="settings-<?php echo $key_escaped; ?>" class="col-lg-6 control-label"><?php echo $data['name']; ?></label>
										<div class="col-lg-6">
								<?php

								switch ($data['kind']) {
									case 'color':
										?>
											<input colorpicker id="settings-<?php echo $key_escaped; ?>" class="form-control input-sm" type="text" ng-model="data.settings.<?php echo $key; ?>" ng-change="notChange = false"/>
										<?php
										break;
									case 'rgba':
										?>
											<input colorpicker="rgba" id="settings-<?php echo $key_escaped; ?>" class="form-control input-sm" type="text" ng-model="data.settings.<?php echo $key; ?>" ng-change="notChange = false"/>
										<?php
										break;
									case 'media':
										?>
											<select class="form-control input-sm" ng-model="data.settings.<?php echo $key; ?>"  ng-options="media.path as media.name for media in data.medias | orderBy: 'name'" ng-change="notChange = false"></select>
										<?php
										break;
									case 'textarea':
										?>
											<textarea rows="3" class="form-control input-sm" id="settings-<?php echo $key_escaped; ?>" ng-model="data.settings.<?php echo $key; ?>" ng-change="notChange = false"></textarea>
										<?php
										break;
									case 'float':
										?>
											<slider id="settings-<?php echo $key_escaped; ?>" 
												ng-model="data.settings.<?php echo $key; ?>" 
												ng-change="notChange = false" 
												min="<?php echo $data['min']; ?>" 
												max="<?php echo $data['max']; ?>" 
												step="<?php echo $data['step']; ?>"></slider>
										<?php
										break;
									
									default:
										?>
											<input type="text" class="form-control input-sm" id="settings-<?php echo $key_escaped; ?>" ng-model="data.settings.<?php echo $key; ?>" ng-change="notChange = false"/>	
										<?php
										break;
								}

								?>
										</div>
									</div>
								<?php
							}
						}
					?>
					</form>
				</div>
			</div>
			<div class="bs-docs-section">
				<div class="page-header">
					<h1 id="categories">Categories</h1>
				</div>
				<div ng-repeat="category in data.categories">
					<div class="row">
						<div class="col-md-8"><h2>{{category.name}}</h2></div>
						<div class="col-md-4"><a class="btn btn-danger pull-right" ng-click="removeCategory(category)">Supprimer</a></div>
					</div>
					<div class="row">
						<div class="col-sm-3 col-md-3" ng-repeat="item in category.items">
							<div class="thumbnail">
								<img class="media-thumbnail" ng-src="/{{item.media.path}}">
								<div class="caption">
									<div class="row">
										<div class="col-md-9"><h3 class="ellipse">{{item.media.name}}</h3></div>
									</div>
									<p>
										<div class="input-group">
											<input type="text" class="form-control" ng-model="item.column">
											<span class="input-group-addon">Colone</span>
										</div>
										<div class="input-group">
											<input type="text" class="form-control" ng-model="item.row">
											<span class="input-group-addon">Ligne</span>
										</div>
									</p>
									<p><select class="form-control" ng-model="item.media"  ng-options="media.name for media in data.medias | orderBy: 'name'" ng-change="$parent.notChange = false"></select></p>
									<p>
										<center>
											<button type="button" class="btn btn-primary" ng-click="pushLeftCategoryItem(category, item)" ng-disabled="$first">
												<span class="glyphicon glyphicon-chevron-left"></span>
											</button>
											<button type="button" class="btn btn-danger" ng-click="removeCategoryItem(category, item)">Supprimer</button>
											<button type="button" class="btn btn-primary" ng-click="pushRightCategoryItem(category, item)" ng-disabled="$last">
												<span class="glyphicon glyphicon-chevron-right"></span>
											</button>
										</center>
									</p>
								</div>
							</div>
						</div>
						<div class="col-sm-3 col-md-3">
							<div class="thumbnail">
								<img class="media-thumbnail" ng-show="selectedMedia" ng-src="/{{selectedMedia.path}}">
								<div class="caption">
									<p>
										<select class="form-control" ng-model="selectedMedia"  ng-options="media.name for media in data.medias | orderBy: 'name'"></select>
										<div class="input-group">
											<input type="text" class="form-control" ng-model="mediaColumn">
											<span class="input-group-addon">Colone</span>
										</div>
										<div class="input-group">
											<input type="text" class="form-control" ng-model="mediaRow">
											<span class="input-group-addon">Ligne</span>
										</div>
									</p>
									<p><a class="btn btn-primary" ng-click="addCategoryMedia(category, selectedMedia, mediaRow, mediaColumn)">Ajouter</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<form ng-submit="addCategory()" class="input-group">
					<input type="text" class="form-control" placeholder="Nom" ng-model="newCategoryName">
					<span class="input-group-btn">
						<input class="btn btn-primary" type="submit" value="Ajouter">
					</span>
				</form>
			</div>
			<div class="bs-docs-section">
				<div class="page-header">
					<h1 id="medias">Medias</h1>
				</div>
				<div class="row">
					<div class="col-sm-3 col-md-3" ng-repeat="media in data.medias">
						<div class="thumbnail">
							<img class="media-thumbnail" ng-src="/{{media.path}}">
							<div class="caption">
								<h3>{{media.name}}</h3>
								<p><a class="btn btn-danger" ng-click="removeMedia(media)">Supprimer</a></p>
							</div>
						</div>
					</div>
				</div>	
				<form action="upload.php" ng-upload>
					<input type="file" name="file" title="Image"/>
					<div class="input-group">
						<input type="text" class="form-control" name="name" ng-model="name" placeholder="Nom"/>
						<span class="input-group-btn">
							<input type="submit" class="btn btn-primary" value="Envoyer" upload-submit="addMedia(content, completed)" />
						</span>
					</div>	
				</form>
				<div class="alert alert-danger" ng-show="uploadError">{{response.message}}</div>
			</div>
		</div> <!-- /container -->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
		<script src="js/ng-upload.min.js"></script>
		<script src="js/bootstrap-colorpicker.js"></script>
		<script src="js/bootstrap-colorpicker-module.js"></script>
		<script src="js/bootstrap-slider.min.js"></script>
		<script src="js/bootstrap-slider-module.js"></script>
		<script src="js/app.js"></script>
	</body>
</html>