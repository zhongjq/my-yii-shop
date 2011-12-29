<?php

class BackupController extends BaseController
{
	const PAGE_SIZE=10;

	public $defaultAction='admin';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	public $cate_list;
	
	/**
	 * Shows a particular model.
	 */
	public function actionShow()
	{
		$filename = Yii::app()->request->getParam('filename');
		
		$dir = dirname(Yii::app()->basePath).'/backup/';
		
		$myfile = Yii::app()->file->set($dir.$filename, true);

		$content = $myfile->getContents();
		$this->render('show',array('content'=>$content));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'show' page.
	 */
	public function actionExport()
	{
		//备份文件名
		$filename = Yii::app()->request->getParam('filename');
		//备份方法，php or shell
		$method = Yii::app()->request->getParam('method');
		//使用扩展插入
		$extendins = Yii::app()->request->getParam('extendins');

		//获取分卷编号
		$volume = isset($_GET['volume']) ? (intval($_GET['volume']) + 1) : 1;
							
		if(empty($filename) || strlen($filename) > 40){	//文件名长度判断
			cpmessage('documents_were_incorrect_length');
		} else {
			$filename = preg_replace("/[^a-z0-9_]/i", '',(str_replace('.', '_', $filename)));
		}

		$db = Yii::app()->db;
		$command=$db->createCommand('SET SQL_QUOTE_SHOW_CREATE=0');//无报错执行关闭我的创建表和列时不加引号
		$command->execute();
		//数据表名			
		$tables = $db->schema->tableNames;
		if(empty($tables) || !is_array($tables)) {
			throw new CHttpException(500,'Backup table wrong. Please connect administrator!');
		}


		$time = date('Y-m-d H:i:s');
		$idstring = '# Identify: '.base64_encode("$_SGLOBAL[timestamp],".'yiicms1.0'.",$type,$method,$volume")."\n";
		$setnames = "SET NAMES 'UTF8';\n\n";

		//备份文件路径
		$backupfile = dirname(Yii::app()->basePath).'/backup/'.$filename;
		
		
		if($method == 'multivol') {//分卷备份
			global $filesize;
			$sqldump = '';
			$sizelimit = intval(Yii::app()->request->getParam('sizelimit'));
			$tableid = intval(Yii::app()->request->getParam('tableid'));//表ID
			$startfrom = intval(Yii::app()->request->getParam('startfrom'));//起始位置
			$tablenum = count($tables);
			$filesize = $sizelimit * 1000;
			$complate = true;

			
			
			for( ; $complate && $tableid < $tablenum && strlen($sqldump) + 500 < $filesize; ++$tableid) {

				$sqldump .= $this->sqldumptable($tables[$tableid], $startfrom, strlen($sqldump));

				if($complate) {
					$startfrom = 0;
				}
			}

			$dumpfile = sprintf($backupfile.'-%s'.'.sql', $volume);
			!$complate && $tableid --;
			if(trim($sqldump)) {
				$sqldump = "$idstring".
				"# <?exit();?>\n".
				"# Yii CMS Multi-Volume Data Dump Vol.$volume\n".
				"# Version: Yii CMS ".X_VER."\n".
				"# Time: $time\n".
				"# Type: $type\n".
				"# Table Prefix: NULL\n".
				"#\n".
				"# Yii CMS: http://u.discuz.net\n".
				"# Please visit our website for newest infomation about Yii CMS\n".
				"# ---------------------------------------------------------\n\n\n".
				"$setnames".
				$sqldump;

				$fp = fopen($dumpfile, 'wb');

				@flock($fp, 2);
				if(!fwrite($fp, $sqldump)) {
					fclose($fp);
					cpmessage('failure_writes_the_document_check_file_permissions', 'admincp.php?ac=backup');
				} else {
					fclose($fp);
					if($usezip == 2) {
						$zipfile = sprintf($backupfile.'-%s'.'.zip', $volume);
						$zipfile = new Zip($zipfile);
						if(!$zipfile->create($dumpfile, PCLZIP_OPT_REMOVE_PATH, S_ROOT.'./data/'.$backupdir)) {
							cpmessage('failure_writes_the_document_check_file_permissions', 'admincp.php?ac=backup');
						} else {
							@unlink($dumpfile);
						}
						fclose($fp);
					}
					
					//分卷备份跳转					
					global $filesize, $startrows;

					$this->redirect(array('export','volume'=>$volume,'tableid'=>$tableid,'startfrom'=>$startrows,'sizelimit'=>$sizelimit,'method'=>$method,'filename'=>$filename));

				}
			} else {
				//使用压缩
				if($usezip == 1){
					$zipfile = $backupfile.'.zip';
					$zipfile = new Zip($zipfile);
					$unlinks = '';
					$arrayzipfile = array();
					for($i = 1; $i < $volume; ++$i){
						$dumpfile = sprintf($backupfile.'-%s'.'.sql', $i);
						$arrayzipfile[] = $dumpfile;
						$unlinks .= "@unlink('$dumpfile');";
					}
					if($zipfile->create($arrayzipfile, PCLZIP_OPT_REMOVE_PATH, S_ROOT.'./data/'.$backupdir)) {
						@eval($unlinks);
					} else {
						cpmessage('complete_database_backup', 'admincp.php?ac=backup', 1, array($volume-1));
					}
					fclose(fopen(S_ROOT.'./data/'.$backupdir.'/index.htm', 'a'));
					cpmessage('successful_data_compression_and_backup_server_to', 'admincp.php?ac=backup');
				} else {
					//fclose(fopen(S_ROOT.'./data/'.$backupdir.'/index.htm', 'a'));
					//cpmessage('complete_database_backup', 'admincp.php?ac=backup', 1, array($volume-1));
				}
			}
		} else {
			$tablesstr = '';
			foreach($tables as $value) {
				$tablesstr .= $value.' ';
			}

			
			$sql = "SHOW VARIABLES LIKE 'basedir'";
			$command=$db->createCommand($sql);
			$query = $command->queryRow();

			$mysql_base = $query['Value'];


			$dumpfile = $datafile_root.'.sql';

			@unlink($dumpfile);

			$mysqlbin = $mysql_base == '/' ? '' : addslashes($mysql_base).'bin/';
			$version = '5.1';
			$username = $db->username;
			$password = $db->password;
			$dbport = 3306;

			$charset = $db->charset;

			$host = $db->connectionString;
			list($dbhost, $dbname) = explode(';', $host);
			
			list($t1, $dbhost) = explode('=', $dbhost);
			list($t1, $dbname) = explode('=', $dbname);


			$exec = '"'.$mysqlbin.'mysqldump" --force --quick --default-character-set='.$charset.' '.($version > 4.1 ? '--skip-opt --create-options' : '-all').' --add-drop-table'.($extendins == 1 ? '--extended-insert' : '').''.($version > '4.1' && $sqlcompat == 'MYSQL40' ? '--compatible=mysql40' : '').' --host='.$dbhost.($dbport ? (is_numeric($dbport) ? ' --port='.$dbport : ' --sock='.$dbport) : '').' --user='.$username.' --password='.$password.' '.$dbname.' '.$tablesstr.' > '.$dumpfile;



			$mx = shell_exec($exec);

			if(file_exists($dumpfile)) {
				if(is_writable($dumpfile)) {
					$fp = fopen($dumpfile, 'rb+');
					fwrite($fp,  $idstring."# <?exit();?>\n ".$setnames."\n #");
					fclose($fp);
				}

			} else {
				cpmessage('shell_backup_failure', 'admincp.php?ac=backup');
			}
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'show' page.
	 */
	public function actionImport()
	{
		$sqldump = '';
		
		$filename = Yii::app()->request->getParam('filename');
		
		$filename = str_replace("..", '', $filename);
		
		$datafile_root = dirname(Yii::app()->basePath).'/backup/'.$filename;
		
		if($fp = @fopen($datafile_root, 'rb')) {
			$sqldump = fgets($fp, 256);
			$identify = explode(',', base64_decode(preg_replace('/^# Identify:\s*(\w+).*/s', '\\1', $sqldump)));
			if($identify[3] == 'multivol') {
				$sqldump .= fread($fp,filesize($datafile_root));
			}
			fclose($fp);
		} else {
			if(isset($_GET['autoimport'])) {
				cpmessage('the_volumes_of_data_into_databases_success', 'admincp.php?ac=backup');
			} else {
				cpmessage('data_file_does_not_exist');
			}
		}
		
		//db链接
		$db = Yii::app()->db;
		
		//多卷导入
		if($identify[3] == 'multivol') {
			//拆分sql
			$sqlquery = $this->splitsql($sqldump);
			//释放内存
			unset($sqldump);

			foreach($sqlquery as $sql) {
				if(!empty($sql)) {
					$command=$db->createCommand($sql);
					$command->execute();
				}
			}

			if(isset($_GET['delunzip'])) {
				@unlink(S_ROOT.'./data/'.$filename);
			}

			$identify[4] = intval($identify[4]);
			$datafile_next = preg_replace("/-($identify[4])(\..+)$/", '-'.($identify[4] + 1).'\\2', $filename);

			if($identify[4] == 1) {
				$showform = 5;
				include template('admin/tpl/backup');
				exit();	
			} elseif (isset($_GET['autoimport'])) {
				cpmessage('data_files_into_success', "admincp.php?ac=backup&op=import&do=import&datafile=$datafile_next&autoimport=yes".(isset($unzip) ? '&delunzip=yes' : ''), 1, array($identify[4]));
			} else {
				cpmessage('the_volumes_of_data_into_databases_success', 'admincp.php?ac=backup');
			}
		} elseif($identify[3] == 'shell') {
		//系统 MySQL Dump (Shell) 导入
		
			list($dbhost, $dbport) = explode(':', $dbhost);

			$query = $_SGLOBAL['db']->query("SHOW VARIABLES LIKE 'basedir'");
			list(, $mysql_base) = $_SGLOBAL['db']->fetch_array($query, MYSQL_NUM);

			$mysqlbin = $mysql_base == '/' ? '' : addslashes($mysql_base).'bin/';
			$dbcharset = empty($_SC['dbcharset']) ? $_SC['charset'] : $_SC['dbcharset'];
			@shell_exec('"'.$mysqlbin.'mysql" --default-character-set='.$dbcharset.' -h '.$dbhost.($dbport ? (is_numeric($dbport) ? ' -P'.$dbport : ' -S'.$dbport.'') : '').' -u'.$dbuser.' -p'.$dbpw.' '.$dbname.' < '.$filename);

			cpmessage('the_volumes_of_data_into_databases_success', 'admincp.php?ac=backup');
		} else {
			cpmessage('data_file_format_is_wrong_not_into');
		}
		
		$this->render('update',array('model'=>$model));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'list' page.
	 */
	public function actionDelete()
	{
	
		if(Yii::app()->request->isPostRequest)
		{
			$filename = Yii::app()->request->getParam('filename');
		
			$dir = dirname(Yii::app()->basePath).'/backup/';
		
			$myfile = Yii::app()->file->set($dir.$filename, true);


			$content = $myfile->getContents();
			$this->render('show',array('content'=>$content));
			
			// we only allow deletion via POST request
			$this->loadcontent()->delete();
			$this->redirect(array('list'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
	
		$this->processAdminCommand();
		
		$shelldisabled = function_exists('shell_exec') ? '' : 'disabled';
		$zipdisplay = function_exists('gzcompress') ? true : false;
		$randomname = date('ymdHis');
	
		
		$dir = dirname(Yii::app()->basePath).'/backup/';

		$options = array(
			'fileTypes'=>array('sql'),
		);
		$files = CFileHelper::findFiles($dir,$options);
	
		foreach($files as $backupfile)
		{
			$myfile = Yii::app()->file->set($backupfile, true);

			$filename = $myfile->basename;

			$filesize = $myfile->size;
			$fp = fopen($backupfile, 'rb');
			$identify = explode(',', base64_decode(preg_replace('/^# Identify:\s*(\w+).*/s', '\\1', $myfile->getContents())));
			fclose($fp);
			if($identify[3] != 'multivol') {
				$identify[4] = '';
			}
			$exportlog[] = array(
				'version' => $identify[1],
				'type' => $identify[2],
				'method' => $identify[3],
				'volume' => $identify[4],
				'filename' => $filename,
				'filesize' => $filesize,
				'dateline' => date('Y-m-d H:i:s',filemtime($backupfile)),
			);
		
		}


		$models=$exportlog;

		$this->render('admin',array(
			'models'=>$models,'filename'=>$randomname,

		));
	}


	protected function processAdminCommand()
	{
		if(isset($_POST['command'], $_POST['filename']) && $_POST['command']==='delete')
		{
		
			$filename = Yii::app()->request->getParam('filename');
		
			$dir = dirname(Yii::app()->basePath).'/backup/';
		
			$myfile = Yii::app()->file->set($dir.$filename, true);
			$myfile->delete();
			// reload the current page to avoid duplicated delete actions
			$this->refresh();
		}
	}
	
	
	function splitsql($sqldump) {
		$sql = str_replace("\r", "\n", $sqldump);
		$ret = array();
		$num = 0;
		$queriesarray = explode(";\n", trim($sql));
		unset($sql);
		foreach($queriesarray as $query) {
			$queries = explode("\n", trim($query));
			foreach($queries as $subquery) {
				if(!empty($subquery[0])){
					$ret[$num] .= $subquery[0] == '#' ? NULL : $subquery;
				}
			}
			$num++;
		}
		return $ret;
	}
	
	function sqldumptable($table, $startfrom = 0, $currsize = 0) {
		global $filesize, $startrows, $_GET, $dumpcharset, $complate;
		$dumpcharset = 'utf8';
		$offset = 300;
		$tabledump = '';
		$tablefields = array();
		

		$db = Yii::app()->db;
		
		$tables = $db->schema->tableNames;
		
		$mytable = $db->schema->getTable($table);

		$columns = $mytable->columns;
		$primaryKey = $mytable->primaryKey;



	

		if(!$startfrom) {
			$sql = 'SHOW CREATE TABLE '.$table;
			$command=$db->createCommand($sql);
			
			$create = $command->queryRow(false);

			$tabledump = "DROP TABLE IF EXISTS $table;\n";
			$tabledump .= $create[1];
			

			$version = '5.1';
			
			if($_GET['sqlcompat'] == 'MYSQL41' && $version < '4.1') {
				$tabledump = preg_replace('/TYPE=(.+)/', "ENGINE=\\1 DEFAULT CHARSET=".$dumpcharset, $tabledump);
			}
			if($version > '4.1' && $_GET['sqlcharset']) {
				$tabledump = preg_replace('/(DEFAULT)*\s*CHARSET=.+/', 'DEFAULT CHARSET='.$dumpcharset, $tabledump);
			}
			
			$command=$db->createCommand("SHOW TABLE STATUS LIKE '$table'");
			$tablestatus = $command->queryRow();
			
			$tabledump .= ($tablestatus['Auto_increment'] ? " AUTO_INCREMENT=$tablestatus[Auto_increment]" : '').";\n\n";
			if($_GET['sqlcompat'] == 'MYSQL40' && $version >= '4.1' && $version < '5.1') {
				if(!empty($tablestatus['Auto_increment'])) {
					$temppos = strpos($tabledump, ',');
					$tabledump = substr($tabledump, 0, $temppos).' auto_increment'.substr($tabledump, $temppos);
				}

				if($tablestatus['Engine'] == 'MEMORY') {
					$tabledump = str_replace('TYPE=MEMORY', 'TYPE=HEAP', $tabledump);
				}
			}
		}

		$tabledumped = 0;
		$numrows = $offset;
		$firstfield = $tablefields[0];
		


		if($_GET['extendins'] == 0){
		
			while($currsize + strlen($tabledump) + 500 < $filesize && $numrows == $offset){

				if($firstfield['Extra'] == 'auto_increment'){
					$selectsql = 'SELECT * FROM '.$table." WHERE $firstfield[Field] > $startfrom LIMIT $offset";
				} else {
					$selectsql = 'SELECT * FROM '.$table." LIMIT $startfrom, $offset";
				}

				$tabledumped = 1;
				
				$command=$db->createCommand($selectsql);
				$query=$command->query();
		

				$numfields = $query->columnCount;	//取得列数
				$numrows = $query->rowCount; //取得行数
				
				$usehex = 0;
				
				if(!empty($numrows)) {
					foreach($query as $row)
					{
						$dumpsql = $comma = '';
						foreach($row as $name => $value)
						{
							$dumpsql .= $comma.($usehex && !empty($value) && (strexists($tablefields[$i]['Type'], 'char') || strexists($tablefields[$i]['Type'], 'text')) ? '0x'.bin2hex($value) : '\''.mysql_escape_string($value).'\'');
							$comma = ',';
						}
						if(strlen($dumpsql) + $currsize + strlen($tabledump) + 500 < $filesize ) {
							if($firstfield['Extra'] == 'auto_increment') {
								$startfrom = $row[0];
							} else {
								$startfrom ++;
							}
							$tabledump .= "INSERT INTO $table VALUES ($dumpsql);\n";
						} else {
							$complate = FALSE;
							break 2;
						}
					}
				}
			}
		} else {
			while($currsize + strlen($tabledump) + 500 < $filesize && $numrows == $offset) {
				if($firstfield['Extra'] == 'auto_increment'){
					$selectsql = 'SELECT * FROM '.$table." WHERE $firstfield[Field] > $startfrom LIMIT $offset";
				} else {
					$selectsql = 'SELECT * FROM '.$table." LIMIT $startfrom, $offset";
				}
				$tabledumped = 1;
				$query = $_SGLOBAL['db']->query($selectsql);
				$numfields = $_SGLOBAL['db']->num_fields($query);
			
				if($numrows = $_SGLOBAL['db']->num_rows($query)) {
					$extdumpsql = $extcomma = '';
					while($row = $_SGLOBAL['db']->fetch_row($query)) {
						$dumpsql = $comma = '';
						for($i = 0; $i < $numfields; ++$i) {
							$dumpsql .= $comma.($_GET['usehex'] && !empty($row[$i]) && (strexists($tablefields[$i]['Type'], 'char') || strexists($tablefields[$i]['Type'], 'text')) ? '0x'.bin2hex($row[$i]) : '\''.mysql_escape_string($row[$i]).'\'');
							$comma = ',';
						}
						if(strlen($extdumpsql) + $currsize + strlen($tabledump) + 500 < $filesize ) {
							if($firstfield['Extra'] == 'auto_increment') {
								$startfrom = $row[0];
							} else {
								$startfrom ++;
							}
							$extdumpsql .= "$extcomma ($dumpsql)";
							$extcomma = ',';
						} else {
							$tabledump .= "INSERT INTO $table VALUES $extdumpsql;\n";
							$complate = FALSE;
							break 2;
						}
					}
					$tabledump .= "INSERT INTO $table VALUES $extdumpsql;\n";
				}
			}
		}
		$startrows = $startfrom;
		$tabledump .= "\n";

		return $tabledump;
	}	
}
