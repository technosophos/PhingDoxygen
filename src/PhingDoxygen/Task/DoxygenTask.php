<?php
/** @file
 * Task for creating doxygen docs from source code.
 *
 * @author M Butcher
 *
 */

/**
 * Include the main task class.
 */
require_once 'phing/Task.php';

/**
 * The main Doxygen task.
 *
 * This task is used for building documentation using the Doxygen tool. It is a 
 * wrapper around the doxygen command line client.
 */
class DoxygenTask extends Task {
  
  /**
   * The configuration file.
   */
  protected $config = 'config.doxy';
  
  /**
   * The alternate operation to perform.
   *
   * If this is unset, the task will generate documentation.
   */
  protected $operation = NULL;
  /**
   * Initialize the task.
   *
   * This is not used for this task. However, it is required for the 
   * abstract Task class.
   */
  public function init(){}
  
  /**
   * Run the task.
   *
   * This builds the documentation. If a filename is passed into setConfig() then
   * it will be used. Otherwise, the default filename (config.doxy) will be assumed.
   *
   * @throws BuildException if the configuration file cannot be found.
   */
  public function main(){
    $this->preFlightCheck();
    
    $op = NULL;
    
    switch ($this->operation) {
      case 'create':
        $op = 'doxygen -g %s';
        break;
      case 'update':
        $op = 'doxygen -u %s';
        break;
      case NULL:
      default:
        $op = 'doxygen %s';
        break;
    }
    
    $cmd = sprintf($op, $this->config);
    
    $ret = system($cmd);
    
    if ($ret === FALSE) {
      throw new BuildException('Doxgen task failed.');
    }
  }
  
  /**
   * Set the path to the configuration file.
   *
   * Doxygen uses a large configuration file to read configuration data. Use this
   * function to set the location of that file.
   *
   * @param string $filename
   *  The path to the file.
   */
  public function setConfig($filename) {
    $this->config = $filename;
  }
  
  /**
   * Set an alternate operation for Doxygen to perform.
   *
   * Available operations are:
   *  - create: Create a configuration file
   *  - update: Update a configuration file
   *
   * By default, 
   */
  public function setOperation($op) {
    
  }
  
  /**
   * Performs a status check to make sure all necessary parameters were set.
   *
   * This checks all necessary parameters, performing validation where necessary.
   *
   * @throws BuildException if the necessary requirements are not filled.
   */
  protected function preFlightCheck() {
    if (empty($this->config)) {
      throw new BuildException('Could not find a configuration file for Doxygen.');
    }
    if (!is_file($this->config)) {
      throw new BuildException(sprintf('The file "%s" could not be found.', $this->config));
    }
  }
}