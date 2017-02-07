<?php
/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 07/02/17
 * Time: 10:43
 */

namespace AppBundle\Services;


class CsvFileParserService
{
    const DEFAULT_DELIMITER = ';';
    protected $delimiter;

    public function __construct()
    {
        $this->delimiter = self::DEFAULT_DELIMITER;
    }

    /**
     * @return string
     */
    public function getDelimiter()
    {
        return $this->delimiter;
    }

    /**
     * @param string $delimiter
     */
    public function setDelimiter($delimiter)
    {
        $this->delimiter = $delimiter;
    }

    public function convert($filename)
    {
        if(!file_exists($filename) || !is_readable($filename)) {
            return FALSE;
        }

        $header = NULL;
        $data = array();

        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, $this->delimiter)) !== FALSE) {
                if(!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
        return $data;
    }
}