<?php

namespace Chiave\StatsBundle\Service;

use Symfony\Component\HttpFoundation\Response;

/**
 * class CitizenStatsService
 *
 * class description here
 *
 * @author  Alphanumerix <>
 */
class CitizenStatsService
{

    protected $container;

    public function setContainer($container)
    {
        $this->container = $container;
    }

    public function getTodayInfluence($citizenId)
    {
        $lastDayChange = $this->container->get('date_time')->getLastDayChange();

        $citizen = $this->getEm()
            ->getRepository('ChiaveErepublikScrobblerBundle:Citizen')
            ->findOneByCitizenId($citizenId)
        ;

        $lastRankPointsChange = $this->getEm()
            ->getRepository('ChiaveErepublikScrobblerBundle:CitizenChange')
            ->createQueryBuilder('cc')
                ->where('cc.citizen = :citizen')
                    ->setParameter('citizen', $citizen)
                ->andWhere('cc.changedAt < :lasdDC')
                    ->setParameter('lasdDC', $lastDayChange)
                ->andWhere('cc.field = \'RankPoints\'')
                ->orderBy('cc.changedAt', 'DESC')
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult()
        ;

        $influence = 0;

        if ($lastRankPointsChange != null) {
            $oldRankPoints = $lastRankPointsChange->getValue();
            $currentRankPoints = $citizen->getRankPoints();

            if ($oldRankPoints && $currentRankPoints) {
                $RankPointsDifference = $currentRankPoints - $oldRankPoints;

                $influence = $RankPointsDifference*10;
            }
        }

        return new Response($influence);
    }

    public function getYesterdayInfluence($citizenId)
    {
        $lastDayChange = $this->container->get('date_time')->getLastDayChange();

        $lastDayChange->modify('-1 day');

        $citizen = $this->getEm()
            ->getRepository('ChiaveErepublikScrobblerBundle:Citizen')
            ->findOneByCitizenId($citizenId)
        ;

        $lastRankPointsChange = $this->getEm()
            ->getRepository('ChiaveErepublikScrobblerBundle:CitizenChange')
            ->createQueryBuilder('cc')
                ->where('cc.citizen = :citizen')
                    ->setParameter('citizen', $citizen)
                ->andWhere('cc.changedAt < :changedAt')
                    ->setParameter('changedAt', $lastDayChange)
                ->andWhere('cc.field = \'RankPoints\'')
                ->orderBy('cc.changedAt', 'DESC')
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult()
        ;
        //TODO: wczoraj - przedwczoraj

        $influence = 0;

        if ($lastRankPointsChange != null) {
            $oldRankPoints = $lastRankPointsChange->getValue();
            $currentRankPoints = $citizen->getRankPoints();
            $RankPointsDifference = $currentRankPoints - $oldRankPoints;

            $influence = $RankPointsDifference*10;
        }

        return new Response($influence);
    }

    private function getEm()
    {
        return $this->container
            ->get('doctrine.orm.entity_manager')
        ;
    }
}

