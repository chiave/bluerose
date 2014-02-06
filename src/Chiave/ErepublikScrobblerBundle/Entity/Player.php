<?php

namespace Chiave\ErepublikScrobblerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Player
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Player
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
     * @var integer
     *
     * @ORM\Column(name="userId", type="integer")
     */
    private $userId;

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
     * @ORM\Column(name="strength", type="integer")
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
     * @ORM\Column(name="truePatriot", type="integer")
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
     * @ORM\Column(name="partyId", type="integer")
     */
    private $partyId;

    /**
     * @var string
     *
     * @ORM\Column(name="partyName", type="string", length=64)
     */
    private $partyName;

    /**
     * @var integer
     *
     * @ORM\Column(name="militaryUnitId", type="integer")
     */
    private $militaryUnitId;

    /**
     * @var string
     *
     * @ORM\Column(name="militaryUnitName", type="string", length=64)
     */
    private $militaryUnitName;

    /**
     * @var array
     *
     * @ORM\Column(name="achievements", type="json_array")
     */
    private $achievements;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return Player
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
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
