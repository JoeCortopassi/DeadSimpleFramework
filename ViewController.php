<?php

class ViewController
{
	// Where we keep track of the file we're going to use as a view/template
	private $view = '';
	
	/**
	 *  Anything that gets called as a property directly, is actually going to be
	 *  referencing this variable. So when you see something like $View->foo, it's
	 *  actually referencing $View->views_variables['foo'].
	 */
	private $views_variables = array();
	
	
	function __construct( $view )
	{
		// Store what view we are using
		$this->view = $view;
	}
	
	
	// Use the __get() magic method to cause $View->foo to actually reference $View->views_variables['foo'].
	function __get( $name )
	{
		return $this->views_variables[ $name ];
	}
	
	
	// Use the __set() magic method to cause $View->foo = 'waffles' to actually store 'waffles' in $View->views_variables['foo'].
	function __set( $name, $value )
	{
		return $this->views_variables[ $name ] = $value;
	}
	
	/**
	 *  Render the view
	 *
	 *  We take the properties that were stored in views_variables, and extract
	 *  them into the just the local scope of this function, then we include the
	 *  view which will fill in the variables that are set in the view appropriately.
	 */
	function render()
	{
		extract( $this->views_variables );
		require_once( $this->view );
	}
}
