<?php
namespace Concrete\Authentication\Linkedin;

defined('C5_EXECUTE') or die('Access Denied');

use Concrete\Core\Authentication\LoginException;
use Concrete\Core\Authentication\Type\OAuth\OAuth2\GenericOauth2TypeController;
use OAuth\OAuth2\Service\Linkedin;
use User;

class Controller extends GenericOauth2TypeController
{

    public function supportsRegistration()
    {
        return \Config::get('auth.linkedin.registration.enabled', false);
    }

    public function registrationGroupID() {
        return \Config::get('auth.linkedin.registration.group');
    }

    public function getAuthenticationTypeIconHTML()
    {
        return '<i class="fa fa-linkedin"></i>';
    }

    public function getHandle()
    {
        return 'linkedin';
    }

    /**
     * @return Google
     */
    public function getService()
    {
        if (!$this->service) {
            $this->service = \Core::make('authentication/linkedin');
        }
        return $this->service;
    }

    public function saveAuthenticationType($args)
    {
        \Config::save('auth.linkedin.appid', $args['apikey']);
        \Config::save('auth.linkedin.secret', $args['apisecret']);
        \Config::save('auth.linkedin.registration.enabled', !!$args['registration_enabled']);
        \Config::save('auth.linkedin.registration.group', intval($args['registration_group'], 10));

        $whitelist = array();
        foreach (explode(PHP_EOL, $args['whitelist']) as $entry) {
            $whitelist[] = trim($entry);
        }

        $blacklist = array();
        foreach (explode(PHP_EOL, $args['blacklist']) as $entry) {
            $blacklist[] = json_decode(trim($entry), true);
        }

        \Config::save('auth.linkedin.email_filters.whitelist', array_values(array_filter($whitelist)));
        \Config::save('auth.linkedin.email_filters.blacklist', array_values(array_filter($blacklist)));
    }

    public function edit()
    {
        $this->set('form', \Loader::helper('form'));
        $this->set('apikey', \Config::get('auth.linkedin.appid', ''));
        $this->set('apisecret', \Config::get('auth.linkedin.secret', ''));

        $list = new \GroupList();
        $list->includeAllGroups();
        $this->set('groups', $list->getResults());

        $this->set('whitelist', \Config::get('auth.linkedin.email_filters.whitelist', array()));
        $blacklist = array_map(function($entry) {
            return json_encode($entry);
        }, \Config::get('auth.linkedin.email_filters.blacklist', array()));

        $this->set('blacklist', $blacklist);
    }

    public function completeAuthentication(User $u)
    {
        $ui = \UserInfo::getByID($u->getUserID());
        if (!$ui->hasAvatar()) {
            try {
                $image = \Image::open($this->getExtractor()->getImageURL());
                $ui->updateUserAvatar($image);
            } catch(\Imagine\Exception\InvalidArgumentException $e) {
                \Log::addNotice("Unable to fetch user images in Linked Authentication Type, is allow_url_fopen disabled?");
            } catch(\Exception $e) {}
        }

        parent::completeAuthentication($u);
    }

    public function isValid()
    {
        $filters = (array)\Config::get('auth.linkedin.email_filters', array());
        $domain = $this->getExtractor()->getExtra('domain');

        foreach (array_get($filters, 'whitelist', array()) as $regex) {
            if (preg_match($regex, $domain)) {
                return true;
            }
        }

        foreach (array_get($filters, 'blacklist', array()) as $arr) {
            list($regex, $error) = array_pad((array) $arr, 2, null);
            if (preg_match($regex, $domain)) {
                if (trim($error)) {
                    throw new LoginException($error);
                }
                return false;
            }
        }

        return true;
    }

}
