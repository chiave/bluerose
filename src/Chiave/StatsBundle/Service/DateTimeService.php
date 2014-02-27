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

    public function getLastDayChange()
    {
        $lastDayChange = new \DateTime('now');
        $lastDayChange->modify('+8 hours');

        if($lastDayChange->format('G') < 9) {
            $lastDayChange->modify('-1 day');
        }

        $lastDayChange->setTime(9, 0);

        return $lastDayChange;
    }

    private function getEm()
    {
        return $this->container
            ->get('doctrine.orm.entity_manager')
        ;
    }
}

