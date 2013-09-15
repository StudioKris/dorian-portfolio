<?php
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	$data = file_get_contents( "php://input" );
	$data_storage = '<?php'.PHP_EOL.'$data = \''.$data.'\';';
	file_put_contents( '../data.inc.php', $data_storage );

	$data = json_decode($data);

	include_once dirname(__FILE__).'/php/generator.inc.php';

	$html = Generator::generateHTML($data);

	file_put_contents( '../index.html', $html );
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
		$data->settings->contact = new stdClass();
		$data->settings->contact->title = '';
		$data->settings->contact->content = '';

		echo json_encode($data);
	}
}
