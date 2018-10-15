<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ItemsTags Controller
 *
 * @property \App\Model\Table\ItemsTagsTable $ItemsTags
 *
 * @method \App\Model\Entity\ItemsTag[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemsTagsController extends AppController
{
	public function isAuthorized($user)
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

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Items', 'Tags']
        ];
        $itemsTags = $this->paginate($this->ItemsTags);

        $this->set(compact('itemsTags'));
    }

    /**
     * View method
     *
     * @param string|null $id Items Tag id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $itemsTag = $this->ItemsTags->get($id, [
            'contain' => ['Items', 'Tags']
        ]);

        $this->set('itemsTag', $itemsTag);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $itemsTag = $this->ItemsTags->newEntity();
        if ($this->request->is('post')) {
            $itemsTag = $this->ItemsTags->patchEntity($itemsTag, $this->request->getData());
            if ($this->ItemsTags->save($itemsTag)) {
                $this->Flash->success(__('The items tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The items tag could not be saved. Please, try again.'));
        }
        $items = $this->ItemsTags->Items->find('list', ['limit' => 200]);
        $tags = $this->ItemsTags->Tags->find('list', ['limit' => 200]);
        $this->set(compact('itemsTag', 'items', 'tags'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Items Tag id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $itemsTag = $this->ItemsTags->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemsTag = $this->ItemsTags->patchEntity($itemsTag, $this->request->getData());
            if ($this->ItemsTags->save($itemsTag)) {
                $this->Flash->success(__('The items tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The items tag could not be saved. Please, try again.'));
        }
        $items = $this->ItemsTags->Items->find('list', ['limit' => 200]);
        $tags = $this->ItemsTags->Tags->find('list', ['limit' => 200]);
        $this->set(compact('itemsTag', 'items', 'tags'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Items Tag id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemsTag = $this->ItemsTags->get($id);
        if ($this->ItemsTags->delete($itemsTag)) {
            $this->Flash->success(__('The items tag has been deleted.'));
        } else {
            $this->Flash->error(__('The items tag could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
