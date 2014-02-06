<?php

namespace Chiave\ErepublikScrobblerBundle\Service;

use Chiave\ErepublikScrobblerBundle\Libraries\CurlUtils;

use Chiave\ErepublikScrobblerBundle\Entity\Citizen;

/**
 * class CitizenScrobblerService
 *
 * class description here
 *
 * @author  Sowx <>
 * @author  Alphanumerix <>
 */
class CitizenScrobblerService extends CurlUtils
{

    protected $container;

    public function setContainer($container)
    {
        $this->container = $container;
    }

    CONST URL_PROFILE = 'http://www.erepublik.com/en/citizen/profile/';

    private $_xpath;
    private $_id;

    public function showRawData($id) {
        $this->_prepare($id);

        if ($this->userExists()) {
            echo '<br>nick: ' . $this->getName();
            echo '<br>avatar url: ' . $this->getAvatar();
            echo '<br>avatar large url: ' . $this->getAvatar('large');
            echo '<br>avatar medium url: ' . $this->getAvatar('medium');
            echo '<br>avatar small url: ' . $this->getAvatar('small');
            echo '<br>lvl: ' . $this->getLvl();
            echo '<br>exp: ' . $this->getExp();
            echo '<br>str: ' . $this->getStr();
            echo '<br>rank: ' . $this->getRank();
            echo '<br>rank points: ' . $this->getRankPoints();
            echo '<br>rank image url: ' . $this->getRankImage();
            echo '<br>tp: ' . $this->getTruePatriot();
            echo '<br>';
            echo '<br>eUrodziny: ' . $this->getEBirthday()->format('Y-m-d');
            echo '<br>panstwo: ' . $this->getCountry();
            echo '<br>region: ' . $this->getRegion();
            echo '<br>obywatelstwo: ' . $this->getCitizenship();

            echo '<br>national rank: ' . $this->getNationalRank();
            echo '<br>';
            echo '<br>partia: ' . $this->getParty();
            echo '<br>id partii: ' . $this->getPartyId();
            echo '<br>mu: ' . $this->getMilitaryUnit();
            echo '<br>id mu: ' . $this->getMilitaryUnitId();
            echo '<br>';echo '<br>';
            var_dump($this->getMedals());
        } else {
            echo '<br />User o podanym ID prawdopodobnie nie istnieje.';
        }
    }

    public function updateCitizen($id) {
        $this->_prepare($id);

        if (!$this->userExists()) {
            $status = 'nouser';
            return $status;
        }

        $em = $this->container
            ->get('doctrine.orm.entity_manager')
        ;

        $citizen = $em
            ->getRepository('Chiave\ErepublikScrobblerBundle\Entity\Citizen')
            ->findOneByUserId($id)
        ;

        if ($citizen instanceof Citizen) {
            $status = 'update';
        } else {
            $status = 'create';
            $citizen = new Citizen();
        }

        $citizen->setUserId($id);
        $citizen->setNick($this->getName());
        $citizen->setAvatarUrl($this->getAvatar());
        // $citizen->set($this->getLvl());
        $citizen->setExperience($this->getExp());
        $citizen->setStrength($this->getStr());
        // $citizen->set($this->getRank());
        $citizen->setRankPoints($this->getRankPoints());
        // $citizen->set($this->getRankImage());
        $citizen->setTruePatriot($this->getTruePatriot());
        $citizen->setEbirth($this->getEBirthday());
        $citizen->setCountry($this->getCountry());
        $citizen->setRegion($this->getRegion());
        $citizen->setCitizenship($this->getCitizenship());
        $citizen->setNationalRank($this->getNationalRank());
        $citizen->setPartyId($this->getPartyId());
        $citizen->setPartyName($this->getParty());
        $citizen->setMilitaryUnitId($this->getMilitaryUnitId());
        $citizen->setMilitaryUnitName($this->getMilitaryUnit());
        $citizen->setAchievements($this->getMedals());

        $em->persist($citizen);
        $em->flush();

        return $status;
    }

