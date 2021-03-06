<?php

namespace Chiave\StatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ranking
 *
 * @ORM\Table(name="ranking")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Ranking
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
     * @ORM\OneToMany(
     *     targetEntity="RankingUser",
     *     mappedBy="ranking",
     *     cascade={"all"}
     * )
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $rankingUsers;

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


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rankingUsers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add rankingUsers
     *
     * @param \Chiave\StatsBundle\Entity\RankingUser $rankingUsers
     * @return Ranking
     */
    public function addRankingUser(\Chiave\StatsBundle\Entity\RankingUser $rankingUsers)
    {
        $this->rankingUsers[] = $rankingUsers;

        return $this;
    }

    /**
     * Remove rankingUsers
     *
     * @param \Chiave\StatsBundle\Entity\RankingUser $rankingUsers
     */
    public function removeRankingUser(\Chiave\StatsBundle\Entity\RankingUser $rankingUsers)
    {
        $this->rankingUsers->removeElement($rankingUsers);
    }

    /**
     * Get rankingUsers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRankingUsers()
    {
        return $this->rankingUsers;
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
