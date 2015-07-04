<?php
/**
 * Created by PhpStorm.
 * User: efik
 * Date: 04.07.15
 * Time: 12:24
 */

namespace SeriesReader\Repository;


use SeriesReader\Model\Episode;

/**
 * Class SeriesRepository
 * @package SeriesReader\Repository
 */
class SeriesRepository
{

    private $episodesArray;

    /**
     * @param Episode $episode
     *
     * @throws \Exception
     */
    public function put(Episode $episode)
    {
        $this->check($episode);
        $this->episodesArray[] = $episode;
    }

    /**
     * @param Episode $episode
     *
     * @return bool
     * @throws \Exception
     */
    private function check(Episode $episode)
    {
        if (empty($this->episodesArray)) {
            return true;
        }

        foreach ($this->episodesArray as $key => $value) {
            if ($episode->getTitle() === $value->getTitle() &&
                $episode->getRating() === $value->getRating() &&
                $episode->getNumber() === $value->getNumber() &&
                $episode->getSeason() === $value->getSeason()
            ) {
                throw new \Exception("Episode already exists!");
            }
        }

        return true;
    }

    /**
     * @return array of Episode
     */
    public function getEpisodes()
    {
        return $this->episodesArray;
    }
}