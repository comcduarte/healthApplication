<?php
namespace Certificate\Controller;

use Midnet\Controller\AbstractBaseController;
use Midnet\Model\Uuid;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Predicate\Like;
use Zend\View\Model\ViewModel;

class CertificateController extends AbstractBaseController
{
    public function createAction()
    {
        $view = new ViewModel();
        
        $request = $this->getRequest();
        $this->form->bind($this->model);
        
        if ($request->isPost()) {
            $post = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
                );
            
            $this->form->setData($post);
            
            if ($this->form->isValid()) {
                $user = $this->currentUser();
                $this->model->setCurrentUser($user->USERNAME);
                $this->model->create();
                
                $this->flashmessenger()->addSuccessMessage('Add New Record Successful');
            } else {
                $this->flashmessenger()->addErrorMessage("Form is Invalid.");
            }
            
//             $url = $this->getRequest()->getHeader('Referer')->getUri();
//             return $this->redirect()->toUrl($url);
            return $this->redirect()->toRoute('certificate/default', ['action' => 'update', 'uuid' => $this->model->UUID]);
        }
        
        $view->setVariables([
            'form' => $this->form,
            'title' => 'Add New Record',
        ]);
        
        return ($view);
    }
    
    public function updateAction()
    {
        $uuid = new Uuid();
        
        $view = new ViewModel();
        $view = parent::updateAction();
        $view->setVariable('uuid', $this->model->UUID);
        
        /****************************************
         * REPORTS SUBTABLE
         ****************************************/
        $reports = [];
        
        $sql = new Sql($this->adapter);
        $select = new Select();
        $select->columns(['UUID', 'NAME'])
        ->from('reports')
        ->where([new Like('NAME', 'CERTIFICATE - %')]);
        
        $statement = $sql->prepareStatementForSqlObject($select);
        
        $results = $statement->execute();
        $resultSet = new ResultSet($results);
        $resultSet->initialize($results);
        $reports = $resultSet->toArray();
        
        $view->setVariable('reports', $reports);
        
        return $view;
    }
}