<?php
/**
 * Created by PhpStorm.
 * User: efik
 * Date: 04.07.15
 * Time: 13:03
 */
namespace SeriesReader\Repository;

use SeriesReader\Model\EpisodeInterface;

interface SeriesRepositoryInterface
{
    /**
     * Put Episode into Episodes array
     *
     * @param EpisodeInterface $episode
     * Should contain method check to verify that episode already exists before put
     *
     * @throws \Exception
     */
    public function put(EpisodeInterface $episode);

    /**
     * Check that episode Already Exists
     *
     * @param EpisodeInterface $episode
     *
     * @return bool
     * @throws \Exception
     */
    public function check(EpisodeInterface $episode);

    /**
     * @return array of Episodes
     */
    public function getEpisodes();

    /**
     * Returns best rated episode for specified $season number.
     *
     * @param int $season
     */
    public function getBestInSeason($season);

    /**
     * Returns best rated season finale episode.
     */
    public function getBestSeasonFinale();

    /**
     * Returns array of episodes starting with $letter.
     *
     * @param string $letter
     */
    public function getByTitleFirstLetter($letter);
}