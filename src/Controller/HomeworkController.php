<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Homework Controller
 *
 */
class HomeworkController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event): void
    {
        parent::beforeFilter($event);
        // Require authentication for all actions in this controller
        $this->Authentication->requireAuthentication();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function choice()
    {
        // Static choice view; no model interaction required.
        // If you later add a HomeworkTable, you can re-enable queries here.
    }

}
