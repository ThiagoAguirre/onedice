<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;
// use Authentication\Controller\Component\AuthenticationComponent;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/5/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');
        $this->loadComponent('Authentication.Authentication');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/5/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    // AuthenticationComponent performs identity checks automatically
    // at Controller.startup unless actions are whitelisted in controllers.

    /**
     * beforeRender callback.
     * Sets the current user to view variables for all actions.
     *
     * @param \Cake\Event\EventInterface $event Event instance
     * @return void
     */
    public function beforeRender(EventInterface $event): void
    {
        parent::beforeRender($event);

        // Defina controllers e actions sem layout
        $semLayout = [
            'Users' => ['home'],
            // '' => ['choice']
            // Exemplo: 'OutroController' => ['action1', 'action2'],
        ];

        $controller = $this->getRequest()->getParam('controller');
        $action = $this->getRequest()->getParam('action');

        if (
            isset($semLayout[$controller]) &&
            in_array($action, $semLayout[$controller], true)
        ) {
            $this->viewBuilder()->disableAutoLayout();
        }

        $user = $this->getUser();
        $this->set(compact('user'));
    }

    /**
     * Helper to get the current authenticated user/identity.
     * Uses the request attribute set by the Authentication middleware.
     *
     * @return object|null
     */
    protected function getUser(): ?object
    {
        return $this->getRequest()->getAttribute('identity');
    }
}
