<?php
/**
 * Created by PhpStorm.
 * User: efik
 * Date: 01.07.15
 * Time: 21:28
 */
namespace Tests\SeriesReader\Iterator;

use SeriesReader\Iterator\CsvReader;

class CsvLoaderTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException \SeriesReader\Exception\FileNotFound
     * @expectedExceptionMessage File dada.txt not found!
     */
    public function test_throw_exception_during_file_not_found()
    {
        $csvReader = new CsvReader('dada.txt');
    }

    public function test_when_file_is_found()
    {
        $csvReader = new CsvReader('ratings.csv');

        return $csvReader;
    }

    /**
     * @depends test_when_file_is_found
     */
    public function test_current_method(CsvReader $csvReader)
    {
        $this->assertNotNull($csvReader);
        $array = explode(',', trim(file('ratings.csv')[0]));
        $this->assertSame($array, $csvReader->current());
    }

    /**
     * @depends test_when_file_is_found
     */
    public function test_next_and_key_method(CsvReader $csvReader)
    {
        $csvReader->next();
        $this->assertSame(1, $csvReader->key());
    }

    /**
     * @depends test_when_file_is_found
     */
    public function test_rewind_and_vaild_method(CsvReader $csvReader)
    {
        ;
        foreach ($csvReader as $data) {
            $current = $csvReader->current()[12];
            if ($current === "905Lordofth") {
                $this->assertTrue($csvReader->valid());
            } elseif ($current === "908Hellboun") {
                $this->assertFalse($csvReader->valid());
            }
        }
        $this->assertSame(0, $csvReader->key());
    }
}
