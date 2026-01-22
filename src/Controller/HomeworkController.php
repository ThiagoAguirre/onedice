<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Event\EventInterface;

/**
 * Homework Controller
 *
 */
class HomeworkController extends AppController
{
    // AuthenticationComponent already requires identity by default.
    // No custom beforeFilter is needed here.
    /**
     * Before render callback.
     *
     * @param \Cake\Event\EventInterface $event The beforeRender event.
     * @return void
     */
    public function beforeRender(EventInterface $event): void
    {
        parent::beforeRender($event);

        // Additional beforeRender logic can be added here if needed.
        $this->set('user', $this->Authentication->getIdentity());
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function choice()
    {
        // Logged-in user identity from Authentication plugin
        $user = $this->Authentication->getIdentity();

        // Receive optional data
        $query = $this->request->getQueryParams();
        $data = $this->request->getData(); // empty array for non-POST

        // Expose to view
        $this->set(compact('user', 'query', 'data'));
        $this->set('hideTopNav', true);
    }

}
