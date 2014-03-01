<?php

namespace Chiave\StatsBundle\Service;

use Chiave\ErepublikScrobblerBundle\Entity\CitizenInfluenceHistory;

/**
 * class CitizenInfluenceService
 *
 * class description here
 *
 * @author  Alphanumerix <>
 */
class CitizenInfluenceService
{

    protected $container;

    public function setContainer($container)
    {
        $this->container = $container;
    }

    // public function get($citizen, $dayChange = null)
    // {
    //     if ($dayChange == null) {
    //         $dayChange = $this->container->get('date_time')->getDayChange();
    //     }

    //     $influence = $em
    //         ->getRepository('ChiaveErepublikScrobblerBundle:CitizenInfuenceHistory')
    //         ->createQueryBuilder('cih')
    //             ->where('cih.citizen = :citizen')
    //                 ->setParameter('citizen', $citizen)
    //             ->andWhere('cih.createdAt >= :dayChange')
    //                 ->setParameter('dayChange', $dayChange)
    //             ->setMaxResults(1)
    //             ->getQuery()
    //             ->getOneOrNullResult()
    //     ;

    // }

    public function update($citizen)
    {
        $dayChange = $this->container->get('date_time')->getDayChange();

        $em = $this->getEm();

        $influence = $em
            ->getRepository('ChiaveErepublikScrobblerBundle:CitizenInfuenceHistory')
            ->createQueryBuilder('cih')
                ->where('cih.citizen = :citizen')
                    ->setParameter('citizen', $citizen)
                ->andWhere('cih.createdAt >= :dayChange')
                    ->setParameter('dayChange', $dayChange)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult()
        ;

        if ($influence == null) {
            $influence = new CitizenInfluenceHistory($citizen);
        }

        //last influence from day before
        $rankPointsChange = $em
            ->getRepository('ChiaveErepublikScrobblerBundle:CitizenChange')
            ->createQueryBuilder('cc')
                ->where('cc.citizen = :citizen')
                    ->setParameter('citizen', $citizen)
                ->andWhere('cc.changedAt < :dayChange')
                    ->setParameter('dayChange', $dayChange)
                ->andWhere('cc.field = \'RankPoints\'')
                ->orderBy('cc.changedAt', 'DESC')
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult()
        ;

        $influenceValue = 0;

        // if ($startRankPointsChange != null)
        //     echo 'srp', $startRankPointsChange->getValue(), '<br />';
        // if ($endRankPointsChange != null)
        //     echo 'erp', $endRankPointsChange->getValue(), '<br />';

        // echo 'crp', $citizen->getRankPoints(), '<br />';

        if ($rankPointsChange != null) {
            $startRankPoints = $startRankPointsChange->getValue();
            $endRankPoints = $citizen->getRankPoints();
            $rankPointsDifference = $endRankPoints - $startRankPoints;

            $influenceValue = $rankPointsDifference*10;
        }

        $influence->setInfluence($influenceValue);

        $em->persist($influence);
        $em->flush();

        return $influence;
    }

    private function getEm()
    {
        return $this->container
            ->get('doctrine.orm.entity_manager')
        ;
    }
}

