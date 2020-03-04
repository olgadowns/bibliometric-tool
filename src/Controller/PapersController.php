<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\ORM\TableRegistry;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class PapersController extends AppController
{
    /**
     * Displays a view
     *
     * @param array ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\View\Exception\MissingTemplateException When the view file could not
     *   be found and in debug mode.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found and not in debug mode.
     * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
     */


     public function keep($id)
     {
         $paper = $this->Papers->findById($id)->first();
         $paper->include = 1;
         $this->Papers->save($paper);
         return $this->redirect("/papers/view");
     }

    public function hide($id)
    {
        $paper = $this->Papers->findById($id)->first();
        $paper->include = 0;
        $this->Papers->save($paper);
        return $this->redirect("/papers/view");
    }

     public function index()
     {
         // Paginate the ORM table.
      $this->set('papers', $this->paginate($this->Papers,['limit' => 50]));

      // Paginate a partially completed query
      //$query = $this->Papers->find();
      //$this->('articles', $this->paginate($query));

     }

     public function view($id = "")
     {

         if ($id == "")
         {
             //Get the first paper that has include = 3

             $paper = $this->Papers->findByInclude(3)->first();
             $this->set('paper', $paper);
         }
         else {
             $paper = $this->Papers->findById($id)->first();
             $this->set('paper', $paper);
         }
     }

     public function update($paper_id)
    {
        $this->autoRender = false;

        debug ($this->request->getData());

        $paperDetailsTable = TableRegistry::getTableLocator()->get('PaperDetails');

        $detailsEntity = $paperDetailsTable->find()->where(['paper_id' => $this->request->getData()['paper_id']])->first();

        if ($detailsEntity != null)
        {
//            debug ("Patch");
            //Patch
            $entity = $paperDetailsTable->patchEntity($detailsEntity, $this->request->getData());
            $result = $paperDetailsTable->save($entity);
//            debug ($result);
        }
        else
        {
//            debug ("Creating");
            $entity = $paperDetailsTable->newEntity($this->request->getData());
            $result = $paperDetailsTable->save($entity);
//            debug ($entity);
        }

        return ($this->redirect("/papers"));


        //debug ($this->request->getData());
    }
}
