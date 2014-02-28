<?php

namespace Chiave\ErepublikScrobblerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Player
 *
 * @ORM\Table(name="citizen_change")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CitizenChange
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
     * @ORM\ManyToOne(targetEntity="Citizen", inversedBy="changes")
     * @ORM\JoinColumn(name="citizen_id", referencedColumnName="id")
     **/
    private $citizen;

    /**
     * @var string
     *
     * @ORM\Column(name="field", type="string", length=32)
     */
    private $field;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=1024)
     */
    private $value;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="changedAt", type="datetime")
     */
    private $changedAt;


    public function __construct($citizen, $field, $value) {
        $this->citizen = $citizen;
        $this->field = $field;

        $this->setValue($value);
    }

    //TODO: Why error if no those lines and adding
    public function __toString() {
        return strval($this->id);
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
     * @return CitizenChange
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
     * Set field
     *
     * @param string $field
     * @return CitizenChange
     */
    public function setField($field)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Get field
     *
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Set value
     *
     * @param mixed $value
     * @return CitizenChange
     */
    public function setValue($value)
    {
        // if($this->field == 'Achievements') {
        //     $this->value = json_encode($value);
        // } else {
            $this->value = $value;
        // }

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get changedAt
     *
     * @return \DateTime
     */
    public function getChangedAt()
    {
        return $this->changedAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setInitialTimestamps()
    {
        $this->changedAt = new \DateTime('now');
    }
}
