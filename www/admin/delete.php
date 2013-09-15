<?php
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	$data = file_get_contents( "php://input" );
	if(strlen($data) > 0) {
		$data = json_decode($data);
		foreach ($data as $media) {
			$path = '../'.$media->path;
			if(file_exists($path)) {
				unlink($path);
			}
		}
	}
}
