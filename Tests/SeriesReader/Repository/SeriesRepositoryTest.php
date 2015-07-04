<?php
/**
 * Created by PhpStorm.
 * User: efik
 * Date: 04.07.15
 * Time: 12:22
 */

namespace Test\SeriesReader\Repository;


use SeriesReader\Model\Episode;
use SeriesReader\Repository\SeriesRepository;
use SeriesReader\Repository\SeriesRepositoryInterface;

/**
 * Class SeriesRepositoryTest
 * @package Test\SeriesReader\Repository
 */
class SeriesRepositoryTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var SeriesRepositoryInterface
     */
    private $series;

    public function setUp()
    {
        $this->series = new SeriesRepository();
        for ($index = 0; $index < 100; $index++) {
            $this->series->put(new Episode(1, ($index + 1), $index * 0.3, 'title' . ($index + 1)));
        }
    }

    public function test_put_season_into_series_repository()
    {

        $this->assertCount(100, $this->series->getEpisodes());
    }

    /**
     * @expectedException \Exception
     */
    public function test_put_season_into_series_repository_but_episode_already_exists()
    {

        $this->series->put(new Episode(1, 87, 25.8, 'title87'));
    }


}
