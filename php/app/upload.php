<?php
	print_r($_FILES);
	$new_image_name = "namethisimage.png";
	move_uploaded_file($_FILES["file"]["tmp_name"], "http://minmin.esy.es/img/".$new_image_name);
?>