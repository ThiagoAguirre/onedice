<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Homework Controller
 *
 */
class HomeworkController extends AppController
{
    // AuthenticationComponent already requires identity by default.
    // No custom beforeFilter is needed here.

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
    }

}
