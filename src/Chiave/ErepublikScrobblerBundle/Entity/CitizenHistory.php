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
     * @var string
     *
     * @ORM\Column(name="nick", type="string", length=64, nullable=true)
     */
    private $nick;

    /**
     * @var string
     *
     * @ORM\Column(name="experience", type="string", nullable=true)
     */
    private $experience;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="integer", nullable=true)
     */
    private $level;

    /**
     * @var integer
     *
     * @ORM\Column(name="division", type="integer", nullable=true)
     */
    private $division;

    /**
     * @var float
     *
     * @ORM\Column(name="strength", type="float", nullable=true)
     */
    private $strength;

    /**
     * @var string
     *
     * @ORM\Column(name="rankPoints", type="string", nullable=true)
     */
    private $rankPoints;

    /**
     * @var integer
     *
     * @ORM\Column(name="rankLevel", type="integer", nullable=true)
     */
    private $rankLevel;

    /**
     * @var string
     *
     * @ORM\Column(name="rankName", type="string", nullable=true)
     */
    private $rankName;

    /**
     * @var string
     *
     * @ORM\Column(name="truePatriot", type="string", nullable=true)
     */
    private $truePatriot;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=64, nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=64, nullable=true)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="citizenship", type="string", length=64, nullable=true)
     */
    private $citizenship;

    /**
     * @var integer
     *
     * @ORM\Column(name="nationalRank", type="integer", nullable=true)
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
     * @var json_array
     *
     * @ORM\Column(name="achievements", type="json_array", nullable=true)
     */
    private $achievements;

    /**
     * @var string
     *
     * @ORM\Column(name="influence", type="string")
     */
    private $influence = '0';

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
    private $egovInfluence = '0';

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
        return $this->egovInfluence ? $this->egovInfluence : '0';
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
     * Set experience
     *
     * @param string $experience
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
     * @return string
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

        $this->setDivision(
            $this->countDivision($level)
        );

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
     * Set division
     *
     * @param integer $division
     * @return Citizen
     */
    public function setDivision($division)
    {
        $this->division = $division;

        return $this;
    }

    /**
     * Get division
     *
     * @return integer
     */
    public function getDivision($mode = 'arabic')
    {
        $result = '';
        $mode == 'arabic' ?
            $result = $this->division :
            $result = $this->romanNumerals($this->division)
        ;
        return $result;
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
     * @param string $rankPoints
     * @return Player
     */
    public function setRankPoints($rankPoints)
    {
        $this->rankPoints = $rankPoints;
        $this->rankLevel = $this->countRankLevel($rankPoints);

        return $this;
    }

    /**
     * Get rankPoints
     *
     * @return string
     */
    public function getRankPoints()
    {
        return $this->rankPoints;
    }

    /**
     * Set rankLevel
     *
     * @param integer $rankLevel
     * @return CitizenHistory
     */
    public function setRankLevel($rankLevel)
    {
        $this->rankLevel = $rankLevel;

        return $this;
    }

    /**
     * Get rankLevel
     *
     * @return integer
     */
    public function getRankLevel()
    {
        return $this->rankLevel;
    }

    /**
     * Set rankName
     *
     * @param string $rankName
     * @return Citizen
     */
    public function setRankName($rankName)
    {
        $this->rankName = $rankName;

        return $this;
    }

    /**
     * Get rankName
     *
     * @return string
     */
    public function getRankName()
    {
        return $this->rankName;
    }

    /**
     * Set truePatriot
     *
     * @param string $truePatriot
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
     * @return string
     */
    public function getTruePatriot()
    {
        return $this->truePatriot;
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
     * @param json_array $achievements
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
     * @return json_array
     */
    public function getAchievements()
    {
        return $this->achievements;
    }

    /**
     * Set influence
     *
     * @param string $influence
     * @return CitizenHistory
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
