<?php

namespace SeriesReader\Repository;

use SeriesReader\Model\Episode;
use SeriesReader\Model\EpisodeInterface;

/**
 * Class SeriesRepository
 * @package SeriesReader\Repository
 */
class SeriesRepository implements SeriesRepositoryInterface
{

    private $episodesArray;

    /**
     * Put episodes into array
     * @param EpisodeInterface $episode
     * @throws \Exception
     */
    public function put(EpisodeInterface $episode)
    {
        $this->check($episode);
        $this->episodesArray[] = $episode;
    }

    /**
     * Check if episode already exists
     * @param EpisodeInterface $episode
     * @return bool
     * @throws \Exception
     */
    public function check(EpisodeInterface $episode)
    {
        if (empty($this->episodesArray)) {
            return true;
        }
        if (in_array($episode, $this->episodesArray)) {
            throw new \Exception("Episode already exists!");
        }
        return true;
    }

    /**
     * @return Episode[]
     */
    public function getEpisodes()
    {
        return $this->episodesArray;
    }

    /**
     * Returns best rated episode for specified $season number.
     *
     * @param int $season
     * @return Episode
     * @throws \Exception
     */
    public function getBestInSeason($season)
    {
        if (!array_key_exists($season, $this->episodesArray)) {
            throw new \Exception("Episode not found!");
        }
        $episodes = array_filter($this->episodesArray, function ($episode) use ($season) {
            if ($episode->getSeason() === $season) {
                return $episode;
            }
            return false;
        });
        return $this->getBestRating($episodes);
    }

    /**
     * Get best Rating based
     *
     * @param array $arrayOfObjects Episode[]
     * @param bool $single Return as Object
     * @return Episode|Episode[]
     */
    private function getBestRating(array $arrayOfObjects, $single = true)
    {
        usort($arrayOfObjects,
            function ($a, $b) {
                if ($a->getRating() === $b->getRating()) {
                    return 0;
                }
                return ($a->getRating() > $b->getRating()) ? -1 : 1;
            }
        );
        return ($single) ? $arrayOfObjects[0] : $arrayOfObjects;
    }

    /**
     * Returns best rated season finale episode.
     * @return Episode
     */
    public function getBestSeasonFinale()
    {
        return $this->getBestRating($this->episodesArray);
    }

    /**
     * Returns array of episodes starting with $letter.
     *
     * @param string $letter
     * @return Episode[]
     */
    public function getByTitleFirstLetter($letter)
    {
        $foundEpisodes = array_filter($this->episodesArray, function ($episode) use ($letter) {
            if (preg_match('/(\d+)(' . $letter . ')/s', $episode->getTitle())) {
                return true;
            }
            return false;
        });
        return $foundEpisodes;
    }
}
