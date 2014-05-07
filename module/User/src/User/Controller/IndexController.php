<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use User\Entity\Student;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\ORM;
use User\Form\StudentForm;

class IndexController extends AbstractActionController
{
    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var ZfcUserAuthService
     */
    protected $_auth;


    public function indexAction()
    {
        $userId = 0;
        $name = '';
        $email = '';
        $auth = $this->getAuth();
        if (!empty($auth) && $auth->hasIdentity()) {
            $userId = $auth->getIdentity()->getId();
            $name = $auth->getIdentity()->getDisplayname();
            $email = $auth->getIdentity()->getEmail();
        }
        $mode = "edit";
        $user = $this->getEntityManager()->getRepository('User\Entity\Student')->findOneBy(array('userId' => $userId));
        if (!$user instanceof Student) {
            $user = new Student();
            $mode = "add";
        }

        $form = new StudentForm($this->getEntityManager());
        $hydrator = new DoctrineHydrator($this->getEntityManager(), get_class($user));
        $form->setHydrator($hydrator);

        //bind object to form
        $form->bind($user);
        if ($mode == "add") {
            $form->get('userId')->setValue($userId);
            $form->get('name')->setValue($name);
            $form->get('email')->setValue($email);
            $form->get('submit')->setValue('Add');
        } else {
            $form->get('submit')->setAttribute('value', 'Save');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                if ($mode == "add") {
                    $this->getEntityManager()->persist($user);
                    $msg = 'Add new user';
                } else {
                    $msg = 'Edit user';
                }
                $this->getEntityManager()->flush();
                $this->FlashMessenger()->setNamespace(\Zend\Mvc\Controller\Plugin\FlashMessenger::NAMESPACE_INFO);
                // Redirect to list of albums
                return $this->redirect()->toRoute('user/default', array('controller' => 'index', 'action' => 'index'));
            }
        }
        return array('form' => $form);
    }

    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /module-specific-root/Index/foo
        return array();
    }

    /**
     * @return array|object|Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        if (null == $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    /**
     * @return array|object|ZfcUserAuthService
     */
    public function getAuth() {
        if (!$this->_auth) {
            $this->_auth = $this->zfcUserAuthentication();
        }
        return $this->_auth;
    }
}
