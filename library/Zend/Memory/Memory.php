<?php
/*
 * 2014.8.11 Written by XBN.
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Zend\Memory;

use Zend\Cache\StorageFactory;

/**
 * Memory
 *
 * Memory Manager factory
 */
class Memory {
	
	/**
	 * Memory Manager Factory。
	 *
	 * @param String $file        	
	 * @param Array $option        	
	 * @return \Zend\Memory\MemoryManager 
	 */
	public static function factory($file = "None", $option = null) {
		
		if (strtolower ( $file ) === "file") {
			if (! (is_array ( $option ) && isset ( $option ['cache_dir'] ) && file_exists ( $option ['cache_dir'] ))) {
				$option = array (
						'cache_dir' => './data/cache/' 
				);
			}
			
			if (! file_exists ( './data/cache/' )) {
				mkdir ( './data/cache/' );
			}
			
			$cache = StorageFactory::factory ( array (
					'adapter' => array (
							'name' => 'filesystem',
							'options' => $option 
					),
					'plugins' => array (
							'exception_handler' => array (
									'throw_exceptions' => false 
							),
							'Serializer' 
					) 
			) );
		}else{
			$cache = null;
		}
		
		return new MemoryManager ( $cache );
	}
}

?>
