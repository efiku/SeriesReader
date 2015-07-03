<?php
/**
 * Created by PhpStorm.
 * User: efik
 * Date: 04.07.15
 * Time: 00:24
 */

namespace Tests\SeriesReader\Model;


use SeriesReader\Model\Episode;

class EpisodeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Episode
     */
    protected $episode;

    public function setUp()
    {
        $episode = new Episode(1, 3.3, 'test');
        $this->episode = $episode;
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Only numbers are supported in number and rating parameter
     */
    public function test_it_should_throw_exception_during_insert_bad_episode_number()
    {
        $episode = new Episode('D', 2, 'test');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Only numbers are supported in number and rating parameter
     */
    public function test_it_should_throw_exception_during_insert_bad_episode_rating()
    {
        $episode = new Episode(1, 'D', 'test');
    }


    public function test_it_should_Implement_EpisodeInterface()
    {
        $this->assertInstanceOf('\SeriesReader\Model\EpisodeInterface', $this->episode);
    }

    public function test_should_return_episode_number()
    {
        $this->assertSame(1, $this->episode->getNumber());
    }

    public function test_should_return_episode_rating()
    {
        $this->assertSame(3.3, $this->episode->getRating());
    }

    public function test_should_return_episode_title()
    {
        $this->assertSame('test', $this->episode->getTitle());
    }
}
