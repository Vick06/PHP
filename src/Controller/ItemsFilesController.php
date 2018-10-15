<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ItemsFiles Controller
 *
 * @property \App\Model\Table\ItemsFilesTable $ItemsFiles
 *
 * @method \App\Model\Entity\ItemsFile[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemsFilesController extends AppController
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
            'contain' => ['Items', 'Files']
        ];
        $itemsFiles = $this->paginate($this->ItemsFiles);

        $this->set(compact('itemsFiles'));
    }

    /**
     * View method
     *
     * @param string|null $id Items File id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $itemsFile = $this->ItemsFiles->get($id, [
            'contain' => ['Items', 'Files']
        ]);

        $this->set('itemsFile', $itemsFile);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $itemsFile = $this->ItemsFiles->newEntity();
        if ($this->request->is('post')) {
            $itemsFile = $this->ItemsFiles->patchEntity($itemsFile, $this->request->getData());
            if ($this->ItemsFiles->save($itemsFile)) {
                $this->Flash->success(__('The items file has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The items file could not be saved. Please, try again.'));
        }
        $items = $this->ItemsFiles->Items->find('list', ['limit' => 200]);
        $files = $this->ItemsFiles->Files->find('list', ['limit' => 200]);
        $this->set(compact('itemsFile', 'items', 'files'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Items File id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $itemsFile = $this->ItemsFiles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemsFile = $this->ItemsFiles->patchEntity($itemsFile, $this->request->getData());
            if ($this->ItemsFiles->save($itemsFile)) {
                $this->Flash->success(__('The items file has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The items file could not be saved. Please, try again.'));
        }
        $items = $this->ItemsFiles->Items->find('list', ['limit' => 200]);
        $files = $this->ItemsFiles->Files->find('list', ['limit' => 200]);
        $this->set(compact('itemsFile', 'items', 'files'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Items File id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemsFile = $this->ItemsFiles->get($id);
        if ($this->ItemsFiles->delete($itemsFile)) {
            $this->Flash->success(__('The items file has been deleted.'));
        } else {
            $this->Flash->error(__('The items file could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
