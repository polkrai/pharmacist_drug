<?php
/**
 * This file handles the retrieval and serving of news articles
 */
class News_Controller {
	/**
	 * This template variable will hold the 'view' portion of our MVC for this 
	 * controller
	 */
	public $template = 'news';
	
	/**
	 * This is the default function that will be called by router.php
	 * 
	 * @param array $getVars the GET variables posted to index.php
	 */
	public function main(array $getVars)
	{
		$newsModel = new News_Model;
		
		//get an article
		$article = $newsModel->get_article($getVars['author']);
		
		//create a new view and pass it our template
		$view = new View_Model($this->template);
		
		//assign article data to view
		$view->assign('article' , $article);

		//Now we can nest our templates using multiple views
		//$header = new View_Model('header_template');

		//$footer = new View_Model('footer_template');

		//$master = new View_Model('master_template');

		//$master->assign('header', $header->render(FALSE));
		//$master->assign('footer', $footer->render(FALSE));

		//$master->render();
	}
}
