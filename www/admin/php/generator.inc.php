<?php

class Generator {
	public static function generateHTML( $data ) {

		$menu = '';
		$content = '';

		$contact_id = $data->settings->contact->title;
		$contact_id = strtolower( $contact_id );
		$contact_id = preg_replace( '/[^a-z0-9]/', ' ', $contact_id );
		$contact_id = preg_replace( '/\\s{2,}/', ' ', $contact_id );
		$contact_id = trim( $contact_id );
		$contact_id = preg_replace( '/\\s/', '-', $contact_id );
		$not_first = false;

		$nb_row = $data->settings->nbRow;

		foreach ( $data->categories as $category ) {
			$name = $category->name;
			$id = strtolower( $name );
			$id = preg_replace( '/[^a-z0-9]/', ' ', $id );
			$id = preg_replace( '/\\s{2,}/', ' ', $id );
			$id = trim( $id );
			$id = preg_replace( '/\\s/', '-', $id );

			$menu .= '<li><a href="#'.$id.'">'.$name.'</a></li>';

			$cat_content = self::_generateCategoryContent( $category, $nb_row );

			$content .= '<div class="pf-item">
				<div id="'.$id.'" class="pf-item-title">';
			if ( $not_first ) {
				$content .= '<span>'.$name.'</span>';
			}
			$not_first = true;
			$content .= '</div>
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

	protected static function _generateCategoryContent( $category, $nb_row ) {
		$result = '<div class="column">';
		$offset_row = 0;
		$not_first = false;
		foreach ( $category->items as $item ) {

			$offset_row += $item->row;

			if ( $not_first && ( $offset_row > $nb_row || $item->row > ( $nb_row-1 ) ) ) {
				$result .= '</div><div class="column">';
				$offset_row = $item->row;
			}

			$result .='<div offset_row="'.$offset_row.'" class="pf-thumbnail span'.$item->column.' row'.$item->row.'" style="background-image: url(\''.$item->media->path.'\');">
			<img src="'.$item->media->path.'"/>
			</div>';
			$not_first = true;
		}

		$result .= '</div>';

		return $result;
	}

	public static function generateCSS( $data ) {

		$footer_bg_color = $data->settings->page->footer->bgColor;
		$items_position = $data->settings->items->position;
		$page_height = $data->settings->page->height;
		$subtitle_font_color = $data->settings->subtitleFontColor;
		$cat_font_size = $data->settings->catFontSize;
		$cat_font_color = $data->settings->catFontColor;
		$nb_row = $data->settings->nbRow;
		$nb_column = $data->settings->nbColumn;
		$items_width = $data->settings->items->width;
		$items_height = $data->settings->items->height;
		$items_margin_left = $data->settings->items->marginLeft;
		$items_margin_top = $data->settings->items->marginTop;

		$result = '
@font-face {
  font-family: Altera;
  src: url(\'fonts/altera.ttf\');
}
* {
  margin: 0px;
  padding: 0px;
  border: 0px;
}
body {
  overflow-x: scroll;
  overflow-y: hidden;
  white-space: nowrap;
  font-family: Altera;
}
.header {
  float: left;
  height: 186px;
  position: relative;
}
.header-title {
  width: 462px;
  margin-top: 24px;
  margin-left: 4px;
  font-size: 36px;
  text-align: right;
  float: left;
  background-image: url(\'images/underline.png\');
  background-repeat: no-repeat;
  background-position: right 49px;
}
.header-subtitle {
  font-size: 24px;
  color: '.$subtitle_font_color.';
}
.header-menu {
  float: left;
  margin-top: 52px;
  margin-left: 56px;
}
.header-menu li {
  line-style: none;
  float: left;
  font-size: 35px;
  margin-right: 65px;
}
.header-menu li a {
  text-decoration: none;
  color: black;
}
.logo {
  height: 202px;
  width: 188px;
  margin-top: 16px;
  margin-left: 84px;
  background-image: url(\'images/logo.png\');
  float: left;
}
.content {
  min-width: 100%;
  float: left;
}
.pf-item {
  display: inline-block;
  margin-left: -'.$cat_font_size.'px;
  padding-right: '.$cat_font_size.'px;
}
.pf-item-title {
  float: left;
  height: 0px;
  -webkit-backface-visibility: hidden;
  -webkit-transform: translateX(-100%) rotate(-90deg);
  -moz-transform: translateX(-100%) rotate(-90deg);
  -o-transform: translateX(-100%) rotate(-90deg);
  -ms-transform: translateX(-100%) rotate(-90deg);
  transform: translateX(-100%) rotate(-90deg);
  /* also accepts left, right, top, bottom coordinates; not required, but a good idea for styling */

  -webkit-transform-origin: right top;
  -moz-transform-origin: right top;
  -ms-transform-origin: right top;
  -o-transform-origin: right top;
  transform-origin: right top;
  /* Should be unset in IE9+ I think. */

  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
}
.pf-item-title span {
  display: block;
  position: relative;
  right: -68px;
  text-align: right;
  font-size: '.$cat_font_size.'px;
  color: '.$cat_font_color.';
  -webkit-user-select: none;
}
.pf-item-content {
  margin-left: '.$cat_font_size.'px;
}
.column {
  margin-top: '.$items_position.'px;
  display: inline-block;
  vertical-align: top;
}
footer {
  background-color: '.$footer_bg_color.';
  top: '.$page_height.'px;
  bottom: 0px;
  position: fixed;
  width: 100%;
  -webkit-box-shadow: inset 0 4px 0px rgba(0, 0, 0, 0.4);
  -moz-box-shadow: inset 0 4px 0px rgba(0, 0, 0, 0.4);
  box-shadow: inset 0 4px 0px rgba(0, 0, 0, 0.4);
}
.pf-thumbnail {
  overflow: hidden;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: 50% 50%;
}
.pf-thumbnail img {
  min-height: 100%;
  min-width: 100%;
  max-width: 100%;
  max-height: 100%;
  /* IE 8 */

  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  /* IE 5-7 */

  filter: alpha(opacity=0);
  /* modern browsers */

  opacity: 0;
}
';


		for ( $i=0; $i < $nb_row; $i++ ) {
			$r = ( $i+1 );
			$result .= '.row'.$r.' {
  margin-top: '.$items_margin_top.'px;
  height: '.( ( $items_height*$r )+( $items_margin_top*$i ) ).'px;
}'.PHP_EOL;
		}

		for ( $i=0; $i < $nb_column; $i++ ) {
			$c = ( $i+1 );
			$result .= '.span'.$c.' {
  margin-left: '.$items_margin_left.'px;
  width: '.( ( $items_width*$c )+( $items_margin_left*$i ) ).'px;
}'.PHP_EOL;
		}


		return $result;
	}
}
