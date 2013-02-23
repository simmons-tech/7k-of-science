<html>

	<?php
		include('globalsetup.php');
		setupHeader();
	?>
	
	<body>
		<div class="prettyForm">
			<form enctype="multipart/form-data" action="addPic.php" method="POST">
			<!--<input type="hidden" name="MAX_FILE_SIZE" value="1000000" /> -->
			Choose a file to upload: <input name="uploadedfile" type="file" />
			<br />
			<br />
			<input type="submit" value="Upload" />
			</form>
		</div>

	<a href="javascript:self.close()" id="cancelBtn">Cancel</a>
	
	</body>
</html>