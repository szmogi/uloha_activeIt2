<?php



// Prints a pre.
   function pre($data){
	   echo '<pre>';
	   print_r($data);  
	   echo '</pre>';
   }



	/**
	 * Show 404
	 *
	 * Sends 404 not found header
	 * And shows 404 HTML page
	 *
	 * @return void
	 */
	function show_404()
	{
		header("HTTP/1.0 404 Not Found");
		include_once "404.php";
		die();
	}




	/**
	 * Is AJAX
	 *
	 * Determines if request was AJAXed into existence
	 *
	 * @return bool
	 */
	function is_ajax()
	{
		return ( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
			strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' );
	}
	

	/**
	 * Asset
	 *
	 * Creates absolute URL to asset file
	 *
	 * @param  string   $path   path to asset file
	 * @param  string   $base   asset base url
	 * @return string   absolute URL to asset file
	 */
	function asset( $path, $base = BASE_URL.'/assets/' )
	{
		$path = trim( $path, '/' );
		return filter_var( $base.$path, FILTER_SANITIZE_URL );
	}


	/**
	 * Redirect
	 *
	 * @param $page
	 * @param int $status_code
	 */
	function redirect( $page, $status_code = 302 )
	{
		if ( $page == 'back' )
		{
			$location = $_SERVER['HTTP_REFERER'];
		}
		else
		{
			$page = ltrim($page, '/');
			$location = BASE_URL . "$page";
		}

		header("Location: $location", true, $status_code);
		die();
	}
	

	/**
	 * Plain
	 *
	 * Escape (though not from New York)
	 *
	 * @param  string $str
	 * @return string
	 */
	function plain( $str )
	{
		return htmlspecialchars( $str, ENT_QUOTES );
	}


