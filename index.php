<?php
   if (substr_count($_SERVER[HTTP_ACCEPT_ENCODING], gzip))
   ob_start(ob_gzhandler);
   else ob_start();
?>
<?php
$ncsite="paste.uk.to 7777";
?>
<html>
    <body>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">

<link rel="stylesheet" href="./style.css">
	<title>Running under KISSmo Paste</title>
	<center>
<pre>Running</pre>
<pre>  _  _____ ___ ___           
 | |/ /_ _/ __/ __|_ __  ___ 
 | ' &lt; | |\__ \__ \ '  \/ _ \
 |_|\_\___|___/___/_|_|_\___/
</pre>
</center><br>
	<center><a href="./">Paste</a> | <a href="./archive.php">Archive</a></center>
        <center><form name="form" method="post">
            <textarea name="text_box" cols="40" minlength="5" rows="5" placeholder="Paste your code here..." maxlength="1048576" style="margin: 0px; width: 80%; height: 249px;" required pattern="\S+" oninvalid="this.setCustomValidity('We apologize but we won`t allow empty paste!')" oninput="this.setCustomValidity('')"></textarea> 
	<br>
	<br>
            <input type="submit" id="search-submit" value="Paste it!" />
        </form></center>
	<br>
	<br>
	<center>Use this paste via terminal examples <span style="color:#e74c3c">"echo I was here | nc <?php echo"$ncsite";?>"</span> or <span style="color:#e74c3c">"cat example | nc <?php echo"$ncsite";?>"</span><center><br>
	<center>KISS (Keep it simple, stupid) style pastebin developed from (monaco) with less than <span style="color:#e74c3c">70</span> Lines of code!</center>
	<center>Running KISSmo v.1.0.0 stable > 1.5 KB</center>
	<br>
<?php
// Set the current working directory
$directory = getcwd()."/p/";

// Initialize filecount variavle
$filecount = 0;

$files2 = glob( $directory ."*" );

if( $files2 ) {
    $filecount = count($files2);
}

echo "<center>Currently archiving: ";
echo $filecount . " paste files </center>";
?>
    </body>
</html>
<?php
    
if(isset($_POST['text_box'])) { //only do file operations when appropriate
        
	$sitename = "https://paste.ircnow.org/p";
	$a = $_POST['text_box'];
	$powered = "### This content was generated under KISSmo Paste with love at this time:";
	$tagz = "### ";
	$koha = date('d.m.Y H:i:s A');
	$num_str = uniqid() . '.txt';
	//*$num_str = uniqid(rand(), true) . '.txt';
        $myFile = "p/$num_str";
        $fh = fopen($myFile, 'w') or die("can't open file");
	fwrite($fh, $a."\n"."\n");
	fwrite($fh, $powered."\n");
	fwrite($fh, $tagz);
	fwrite($fh, $koha."\n");
        fclose($fh);

	echo "<br>";
	echo "<span class='mon'>You're paste has been successful at a correct time: $koha</span>";
	echo "<br>";
	echo "<span style='color:#2c3e50'><strong>Click here to open you're paste -></strong></span>: <a href='$sitename/$num_str' target='_blank'>$num_str<a>";
	echo "<br>";
	echo "Or copy you're full url: <span class='success'><strong>$sitename/$num_str</span></strong></span>";
	echo "<br>";
        echo "<br>";
	echo "You're paste preview here";
        echo "<br>";
        echo "<br>";
	echo "<center><textarea style='margin: 0px; width: 80%; height: 249px;'>$a</textarea></center>";
	echo "<br>";
    }
?>
