<?php
  // if (substr_count($_SERVER[HTTP_ACCEPT_ENCODING], gzip))
   //ob_start(ob_gzhandler);
  // else ob_start();
?>
<title>KISSmo Archive</title>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<meta name="HandheldFriendly" content="true">

<body>
<center>
<pre>Running</pre>
<pre>  _  _____ ___ ___           
 | |/ /_ _/ __/ __|_ __  ___ 
 | ' &lt; | |\__ \__ \ '  \/ _ \
 |_|\_\___|___/___/_|_|_\___/
</pre>
</center><br>
	<center><form method="POST" action="archive.php" class="search" enctype="multipart/form-data" autocomplete="off">
       <input type="text" name="query" maxlength=75 class="searchbox" minlength=3 placeholder="Enter keywords" required>
       <input type="submit" value="Search"></input>
</form></center>
<?php

if(isset($_POST['query'])) { //only do file operations when appropriate

echo "<pre class='cmdbox'>";
$input = $_POST['query'];

$directory = getcwd()."/p/";

$txts= glob($directory. "*.txt") or DIE("Unable to open $directory");
$found = 0;
foreach ($txts as $txt){
$searchfor = $_POST['query'];
$file = $txt;

$contents = file_get_contents($file);
$pattern = preg_quote($searchfor, '/');
$pattern = "/^.*$pattern.*\$/m";

    if (preg_match_all($pattern, $contents, $matches)) {
        
        $path_parts = pathinfo($file);
        $filename = $path_parts['basename'];
        $link = "<a href='./p/$filename' target='_blank'>$filename </a><br />";
        echo $link;
        echo implode("<br />", $matches[0]);
        echo '<br>';
        echo '-----------------<br>';
        $found = 1;
    } 
}

if($found == 0)
{
  echo 'No match found';
}

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

?>

  <?php
    $options = array(
      'quantity'  => 30, // how many item to display for each page
      'around'    => 7,  // how many page btn to show around the current page btn
      'directory' => './p', // dir to scan for items
    );

    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $options['quantity']; // $page base index is 1
    $filelist =  array_diff(scandir($options['directory']), array('..', '.'));

     //get subset of file array
    $selectedFiles = array_slice($filelist, $offset, $options['quantity']);

    foreach ($selectedFiles as $file) {
      $path = $options['directory'] . '/' . $file;

        $link = "<a href='./p/$file' target='_blank'> $file </a><br />";
        echo $link;
      
    }
  ?>

<div class="pagination">
  <a <?= $page <= 1 ? 'disabled' : '' ?> href="?page=<?= $page - 1 ?>">&larr;</a>
  <?php
    $len = count($filelist) / $options['quantity'];
    for ($i = 1; $i < $len + 1; $i++) {
      if (($i == 1 || $i > $len) || ($i > $page - $options['around'] && $i < $page + $options['around'])) {
        echo '<a class="'. ($page == $i ? 'active' : '') .'" href="?page='.$i.'">'. $i .'</a>';
      } elseif ($i > $page - $options['around'] - 1 && $i < $page + $options['around'] + 1) {
        echo '<a disabled class="btn">&hellip;</a>';
      }
    }
  ?>
  <a <?= $page >= $len ? 'disabled' : '' ?> href="?page=<?= $page + 1 ?>">&rarr;</a>
</ul>
</div>
</body>
