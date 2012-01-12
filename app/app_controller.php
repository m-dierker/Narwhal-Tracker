<?php
    class AppController extends Controller {
        var $components = array('Acl', 'Auth', 'Session');
        var $helpers = array('Html', 'Form', 'Session');
        
        function beforeFilter() {
            $this->Auth->allow('display');
            $this->Auth->actionPath = 'Controllers/';
            $this->Auth->authorize = 'actions';
            $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
            $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
            $this->Auth->loginRedirect = array('controller' => 'riders', 'action' => 'index');
            
            $this->loadModel('User');
            $user = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
            
            if($user['Group']['name'] == 'riders') {
                $this->layout = 'rider';
            }
        }
    }
?>