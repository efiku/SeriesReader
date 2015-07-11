<?php
/**
 * Created by PhpStorm.
 * User: efik
 * Date: 11.07.15
 * Time: 01:48
 */

namespace SeriesReader\Repository;


use SeriesReader\Iterator\CsvReader;
use SeriesReader\Model\Episode;

final class Helpers
{
    public function loadEpisodes(CsvReader &$csvReader, SeriesRepository &$seriesRepository)
    {
        foreach ($csvReader as $key => $episode) {
            if ($episode[0] === null || $csvReader->key() === 0) {
                continue;
            }
            $ratingsArray = array_slice($episode, 2, 10);
            $rating = $this->calculateRate($ratingsArray);
            $seriesRepository->put(new Episode($episode[0], $episode[1], $rating, $episode[12]));
        }

    }

    public function calculateRate(array $options)
    {
        $vote = [];
        for ($index = 0; $index < 10; $index++) {
            $vote[] = $options[$index] * (10 - $index);
        }
        $result = array_sum($vote) / array_sum($options);
        return $result;
    }
}
