<?php

namespace Concrete\Package\CustomAuthentication;

use Package;
use \Concrete\Core\Authentication\AuthenticationType;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends Package
{

	protected $pkgHandle = 'custom_authentication';
	protected $appVersionRequired = '5.7.1';
	protected $pkgVersion = '1.0';



	public function getPackageDescription()
	{
		return t("Add Custom Authentication");
	}

	public function getPackageName()
	{
		return t("Custom Authentication");
	}

	public function install()
	{
		$pkg = parent::install();
        $auth = \Concrete\Core\Authentication\AuthenticationType::add('linkedin', 'LinkedIn', $pkg);

		$auth->disable();
	}

	public function uninstall()
    {
        parent::uninstall();
    }
}
?>
