<?php

class Generator {
	public static function generateHTML($data) {
		
		$menu = '';
		$content = '';

		$contact_id = $data->settings->contact->title;
		$contact_id = strtolower($contact_id);
		$contact_id = preg_replace( '/[^a-z0-9]/', ' ', $contact_id );
		$contact_id = preg_replace( '/\\s{2,}/', ' ', $contact_id );
		$contact_id = trim( $contact_id );
		$contact_id = preg_replace( '/\\s/', '-', $contact_id );

		foreach ($data->categories as $category) {
			$name = $category->name;
			$id = strtolower($name);
			$id = preg_replace( '/[^a-z0-9]/', ' ', $id );
			$id = preg_replace( '/\\s{2,}/', ' ', $id );
			$id = trim( $id );
			$id = preg_replace( '/\\s/', '-', $id );

			$menu .= '<li><a href="#'.$id.'">'.$name.'</a></li>';

			$cat_content = self::_generateCategoryContent($category);

			$content .= '<div class="pf-item">
				<div id="'.$id.'" class="pf-item-title">
					<span>'.$name.'</span>
				</div>
				<div class="pf-item-content">
					'.$cat_content.'
				</div>
			</div>';
		}

		$result = '<html>
	<head>
		<title>'.$data->settings->title.'</title>
		<link href="css/portfolio.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="header">
			<div class="logo"></div>
			<div class="header-title">
				'.$data->settings->title.'
				<div class="header-subtitle">
					'.$data->settings->subtitle.'
				</div>
			</div>
			<ul class="header-menu">
				'.$menu.'
				<li><a href="#'.$contact_id.'">'.$data->settings->contact->title.'</a></li>
			</ul>
		</div>
		<div class="content">
			'.$content.'
			<div class="pf-item">
				<div id="'.$contact_id.'" class="pf-item-title">
					<span>'.$data->settings->contact->title.'</span>
				</div>
				<div class="pf-item-content">
					<div class="collumn">
						'.$data->settings->contact->content.'
					</div>
				</div>
			</div>
		</div>
		<footer>
		</footer>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="js/jquery.mousewheel.min.js"></script>
		<script type="text/javascript">
			/*$(function() {
				$("body").mousewheel(function(event, delta) {
					this.scrollLeft -= delta;
					event.preventDefault();
				});
			});*/
		</script>
	</body>
</html>';

		return $result;
	}

	protected static function _generateCategoryContent($category) {
		$result = '<div class="column">';

		foreach ($category->items as $item) {

			if($item->newColumn) {
				$result .= '</div><div class="column">';
			}
			$result .='<div class="pf-thumbnail span'.$item->column.' row'.$item->row.'">
			<img src="'.$item->media->path.'"/>
			</div>';
		}

		$result .= '</div>';

		return $result;
	}
}