<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 04.04.14
 * Time: 22:40
 */

namespace Meeting\Entity;

use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Meeting {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $schoolId;

    /** @ORM\Column(type="integer") */
    protected $leadingId;

    /** @ORM\Column(type="string") */
    protected $name;

    /** @ORM\Column(type="text") */
    protected $about;

    /** @ORM\Column(type="datetime") */
    protected $timeStart;

    /** @ORM\Column(type="datetime") */
    protected $timeStop;

    /** @ORM\Column(type="text") */
    protected $address;

    /** @ORM\Column(type="integer") */
    protected $levelLanguage;

    /**
     * @param mixed $leadingId
     */
    public function setLeadingId($leadingId)
    {
        $this->leadingId = $leadingId;
    }

    /**
     * @return mixed
     */
    public function getLeadingId()
    {
        return $this->leadingId;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $timeStart
     */
    public function setTimeStart($timeStart)
    {
        $this->timeStart = $timeStart;
    }

    /**
     * @return mixed
     */
    public function getTimeStart()
    {
        return $this->timeStart;
    }

    /**
     * @param mixed $timeStop
     */
    public function setTimeStop($timeStop)
    {
        $this->timeStop = $timeStop;
    }

    /**
     * @return mixed
     */
    public function getTimeStop()
    {
        return $this->timeStop;
    }

    /**
     * @param mixed $about
     */
    public function setAbout($about)
    {
        $this->about = $about;
    }

    /**
     * @return mixed
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $levelLanguage
     */
    public function setLevelLanguage($levelLanguage)
    {
        $this->levelLanguage = $levelLanguage;
    }

    /**
     * @return mixed
     */
    public function getLevelLanguage()
    {
        return $this->levelLanguage;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $schoolId
     */
    public function setSchoolId($schoolId)
    {
        $this->schoolId = $schoolId;
    }

    /**
     * @return mixed
     */
    public function getSchoolId()
    {
        return $this->schoolId;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

} 