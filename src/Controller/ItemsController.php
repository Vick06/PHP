<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Items Controller
 *
 * @property \App\Model\Table\ItemsTable $Items
 *
 * @method \App\Model\Entity\Item[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemsController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    public function isAuthorized($user) {
		/*parent::isAuthorized(); */
	{
		$action = $this->request->getParam('action');
		
		$valid = false;
        if ($user) {
           switch ($user['role']) {
            case 'Docteur':
				if (in_array($action, ['logout', 'viewCurrentUser', 'add', 'edit', 'apropos', 'menu'])) {
					$valid = true;
				} 
                break;
            case 'admin':
				if (in_array($action, ['logout', 'viewCurrentUser', 'add', 'apropos', 'menu'])) {
					$valid = true;
				} 
                break;
			}
	}else{
		
		 if(in_array($action, ['add'])) {
			$valid = true;
		} 
	}
		
		return $valid;
	}
		
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $items = $this->paginate($this->Items);

        $this->set(compact('items'));
    }

    /**
     * View method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $item = $this->Items->get($id, [
            'contain' => ['Users', 'Tags', 'Comments', 'files']
        ]);

        $this->set('item', $item);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() 
	{
        $item = $this->Items->newEntity();
    if ($this->request->is('post')) {
        $item = $this->Items->patchEntity($item, $this->request->getData());

        // Changed: Set the user_id from the session.
        $item->user_id = $this->Auth->user('id');

        if ($this->Items->save($item)) {
            $this->Flash->success(__('Your item has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to add your item.'));
    }
	$users = $this->Items->Users->find('list', ['limit' => 200]);
    $this->set(compact('item', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) 
	{
        $item = $this->Items->get($id, [
            'contain' => ['Tags', 'files']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $item = $this->Items->patchEntity($item, $this->request->getData());
            if ($this->Items->save($item)) {
                $this->Flash->success(__('The item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ietm could not be saved. Please, try again.'));
        }
        $users = $this->Items->Users->find('list', ['limit' => 200]);
		
        $tags = $this->Items->Tags->find('list', ['limit' => 200]);
        $files = $this->Items->files->find('list', ['limit' => 200]);
        $this->set(compact('item', 'users', 'tags', 'files'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $item = $this->Items->get($id);
        if ($this->Items->delete($item)) {
            $this->Flash->success(__('The item has been deleted.'));
        } else {
            $this->Flash->error(__('The item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

  /*  public function tags() {
        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        $tags = $this->request->getParam('pass');

        // Use the ItemsTable to find tagged items.
        $items = $this->Items->find('tagged', [
            'tags' => $tags
        ]);

        // Pass variables into the view template context.
        $this->set([
            'items' => $items,
            'tags' => $tags
        ]);
    }*/
	
	public function apropos()
    {
		
    }
	
	public function menu()
    {
		
    }

}
