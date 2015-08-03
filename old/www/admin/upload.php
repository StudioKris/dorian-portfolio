<?php

$result = new stdClass();

if ( isset( $_REQUEST ) && isset( $_REQUEST['name'] ) ) {
	if ( !empty( $_REQUEST['name'] ) ) {
		if ( isset( $_FILES ) && isset( $_FILES['file'] ) ) {
			if ( $_FILES['file']['error'] == 0 ) {
				if ( $_FILES['file']['size'] > 0 ) {
					if ( $_FILES['file']['type'] == 'image/jpeg' || $_FILES['file']['type'] == 'image/png' ) {
						$name = $_REQUEST['name'];
						$file_name = strtolower( $name );
						$file_name = preg_replace( '/[^a-z0-9]/', ' ', $file_name );
						$file_name = preg_replace( '/\\s{2,}/', ' ', $file_name );
						$file_name = trim( $file_name );
						$file_name = preg_replace( '/\\s/', '-', $file_name );

						$extention = '.jpg';
						if ( $_FILES['file']['type'] == 'image/png' ) {
							$extention = '.png';
						}
						$path = 'images/'.$file_name.$extention;
						if ( move_uploaded_file( $_FILES['file']['tmp_name'], '../'.$path ) ) {
							$result->error = 0;
							$result->name = $name;
							$result->path = $path;
						}
						else {
							//internal error
							$result->error = 1;
							$result->message = 'Internam error.';
						}
					}
					else {
						//invalide file
						$result->error = 2;
						$result->message = 'Invalide file.';
					}
				}
				else {
					//file is empty
					$result->error = 3;
					$result->message = 'The uploaded file is empty.';
				}
			}
			else {
				//upload file error
				$result->error = 4;
				$result->message = 'Upload file error.';
			}
		}
		else {
			//no file
			$result->error = 5;
			$result->message = 'No file given.';
		}
	}
	else {
		//erro empty name
		$result->error = 6;
		$result->message = 'Empty name given.';
	}
}
else {
	//error no name
	$result->error = 7;
	$result->message = 'No name given.';
}

echo json_encode( $result );
