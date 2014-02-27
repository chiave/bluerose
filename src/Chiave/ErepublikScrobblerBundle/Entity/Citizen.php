<?php

namespace Chiave\ErepublikScrobblerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Citizen
 *
 * If you will add new field, remember to add
 * field checking in CitizenScrobblerService
 * (function updateCitizenChanges())
 *
 * @ORM\Table(name="citizen")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Citizen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    // *
    //  * @ORM\OneToOne(targetEntity="\Chiave\UserBundle\Entity\User", inversedBy="citizen", cascade={"all"})
    //  * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
    //  *
    // private $user;

    /**
     * @var integer
     *
     * @ORM\Column(name="citizenId", type="integer", nullable=true)
     */
    private $citizenId;

    /**
     * @var string
     *
     * @ORM\Column(name="nick", type="string", length=64)
     */
    private $nick;

    /**
     * @var string
     *
     * @ORM\Column(name="avatarUrl", type="string", length=255)
     */
    private $avatarUrl;

    /**
     * @var integer
     *
     * @ORM\Column(name="experience", type="integer")
     */
    private $experience;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * @var float
     *
     * @ORM\Column(name="strength", type="float")
     */
    private $strength;

    /**
     * @var integer
     *
     * @ORM\Column(name="rankPoints", type="integer")
     */
    private $rankPoints;

    /**
     * @var integer
     *
     * @ORM\Column(name="truePatriot", type="integer", nullable=true)
     */
    private $truePatriot;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ebirth", type="date")
     */
    private $ebirth;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=64)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=64)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="citizenship", type="string", length=64)
     */
    private $citizenship;

    /**
     * @var integer
     *
     * @ORM\Column(name="nationalRank", type="integer")
     */
    private $nationalRank;

    /**
     * @var integer
     *
     * @ORM\Column(name="partyId", type="integer", nullable=true)
     */
    private $partyId;

    /**
     * @var string
     *
     * @ORM\Column(name="partyName", type="string", length=64, nullable=true)
     */
    private $partyName;

    /**
     * @var integer
     *
     * @ORM\Column(name="militaryUnitId", type="integer", nullable=true)
     */
    private $militaryUnitId;

    /**
     * @var string
     *
     * @ORM\Column(name="militaryUnitName", type="string", length=64, nullable=true)
     */
    private $militaryUnitName;

    /**
     * @var array
     *
     * @ORM\Column(name="achievements", type="json_array", nullable=true)
     */
    private $achievements;

    /**
     * @ORM\OneToMany(targetEntity="CitizenChange", mappedBy="citizen")
     */
    private $changes;

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


    public function __construct() {
        $this->changes = new ArrayCollection();
    }

    public function __toString() {
        return $this->getNick();
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

    // /**
    //  * Set user
    //  *
    //  * @param \Chiave\UserBundle\Entity\User $user
    //  * @return Citizen
    //  */
    // public function setUser(\Chiave\UserBundle\Entity\User $user = null)
    // {
    //     $this->user = $user;

    //     return $this;
    // }

    // /**
    //  * Get user
    //  *
    //  * @return \Chiave\UserBundle\Entity\User
    //  */
    // public function getUser()
    // {
    //     return $this->user;
    // }

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
     * Set nick
     *
     * @param string $nick
     * @return Player
     */
    public function setNick($nick)
    {
        $this->nick = $nick;

        return $this;
    }

    /**
     * Get nick
     *
     * @return string
     */
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * Set avatarUrl
     *
     * @param string $avatarUrl
     * @return Player
     */
    public function setAvatarUrl($avatarUrl)
    {
        $this->avatarUrl = $avatarUrl;

        return $this;
    }

    /**
     * Get avatarUrl
     *
     * @return string
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    /**
     * Get avatarUrl
     *
     * @return string
     */
    public function getLargeAvatarUrl()
    {
        return $this->avatarUrl;
    }

    /**
     * Get medium avatarUrl
     *
     * @return string
     */
    public function getMediumAvatarUrl()
    {
        $filename = $this->avatarUrl;
        $extension_pos = strrpos($filename, '.');

        return substr($filename, 0, $extension_pos) .
            '_142x142' . substr($filename, $extension_pos);
    }

    /**
     * Get small avatarUrl
     *
     * @return string
     */
    public function getSmallAvatarUrl()
    {
        $filename = $this->avatarUrl;
        $extension_pos = strrpos($filename, '.');

        return substr($filename, 0, $extension_pos) .
            '_55x55' . substr($filename, $extension_pos);
    }

    /**
     * Set experience
     *
     * @param integer $experience
     * @return Player
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * Get experience
     *
     * @return integer
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * Set level
     *
     * @param integer $level
     * @return Citizen
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set strength
     *
     * @param integer $strength
     * @return Player
     */
    public function setStrength($strength)
    {
        $this->strength = $strength;

        return $this;
    }

    /**
     * Get strength
     *
     * @return integer
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * Set rankPoints
     *
     * @param integer $rankPoints
     * @return Player
     */
    public function setRankPoints($rankPoints)
    {
        $this->rankPoints = $rankPoints;

        return $this;
    }

    /**
     * Get rankPoints
     *
     * @return integer
     */
    public function getRankPoints()
    {
        return $this->rankPoints;
    }

    /**
     * Set truePatriot
     *
     * @param integer $truePatriot
     * @return Player
     */
    public function setTruePatriot($truePatriot)
    {
        $this->truePatriot = $truePatriot;

        return $this;
    }

    /**
     * Get truePatriot
     *
     * @return integer
     */
    public function getTruePatriot()
    {
        return $this->truePatriot;
    }

    /**
     * Set ebirth
     *
     * @param \DateTime $ebirth
     * @return Player
     */
    public function setEbirth($ebirth)
    {
        $this->ebirth = $ebirth;

        return $this;
    }

    /**
     * Get ebirth
     *
     * @return \DateTime
     */
    public function getEbirth()
    {
        return $this->ebirth;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Player
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set region
     *
     * @param string $region
     * @return Player
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set citizenship
     *
     * @param string $citizenship
     * @return Player
     */
    public function setCitizenship($citizenship)
    {
        $this->citizenship = $citizenship;

        return $this;
    }

    /**
     * Get citizenship
     *
     * @return string
     */
    public function getCitizenship()
    {
        return $this->citizenship;
    }

    /**
     * Set nationalRank
     *
     * @param integer $nationalRank
     * @return Player
     */
    public function setNationalRank($nationalRank)
    {
        $this->nationalRank = $nationalRank;

        return $this;
    }

    /**
     * Get nationalRank
     *
     * @return integer
     */
    public function getNationalRank()
    {
        return $this->nationalRank;
    }

    /**
     * Set partyId
     *
     * @param integer $partyId
     * @return Player
     */
    public function setPartyId($partyId)
    {
        $this->partyId = $partyId;

        return $this;
    }

    /**
     * Get partyId
     *
     * @return integer
     */
    public function getPartyId()
    {
        return $this->partyId;
    }

    /**
     * Set partyName
     *
     * @param string $partyName
     * @return Player
     */
    public function setPartyName($partyName)
    {
        $this->partyName = $partyName;

        return $this;
    }

    /**
     * Get partyName
     *
     * @return string
     */
    public function getPartyName()
    {
        return $this->partyName;
    }

    /**
     * Set militaryUnitId
     *
     * @param integer $militaryUnitId
     * @return Player
     */
    public function setMilitaryUnitId($militaryUnitId)
    {
        $this->militaryUnitId = $militaryUnitId;

        return $this;
    }

    /**
     * Get militaryUnitId
     *
     * @return integer
     */
    public function getMilitaryUnitId()
    {
        return $this->militaryUnitId;
    }

    /**
     * Set militaryUnitName
     *
     * @param string $militaryUnitName
     * @return Player
     */
    public function setMilitaryUnitName($militaryUnitName)
    {
        $this->militaryUnitName = $militaryUnitName;

        return $this;
    }

    /**
     * Get militaryUnitName
     *
     * @return string
     */
    public function getMilitaryUnitName()
    {
        return $this->militaryUnitName;
    }

    /**
     * Set achievements
     *
     * @param array $achievements
     * @return Player
     */
    public function setAchievements($achievements)
    {
        $this->achievements = $achievements;

        return $this;
    }

    /**
     * Get achievements
     *
     * @return array
     */
    public function getAchievements()
    {
        return $this->achievements;
    }

    /**
     * Add changes
     *
     * @param CitizenChange $changes
     * @return Citizen
     */
    public function addChange(CitizenChange $changes)
    {
        $this->changes[] = $changes;

        return $this;
    }

    /**
     * Remove change
     *
     * @param CitizenChange $changes
     */
    public function removeChange(CitizenChange $changes)
    {
        $this->changes->removeElement($changes);
    }

    /**
     * Get changes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChanges()
    {
        return $this->changes;
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
