<?php

namespace SeriesReader\Model;

/**
 * Interface EpisodeInterface
 * @package SeriesReader\Model
 */
interface EpisodeInterface
{
    /**
     * @param int $season Episode season
     * @param int $number   Episode number.
     * @param float $rating Episode rating.
     * @param string $title Episode title.
     */
    public function __construct($season, $number, $rating, $title);

    /**
     * Returns episode number.
     * @return int
     */
    public function getNumber();

    /**
     * Returns weighted arithmetic mean of episode ratings.
     * @return float
     */
    public function getRating();

    /**
     * Returns episode title.
     * @return string
     */
    public function getTitle();
}
