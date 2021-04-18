<?php
   if (substr_count($_SERVER[HTTP_ACCEPT_ENCODING], gzip))
   ob_start(ob_gzhandler);
   else ob_start();
?>
<title>KISSmo Archive</title>
<link rel="stylesheet" href="./style.css">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
        <center><h2>Runing KISSmo Paste</h2></center><br>
	<center><form method="POST" action="archive.php" class="search" enctype="multipart/form-data" autocomplete="off">
       <input type="text" name="query" maxlength=75 class="searchbox" minlength=3 placeholder="Enter keywords" required>
       <input type="submit" value="Search"></input>
</form></center>
<?php
//*$zer = system('grep -l ' . escapeshellarg($_POST['query']) . ' *p/*.txt');
if(isset($_POST['query'])) { //only do file operations when appropriate

echo "<pre class='cmdbox'>";
system('grep -l ' . escapeshellarg($_POST['query']) . ' *p/*.txt');
echo "</pre><br>";
}
?>
        <center><a href="./">Paste</a> | <a href="./archive.php">Archive</a></center>

<?php
// Set the current working directory
$directory = getcwd()."/p/";

// Initialize filecount variavle
$filecount = 0;

$files2 = glob( $directory ."*" );

if( $files2 ) {
    $filecount = count($files2);
}

echo "Currently archiving: ";
echo $filecount . " paste files ";

echo "<br><br>";

$dir_open = opendir('./p/');

while(false !== ($filename = readdir($dir_open))){
    if($filename != "." && $filename != ".."){
        $link = "<a href='./p/$filename' target='_blank'> $filename </a><br />";
        echo $link;
    }
}

closedir($dir_open);
?>
