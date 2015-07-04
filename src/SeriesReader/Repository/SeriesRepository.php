<?php
/**
 * Created by PhpStorm.
 * User: efik
 * Date: 04.07.15
 * Time: 12:24
 */

namespace SeriesReader\Repository;

use SeriesReader\Model\EpisodeInterface;

/**
 * Class SeriesRepository
 * @package SeriesReader\Repository
 */
class SeriesRepository implements SeriesRepositoryInterface
{

    private $episodesArray;

    /**
     * @param EpisodeInterface $episode
     *
*@throws \Exception
     */
    public function put(EpisodeInterface $episode)
    {
        $this->check($episode);
        $this->episodesArray[] = $episode;
    }

    /**
     * @param EpisodeInterface $episode

     *
*@return bool
     * @throws \Exception
     */
    public function check(EpisodeInterface $episode)
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

    /**
     * Returns best rated episode for specified $season number.
     *
     * @param int $season
     */
    public function getBestInSeason($season)
    {
        // TODO: Implement getBestInSeason() method.
    }

    /**
     * Returns best rated season finale episode.
     */
    public function getBestSeasonFinale()
    {
        // TODO: Implement getBestSeasonFinale() method.
    }

    /**
     * Returns array of episodes starting with $letter.
     *
     * @param string $letter
     */
    public function getByTitleFirstLetter($letter)
    {
        // TODO: Implement getByTitleFirstLetter() method.
    }
}