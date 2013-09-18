<html ng-app="portfolioAdmin">
	<head>
		<title>@@admin-title@@</title>
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
		<link href="css/admin.css" rel="stylesheet" type="text/css">
		<link href="css/colorpicker.css" rel="stylesheet" type="text/css">
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
			<div class="jumbotron">
				<h1>Navbar example</h1>
				<p>This example is a quick exercise to illustrate how the default, static and fixed to top navbar work. It includes the responsive CSS and HTML, so it also adapts to your viewport and device.</p>
				<p>To see the difference between static and fixed top navbars, just scroll.</p>
				<p>
					<a class="btn btn-lg btn-primary" href="../../components/#navbar">View navbar docs »</a>
				</p>
			</div>
			<div class="bs-docs-section">
				<div class="page-header">
					<h1 id="settings">@@admin-settings@@</h1>
				</div>
				<div class="row">
					<form class="form-horizontal" role="form">
					<?php
						$settings = array(
							'categories.color' => 'color',
							'categories.size' => 'int',
							'categories.left' => 'int',
							'contact.content' => 'textarea',
							'contact.color' => 'color',
							'contact.title' => 'text',
							'contact.size' => 'int',
							'header.height' => 'int',
							'header.background.position' => 'int',
							'header.background.path' => 'media',
							'items.height' => 'int',
							'items.left' => 'int',
							'items.top' => 'int',
							'items.position' => 'int',
							'items.width' => 'int',
							'logo.height' => 'int',
							'logo.width' => 'int',
							'logo.left' => 'int',
							'logo.top' => 'int',
							'logo.path' => 'media',
							'menu.color' => 'color',
							'menu.size' => 'int',
							'menu.left' => 'int',
							'menu.top' => 'int',
							'menu.gap' => 'int',
							'column' => 'int',
							'row' => 'int',
							'page.height' => 'int',
							'page.shadow.size' => 'int',
							'page.shadow.color' => 'rgba',
							'footer.bg_color' => 'color',
							'subtitle.color' => 'color',
							'subtitle.size' => 'int',
							'subtitle.title' => 'text',
							'title.color' => 'color',
							'title.size' => 'int',
							'title.top' => 'int',
							'title.left' => 'int',
							'title.width' => 'int',
							'title.title' => 'text'
						);

						foreach ($settings as $key => $kind) {
							$key_escaped = str_replace('.', '-', $key);
							if($kind == 'color')
							{
							?>
								<div class="form-group col-md-4">
									<label for="settings-<?php echo $key_escaped; ?>" class="col-lg-6 control-label">@@admin-settings-<?php echo $key_escaped; ?>@@</label>
									<div class="col-lg-6">
										<input colorpicker id="settings-<?php echo $key_escaped; ?>" class="form-control" type="text" ng-model="data.settings.<?php echo $key; ?>" ng-change="notChange = false"/>
									</div>
								</div>
							<?php
							}
							else if($kind == 'rgba')
							{
							?>
								<div class="form-group col-md-4">
									<label for="settings-<?php echo $key_escaped; ?>" class="col-lg-6 control-label">@@admin-settings-<?php echo $key_escaped; ?>@@</label>
									<div class="col-lg-6">
										<input colorpicker="rgba" id="settings-<?php echo $key_escaped; ?>" class="form-control" type="text" ng-model="data.settings.<?php echo $key; ?>" ng-change="notChange = false"/>
									</div>
								</div>
								
							<?php
							}
							else if($kind == 'media')
							{
							?>
								<div class="form-group col-md-4">
									<label for="settings-<?php echo $key_escaped; ?>" class="col-lg-6 control-label">@@admin-settings-<?php echo $key_escaped; ?>@@</label>
									<div class="col-lg-6">
										<select ng-model="data.settings.<?php echo $key; ?>"  ng-options="media.path as media.name for media in data.medias | orderBy: 'name'" ng-change="notChange = false"></select>
									</div>
								</div>
								
							<?php
							}
							else if($kind == 'textarea')
							{
							?>
								<div class="form-group col-md-4">
									<label for="settings-<?php echo $key_escaped; ?>" class="col-lg-6 control-label">@@admin-settings-<?php echo $key_escaped; ?>@@</label>
									<div class="col-lg-6">
										<textarea rows="3" class="form-control" id="settings-<?php echo $key_escaped; ?>" ng-model="data.settings.<?php echo $key; ?>" ng-change="notChange = false"></textarea>
									</div>
								</div>
							<?php
							}
							else
							{
							?>
								<div class="form-group col-md-4">
									<label for="settings-<?php echo $key_escaped; ?>" class="col-lg-6 control-label">@@admin-settings-<?php echo $key_escaped; ?>@@</label>
									<div class="col-lg-6">
										<input type="text" class="form-control" id="settings-<?php echo $key_escaped; ?>" ng-model="data.settings.<?php echo $key; ?>" ng-change="notChange = false">
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
					<h2>{{category.name}}<a class="btn btn-danger right" ng-click="removeCategory(category)">@@admin-delete@@</a></h2>
					<div class="row">
						<div class="col-sm-3 col-md-3" ng-repeat="item in category.items">
							<div class="thumbnail">
								<img class="media-thumbnail" ng-src="/{{item.media.path}}">
								<div class="caption">
									<h3>{{item.media.name}}</h3>
									<p>@@admin-row@@{{item.row}}</p>
									<p>@@admin-column@@{{item.column}}</p>
									<p><a class="btn btn-danger" ng-click="removeCategoryItem(category, item)">@@admin-delete@@</a></p>
								</div>
							</div>
						</div>
						<div class="col-sm-3 col-md-3">
							<div class="thumbnail">
								<img class="media-thumbnail" ng-show="selectedMedia" ng-src="/{{selectedMedia.path}}">
								<div class="caption">
									<p>
										<select ng-model="selectedMedia"  ng-options="media.name for media in data.medias | orderBy: 'name'"></select>
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