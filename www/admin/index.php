<html ng-app="portfolioAdmin">
	<head>
		<title>@@admin-title@@</title>
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
		<link href="css/admin.css" rel="stylesheet" type="text/css">
		<link href="css/colorpicker.css" rel="stylesheet" type="text/css">
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
					<a class="navbar-brand" href="#">@@admin-title@@</a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#settings">@@admin-settings@@</a></li>
						<li><a href="#categories">@@admin-categories@@</a></li>
						<li><a href="#medias">@@admin-medias@@</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<button type="button" class="btn btn-lg btn-primary" ng-disabled="notChange" ng-click="saveData()">@@admin-save@@</button>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>

		<div class="container">
			<div class="bs-docs-section">
				<div class="page-header">
					<h1 id="settings">@@admin-settings@@</h1>
				</div>
				<div class="row">
					<form class="form-horizontal" role="form">
					<?php
						$settings = array(

							'title.title' => array('name' => '@@admin-settings-title-title@@','kind' => 'text'),
							'subtitle.title' => array('name' => '@@admin-settings-subtitle-title@@','kind' => 'text'),
							'page.keywords' => array('name' => '@@admin-settings-page-keywords@@','kind' => 'text'),

							'section.header' => array('name' => '@@admin-settings-header@@','kind' => 'section'),
							'header.background.path' => array('name' => '@@admin-settings-header-background-path@@','kind' => 'media'),
							'header.height' => array('name' => '@@admin-settings-header-height@@','kind' => 'int'),
							'header.background.position' => array('name' => '@@admin-settings-header-background-position@@','kind' => 'int'),

							'section.logo' => array('name' => '@@admin-settings-logo@@','kind' => 'section'),
							'logo.path' => array('name' => '@@admin-settings-logo-path@@','kind' => 'media'),
							'logo.height' => array('name' => '@@admin-settings-logo-height@@','kind' => 'int'),
							'logo.width' => array('name' => '@@admin-settings-logo-width@@','kind' => 'int'),
							'logo.top' => array('name' => '@@admin-settings-logo-top@@','kind' => 'int'),
							'logo.left' => array('name' => '@@admin-settings-logo-left@@','kind' => 'int'),

							'section.title' => array('name' => '@@admin-settings-title@@','kind' => 'section'),
							'title.width' => array('name' => '@@admin-settings-title-width@@','kind' => 'int'),
							'title.size' => array('name' => '@@admin-settings-title-size@@','kind' => 'int'),
							'title.color' => array('name' => '@@admin-settings-title-color@@','kind' => 'color'),
							'title.top' => array('name' => '@@admin-settings-title-top@@','kind' => 'int'),
							'title.left' => array('name' => '@@admin-settings-title-left@@','kind' => 'int'),
							
							'section.subtitle' => array('name' => '@@admin-settings-subtitle@@','kind' => 'section'),
							'subtitle.size' => array('name' => '@@admin-settings-subtitle-size@@','kind' => 'int'),
							'subtitle.color' => array('name' => '@@admin-settings-subtitle-color@@','kind' => 'color'),

							'section.menu' => array('name' => '@@admin-settings-menu@@','kind' => 'section'),
							'menu.size' => array('name' => '@@admin-settings-menu-size@@','kind' => 'int'),
							'menu.color' => array('name' => '@@admin-settings-menu-color@@','kind' => 'color'),
							'menu.color_hover' => array('name' => '@@admin-settings-menu-color_hover@@','kind' => 'color'),
							'menu.top' => array('name' => '@@admin-settings-menu-top@@','kind' => 'int'),
							'menu.left' => array('name' => '@@admin-settings-menu-left@@','kind' => 'int'),
							'menu.gap' => array('name' => '@@admin-settings-menu-gap@@','kind' => 'int'),

							'section.categories' => array('name' => '@@admin-settings-categories@@','kind' => 'section'),
							'categories.size' => array('name' => '@@admin-settings-categories-size@@','kind' => 'int'),
							'categories.color' => array('name' => '@@admin-settings-categories-color@@','kind' => 'color'),
							'categories.left' => array('name' => '@@admin-settings-categories-left@@','kind' => 'int'),
							'categories.right' => array('name' => '@@admin-settings-categories-right@@','kind' => 'int'),
							'content.padding_left' => array('name' => '@@admin-settings-content-padding_left@@','kind' => 'int'),
							'categories.vertical_align' => array('name' => '@@admin-settings-categories-vertical_align@@','kind' => 'int'),
							
							'section.items' => array('name' => '@@admin-settings-items@@','kind' => 'section'),
							'row' => array('name' => '@@admin-settings-row@@','kind' => 'int'),
							'column' => array('name' => '@@admin-settings-column@@','kind' => 'int'),
							'items.height' => array('name' => '@@admin-settings-items-height@@','kind' => 'int'),
							'items.width' => array('name' => '@@admin-settings-items-width@@','kind' => 'int'),
							'items.top' => array('name' => '@@admin-settings-items-top@@','kind' => 'int'),
							'items.left' => array('name' => '@@admin-settings-items-left@@','kind' => 'int'),
							'items.position' => array('name' => '@@admin-settings-items-position@@','kind' => 'int'),

							'section.contact' => array('name' => '@@admin-settings-contact@@','kind' => 'section'),
							'contact.title' => array('name' => '@@admin-settings-contact-title@@','kind' => 'text'),
							'contact.size' => array('name' => '@@admin-settings-contact-size@@','kind' => 'int'),
							'contact.color' => array('name' => '@@admin-settings-contact-color@@','kind' => 'color'),
							'contact.content' => array('name' => '@@admin-settings-contact-content@@','kind' => 'textarea'),

							'section.page' => array('name' => '@@admin-settings-page@@','kind' => 'section'),
							'page.height' => array('name' => '@@admin-settings-page-height@@','kind' => 'int'),
							'page.bg_color' => array('name' => '@@admin-settings-page-bg_color@@','kind' => 'color'),
							'page.shadow.size' => array('name' => '@@admin-settings-page-shadow-size@@','kind' => 'int'),
							'page.shadow.color' => array('name' => '@@admin-settings-page-shadow-color@@','kind' => 'rgba'),
							'footer.bg_color' => array('name' => '@@admin-settings-footer-bg_color@@','kind' => 'color')
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
					<h1 id="categories">@@admin-categories@@</h1>
				</div>
				<div ng-repeat="category in data.categories">
					<div class="row">
						<div class="col-md-8"><h2>{{category.name}}</h2></div>
						<div class="col-md-4"><a class="btn btn-danger pull-right" ng-click="removeCategory(category)">@@admin-delete@@</a></div>
					</div>
					<div class="row">
						<div class="col-sm-3 col-md-3" ng-repeat="item in category.items">
							<div class="thumbnail">
								<img class="media-thumbnail" ng-src="/{{item.media.path}}">
								<div class="caption">
									<div>
										
										
									</div>
									<div class="row">
										<div class="col-md-9"><h3>{{item.media.name}}</h3></div>
										<div class="col-md-3 pull-right">{{item.column}}x{{item.row}}</div>
									</div>
									<p><select class="form-control" ng-model="item.media"  ng-options="media.name for media in data.medias | orderBy: 'name'" ng-change="$parent.notChange = false"></select></p>
									<p><a class="btn btn-danger" ng-click="removeCategoryItem(category, item)">@@admin-delete@@</a></p>
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
											<span class="input-group-addon">@@admin-column@@</span>
										</div>
										<div class="input-group">
											<input type="text" class="form-control" ng-model="mediaRow">
											<span class="input-group-addon">@@admin-row@@</span>
										</div>
									</p>
									<p><a class="btn btn-primary" ng-click="addCategoryMedia(category, selectedMedia, mediaRow, mediaColumn)">@@admin-add@@</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<form ng-submit="addCategory()" class="input-group">
					<input type="text" class="form-control" placeholder="@@admin-categories-name@@" ng-model="newCategoryName">
					<span class="input-group-btn">
						<input class="btn btn-primary" type="submit" value="@@admin-add@@">
					</span>
				</form>
			</div>
			<div class="bs-docs-section">
				<div class="page-header">
					<h1 id="medias">@@admin-medias@@</h1>
				</div>
				<div class="row">
					<div class="col-sm-3 col-md-3" ng-repeat="media in data.medias">
						<div class="thumbnail">
							<img class="media-thumbnail" ng-src="/{{media.path}}">
							<div class="caption">
								<h3>{{media.name}}</h3>
								<p><a class="btn btn-danger" ng-click="removeMedia(media)">@@admin-delete@@</a></p>
							</div>
						</div>
					</div>
				</div>	
				<form action="upload.php" ng-upload>
					<input type="file" name="file" title="@@admin-medias-file@@"/>
					<div class="input-group">
						<input type="text" class="form-control" name="name" ng-model="name" placeholder="@@admin-medias-name@@"/>
						<span class="input-group-btn">
							<input type="submit" class="btn btn-primary" value="@@admin-medias-submit@@" upload-submit="addMedia(content, completed)" />
						</span>
					</div>	
				</form>
				<div class="alert alert-danger" ng-show="uploadError">{{response.message}}</div>
			</div>
		</div> <!-- /container -->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.8/angular.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
		<script src="js/ng-upload.min.js"></script>
		<script src="js/bootstrap-colorpicker.js"></script>
		<script src="js/bootstrap-colorpicker-module.js"></script>
		<script src="js/app.js"></script>
	</body>
</html>