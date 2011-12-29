== CFile extension class for Yii ==
(ist-yii-cfile)
http://www.yiiframework.com/extension/cfile/

The class contains commonly used functions for file manipulation.

CFile at Google Code
http://code.google.com/p/ist-yii-cfile/

Join discussion at Yii Framework Forum
http://www.yiiframework.com/forum/index.php?/topic/5212-extension-cfile/

Report a bug
http://code.google.com/p/ist-yii-cfile/issues/entry

==========
Changelog:

0.4
	* new: 'isFile' & 'isDir' properties
	* new: 'rename()', 'move()', 'copy()', 'delete()', 'getSize()' and 'getContents()' methods now are able to deal with directories
	* new: 'purge()' method to empty filesystem object
	* new: 'createDir()' method to create directory
	* new: 'isEmpty' property
	* chg: '$formatPrecision' param of 'getSize()' method now changed to '$format' and accepts format pattern for 'CNumberFormatter'
	* chg: 'download()' method is now alias for primary 'send()' method
	* chg: now 'readable' & 'writeable' properties are loaded on 'set()' even when in non-greedy mode
	* fix: unnecessary file availability checks when 'greedy' option is specified for 'set()' removed

0.3
	* new: 'setBasename()' method (lazy file rename)
	* new: 'setFilename()' method (lazy file rename)
	* new: 'setExtension()' method (lazy file rename)
	* new: 'download()' method
	* chg: 'copy()' & 'rename()' methods improved (destination file name without path is enough for them to perform actions in the current file directory)
	* fix: 'extension' key existance check (in 'pathInfo()')

0.2
	* new: getContents() and setContents() methods
	* new: create() method
	* new: 'readable' & 'writeable' properties
	* fix: posix family functions existance check (in getOwner() & getGroup())

0.1 
	* Initial release