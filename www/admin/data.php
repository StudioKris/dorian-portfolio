<?php
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	$data = file_get_contents( "php://input" );
	$data_storage = '<?php'.PHP_EOL.'$data = \''.$data.'\';';
	file_put_contents( '../data.inc.php', $data_storage );

	$data = json_decode($data);

	include_once dirname(__FILE__).'/php/generator.inc.php';

	$html = Generator::generateHTML($data);

	file_put_contents( '../index.html', $html );

	$css = Generator::generateCSS($data);

	file_put_contents( '../css/portfolio.css', $css );
}
else {
	if ( file_exists( '../data.inc.php' ) ) {
		include_once '../data.inc.php';
		echo $data;
	}
	else {
		$data = new stdClass();
		$data->categories = array();
		$data->medias = array();
		$data->settings = new stdClass();
		$data->settings->categories = new stdClass();
		$data->settings->categories->color = '#790005';
		$data->settings->categories->size = 100;
		$data->settings->contact = new stdClass();
		$data->settings->contact->content = '';
		$data->settings->contact->title = '';
		$data->settings->header = new stdClass();
		$data->settings->header->height = 186;
		$data->settings->items = new stdClass();
		$data->settings->items->height = 250;
		$data->settings->items->left = 26;
		$data->settings->items->top = 30;
		$data->settings->items->position = -30;
		$data->settings->items->width = 250;
		$data->settings->menu = new stdClass();
		$data->settings->menu->color = '#000000';
		$data->settings->menu->size = 35;
		$data->settings->column = 10;
		$data->settings->row = 2;
		$data->settings->page = new stdClass();
		$data->settings->page->height = 923;
		$data->settings->footer = new stdClass();
		$data->settings->footer->bg_color = '#F5F5F5';
		$data->settings->subtitle = new stdClass();
		$data->settings->subtitle->color = '#790005';
		$data->settings->subtitle->size = 24;
		$data->settings->subtitle->title = '';
		$data->settings->title = new stdClass();
		$data->settings->title->color = '#000000';
		$data->settings->title->size = 36;
		$data->settings->title->top = 24;
		$data->settings->title->left = 4;
		$data->settings->title->width = 462;
		$data->settings->title->title = '';

		echo json_encode($data);
	}
}
