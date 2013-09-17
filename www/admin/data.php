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
		$data->settings->title = '';
		$data->settings->subtitle = '';
		$data->settings->subtitleFontColor = '#790005';
		$data->settings->contact = new stdClass();
		$data->settings->contact->title = '';
		$data->settings->contact->content = '';
		$data->settings->catFontSize = 100;
		$data->settings->catFontColor = '#790005';
		$data->settings->nbRow = 2;
		$data->settings->nbColumn = 10;
		$data->settings->items = new stdClass();
		$data->settings->items->position = -30;
		$data->settings->items->width = 250;
		$data->settings->items->height = 250;
		$data->settings->items->marginLeft = 26;
		$data->settings->items->marginTop = 30;
		$data->settings->page = new stdClass();
		$data->settings->page->height = 923;
		$data->settings->page->footer->bgColor = '#F5F5F5';

		echo json_encode($data);
	}
}
