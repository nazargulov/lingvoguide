<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 04.04.14
 * Time: 22:40
 */

namespace School\Entity;

use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class School {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $userId;

    /** @ORM\Column(type="string") */
    protected $name;

    /** @ORM\Column(type="text") */
    protected $about;

    /** @ORM\Column(type="text") */
    protected $address;

    /** @ORM\Column(type="integer") */
    protected $levelLanguage;

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
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

} 