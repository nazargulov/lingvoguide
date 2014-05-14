<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Meeting for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Meeting\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Meeting\Entity\Meeting;
use User\Entity\Student;
use School\Entity\School;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\ORM;
use Meeting\Form\MeetingForm;

class Main extends AbstractActionController
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
        $auth = $this->getAuth();
        if (!empty($auth) && $auth->hasIdentity()) {
            $userId = $auth->getIdentity()->getId();
        }

        $meetingId = (int) $this->params()->fromRoute("id", 0);
        $mode = "edit";
        $leading = null;
        $organizer = null;
        $meeting = $this->getEntityManager()->find('Meeting\Entity\Meeting', $meetingId);
        if (!$meeting instanceof Meeting) {
            $meeting = new Meeting();
            $leading = new Student();
            $organizer = new School();
            $mode = "add";
        } else {
            $leading = $this->getEntityManager()->find('User\Entity\Student', $meeting->getLeadingId());
            $organizer = $this->getEntityManager()->find('School\Entity\School', $meeting->getSchoolId());
        }

        $readonly = ($userId == $organizer->getUserId());
        $form = new MeetingForm($this->getEntityManager(), $readonly);
        $hydrator = new DoctrineHydrator($this->getEntityManager(), get_class($meeting));
        $form->setHydrator($hydrator);

        //bind object to form
        $form->bind($meeting);
        $form->get('id')->setValue($meetingId);
        if ($mode == "add") {
            $form->get('submit')->setValue('Add');
        } else {
            if (!empty($leading))
                $form->get('leading')->setValue($leading->getName());
            if (!empty($organizer))
                $form->get('school')->setValue($organizer->getName());
            $form->get('timeStart')->setValue($meeting->getTimeStart()->format('d.m.y h:m'));
            $form->get('timeStop')->setValue($meeting->getTimeStop()->format('d.m.y h:m'));
            $form->get('submit')->setAttribute('value', 'Save');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                if ($mode == "add") {
                    $this->getEntityManager()->persist($meeting);
                    $msg = 'Add new meeting';
                } else {
                    $msg = 'Edit meeting';
                }
                $this->getEntityManager()->flush();
                $this->FlashMessenger()->setNamespace(\Zend\Mvc\Controller\Plugin\FlashMessenger::NAMESPACE_INFO);
                // Redirect to list of albums
                return $this->redirect()->toRoute('meeting/default', array('controller' => 'main', 'action' => 'index', 'id' => $meetingId));
            }
        }
        return array('form' => $form);
    }

    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /module-specific-root/main/foo
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
