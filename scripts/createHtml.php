<?php
	// first argument is the folder to create the index file in
	$files = glob($argv[1]."thumbnails/*.*");

	// create the index.html file
	$myfile = fopen($argv[1]."/index.html", "w");

	// prepare the file's header and footer
	$header = "<html><header><title>GIFikOmpetition 2022 - Arduino</title></header><body>";
	$footer = "</body></html>";

	// write header
	fwrite( $myfile,  $header );

	// iterate through the files and add them to the index
     	for ($i=0; $i<count($files); $i++)
      	{
        	$image = $files[$i];
        	$supported_file = array(
                	'gif',
                	'jpg',
                	'jpeg',
                	'png'
         	);

		$filename = explode(".", basename($image));
		$pieces = explode("_", $filename[0]);
         	$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
         	if (in_array($ext, $supported_file)) {
			fwrite( $myfile, '<div class="item"><div class="key">File name:</div><div class="value">'.basename($image)."</div>\n");
			fwrite( $myfile, '<div class="date"><div class="key">Date:</div><div class="value">'.$pieces[0]."</div>\n");
			fwrite( $myfile, '<div class="author"><div class="key">Author:</div><div class="value">'.$pieces[1]."</div>\n");
			fwrite( $myfile, '<div class="title"><div class="key">Title:</div><div class="value">'.$pieces[2]."</div>\n"); 
			fwrite( $myfile, '<div class="image"><a href="images/'.basename($image).'"  target="_blank"><img src="thumbnails/'.basename($image).'" alt="'.$pieces[2]." by ".$pieces[1].'" /></a>'."</div>\n");
            	} else {
                	continue;
            	}
	}

	// write footer
	fwrite( $myfile,  $footer );

	// close file object
	fclose($myfile);
?>
