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

    /**
     * Count hit
     *
     * @return integer
     */
    public function countHit($weaponsQuality = 7)
    {
        $influence = 10 *
                (1 + $this->getStrength()/400) *
                (1 + $this->getRankLevel()/5) *
                (1 + $this->getWeaponsFirePower($weaponsQuality)/100)
        ;

        return round($influence);
    }

    /**
     * Count division
     *
     * @return string
     */
    private function countDivision($level)
    {
        if ($level >= 70) {
            return 4;
        } else if ($level >= 50) {
            return 3;
        } else if ($level >= 35) {
            return 2;
        }

        return 1;
    }

    /**
     * Count rankLevel
     *
     * @return integer
     */
    private function countRankLevel($rankPoints)
    {
        $rankArray = array_reverse($this->getRankArray(), true);

        foreach ($rankArray as $rankLevel => $rank) {
            if ($rankPoints >= $rank) {
                return $rankLevel;
            }
        }

        return 0;
    }

    private function romanNumerals($num){
        $n = intval($num);
        $res = '';

        /*** roman_numerals array  ***/
        $roman_numerals = array(
            'M'  => 1000,
            'CM' => 900,
            'D'  => 500,
            'CD' => 400,
            'C'  => 100,
            'XC' => 90,
            'L'  => 50,
            'XL' => 40,
            'X'  => 10,
            'IX' => 9,
            'V'  => 5,
            'IV' => 4,
            'I'  => 1);

        foreach ($roman_numerals as $roman => $number){
            /*** divide to get  matches ***/
            $matches = intval($n / $number);

            /*** assign the roman char * $matches ***/
            $res .= str_repeat($roman, $matches);

            /*** substract from the number ***/
            $n = $n % $number;
        }

        /*** return the res ***/
        return $res;
    }

    private function getWeaponsFirePower($weaponsQuality)
    {
        $weaponsFirepowerArray = $this->getWeaponsFirepowerArray();

        return $weaponsFirepowerArray[$weaponsQuality];
    }

    private function getWeaponsFirepowerArray()
    {
        return array (
            1 => 20,
            2 => 40,
            3 => 60,
            4 => 80,
            5 => 100,
            6 => 120,
            7 => 200,
        );
    }

    private function getRankArray()
    {
        return array(
                1   => 0,
                2   => 15,
                3   => 45,
                4   => 80,
                5   => 120,
                6   => 170,
                7   => 250,
                8   => 350,
                9   => 450,
                10  => 600,
                11  => 800,
                12  => 1000,
                13  => 1400,
                14  => 1850,
                15  => 2350,
                16  => 3000,
                17  => 3750,
                18  => 5000,
                19  => 6500,
                20  => 9000,
                21  => 12000,
                22  => 15500,
                23  => 20000,
                24  => 25000,
                25  => 31000,
                26  => 40000,
                27  => 52000,
                28  => 67000,
                29  => 85000,
                30  => 110000,
                31  => 140000,
                32  => 180000,
                33  => 225000,
                34  => 285000,
                35  => 355000,
                36  => 435000,
                37  => 540000,
                38  => 660000,
                39  => 800000,
                40  => 950000,
                41  => 1140000,
                42  => 1350000,
                43  => 1600000,
                44  => 1875000,
                45  => 2185000,
                46  => 2550000,
                47  => 3000000,
                48  => 3500000,
                49  => 4150000,
                50  => 4900000,
                51  => 5800000,
                52  => 7000000,
                53  => 9000000,
                54  => 11500000,
                55  => 14500000,
                56  => 18000000,
                57  => 22000000,
                58  => 26500000,
                59  => 31500000,
                60  => 37000000,
                61  => 43000000,
                62  => 50000000,
                63  => 100000000,
                64  => 200000000,
                65  => 500000000,
                66  => 1000000000,
                67  => 2000000000,
                68  => 4000000000,
                69  => 10000000000,
            )
        ;
    }
}
