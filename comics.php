<?php


$starterUrl = "http://www.commitstrip.com/en/page/";
$startValue = 100;
$endValue = 200;

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
        $titlePortion = htmlspecialchars_decode($titlePortion, ENT_QUOTES);
        $imagePortion = htmlspecialchars_decode($imagePortion, ENT_QUOTES);
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
            $imagePortion = htmlspecialchars($line,ENT_QUOTES);
        }
        if ($count == 213) {
            $titlePortion = htmlspecialchars($line,ENT_QUOTES);
        }

    }
    return array ($titlePortion,$imagePortion,$count);

    }


echo "<html><body>";
$urlArray = urlCreator($starterUrl,$startValue,$endValue);
imagePrinter($urlArray);
echo " </body></html>";
?>