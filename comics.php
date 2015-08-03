<?php


$starterUrl = "http://www.commitstrip.com/en/page/";
$startValue = 1;
$endValue = 10;

function urlCreator($starterUrl,$startValue,$endValue)
{
    $urlArray = [];
    for ($comicNumber = $startValue ;$comicNumber <= $endValue; ++$comicNumber)
        $urlArray[] = $starterUrl.$comicNumber;
    return $urlArray;
    }

function imagePrinter($urlArray)
{
    foreach($urlArray as $nextUrl)
    {
        $webPage = file_get_contents($nextUrl);
        list($titlePortion, $imagePortion, $count) =  imageFinder($webPage);
        echo $titlePortion. "<br>";
        echo $imagePortion ."<br>" ;

    }
}

function imageFinder($webPage)
{
    $webPage = explode ("\n",$webPage );
    $count =0;
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
    return array ($titlePortion,$imagePortion,$count);

    }


echo "<html><body>";
$urlArray = urlCreator($starterUrl,$startValue,$endValue);
imagePrinter($urlArray);
echo " </body></html>";
?>