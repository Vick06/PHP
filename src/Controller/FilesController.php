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
public function initialize(){
        parent::initialize();
		
		public function isAuthorized($user)
	{
		$action = $this->request->getParam('action');
		
		$valid = false;
        if ($user) {
           switch ($user['role']) {
            case 'Docteur':
				if (in_array($action, ['logout', 'viewCurrentUser', 'add', 'edit', 'apropos','menu'])) {
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
        
        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        // Load Files model
        $this->loadModel('Files');
        
        // Set the layout
        $this->layout = 'frontend';
    }
    
    public function index(){
        $uploadData = '';
        if ($this->request->is('post')) {
            if(!empty($this->request->data['file']['name'])){
                $fileName = $this->request->data['file']['name'];
                $uploadPath = 'uploads/files/';
                $uploadFile = $uploadPath.$fileName;
                if(move_uploaded_file($this->request->data['file']['tmp_name'],$uploadFile)){
                    $uploadData = $this->Files->newEntity();
                    $uploadData->name = $fileName;
                    $uploadData->path = $uploadPath;
                    $uploadData->created = date("Y-m-d H:i:s");
                    $uploadData->modified = date("Y-m-d H:i:s");
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
        $this->set('uploadData', $uploadData);
        
        $files = $this->Files->find('all', ['order' => ['Files.created' => 'DESC']]);
        $filesRowNum = $files->count();
        $this->set('files',$files);
        $this->set('filesRowNum',$filesRowNum);
    }
}
