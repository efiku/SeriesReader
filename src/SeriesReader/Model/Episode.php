<?php

namespace SeriesReader\Model;

/**
 * Class Episode
 * @package SeriesReader\Model
 */
final class Episode implements EpisodeInterface
{
    private $number;
    private $rating;
    private $title;
    private $season;

    /**
     * @param int $season Episode season
     * @param int $number Episode number.
     * @param float $rating Episode rating.
     * @param string $title Episode title.
     */
    public function __construct($season, $number, $rating, $title)
    {
        $this->check($season);
        $this->check($number);
        $this->check($rating);
        $this->season = (int)$season;
        $this->number = (int)$number;
        $this->rating = (float)$rating;
        $this->title = (string)$title;
    }

    /**
     * Checks if is numeric
     * @param $number
     * @return bool
     */
    private function check($number)
    {
        if (!is_numeric($number)) {
            throw new \InvalidArgumentException("Only numbers are supported in number and rating parameter");
        }

        return true;
    }

    /**
     * Get season
     * @return int
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * Returns episode number.
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Returns weighted arithmetic mean of episode ratings.
     * @return float
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Returns episode title.
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
