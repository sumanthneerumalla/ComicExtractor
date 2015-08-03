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
    $urlNumber = $GLOBALS["startValue"] - 1;
    foreach($urlArray as $nextUrl)
    {
        $urlNumber = $urlNumber +1;
        $webPage = file_get_contents($nextUrl);
        list($titlePortion, $imagePortion, $count) =  imageFinder($webPage);
        $titlePortion = html_entity_decode($titlePortion);
        $imagePortion = html_entity_decode($imagePortion);
        echo $titlePortion ;
        echo "The source page for this had ".$count." lines.<br>";
        echo "The Url number for this is ".$urlNumber."<br>";
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