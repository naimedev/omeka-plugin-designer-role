<?php


class DesignerRolePlugin extends Omeka_Plugin_AbstractPlugin {

	protected $_hooks = [
		'define_acl',
		'uninstall'
	];

	public function hookDefineAcl($args) {
		$acl = $args['acl'];

		$acl->addRole(new Zend_Acl_Role('designer'), 'contributor');
		
		$acl->allow('designer', 'Themes', array('index', 'browse', 'switch', 'config', 'edit', 'edit-navigation', 'edit-settings'));
		$acl->allow('designer', 'Appearance', array('index', 'edit', 'edit-navigation', 'edit-settings', 'reset-navigation-confirm','reset-navigation'));
	}

	public function hookUninstall() {
		$db = $this->_db;
		$prefix = $db->prefix;
		$sql = "UPDATE ".$prefix."users SET role = 'contributor' WHERE role = 'designer'";
		$db->query($sql);
	}
}
