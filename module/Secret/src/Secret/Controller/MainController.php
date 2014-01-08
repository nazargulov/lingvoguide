<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Secret for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Secret\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class MainController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->zfcUserAuthentication()->hasIdentity()) {
            return array();
        }
        return $this->redirect()->toRoute('application');
    }

    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /module-specific-root/skeleton/foo
        return array();
    }
}