    public function userExists()
    {
        $query = $this->_xpath->query("//div[@class='citizen_profile_header']/h2");

        if ($query && $query->item(0) && $query->item(0)->nodeValue) {
            return true;
        }

        return false;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getName()
    {
        return trim($this->_xpath->query("//div[@class='citizen_profile_header']/h2")
            ->item(0)->nodeValue
        );
    }

    public function getAvatar($size = 'large')
    {
        return trim($this->_getImage(
            $this->_xpath->query("//img[@class='citizen_avatar']/@style")
            ->item(0)->nodeValue, $size
        ));

    }

    public function getLvl()
    {
        return trim($this->_xpath->query("//div[@class='citizen_experience']/strong[@class='citizen_level']")
            ->item(0)->nodeValue
        );
    }

    public function getExp()
    {
        return trim($this->_formatNumber($this->_getBeforeSlash(
            $this->_xpath->query("//div[@class='citizen_experience']/div/p")
            ->item(0)->nodeValue
        )));
    }

    public function getStr()
    {
        return trim($this->_formatNumber(
            $this->_xpath->query("//div[@class='citizen_military'][1]/h4")
            ->item(0)->nodeValue
        ));
    }

    public function getRank()
    {
        return trim($this->_xpath->query("//div[@class='citizen_military'][2]/h4/a")
            ->item(0)->nodeValue
        );
    }

    public function getRankImage()
    {
        return trim($this->_xpath->query("//div[@class='citizen_military'][2]/h4/img/@src")
            ->item(0)->nodeValue
        );
    }

    public function getRankPoints()
    {
        return trim($this->_formatNumber($this->_getBeforeSlash(
            $this->_xpath->query("//div[@class='citizen_military'][2]/div[@class='stat']/small[2]/strong")
            ->item(0)->nodeValue
        )));
    }

    public function getTruePatriot()
    {
        $query = $this->_xpath->query("//div[@class='citizen_military'][3]/div[@class='stat']/small[2]/strong")
                    ->item(0)
        ;

        if ($query) {
            return $this->_formatNumber(
                $this->_getBeforeSlash(
                   $query->nodeValue
            ));
        }

        return null;
    }

    public function getEBirthday()
    {
        $eBirthday = trim($this->_xpath->query("//div[@class='citizen_info']/div[@class='citizen_second']/p[2]")
            ->item(0)->nodeValue);
        $dt = new \DateTime();
        $dt = $dt->createFromFormat('M d, Y', $eBirthday);
        return $dt;
    }


    public function getCountry()
    {
        return trim($this->_xpath->query("//div[@class='citizen_sidebar']/div[@class='citizen_info']/a[1]")
            ->item(0)->nodeValue
        );
    }

    public function getRegion()
    {
        return trim($this->_xpath->query("//div[@class='citizen_sidebar']/div[@class='citizen_info']/a[2]")
            ->item(0)->nodeValue
        );
    }

    public function getCitizenship()
    {
        return trim($this->_xpath->query("//div[@class='citizen_sidebar']/div[@class='citizen_info']/a[3]")
            ->item(0)->nodeValue
        );
    }

    public function getNationalRank()
    {
        return trim($this->_xpath->query("//div[@class='citizen_second']/small[3]/strong")
            ->item(0)->nodeValue
        );

    }

    public function getParty()
    {
        $partyString = $this->_xpath->query("//div[@class='citizen_activity']/div[@class='place'][1]/div/span/a")
            ->item(0)
        ;

        if ($partyString) {
            return trim($partyString->nodeValue);
        }

        return null;
    }

    public function getPartyId()
    {
        $partyString = $this->_xpath->query("//div[@class='citizen_activity']/div[@class='place'][1]/div/span/a/@href")
            ->item(0)
        ;

        if ($partyString) {
            $party = $partyString->nodeValue;
            preg_match('/(\d+)/', $party, $id);
            return $id[1];
        }

        return null;
    }

    public function getMilitaryUnit()
    {
        $mu = $this->_xpath->query("//div[@class='citizen_activity']/div[@class='place'][2]/div[@class='one_newspaper']/a")
            ->item(0)
        ;

        if ($mu) {
            return trim($mu->nodeValue);
        }

        return null;
    }

    public function getMilitaryUnitId()
    {
        $mu = $this->_xpath->query("//div[@class='citizen_activity']/div[@class='place'][2]/div[@class='one_newspaper']/a/@href")->item(0);

        if ($mu) {
            $result = $mu->nodeValue;
            $id = explode('/', $result);
            return end($id);
        }

        return null;
    }

    public function getMedals()
    {
        $allMedals = $this->_xpath->query("//ul[@id='achievment']/li");
        $medals = array();
        foreach ($allMedals as $medal) {
            $type = $this->_xpath->query(".//span/p/strong", $medal)
                ->item(0)->nodeValue;
            $amount = $this->_xpath->query(".//div[@class='counter']", $medal);
            $medals[$type] = ($amount->length > 0 ? (int)$amount->item(0)->nodeValue : 0);
        }
        return $medals;
    }

    private function _prepare($id)
    {
        $html = $this->_get(self::URL_PROFILE . $id);
        $dom = new \DOMDocument();
        @$dom->loadHTML($html);
        $this->_xpath = new \DOMXPath($dom);
        $this->_id = $id;
    }

    private function _formatNumber($number)
    {
        return str_replace(',', '', $number);
    }

    private function _getBeforeSlash($string)
    {
        $temp = explode('/', $string);
        return trim($temp[0]);
    }

    private function _getImage($string, $size)
    {
        preg_match('@((?:https?\:\/\/)(?:[a-zA-Z]{1}(?:[\w\-]+\.)+(?:[\w]{2,5}))(?:\:[\d]{1,5})?\/(?:[^\s\/]+\/)*(?:[^\s]+\.(?:jpe?g|gif|png))(?:\?\w+=\w+(?:&\w+=\w+)*)?)@', $string, $matches);
        if ($size == 'large')
            return str_replace('_142x142', '', $matches[1]);
        else if ($size == 'medium')
            return $matches[1];
        else if ($size == 'small');
            return str_replace('_142x142', '_55x55', $matches[1]);
    }
}

