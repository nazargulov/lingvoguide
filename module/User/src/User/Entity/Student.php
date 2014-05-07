<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 04.04.14
 * Time: 22:40
 */

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Student {
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

    /** @ORM\Column(type="string") */
    protected $email;

    /** @ORM\Column(type="integer") */
    protected $levelLanguage;

    /** @ORM\Column(type="string") */
    protected $phone;

    /**
     * set id
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * get id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * set userId
     * @param $userId
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * get userId
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * set name
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * get name
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * set email
     * @param $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * get email
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * set levelLanguage
     * @param $levelLanguage
     * @return $this
     */
    public function setLevelLanguage($levelLanguage)
    {
        $this->levelLanguage = $levelLanguage;
        return $this;
    }

    /**
     * get levelLanguage
     * @return mixed
     */
    public function getLevelLanguage()
    {
        return $this->levelLanguage;
    }

    /**
     * set phone
     * @param $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * get phone
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }
} 