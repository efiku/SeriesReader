<?php
/**
 * Created by PhpStorm.
 * User: efik
 * Date: 04.07.15
 * Time: 00:20
 */

namespace SeriesReader\Model;


use Prophecy\Exception\InvalidArgumentException;

class Episode implements EpisodeInterface
{
    private $number;
    private $rating;
    private $title;

    /**
     * @param int $number   Episode number.
     * @param float $rating Episode rating.
     * @param string $title Episode title.
     */
    public function __construct($number, $rating, $title)
    {
        $this->check($number);
        $this->check($rating);
        $this->number = $number;
        $this->rating = $rating;
        $this->title = $title;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    private function check($number)
    {
        if (!is_numeric($number)) {
            throw new InvalidArgumentException("Only numbers are supported in number and rating parameter");
        }

        return true;
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