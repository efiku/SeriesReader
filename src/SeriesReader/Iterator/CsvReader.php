<?php

namespace SeriesReader\Iterator;

use SeriesReader\Exception\FileNotFoundException;

class CsvReader implements \Iterator
{

    /**
     * Must be greater than the longest line (in characters) to be found in
     * the CSV file (allowing for trailing line-end characters).
     * @var int
     */
    const ROW_LENGTH = 2048;

    /**
     * Resource file pointer
     * @var Resource
     */
    private $filePointer;

    /**
     * Represents current element in iteration
     * @var array
     */
    private $currentElement;

    /**
     * Cumulative row count of CSV data
     * @var int
     */
    private $rowCounter;

    /**
     * CSV column delimiter
     * @var string
     */
    private $delimiter;


    /**
     * @param $file
     * @param string $delimiter
     *
     * @throws FileNotFoundException
     */
    function __construct($file, $delimiter = ',')
    {
        if (!file_exists($file)) {
            throw new FileNotFoundException("File $file not found!");
        }
        $this->filePointer = fopen($file, "rt");
        $this->delimiter = $delimiter;
    }


    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        $this->currentElement = fgetcsv($this->filePointer, self::ROW_LENGTH, $this->delimiter);

        return $this->currentElement;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        ++$this->rowCounter;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return $this->rowCounter;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        if (feof($this->filePointer)) {
            $this->rewind();
            fclose($this->filePointer);

            return false;
        }

        return true;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->rowCounter = 0;
        $this->currentElement = null;
        rewind($this->filePointer);
    }
}
