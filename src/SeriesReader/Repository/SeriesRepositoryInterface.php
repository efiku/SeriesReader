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
}