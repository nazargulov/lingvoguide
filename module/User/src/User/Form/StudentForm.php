<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 04.05.14
 * Time: 20:33
 */

namespace User\Form;

use Zend\Form\Form;
use Doctrine\ORM\EntityManager;

class StudentForm extends Form {

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
        parent::__construct('user');
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
        $this->add(array(
            'name' => 'userId',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->addInput('name', 'Имя', 'Введите имя...');
        $this->addInput('email', 'Email', 'Введите email');
        $this->addInput('phone', 'Тел.', '+7(___)___-__-__');

        $this->add(array(
            'name' => 'levelLanguage',
            'attributes' => array(
                'type'  => 'range',
                'object_manager' => $this->em,
                'target_class' => 'User\Entity\Student',
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

    public function addInput($name, $label, $placeholder)
    {
        $this->add(array(
            'name' => $name,
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => $placeholder,
                'object_manager' => $this->em,
                'target_class' => 'User\Entity\Student',
                'class' => 'topcoat-text-input topcoat-text-input--transparent',
            ),
            'options' => array(
                'label' => $label,
            ),
        ));
    }
} 