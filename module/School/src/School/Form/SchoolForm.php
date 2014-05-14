<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 04.05.14
 * Time: 20:33
 */

namespace School\Form;

use Zend\Form\Form;
use Doctrine\ORM\EntityManager;

class SchoolForm extends Form {

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var FilterPluginManager
     */
    protected $fpm;

    public function __construct(EntityManager $em, $name = null)
    {
        $this->em = $em;
        // we want to ignore the name passed
        parent::__construct('School');
        $this->setAttribute('method', 'post');
        $this->addElements();

    }

    public function addElements()
    {
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->addInput('school', 'Организатор', '', true);
        $this->addInput('leading', 'Ведущий', '', false);
        $this->addInputEntity('name', 'Название', 'Введите название...', false);
        $this->addTextArea('about', 'About', 'Подробности...', true);
        $this->addTextArea('address', 'Address', 'Адрес...', true);
        $this->addDateTime('timeStart', 'Time start', '31.12.2014 00:00');
        $this->addDateTime('timeStop', 'Time stop', '31.12.2014 01:00');



        $this->add(array(
            'name' => 'levelLanguage',
            'attributes' => array(
                'type'  => 'range',
                'placeholder' => 'type your level...',
                'object_manager' => $this->em,
                'target_class' => 'School\Entity\School',
                'class' => 'topcoat-range',
                'min' => '1',
                'max' => '5',
            ),
            'options' => array(
                'label' => 'Level',
            ),
        ));


        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Ok',
                'id' => 'submitbutton',
                'class' => 'topcoat-button--large--cta',
            ),
        ));
    }

    public function addInputEntity($name, $label, $placeholder, $readonly)
    {
        $this->add(array(
            'name' => $name,
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => $placeholder,
                'object_manager' => $this->em,
                'target_class' => 'School\Entity\School',
                'class' => 'topcoat-text-input--transparent',
                'readonly' => $readonly,
            ),
            'options' => array(
                'label' => $label,
            ),
        ));
    }

    public function addInput($name, $label, $placeholder, $readonly)
    {
        $this->add(array(
            'name' => $name,
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => $placeholder,
                'object_manager' => $this->em,
                'class' => 'topcoat-text-input--transparent',
                'readonly' => $readonly,
            ),
            'options' => array(
                'label' => $label,
            ),
        ));
    }

    public function addTextArea($name, $label, $placeholder)
    {
        $this->add(array(
            'name' => $name,
            'attributes' => array(
                'type'  => 'textarea',
                'placeholder' => $placeholder,
                'object_manager' => $this->em,
                'target_class' => 'School\Entity\School',
                'class' => 'topcoat-textarea--transparent',
                'rows' => '3',
            ),
            'options' => array(
                'label' => $label,
            ),
        ));
    }

    public function addDateTime($name, $label, $placeholder)
    {
        $this->add(array(
            'name' => $name,
            'attributes' => array(
                'type'  => 'DateTime',
                'object_manager' => $this->em,
                'target_class' => 'School\Entity\School',
                'placeholder' => $placeholder,
            ),
            'options' => array(
                'label' => $label,
            ),
        ));
    }
} 