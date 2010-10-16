# PhingDoxygen

Phing tasks for running Doxygen and generating API documentation.

## Prerequisites

  * A working copy of doxygen which is accessible from Phing's path.

## Installation

Install using PEAR:

    $ pear channel-discover pear.querypath.org
    $ pear install querypath/PhingDoxygen

## Usage

Add this to your build.xml:

    <!-- Unnecessary if you installed from PEAR -->
    <includepath classpath="./src"/>
    
    <!-- Define the task -->
    <taskdef classname="PhingDoxygen.Task.DoxygenTask" name="doxygen"/>

Then call the task like this:

    <doxygen config="path/to/conf.doxy"/>

Documentation will be generated according to your conf.doxy file.

## More information

For more information, go to http://github.com/technosophos/PhingDoxygen

----
PhingDoxygen by mbutcher (2010)