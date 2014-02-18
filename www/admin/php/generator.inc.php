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

		$nb_row = $data->settings->row;

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
		<title>'.$data->settings->title->title.'</title>
		<link href="css/portfolio.css" rel="stylesheet" type="text/css">
		<meta name="keywords" content="'.$data->settings->page->keywords.'">
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<div class="header">
			<div class="logo"></div>
			<div class="header-title">
				'.$data->settings->title->title.'
				<div class="header-subtitle">
					'.$data->settings->subtitle->title.'
				</div>
			</div>
			<div class="header-menu">
				<ul>
					'.$menu.'
					<li><a href="#'.$contact_id.'">'.$data->settings->contact->title.'</a></li>
				</ul>
			</div>
		</div>
		<div class="pf-content">
			'.$content.'
			<div class="pf-item">
				<div id="'.$contact_id.'" class="pf-item-title">
					<span>'.$data->settings->contact->title.'</span>
				</div>
				<div class="pf-item-content">
					<div class="column contact">
						'.$data->settings->contact->content.'
					</div>
				</div>
			</div>
		</div>
		<div class="footer">
		</div>

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

			$result .='<div class="pf-thumbnail span'.$item->column.' row'.$item->row.'" style="background-image: url(\''.$item->media->path.'\');">
			<img src="'.$item->media->path.'" alt="'.$item->media->name.'"/>
			</div>';
			$not_first = true;
		}

		$result .= '</div>';

		return $result;
	}

	public static function generateCSS( $data ) {

		$nb_row = $data->settings->row;
		$nb_column = $data->settings->column;
		$items_width = $data->settings->items->width;
		$items_height = $data->settings->items->height;
		$items_margin_left = $data->settings->items->left;
		$items_margin_top = $data->settings->items->top;

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
  background-color: '.$data->settings->page->bg_color.';
}
.header {
  float: left;
  height: '.$data->settings->header->height.'px;
  position: fixed;
}
.header > div {
	display: inline-block;
	vertical-align: top;
}
.header-title {
  width: '.$data->settings->title->width.'px;
  margin-top: '.$data->settings->title->top.'px;
  margin-left: '.$data->settings->title->left.'px;
  font-size: '.$data->settings->title->size.'px;
  text-align: right;
  color: '.$data->settings->title->color.';
  background-image: url(\'/'.$data->settings->header->background->path.'\');
  background-repeat: no-repeat;
  background-position: left '.$data->settings->header->background->position.'px;
}
.header-subtitle {
  font-size: '.$data->settings->subtitle->size.'px;
  color: '.$data->settings->subtitle->color.';
}
.header-menu {
  margin-top: '.$data->settings->menu->left.'px;
  margin-left: '.$data->settings->menu->left.'px;
}
.header-menu li {
  line-style: none;
  float: left;
  font-size: '.$data->settings->menu->size.'px;
  margin-right: '.$data->settings->menu->gap.'px;
  list-style: none;
}
.header-menu li a {
  text-decoration: none;
  color: '.$data->settings->menu->color.';
}
.header-menu li a:hover {
  text-decoration: none;
  color: '.$data->settings->menu->color_hover.';
}
.logo {
  height: '.$data->settings->logo->height.'px;
  width: '.$data->settings->logo->width.'px;
  margin-top: '.$data->settings->logo->top.'px;
  margin-left: '.$data->settings->logo->left.'px;
  background-image: url(\'/'.$data->settings->logo->path.'\');
  background-size: cover;
  background-repeat: no-repeat;
  background-position: 50% 50%;
}
.pf-content {
  min-width: 100%;
  float: left;
  padding-left: '.$data->settings->content->padding_left.'px;
  margin-top: '.$data->settings->header->height.'px;
}
.content {
  min-width: 100%;
  float: left;
  padding-left: '.$data->settings->content->padding_left.'px;
}
.pf-item {
  display: inline-block;
  margin-left: -'.$data->settings->categories->size.'px;
  padding-right: '.$data->settings->categories->size.'px;
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
  right: '.$data->settings->categories->vertical_align.'px;
  text-align: right;
  font-size: '.$data->settings->categories->size.'px;
  color: '.$data->settings->categories->color.';
  -webkit-user-select: none;
}
.pf-item-content {
  margin-left: '.$data->settings->categories->left.'px;
  margin-right: '.$data->settings->categories->right.'px;
}
.column {'.
  //margin-top: '.$data->settings->items->position.'px;
  '
  display: inline-block;
  vertical-align: top;
}
.column .pf-thumbnail:first-child {
	margin-top: 0px;
}
.contact {
  color: '.$data->settings->contact->color.';
  font-size: '.$data->settings->contact->size.'px;
}
.footer {
  background-color: '.$data->settings->footer->bg_color.';
  top: '.$data->settings->page->height.'px;
  bottom: 0px;
  position: fixed;
  width: 100%;
  -webkit-box-shadow: inset 0 '.$data->settings->page->shadow->size.'px 0px '.$data->settings->page->shadow->color.';
  -moz-box-shadow: inset 0 '.$data->settings->page->shadow->size.'px 0px '.$data->settings->page->shadow->color.';
  box-shadow: inset 0 '.$data->settings->page->shadow->size.'px 0px '.$data->settings->page->shadow->color.';
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
