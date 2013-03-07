<?php
	include('globalsetup.php');
   	include('picasaFunctions.php');	
  	
  	print("Loading <br/>");
  	
  	
  	if(true) {
		//$myusername != "nhynes"
		//Add the photo, then add it and its thumbnails to the database
		$addedPicture = storeToPicasa();
		
		print("Stored to picasa <br/>");
		
		storeToDatabase($addedPicture);
		
		print("Stored to Database <br/>");
	
  	} else {
		print "<script type=\"text/javascript\">";
		print "alert('Nice try, Nick')";
		print "</script>";  
  	}

	//closeAndReloadParent();

	function storeToDatabase($addedPic) {
		//print($addedPic->getGphotoAlbumId ()  . "= album id <br/>");
		//print($addedPic->getGphotoId ()  . " = gphoto id<br/>");		
		
		$thumb = $addedPic->getMediaGroup()->getThumbnail();
    	$content = $addedPic->getMediaGroup()->getContent();

		var_dump($content);
		print"<br/><br/>";
		
		
		//https://picasaweb.google.com/data/feed/api/user/userID/album/albumName?imgmax=912
		//$file = (string)$fullsize[0]->getUrl()."?imgmax=d"; 
		
	    $url = $content[0]->getUrl();

		$preffix = substr( $url, 0, strrpos( $url, '/' )+1 );
		$suffix =  substr( $url, strrpos( $url, '/' ));
		$contentURL =  $preffix . "s0" . $suffix;
	    
	    
    	$thumbURL = $thumb[1]->getUrl();    
    	
    	
    	
		createNewDisplayItem($contentURL, $thumbURL);    	 
	}
  	
?>