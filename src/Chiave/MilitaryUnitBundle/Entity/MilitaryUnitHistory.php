<?php

namespace Chiave\MilitaryUnitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * MilitaryUnitHistory
 *
 * @ORM\Table(name="military_unit_history")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MilitaryUnitHistory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="MilitaryUnit", inversedBy="history")
     * @ORM\JoinColumn(name="militaryUnit_id", referencedColumnName="id")
     **/
    private $militaryUnit;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $battles;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hits;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1024)
     */
    private $influence = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="soldiers", type="integer", nullable=true)
     */
    private $soldiers;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    public function __construct($militaryUnit) {
        $this->militaryUnit = $militaryUnit;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set militaryUnit
     *
     * @param \Chiave\MilitaryUnitBundle\Entity\MilitaryUnit $militaryUnit
     * @return MilitaryUnitHistory
     */
    public function setMilitaryUnit(\Chiave\MilitaryUnitBundle\Entity\MilitaryUnit $militaryUnit = null)
    {
        $this->militaryUnit = $militaryUnit;

        return $this;
    }

    /**
     * Get militaryUnit
     *
     * @return \Chiave\MilitaryUnitBundle\Entity\MilitaryUnit
     */
    public function getMilitaryUnit()
    {
        return $this->militaryUnit;
    }

    /**
     * Set battles
     *
     * @param integer $battles
     * @return MilitaryUnitHistory
     */
    public function setBattles($battles)
    {
        $this->battles = $battles;

        return $this;
    }

    /**
     * Get battles
     *
     * @return integer
     */
    public function getBattles()
    {
        return $this->battles;
    }

    /**
     * Set hits
     *
     * @param integer $hits
     * @return MilitaryUnitHistory
     */
    public function setHits($hits)
    {
        $this->hits = $hits;

        return $this;
    }

    /**
     * Get hits
     *
     * @return integer
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * Set influence
     *
     * @param string $influence
     * @return MilitaryUnitHistory
     */
    public function setInfluence($influence)
    {
        $this->influence = $influence;

        return $this;
    }

    /**
     * Get influence
     *
     * @return string
     */
    public function getInfluence()
    {
        return $this->influence;
    }

    /**
     * Set soldiers
     *
     * @param integer $soldiers
     * @return MilitaryUnitHistory
     */
    public function setSoldiers($soldiers)
    {
        $this->soldiers = $soldiers;

        return $this;
    }

    /**
     * Get soldiers
     *
     * @return integer
     */
    public function getSoldiers()
    {
        return $this->soldiers;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Pages
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setInitialTimestamps()
    {
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Pages
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedTimestamps()
    {
        $this->updatedAt = new \DateTime('now');
    }
}
