<?php
class UsersController extends AppController {
	var $name = 'Users';
    
	function index() {
		$this->User->recursive = 1;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
        $this->set('groups', $this->groupList());
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
        
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please try again.', true));
			}
		} else {
			$this->data = $this->User->read(null, $id);
		}
        
        $this->set('groups', $this->groupList());
	}

    function password() {
        $user = $this->User->read(null, $this->Auth->user('id'));
        
		if (!empty($this->data)) {
            if($this->data['User']['password'] != $user['User']['password']) {
				$this->Session->setFlash(__('Your current password was incorrect. Please try again.', true));
            } else if($this->data['User']['new_password'] != $this->data['User']['new_password1']) {
				$this->Session->setFlash(__('Your new passwords did not match. Please try again.', true));
            } else {
                $user['User']['password'] = $this->data['User']['new_password'];
                $user = $this->Auth->hashPasswords($user);
                if($this->User->save($user)) {
                    $this->Session->setFlash(__('Your password has been saved', true));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('An error occurred. Please try again.', true));
                }
            }
        } else {
            $this->set('username', $this->Auth->user('username'));
			$this->data = $user;
        }
    }   
    
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
    
    function beforeFilter() {
        parent::beforeFilter();
    }
    
    function login() {
        $this->layout = 'public';
    }
    
    function logout() {
        $this->layout = 'public';
        $this->Session->setFlash('You are now logged out');
        $this->redirect($this->Auth->logout());
    }
    
    private function groupList() {
        $this->loadModel('Group');
        $groups = $this->Group->find('all');
        
        $groupList = array();
        foreach($groups as $group) {
            $groupList[$group['Group']['id']] = $group['Group']['name'];
        }
        return $groupList;
    }
    
    ##helper function to codify permissions
    /*
    function initDB() {
        $group =& $this->User->Group;
        
        echo 'developer';
        $group->id = 8;
        $this->Acl->allow($group, 'controllers');
        echo 'treasury';
        $group->id = 5;
        $this->Acl->allow($group, 'controllers');
        $this->Acl->deny($group, 'controllers/Users');
        $this->Acl->allow($group, 'controllers/users/logout');
        $this->Acl->allow($group, 'controllers/users/login');
        $this->Acl->allow($group, 'controllers/users/password');
        echo 'admin';
        $group->id = 4;
        $this->Acl->allow($group, 'controllers');
        $this->Acl->deny($group, 'controllers/donations/add');
        $this->Acl->deny($group, 'controllers/donations/edit');
        $this->Acl->deny($group, 'controllers/donors/add');
        $this->Acl->deny($group, 'controllers/donors/edit');
        $this->Acl->deny($group, 'controllers/riders/add');
        $this->Acl->deny($group, 'controllers/riders/edit');
        $this->Acl->allow($group, 'controllers/users/logout');
        $this->Acl->allow($group, 'controllers/users/login');
        $this->Acl->allow($group, 'controllers/users/password');
        echo 'marketing';
        $group->id = 6;
        $this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/riders/index');
        $this->Acl->allow($group, 'controllers/RiderSummaries/team');
        $this->Acl->deny($group, 'controllers/Donors');
        $this->Acl->allow($group, 'controllers/donors/index');
        $this->Acl->allow($group, 'controllers/donors/search');
        $this->Acl->allow($group, 'controllers/donors/view');
        $this->Acl->allow($group, 'controllers/users/logout');
        $this->Acl->allow($group, 'controllers/users/login');
        $this->Acl->allow($group, 'controllers/users/password');
        echo 'info';
        $group->id = 9;
        $this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/Users');
        $this->Acl->allow($group, 'controllers/riders/index');
        $this->Acl->allow($group, 'controllers/riders/edit');
        $this->Acl->allow($group, 'controllers/riders/add');
        $this->Acl->allow($group, 'controllers/riders/delete');
        $this->Acl->allow($group, 'controllers/RiderSummaries/team');
        $this->Acl->allow($group, 'controllers/users/logout');
        $this->Acl->allow($group, 'controllers/users/login');
        $this->Acl->allow($group, 'controllers/users/password');
        $this->Acl->allow($group, 'controllers/Releases');
        $this->Acl->allow($group, 'controllers/AppSettings');
        echo 'fundraising';
        $group->id = 10;
        $this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/Donors');
        $this->Acl->deny($group, 'controllers/donors/add');
        $this->Acl->deny($group, 'controllers/donors/edit');
        $this->Acl->allow($group, 'controllers/Riders');
        $this->Acl->allow($group, 'controllers/RiderSummaries');
        $this->Acl->allow($group, 'controllers/users/logout');
        $this->Acl->allow($group, 'controllers/users/login');
        $this->Acl->allow($group, 'controllers/users/password');
        echo 'riders';
        $group->id = 11;
        $this->Acl->deny($group, 'controllers');
        $this->Acl->deny($group, 'controllers/Riders');
        $this->Acl->allow($group, 'controllers/riders/index');
        $this->Acl->allow($group, 'controllers/riders/summary');
        $this->Acl->allow($group, 'controllers/users/logout');
        $this->Acl->allow($group, 'controllers/users/login');
        $this->Acl->allow($group, 'controllers/users/password');
        
        echo 'all done';
        
        exit;
    }
    
    ##helper function for creating ACLs
    
    
    function build_acl() {
		if (!Configure::read('debug')) {
			return $this->_stop();
		}
		$log = array();

		$aco =& $this->Acl->Aco;
		$root = $aco->node('controllers');
		if (!$root) {
			$aco->create(array('parent_id' => null, 'model' => null, 'alias' => 'controllers'));
			$root = $aco->save();
			$root['Aco']['id'] = $aco->id; 
			$log[] = 'Created Aco node for controllers';
		} else {
			$root = $root[0];
		}   

		App::import('Core', 'File');
		$Controllers = App::objects('controller');
		$appIndex = array_search('App', $Controllers);
		if ($appIndex !== false ) {
			unset($Controllers[$appIndex]);
		}
		$baseMethods = get_class_methods('Controller');
		$baseMethods[] = 'build_acl';

		$Plugins = $this->_getPluginControllerNames();
		$Controllers = array_merge($Controllers, $Plugins);

		// look at each controller in app/controllers
		foreach ($Controllers as $ctrlName) {
			$methods = $this->_getClassMethods($this->_getPluginControllerPath($ctrlName));

			// Do all Plugins First
			if ($this->_isPlugin($ctrlName)){
				$pluginNode = $aco->node('controllers/'.$this->_getPluginName($ctrlName));
				if (!$pluginNode) {
					$aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $this->_getPluginName($ctrlName)));
					$pluginNode = $aco->save();
					$pluginNode['Aco']['id'] = $aco->id;
					$log[] = 'Created Aco node for ' . $this->_getPluginName($ctrlName) . ' Plugin';
				}
			}
			// find / make controller node
			$controllerNode = $aco->node('controllers/'.$ctrlName);
			if (!$controllerNode) {
				if ($this->_isPlugin($ctrlName)){
					$pluginNode = $aco->node('controllers/' . $this->_getPluginName($ctrlName));
					$aco->create(array('parent_id' => $pluginNode['0']['Aco']['id'], 'model' => null, 'alias' => $this->_getPluginControllerName($ctrlName)));
					$controllerNode = $aco->save();
					$controllerNode['Aco']['id'] = $aco->id;
					$log[] = 'Created Aco node for ' . $this->_getPluginControllerName($ctrlName) . ' ' . $this->_getPluginName($ctrlName) . ' Plugin Controller';
				} else {
					$aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $ctrlName));
					$controllerNode = $aco->save();
					$controllerNode['Aco']['id'] = $aco->id;
					$log[] = 'Created Aco node for ' . $ctrlName;
				}
			} else {
				$controllerNode = $controllerNode[0];
			}

			//clean the methods. to remove those in Controller and private actions.
			foreach ($methods as $k => $method) {
				if (strpos($method, '_', 0) === 0) {
					unset($methods[$k]);
					continue;
				}
				if (in_array($method, $baseMethods)) {
					unset($methods[$k]);
					continue;
				}
				$methodNode = $aco->node('controllers/'.$ctrlName.'/'.$method);
				if (!$methodNode) {
					$aco->create(array('parent_id' => $controllerNode['Aco']['id'], 'model' => null, 'alias' => $method));
					$methodNode = $aco->save();
					$log[] = 'Created Aco node for '. $method;
				}
			}
		}
		if(count($log)>0) {
			debug($log);
		}
	}

	function _getClassMethods($ctrlName = null) {
		App::import('Controller', $ctrlName);
		if (strlen(strstr($ctrlName, '.')) > 0) {
			// plugin's controller
			$num = strpos($ctrlName, '.');
			$ctrlName = substr($ctrlName, $num+1);
		}
		$ctrlclass = $ctrlName . 'Controller';
		$methods = get_class_methods($ctrlclass);

		// Add scaffold defaults if scaffolds are being used
		$properties = get_class_vars($ctrlclass);
		if (array_key_exists('scaffold',$properties)) {
			if($properties['scaffold'] == 'admin') {
				$methods = array_merge($methods, array('admin_add', 'admin_edit', 'admin_index', 'admin_view', 'admin_delete'));
			} else {
				$methods = array_merge($methods, array('add', 'edit', 'index', 'view', 'delete'));
			}
		}
		return $methods;
	}

	function _isPlugin($ctrlName = null) {
		$arr = String::tokenize($ctrlName, '/');
		if (count($arr) > 1) {
			return true;
		} else {
			return false;
		}
	}

	function _getPluginControllerPath($ctrlName = null) {
		$arr = String::tokenize($ctrlName, '/');
		if (count($arr) == 2) {
			return $arr[0] . '.' . $arr[1];
		} else {
			return $arr[0];
		}
	}

	function _getPluginName($ctrlName = null) {
		$arr = String::tokenize($ctrlName, '/');
		if (count($arr) == 2) {
			return $arr[0];
		} else {
			return false;
		}
	}

	function _getPluginControllerName($ctrlName = null) {
		$arr = String::tokenize($ctrlName, '/');
		if (count($arr) == 2) {
			return $arr[1];
		} else {
			return false;
		}
	}

	function _getPluginControllerNames() {
		App::import('Core', 'File', 'Folder');
		$paths = Configure::getInstance();
		$folder =& new Folder();
		$folder->cd(APP . 'plugins');

		// Get the list of plugins
		$Plugins = $folder->read();
		$Plugins = $Plugins[0];
		$arr = array();

		// Loop through the plugins
		foreach($Plugins as $pluginName) {
			// Change directory to the plugin
			$didCD = $folder->cd(APP . 'plugins'. DS . $pluginName . DS . 'controllers');
			// Get a list of the files that have a file name that ends
			// with controller.php
			$files = $folder->findRecursive('.*_controller\.php');

			// Loop through the controllers we found in the plugins directory
			foreach($files as $fileName) {
				// Get the base file name
				$file = basename($fileName);

				// Get the controller name
				$file = Inflector::camelize(substr($file, 0, strlen($file)-strlen('_controller.php')));
				if (!preg_match('/^'. Inflector::humanize($pluginName). 'App/', $file)) {
					if (!App::import('Controller', $pluginName.'.'.$file)) {
						debug('Error importing '.$file.' for plugin '.$pluginName);
					} else {
						/// Now prepend the Plugin name ...
						// This is required to allow us to fetch the method names.
						$arr[] = Inflector::humanize($pluginName) . "/" . $file;
					}
				}
			}
		}
		return $arr;
	}
    */
}
