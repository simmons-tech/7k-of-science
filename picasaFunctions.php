<?php

//Picasa Libraries
  	require_once 'Zend/Loader.php';
		Zend_Loader::loadClass('Zend_Gdata_Photos');
		Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
		Zend_Loader::loadClass('Zend_Gdata_AuthSub');


	$serviceName = Zend_Gdata_Photos::AUTH_SERVICE_NAME;
	$picasauser = "simmons-display@mit.edu";
	$picasapass = "SteveHoll!";
	
	$client = Zend_Gdata_ClientLogin::getHttpClient($picasauser, $picasapass, $serviceName);
	
	// update the second argument to be CompanyName-ProductName-Version
	$gp = new Zend_Gdata_Photos($client, "Google-DevelopersGuide-1.0");

// Creates a Zend_Gdata_Photos_AlbumQuery
$query = $gp->newAlbumQuery();

$query->setUser("default");
$query->setAlbumName("DisplayPics");
 


function printThumbList() {
	global $gp, $query;
	
	$albumFeed = $gp->getAlbumFeed($query);
	foreach ($albumFeed as $photoEntry) {
				//echo $albumEntry->title->text . "<br />\n";
			$camera = "";
			$contentUrl = "";
			$firstThumbnailUrl = "";
			
			$albumId = $photoEntry->getGphotoAlbumId()->getText();
			$photoId = $photoEntry->getGphotoId()->getText();
			
			if ($photoEntry->getExifTags() != null && 
				$photoEntry->getExifTags()->getMake() != null &&
				$photoEntry->getExifTags()->getModel() != null) {
			
				$camera = $photoEntry->getExifTags()->getMake()->getText() . " " . 
						  $photoEntry->getExifTags()->getModel()->getText();
			}
			
			if ($photoEntry->getMediaGroup()->getContent() != null) {
			  $mediaContentArray = $photoEntry->getMediaGroup()->getContent();
			  $contentUrl = $mediaContentArray[0]->getUrl();
			}
			
			if ($photoEntry->getMediaGroup()->getThumbnail() != null) {
			  $mediaThumbnailArray = $photoEntry->getMediaGroup()->getThumbnail();
			  $firstThumbnailUrl = $mediaThumbnailArray[0]->getUrl();
			}
			
			//echo "AlbumID: " . $albumId . "<br />\n";
			//echo "PhotoID: " . $photoId . "<br />\n";
			//echo "Camera: " . $camera . "<br />\n";
			//echo "Content URL: " . $contentUrl . "<br />\n";
			echo('<img src="' . $firstThumbnailUrl . '" alt="Smiley face">');
			
			//echo "First Thumbnail: " . $firstThumbnailUrl . "<br />\n";
			
			//echo "<br />\n";    
			
			}

	}

function storeToPicasa() {
	global $gp, $_FILES;
	
	/* Add the original filename to our target path.  
	Result is "uploads/filename.extension" */
	$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
	
	if ($_FILES["uploadedfile"]["error"] > 0)
	  {
		echo "Error: " . $_FILES["uploadedfile"]["error"] . "<br />";
		echo ("Did you try to upload an especially large photo? Tsk tsk. <br/>
		Complain to Ada, she'll help you out.");
	  }
	else
	  {
		//echo "Upload: " . $_FILES["uploadedfile"]["name"] . "<br />";
	  	//echo "Type: " . $_FILES["uploadedfile"]["type"] . "<br />";
	    //echo "Size: " . ($_FILES["uploadedfile"]["size"] / 1024) . " Kb<br />";
	    //echo "Stored in: " . $_FILES["uploadedfile"]["tmp_name"];
	    
		$username = "default";
		$filename = $_FILES["uploadedfile"]["tmp_name"];
		//print("Using the filename of " . $filename . "<br/>");
		
		$photoName = "Name";
		$photoCaption = "Caption";
		$photoTags = "display";
	
		// We use the albumId of 'default' to indicate that we'd like to upload
		// this photo into the 'drop box'.  This drop box album is automatically 
		// created if it does not already exist.
		$albumId = "DisplayPics";
		
		$fd = $gp->newMediaFileSource($filename);
		$fd->setContentType("image/jpeg");
		//$_FILES['userfile']['type'] 
		
		
		// Create a PhotoEntry
		$photoEntry = $gp->newPhotoEntry();
		
		$photoEntry->setMediaSource($fd);
		$photoEntry->setTitle($gp->newTitle($photoName));
		$photoEntry->setSummary($gp->newSummary($photoCaption));
		
		// add some tags
		$keywords = new Zend_Gdata_Media_Extension_MediaKeywords();
		$keywords->setText($photoTags);
		$photoEntry->mediaGroup = new Zend_Gdata_Media_Extension_MediaGroup();
		$photoEntry->mediaGroup->keywords = $keywords;
		
		// We use the AlbumQuery class to generate the URL for the album
		$albumQuery = $gp->newAlbumQuery();
		
		$albumQuery->setUser($username);
		$albumQuery->setAlbumId($albumId);
		
		// We insert the photo, and the server returns the entry representing
		// that photo after it is uploaded
		
		$picasaid = "103719939483543979810";
		$picasaalbumid = "DisplayPics";
		$newalb = "http://www.picasaweb.google.com/data/feed/api/user/$picasaid/album/$picasaalbumid";
		
		//print($photoEntry . " = photoenry<br/>");
		//print($newalb . " = nwealb<br/>");

		
//		var_dump($photoEntry);
		
//		$insertedEntry = $gp->insertPhotoEntry($photoEntry, $albumQuery->getQueryUrl()); 
		
		try {
			var_dump($insertedEntry);
			$insertedEntry = $gp->insertPhotoEntry($photoEntry, $newalb); 
			
			
		} catch (Zend_Gdata_App_Exception $e) {
			echo "Error: " . $e->getMessage();
		}
		
		//var_dump($insertedEntry);

	    
		}		
	return $insertedEntry;

  	}
  	
?>