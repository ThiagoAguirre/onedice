<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        // Allow unauthenticated access to home, login and register
        $this->Authentication->addUnauthenticatedActions(['home', 'login', 'register']);
    }

    /**
     * Login method
     *
     * @return \Cake\Http\Response|null|void
     */
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        if ($result && $result->isValid()) {
            $redirect = $this->request->getQuery('redirect') ?: $this->request->getData('redirect');
            $redirect = $redirect ?: ['controller' => 'Homework', 'action' => 'choice'];
            return $this->redirect($redirect);
        }

        if ($this->request->is('post')) {
            $this->Flash->error(__('Invalid email or password'));
        }
    }

    /**
     * Home (landing) page
     *
     * Public page with links to login and register.
     *
     * @return void
     */
    public function home(): void
    {
        $this->request->allowMethod(['get']);
        // Disable CakePHP default layout so the view can render
        // a full standalone landing page (includes its own <html>/<head>/<body>)
        // $this->viewBuilder()->disableAutoLayout();
    }

    /**
     * Logout method
     *
     * @return \Cake\Http\Response|null
     */
    public function logout()
    {
        $this->request->allowMethod(['post', 'get']);
        $this->Authentication->logout();
        $this->Flash->success(__('You are now logged out'));
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    /**
     * Register method
     *
     * @return \Cake\Http\Response|null|void
     */
    public function register()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Registration successful. You can now log in.'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Unable to register. Please, try again.'));
        }
        $this->set(compact('user'));
    }
}
