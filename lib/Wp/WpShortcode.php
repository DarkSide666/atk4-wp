<?php

/**
 * Created by abelair.
 * Date: 2015-09-30
 * Time: 9:39 AM
 *
 *
 *
 *
 */
class Wp_WpShortcode extends AbstractView
{
	//Whether this shortcode need to load atk Javascript and Css file
	public $needAtkJs = false;

	//Shortocode argument
	public $args = null;

	//Array that contains custom js and css file need for the shortcode as per config-shortcode setup
	public $jsFiles = null;
	public $cssFiles = null;

	public function init()
	{
		parent::init();

		if ( $this->needAtkJs && ! $this->app->isShortcodeInitialised() ){
			//setup atkjs file.
			$this->app->enqueueCtrl->enqueueAtkJsInFront();
		}

		//enqueue js and css file if needed.
		if ( isset($this->jsFiles) && ! $this->app->isSHortcodeInitialised() ){
			$this->app->enqueueCtrl->enqueueFiles( $this->jsFiles, 'js' );
		}
		if ( isset($this->cssFiles) && ! $this->app->isSHortcodeInitialised() ){
			$this->app->enqueueCtrl->enqueueFiles( $this->cssFiles , 'css');
		}

	}

	public function defaultTemplate()
	{
		return ['wp-shortcode'];
	}

	public function getHTML( $destroy = true, $execute_js = true )
	{
		//$this->app->setShortcodeInitialised(true);
		return parent::getHTML( $destroy, $execute_js );
	}


	public function render()
	{
		$this->app->setShortcodeInitialised(true);
		parent::render();
	}
}