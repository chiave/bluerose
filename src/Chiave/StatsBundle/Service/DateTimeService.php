<?php

namespace Chiave\StatsBundle\Service;

/**
 * class DateTimeService
 *
 * class description here
 *
 * @author  Alphanumerix <>
 */
class DateTimeService
{

    protected $container;

    public function setContainer($container)
    {
        $this->container = $container;
    }

    public function getDayChange($modifyDays = 0)
    {
        $dayChange = new \DateTime('now');
        $dayChange->modify("-$modifyDays days");

        if($dayChange->format('G') < 9) {
            $dayChange->modify('-1 day');
        }

        $dayChange->setTime(9, 0);

        return $dayChange;
    }

    public function getErepublikDate($date = null)
    {
        if ($date == null) {
            $date = new \DateTime('now');
        }

        $erepZeroDay = new \DateTime('2007-11-20 9:00:00');
        $interval = $date->diff($erepZeroDay);
        return $interval->format('%a');
    }

    private function getEm()
    {
        return $this->container
            ->get('doctrine.orm.entity_manager')
        ;
    }
}

