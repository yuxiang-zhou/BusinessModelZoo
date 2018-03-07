<?php
namespace Concrete\Core\Authentication\Type\LinkedIn;

use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Storage\SymfonySession;
use OAuth\ServiceFactory;

class ServiceProvider extends \Concrete\Core\Foundation\Service\Provider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindShared(
            'authentication/linkedin',
            function ($app, $callback = '/ccm/system/authentication/oauth2/linkedin/callback/') {
                /** @var ServiceFactory $factory */
                $factory = $app->make('oauth/factory/service');
                return $factory->createService(
                    'linkedin',
                    new Credentials(
                        \Config::get('auth.linkedin.appid'),
                        \Config::get('auth.linkedin.secret'),
                        (string) \URL::to($callback)
                    ),
                    new SymfonySession(\Session::getFacadeRoot(), false),
                    array('r_emailaddress'));
            }
        );
    }

}
