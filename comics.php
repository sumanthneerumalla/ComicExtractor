<?php


$starterUrl = "http://www.commitstrip.com/en/page/";
$startValue = 1;
$endValue = 2;

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
        list( $imageUrl) =  imageFinder($webPage);
        #echo "<p>".$imageTitle."</p>";
        echo "<img style=\"-webkit-user-select: none\" src=\"".$imageUrl."\">";
    }
}

function imageFinder($webPage)
{
    $webPage = htmlentities($webPage,ENT_QUOTES);
    #$Title = strtok($webPage, "Permalink to ");
    #$Title = strtok($webPage, "\"");
    $imageUrl = strtok($webPage, "http://www.commitstrip.com/wp-content/uploads");
    $imageUrl = strtok($webPage, ".jpg");
    #$imageUrl = "http://www.commitstrip.com/wp-content/uploads".$imageUrl.".jpg";

    return array( $webPage, $imageUrl);
    }


#echo "<html><body>";
$urlArray = urlCreator($starterUrl,$startValue,$endValue);
imagePrinter($urlArray);
#echo " </body></html>";
?>