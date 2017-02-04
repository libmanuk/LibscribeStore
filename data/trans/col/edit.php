<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Libscribe Text Editor</title>
<meta name="description" content="Editor">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="styles.css">
</head>

<?php
// first we need to see if we actually GET anything
$gettest = $_GET['p'];
if ( isset($gettest) ){

// need to lowercase the filename
$gettest = strtolower($gettest);

// remove all whitespace
$gettest = preg_replace('/\s+/', '', $gettest);


// set file to read 
$filename ='txt/'.$gettest.'.txt';

// set owner file to read
$owner ='txt/'.$gettest.'_owner.txt';

// set state file to read
$state ='txt/'.$gettest.'_state.txt';

// set notes file to read
$notes ='txt/'.$gettest.'_notes.txt';

// check if data file exists
if (file_exists($filename)) {

// now open the data file
$fh = @fopen($filename, "r");

// read data file contents
$data = @fread($fh, filesize($filename));

// then close it
  fclose($fh);
} else {

// if not, create it
  fopen($filename, "w+");

// read file contents 
  $data = @fread($fh, filesize($filename)); 

// close file 
  @fclose($fh); 
}



// check if owner file exists
if (file_exists($owner)) {

// now open the owner file
$oh = @fopen($owner, "r");

// read file contents
$owndata = @fread($oh, filesize($owner));

// then close it
  fclose($oh);
} else {

// if not, create it
  fopen($owner, "w+");

// read file contents 
  $owndata = @fread($oh, filesize($owner)); 

// close file 
  @fclose($oh); 
}


// check if owner transcript state exists
if (file_exists($state)) {

// now open the state file
$sh = @fopen($state, "r");

// read file contents
$statedata = @fread($sh, filesize($state));

// then close it
  fclose($sh);
} else {

// if not, create it
  fopen($state, "w+");

// read file contents 
  $statedata = @fread($sh, filesize($state)); 

// close file 
  @fclose($sh); 
}


// check if notes exists
if (file_exists($notes)) {

// now open the state file
$nh = @fopen($notes, "r");

// read file contents
$notesdata = @fread($nh, filesize($notes));

// then close it
  fclose($nh);
} else {

// if not, create it
  fopen($notes, "w+");

// read file contents 
  $notesdata = @fread($nh, filesize($notes)); 

// close file 
  @fclose($nh); 
}
} 

	echo '<body>
		<div class="main-container">
<div><span></span><span style="float:right"><a href="'.$filename.'" target="_blank"><img src="/libscribe_store/images/download.png"/></a></span></div>
				<div class="editor-view">
					<form action="" method= "post" > 
						<input type="submit" value="Save" align="right"><br/><br/>
						<textarea rows="20" name="newd">'.$data.'</textarea><br/><br/>
  <!-- Transcriber:<br/>
  <textarea rows="1" name="transd">'.$owndata.'</textarea><br/><br/>
  State (draft/final):<br/>
  <textarea rows="1" name="stated">'.$statedata.'</textarea><br/><br/>
  Notes:<br/>
  <textarea rows="10" name="notesd">'.$notesdata.'</textarea><br/><br/> -->
					</form>
				</div>
		</div>
	</body>';


// GATHER HTML FORM DATA AND UPDATE FILES

// gather new transcript text data
$newdata = @$_POST['newd']; 

if (isset($newdata)) { 

// open file  
$fw = fopen($filename, 'w'); 

// write to file 
// added stripslashes to $newdata
// strip tags if someone is using html or php tags
$newdata = strip_tags($newdata);
$fb = fwrite($fw,stripslashes($newdata)) or copy("source.txt","$filename.txt"); 

// close file 
fclose($fw);


echo '<script>
location = location
</script> ';
}

// gather new transcript owner data
$ownerdata = @$_POST['transd']; 

if (isset($ownerdata)) { 

// open file  
$ow = fopen($owner, 'w'); 

// write to file 
// added stripslashes to $ownerdata
// strip tags if someone is using html or php tags
$ownerdata = strip_tags($ownerdata);
$ob = fwrite($ow,stripslashes($ownerdata)) or copy("source.txt","$owner.txt"); 

// close file 
fclose($ow);

// set update file to read
$update ='txt/'.$gettest.'_update.txt';
$today = file_get_contents($update);
// get today's date
$today .= date("D M j G:i:s T Y\n");
file_put_contents($update, $today);


echo '<script>
location = location
</script> ';
}

// gather new transcript state data
$statedata = @$_POST['stated']; 

if (isset($statedata)) { 

// open file  
$sw = fopen($state, 'w'); 

// write to file 
// added stripslashes to $statedata
// strip tags if someone is using html or php tags
$statedata = strip_tags($statedata);
$sb = fwrite($sw,stripslashes($statedata)) or copy("source.txt","$state.txt"); 

// close file 
fclose($sw);


echo '<script>
location = location
</script> ';
}

// gather new transcript notes data
$notesdata = @$_POST['notesd']; 

if (isset($notesdata)) { 

// open file  
$nw = fopen($notes, 'w'); 

// write to file 
// added stripslashes to $notesdata
// strip tags if someone is using html or php tags
$notesdata = strip_tags($notesdata);
$nb = fwrite($nw,stripslashes($notesdata)) or copy("source.txt","$notes.txt"); 

// close file 
fclose($nw);


echo '<script>
location = location
</script> ';
}


?>
</html>
