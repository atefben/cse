<?php
/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 07/02/17
 * Time: 10:31
 */

namespace AppBundle\Services;

use AppBundle\Entity\Collaborateur;
use Doctrine\ORM\EntityManager;
use AppBundle\Services\CsvFileParserService;

/**
 * Class EverwinCollaborateurImporterService
 * @package AppBundle\Services
 * This service allows to import collaborateurs from Everwin via a csv file
 */
class EverwinCollaborateurImporterService
{
    protected $columnsToImport;
    protected $csvFileParser;
    protected $em;

    /**
     * EverwinCollaborateurImporterService constructor.
     * @param array $columns
     * @param EntityManager $em
     * @param \AppBundle\Services\CsvFileParserService $csvFileParser
     */
    public function __construct($columns = [],EntityManager $em,CsvFileParserService $csvFileParser)
    {
        $this->columnsToImport = $columns;
        $this->em = $em;
        $this->csvFileParser = $csvFileParser;
    }

    /**
     * @param $fileName
     * @param null $delimiter
     * @return array|bool
     */
    protected function getCollaborateursFromCsv($fileName,$delimiter = null)
    {
        $parser = $this->csvFileParser;
        if(null !== $delimiter)
        {
            $parser->setDelimiter($delimiter);
        }
        $collaborateurs = $parser->convert($fileName);
        //@todo handle exception an enable logging
        return $collaborateurs;
    }

    /**
     * @param $filename
     */
    public function import($filename)
    {
        $collaborateursToImport = $this->getCollaborateursFromCsv($filename);
        $collaborateurs = [];
        if(empty($collaborateursToImport))
        {
            return ;
        }
        foreach ($collaborateursToImport as $collaborateur)
        {
            $qb = $this->em->createQuery('
                INSERT INTO AppBundle:Collaborateur ()
            ');
            $collab = new Collaborateur();
            $collab->setEverwinId($collaborateur['ID']);
            $collab->setFirstName($collaborateur['FIRST_NAME']);
            $collab->setLastName($collaborateur['LAST_NAME']);
//            $collab->setLastName($collaborateur['']);

            $collaborateurs[] = $collab;

            //@todo upsert collaborateurs into db
        }
    }

}