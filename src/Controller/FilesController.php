<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Files Controller
 *
 * @property \App\Model\Table\FilesTable $Files
 *
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FilesController extends AppController
{
	public function isAuthorized($user)
	{
		$action = $this->request->getParam('action');
		
		$valid = false;
        if ($user) {
           switch ($user['role']) {
            case 'Docteur':
				if (in_array($action, ['logout', 'viewCurrentUser', 'add', 'edit', 'apropos','menu', 'delete'])) {
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
    public function index() {
        $files = $this->paginate($this->Files);

        $this->set(compact('files'));
        $this->set('_serialize', ['files']);
    }


    /**
     * Add method
     * 
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    
    public function add(){
        $file = $this->Files->newEntity();

        if ($this->request->is('post')) {

            if(!empty($this->request->data['name']['name'])){
                $fileName = $this->request->data['name']['name'];
                $uploadPath = 'Files/';
                $uploadFile = $uploadPath . $fileName;
                if(move_uploaded_file($this->request->data['name']['tmp_name'], 'img/' . $uploadFile)){
                    $uploadData = $this->Files->patchEntity($file, $this->request->getData());
                    $uploadData->name = $fileName;
                    $uploadData->path = $uploadPath;
                    if ($this->Files->save($uploadData)) {
                        $this->Flash->success(__('File has been uploaded and inserted successfully.'));
                    }else{
                        $this->Flash->error(__('Unable to upload file, please try again.'));
                    }
                }else{
                    $this->Flash->error(__('Unable to upload file, please try again.'));
                }
            }else{
                $this->Flash->error(__('Please choose a file to upload.'));
            }
            
        }
        
        $items = $this->Files->Items->find('list',['limit' => 200]);
        $this->set(compact('file','items'));
        $this->set('_serialize', ['file']);
    }


    public function view($id = null){
        $file = $this->Files->get($id, [
            'contain' => ['Items']
        ]);

        $this->set('file', $file);
        $this->set('_serialize', ['file']);
    }

    public function edit($id = null) {
        $file = $this->Files->get($id, [
            'contain' => ['Items']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $file = $this->Files->patchEntity($file, $this->request->getData());
            if ($this->Files->save($file)) {
                $this->Flash->success(__('The file has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The file could not be saved. Please, try again.'));
        }
        $items = $this->Files->Items->find('list', ['limit' => 200]);
        $this->set(compact('file', 'items'));
        $this->set('_serialize', ['file']);
    }

    public function delete($id = null){
        $this->request->allowMethod(['post', 'delete']);
        $file = $this->Files->get($id);
        if ($this->Files->delete($file)) {
            $this->Flash->success(__('The file has been deleted.'));
        } else {
            $this->Flash->error(__('The file could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
