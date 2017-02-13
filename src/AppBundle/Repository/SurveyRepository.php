<?php
namespace AppBundle\Repository;

/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 10/02/17
 * Time: 13:50
 */
class SurveyRepository extends \Doctrine\ORM\EntityRepository
{

    const CONDITION_NO_EVALUATION = 1;
    const CONDITION_RENEWABLE_EVALUATION = 2;
    const CONDITION_UNSATISFIED_EVALUATION = 3;


    public function getSurveysByUserIds($userIds = [],$conditions = [])
    {
        $conditionsFunctions = [
            self::CONDITION_NO_EVALUATION => function (){
                return 's.SRV_ID is null';
            },
            self::CONDITION_RENEWABLE_EVALUATION  => function (){
                return 'DATE_ADD(s.SRV_DATE,INTERVAL 90 DAY) < CURDATE()' ;
            },
            self::CONDITION_UNSATISFIED_EVALUATION => function (){
                return 'SURVEY_NOTE < 10';
            }
        ];



        $surveyQuery =
            <<<DQL
                SELECT 
                    *
                FROM
                    MSN_MISSION m
                        LEFT JOIN
                        (
                            SELECT * 
                            FROM SRV_SURVEY ms
                            JOIN (
                                    SELECT
                                        MAX(SRV_ID) AS SRV_ID_MAX,
                                        MSN_ID AS MSN_ID_MAX
                                    FROM SRV_SURVEY
                                    GROUP BY MSN_ID
                                 )
                                    
                            AS s ON s.MSN_ID_MAX = ms.MSN_ID
                            LEFT JOIN (
                                    SELECT 
                                        AVG(sc.SCR_COEFFICIENT*sc.SCR_SCORE) AS SURVEY_NOTE,
                                        SRV_ID AS SRV_ID_NOTE
                                    FROM SCR_SURVEY_CRITERIA sc GROUP BY SRV_ID
                                 ) AS snote ON snote.SRV_ID_NOTE = ms.SRV_ID   
                        ) s ON s.MSN_ID = m.MSN_ID
DQL;


        if(!empty($conditions))
        {
            $combinedConditions = '';
            $conditionsToAppend = [];
            foreach ($conditions as $condition)
            {
                if(!in_array($condition,array_keys($conditionsFunctions)))
                {
                    throw new \InvalidArgumentException('This value does not contains a function');
                }
                $conditionsToAppend[] = $conditionsFunctions[$condition]();
            }
            $combinedConditions = implode(' OR ',$conditionsToAppend);
            $surveyQuery .= ' WHERE '.$combinedConditions;
        }

        $stmt = $this->_em->getConnection()->prepare($surveyQuery);
        $stmt->execute();
        return $stmt->fetchAll();
        $surveys = $surveyQuery->getResult();
        return $surveys;
    }
}