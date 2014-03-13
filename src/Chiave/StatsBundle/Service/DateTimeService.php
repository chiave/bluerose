<?php

namespace Chiave\StatsBundle\Service;

use Symfony\Component\HttpFoundation\Response;

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

    public function getDateByDay($day)
    {
        $date = new \DateTime('now');

        $erepZeroDay = new \DateTime('2007-11-20 9:00:00');
        $today = $date->diff($erepZeroDay)->format('%a');

        return $this->getDayChange($today-$day);
    }

    public function getErepublikDate($modifyDays = 0, $response = false)
    {
        $date = new \DateTime('now');
        $date->modify("-$modifyDays days");

        $erepZeroDay = new \DateTime('2007-11-20 9:00:00');
        $erepDay = $date->diff($erepZeroDay)->format('%a');

        if ($response == true) {
            return new Response($erepDay);
        }

        return $erepDay;
    }

    private function getEm()
    {
        return $this->container
            ->get('doctrine.orm.entity_manager')
        ;
    }
}

