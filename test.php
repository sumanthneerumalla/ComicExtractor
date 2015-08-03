<?php
$webPage = file_get_contents("http://www.commitstrip.com/en/page/692/");
$count = 0;
$webPage = explode ("\n",$webPage );

foreach ($webPage as $line)
{
    $count = $count + 1;

    if ($count == 226) {
        $imagePortion = htmlentities($line,ENT_QUOTES);
    }
    if ($count == 213) {
        $titlePortion = htmlentities($line,ENT_QUOTES);
    }

}
echo $count;
?>