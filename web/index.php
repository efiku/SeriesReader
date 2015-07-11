<?php
require __DIR__ . '/../vendor/autoload.php';
use SeriesReader\Iterator\CsvReader;
use SeriesReader\Repository\Helpers;
use SeriesReader\Repository\SeriesRepository;

$csvReader = new CsvReader('../ratings.csv');
$series = new SeriesRepository();
$helpers = new Helpers();
$helpers->loadEpisodes($csvReader, $series);

$twig = new Twig_Environment(new Twig_Loader_Filesystem('../src/SeriesReader/Resources/'));

echo $twig->render('index.html.twig', [
    "BestInSeason" => $series->getBestInSeason(4),
    "BestInAll" => $series->getBestSeasonFinale(),
    "FoundEpisodes" => $series->getByTitleFirstLetter('P')
]);
