<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 04.05.14
 * Time: 20:33
 */

namespace Meeting\Form;

use Zend\Form\Form;
use Doctrine\ORM\EntityManager;

class MeetingForm extends Form {

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var bool
     */
    protected $readonly;

    /**
     * @var FilterPluginManager
     */
    protected $fpm;

    public function __construct(EntityManager $em, $name = null, $readonly = true)
    {
        $this->em = $em;
        $this->readonly = $readonly;
        // we want to ignore the name passed
        parent::__construct('Meeting');
        $this->setAttribute('method', 'post');
        $this->addElements();

    }

    public function addElements()
    {
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
                'readonly' => $this->readonly,
            ),
        ));
        $this->addInput('school', 'Организатор', '');
        $this->addInput('leading', 'Ведущий', '');
        $this->addInputEntity('name', 'Название', 'Введите название...');
        $this->addTextArea('about', 'Подробности', 'Введите подробности...');
        $this->addTextArea('address', 'Адрес', 'Адрес...');
        $this->addDateTime('timeStart', 'Начало', '31.12.2014 00:00');
        $this->addDateTime('timeStop', 'Конец', '31.12.2014 01:00');



        $this->add(array(
            'name' => 'levelLanguage',
            'attributes' => array(
                'readonly' => $this->readonly,
                'type'  => 'range',
                'object_manager' => $this->em,
                'target_class' => 'Meeting\Entity\Meeting',
                'class' => 'topcoat-range',
                'min' => '1',
                'max' => '5',
            ),
            'options' => array(
                'label' => 'Уровень',
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

    public function addInputEntity($name, $label, $placeholder)
    {
        $this->add(array(
            'name' => $name,
            'attributes' => array(
                'readonly' => $this->readonly,
                'type'  => 'text',
                'placeholder' => $placeholder,
                'object_manager' => $this->em,
                'target_class' => 'Meeting\Entity\Meeting',
                'class' => 'topcoat-text-input--transparent',
            ),
            'options' => array(
                'label' => $label,
            ),
        ));
    }

    public function addInput($name, $label, $placeholder)
    {
        $this->add(array(
            'name' => $name,
            'attributes' => array(
                'readonly' => $this->readonly,
                'type'  => 'text',
                'placeholder' => $placeholder,
                'object_manager' => $this->em,
                'class' => 'topcoat-text-input--transparent',
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
                'readonly' => $this->readonly,
                'type'  => 'textarea',
                'placeholder' => $placeholder,
                'object_manager' => $this->em,
                'target_class' => 'Meeting\Entity\Meeting',
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
                'readonly' => $this->readonly,
                'type'  => 'DateTime',
                'object_manager' => $this->em,
                'target_class' => 'Meeting\Entity\Meeting',
                'placeholder' => $placeholder,
            ),
            'options' => array(
                'label' => $label,
            ),
        ));
    }
} 