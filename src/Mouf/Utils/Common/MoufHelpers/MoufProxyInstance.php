<?php
namespace Mouf\Utils\Common\MoufHelpers;

/**
 * A MoufProxyInstance class is an object that will forward any function call to a separate process that will execute the call. 
 * You can create a MoufProxyInstance using the MoufProxy::getInstance($instanceName) function.
 * 
 * @author David Negrier
 */
class MoufProxyInstance {
	
	protected $instanceName;
	
	protected $selfEdit;
	
	/**
	 * Creates the object
	 * 
	 * @param string $instanceName
	 * @param bool $selfEdit
	 */
	public function __construct($instanceName, $selfEdit = false) {
		$this->instanceName = $instanceName;
		$this->selfEdit = $selfEdit;
	}
	
	/**
	 * Intercepts any call to any function and forwards it to the proxy.
	 * 
	 * @param string $methodName
	 * @param array $arguments
	 */
	public function __call($methodName, $arguments) {
		$postArray = array("instance"=>$this->instanceName, "method"=>$methodName, "args"=>serialize($arguments));
		$url = "plugins/utils/common/mouf_helpers/1.0/direct/proxy.php";
		
		return MoufProxy::request($url, $postArray);
	}
}