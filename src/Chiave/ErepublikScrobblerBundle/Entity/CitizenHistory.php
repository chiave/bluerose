<?php

namespace Chiave\ErepublikScrobblerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CitizenHistory
 *
 * @ORM\Table(name="citizen_history")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CitizenHistory
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
     * @ORM\ManyToOne(targetEntity="Citizen", inversedBy="history")
     * @ORM\JoinColumn(name="citizen_id", referencedColumnName="id")
     **/
    private $citizen;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $egovBattles = 0;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $egovHits = 0;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1024)
     */
    private $egovInfluence = '-----';

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

    public function __construct($citizen) {
        $this->citizen = $citizen;
    }

    public function __toString() {
        return $this->egovInfluence ? $this->egovInfluence : '-----';
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
     * Set citizen
     *
     * @param \Chiave\ErepublikScrobblerBundle\Entity\Citizen $citizen
     * @return CitizenHistory
     */
    public function setCitizen(\Chiave\ErepublikScrobblerBundle\Entity\Citizen $citizen = null)
    {
        $this->citizen = $citizen;

        return $this;
    }

    /**
     * Get citizen
     *
     * @return \Chiave\ErepublikScrobblerBundle\Entity\Citizen
     */
    public function getCitizen()
    {
        return $this->citizen;
    }

    /**
     * Set egovBattles
     *
     * @param integer $egovBattles
     * @return CitizenHistory
     */
    public function setEgovBattles($egovBattles)
    {
        $this->egovBattles = $egovBattles;

        return $this;
    }

    /**
     * Get egovBattles
     *
     * @return integer
     */
    public function getEgovBattles()
    {
        return $this->egovBattles;
    }

    /**
     * Set egovHits
     *
     * @param integer $egovHits
     * @return CitizenHistory
     */
    public function setEgovHits($egovHits)
    {
        $this->egovHits = $egovHits;

        return $this;
    }

    /**
     * Get egovHits
     *
     * @return integer
     */
    public function getEgovHits()
    {
        return $this->egovHits;
    }

    /**
     * Set egovInfluence
     *
     * @param string $egovInfluence
     * @return CitizenHistory
     */
    public function setEgovInfluence($egovInfluence)
    {
        $this->egovInfluence = $egovInfluence;

        return $this;
    }

    /**
     * Get egovInfluence
     *
     * @return string
     */
    public function getEgovInfluence()
    {
        return $this->egovInfluence;
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
