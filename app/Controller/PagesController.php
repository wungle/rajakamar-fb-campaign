<?php
App::uses('AppController', 'Controller');
/**
 * Pages Controller
 *
 * @property Page $Page
 */
class PagesController extends AppController {

	function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('index');
	}

	public function index($slug = null) {
		$this->Page->recursive = 0;

		$pageFaq = $this->Page->find('first', array(
				'conditions' => array(
					'Page.slug' => $slug,
					'Page.published' => true
				)
			)
		);

		switch ($pageFaq['Page']['id']) {
			case PAGE_TYPE_FAQ:
				$this->layout = 'faq';
				$this->set('pageFaq', $pageFaq);
				$this->render('/Pages/faq');
				break;
		}
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Page->recursive = 0;
		$this->paginate = array(
			'limit' => PAGINATION_LIMIT
		);

		$this->set('pages', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Page->exists($id)) {
			throw new NotFoundException(__('Invalid page'), 'flash_error');
		}
		$options = array('conditions' => array('Page.' . $this->Page->primaryKey => $id));
		$this->set('page', $this->Page->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->redirect('/admin/pages');

		if ($this->request->is('post')) {
			$this->Page->create();
			$this->request->data['Page']['is_closed'] = false;
			if($this->request->data['Page']['is_default'] == true) {
				$this->Page->updateAll(array('Page.is_default' => false));
			}

			if ($this->Page->save($this->request->data)) {
				$this->Session->setFlash(__('The page has been saved'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page could not be saved. Please, try again.'), 'flash_error');
			}
		}

		$this->render('/Pages/admin_form');
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->redirect('/admin/pages');

		if (!$this->Page->exists($id)) {
			throw new NotFoundException(__('Invalid page'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if($this->request->data['Page']['is_default'] == true) {
				$this->Page->updateAll(array('Page.is_default' => false));
			}

			if ($this->Page->save($this->request->data)) {
				$this->Session->setFlash(__('The page has been saved'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page could not be saved. Please, try again.'), 'flash_error');
			}
		} else {
			$options = array('conditions' => array('Page.' . $this->Page->primaryKey => $id));
			$this->request->data = $this->Page->find('first', $options);
		}
		
		$this->render('/Pages/admin_form');
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->redirect('/admin/pages');

		$this->Page->id = $id;
		if (!$this->Page->exists()) {
			throw new NotFoundException(__('Invalid page'), 'flash_error');
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Page->delete()) {
			$this->Session->setFlash(__('Page deleted'), 'flash_success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Page was not deleted'), 'flash_error');
		$this->redirect(array('action' => 'index'));
	}
}
