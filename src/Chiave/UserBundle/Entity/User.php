<?php

namespace Chiave\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Player
 *
 * @ORM\Table(name="system_user")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="citizenId", type="integer", nullable=true)
     */
    private $citizenId;

    /**
     * @ORM\OneToOne(targetEntity="\Chiave\ErepublikScrobblerBundle\Entity\Citizen", mappedBy="user")
     * @ORM\JoinColumn(name="citizen_id", referencedColumnName="id", nullable=true)
     **/
    private $citizen;

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



    public function __construct()
    {
        parent::__construct();
        // your own logic
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
     * Set citizenId
     *
     * @param integer $citizenId
     * @return User
     */
    public function setCitizenId($citizenId)
    {
        $this->citizenId = $citizenId;

        return $this;
    }

    /**
     * Get citizenId
     *
     * @return integer
     */
    public function getCitizenId()
    {
        return $this->citizenId;
    }

    /**
     * Set citizen
     *
     * @param \Chiave\ErepublikScrobblerBundle\Entity\Citizen $citizen
     * @return User
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
