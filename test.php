<?php
$webPage = file_get_contents("http://www.commitstrip.com/en/page/691/");
$count = 0;
$webPage = explode ("\r\n",$webPage );

foreach ($webPage as $line)
{
    $count = $count + 1;
    $characterArray = htmlentities($line,ENT_QUOTES);
    echo $characterArray;

}
echo $count;
?>