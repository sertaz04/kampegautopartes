<?php
require_once('phpseclib/Net/SFTP.php');
require_once('phpseclib/Crypt/RSA.php');

class conexionSFTP
{
	var $link = false;
	var $sftp_link = false;
	var $keys = false;
	var $password = false;
	var $errors = array();
	var $options = array();
    
    public function conexionSFTP($server,$port,$usuario,$password)
    {
		if ( !function_exists('stream_get_contents') ) 
        {
			echo 'Se requiere la funcion de PHP 5:<code>stream_get_contents()</code>';
			return false;
		}
        $this->options['port'] = 22;
        $this->options['hostname']=$server;
        $this->options['username']=$usuario;
        $this->options['password']=$password;        
    }      
    
	public function conectar() 
    {
		$this->link = new Net_SFTP($this->options['hostname'], $this->options['port']);
    	if ( ! $this->link ) 
        {
			echo 'Fallo la conexion al servidor'. $this->options['hostname'].':'.$this->options['port'];
			return false;
		}

		if ( !$this->keys ) 
        {
			if ( ! $this->link->login($this->options['username'], $this->options['password']) ) 
            {
				echo 'Usuario y/o contrase�a incorrecta. '. $this->options['username'];
				return false;
			}
		}
		return true;
	}

	function run_command( $command, $returnbool = false) {

		if ( ! $this->link )
			return false;

		$data = $this->link->exec($command);

		if ( $returnbool )
			return ( $data === false ) ? false : '' != trim($data);
		else
			return $data;
	}

	function get_contents($file, $type = '', $resumepos = 0 ) {
		return $this->link->get($file);
	}

	function get_contents_array($file) {
		$lines = preg_split('#(\r\n|\r|\n)#', $this->link->get($file), -1, PREG_SPLIT_DELIM_CAPTURE);
		$newLines = array();
		for ($i = 0; $i < count($lines); $i+= 2)
			$newLines[] = $lines[$i] . $lines[$i + 1];
		return $newLines;
	}

	function put_contents($file, $contents, $mode = false ) {
		$ret = $this->link->put($file, $contents);

		$this->chmod($file, $mode);

		return false !== $ret;
	}

	function cwd() {
		$cwd = $this->run_command('pwd');
		if ( $cwd )
			$cwd = trailingslashit($cwd);
		return $cwd;
	}

	function chdir($dir) {
		$this->list->chdir($dir);
		return $this->run_command('cd ' . $dir, true);
	}

	function chgrp($file, $group, $recursive = false ) {
		if ( ! $this->exists($file) )
			return false;
		if ( ! $recursive || ! $this->is_dir($file) )
			return $this->run_command(sprintf('chgrp %o %s', $mode, escapeshellarg($file)), true);
		return $this->run_command(sprintf('chgrp -R %o %s', $mode, escapeshellarg($file)), true);
	}

	function chmod($file, $mode = false, $recursive = false) {
		return $mode === false ? false : $this->link->chmod($mode, $file, $recursive);
	}

	function chown($file, $owner, $recursive = false ) {
		if ( ! $this->exists($file) )
			return false;
		if ( ! $recursive || ! $this->is_dir($file) )
			return $this->run_command(sprintf('chown %o %s', $mode, escapeshellarg($file)), true);
		return $this->run_command(sprintf('chown -R %o %s', $mode, escapeshellarg($file)), true);
	}

	function owner($file, $owneruid = false) {
		if ($owneruid === false) {
			$result = $this->link->stat($file);
			$owneruid = $result['uid'];
		}

		if ( ! $owneruid )
			return false;
		if ( ! function_exists('posix_getpwuid') )
			return $owneruid;
		$ownerarray = posix_getpwuid($owneruid);
		return $ownerarray['name'];
	}

	function getchmod($file) {
		$result = $this->link->stat($file);

		return substr(decoct($result['permissions']),3);
	}

	function group($file, $gid = false) {
		if ($gid === false) {
			$result = $this->link->stat($file);
			$gid = $result['gid'];
		}

		if ( ! $gid )
			return false;
		if ( ! function_exists('posix_getgrgid') )
			return $gid;
		$grouparray = posix_getgrgid($gid);
		return $grouparray['name'];
	}

	function copy($source, $destination, $overwrite = false, $mode = false) 
    {
		if ( ! $overwrite && $this->exists($destination) )
			return false;
		$content = $this->get_contents($source);
		if ( false === $content)
			return false;
		return $this->put_contents($destination, $content, $mode);
	}

	function move($source, $destination, $overwrite = false) {
		return $this->link->rename($source, $destination);
	}

	function delete($file, $recursive = false) {
		return $this->link->delete($file, $recursive);
	}

	function exists($file) {
		return $this->link->stat($file) !== false;
	}

	function is_file($file) {
		$result = $this->link->stat($file);
		return $result['type'] == NET_SFTP_TYPE_REGULAR;
	}

	function is_dir($path) {
		$result = $this->link->stat($path);
		return $result['type'] == NET_SFTP_TYPE_DIRECTORY;
	}

	function is_readable($file) {
		return true;

		return is_readable('ssh2.sftp://' . $this->sftp_link . '/' . $file);
	}

	function is_writable($file) {
		return true;

		return is_writable('ssh2.sftp://' . $this->sftp_link . '/' . $file);
	}

	function atime($file) {
		$result = $this->link->stat($file);
		return $result['atime'];
	}

	function mtime($file) {
		$result = $this->link->stat($file);
		return $result['mtime'];
	}

	function size($file) {
		$result = $this->link->stat($file);
		return $result['size'];
	}

	function touch($file, $time = 0, $atime = 0) {
		//Not implmented.
	}

	function mkdir($path, $chmod = false, $chown = false, $chgrp = false) {
		$path = untrailingslashit($path);
		if ( ! $chmod )
			$chmod = FS_CHMOD_DIR;
		//if ( ! ssh2_sftp_mkdir($this->sftp_link, $path, $chmod, true) )
		//	return false;
		if ( ! $this->link->mkdir($path) && $this->link->chmod($chmod, $path) )
			return false;
		if ( $chown )
			$this->chown($path, $chown);
		if ( $chgrp )
			$this->chgrp($path, $chgrp);
		return true;
	}

	function rmdir($path, $recursive = false) {
		return $this->delete($path, $recursive);
	}

	function dirlist($path, $include_hidden = true, $recursive = false) {
		if ( $this->is_file($path) ) {
			$limit_file = basename($path);
			$path = dirname($path);
		} else {
			$limit_file = false;
		}

		if ( ! $this->is_dir($path) )
			return false;

		$ret = array();
		$entries = $this->link->rawlist($path);

		foreach ($entries as $name => $entry) {
			$struc = array();
			$struc['name'] = $name;

			if ( '.' == $struc['name'] || '..' == $struc['name'] )
				continue; //Do not care about these folders.

			if ( ! $include_hidden && '.' == $struc['name'][0] )
				continue;

			if ( $limit_file && $struc['name'] != $limit_file )
				continue;

			$struc['perms'] 	= $entry['permissions'];
			#$struc['permsn']	= $this->getnumchmodfromh($struc['perms']);
			$struc['number'] 	= false;
			$struc['owner']    	= $this->owner($path.'/'.$entry, $entry['uid']);
			$struc['group']    	= $this->group($path.'/'.$entry, $entry['gid']);
			$struc['size']    	= $entry['size'];//$this->size($path.'/'.$entry);
			$struc['lastmodunix']= $entry['mtime'];//$this->mtime($path.'/'.$entry);
			$struc['lastmod']   = date('M j',$struc['lastmodunix']);
			$struc['time']    	= date('h:i:s',$struc['lastmodunix']);
			$struc['type']		= $entry['type'] == NET_SFTP_TYPE_DIRECTORY ? 'd' : 'f';

			if ( 'd' == $struc['type'] ) {
				if ( $recursive )
					$struc['files'] = $this->dirlist($path . '/' . $struc['name'], $include_hidden, $recursive);
				else
					$struc['files'] = array();
			}

			$ret[ $struc['name'] ] = $struc;
		}
		return $ret;
	}
     
}	#END OF CLASS
?>

<?php 

$a = $_POST['tipoDocto'];
//$b = $_POST['xmlCaf'];
$c = $_POST['ultimoFolio'];
$FechaMov=date('Ymd');
$rutEmisor = $_POST['rut'];

$dir_subida_xml_db1 = $rutEmisor.'/'.$a;
$dir_subida_xml_db = $dir_subida_xml_db1.'/'.$_FILES['xmlCaf']['name'];

$usuario="jce";
$password="Mult0942.paz.tor";
$raiz="/wwwroot_nn/CAF/".$dir_subida_xml_db1."/";
$targetFile=$_FILES["xmlCaf"]["tmp_name"];
include_once("phpseclib");

$conexion= new conexionSFTP("190.114.253.217",21,$usuario,$password);
 echo   $conexion->conectar();

#ASI SUBIMOS UN ARCHIVO
$conexion->put_contents($raiz.$_FILES['xmlCaf']['name'],file_get_contents($targetFile));
?>	


<?php
session_start();
include('../connect.php');


// querys
//$RutEmpresa="76.216.364-0";
//$PrimerFolio='1';
	$result=mysql_query("SELECT UltimoFolio,RutEmpresa FROM DTE_caf where Empresa='$sesionEmpresaID' and TipoDocto='$a' and Usuario='1000000000'");	    
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
  			$PrimerFolio= $row['UltimoFolio']+1; 
			$UltimoFolio= $row['UltimoFolio'];
			$RutEmpresa= $row['RutEmpresa']; 
	}


///UPDATE
$result=mysql_query("UPDATE DTE_caf 
SET Usuario='$UltimoFolio', Vigente='NO'
where Empresa='$sesionEmpresaID' and TipoDocto='$a' and Usuario='1000000000'");

///insert
//REPLACE('abcdefghicde','cde','xxx');  
$result=mysql_query("INSERT INTO `DTE_caf` (TipoDocto,CAFVigente,UltimoFolio, Empresa, Usuario,Vigente,FechaMov,PrimerFolio,RutEmpresa) VALUES('$a',REPLACE('$dir_subida_xml_db','rar','xml'),'$c', '$sesionEmpresaID', '1000000000','SI','$FechaMov','$PrimerFolio','$RutEmpresa')");

//echo "INSERT INTO `DTE_caf` (TipoDocto,CAFVigente,UltimoFolio, Empresa, Usuario,Vigente,FechaMov,PrimerFolio,RutEmpresa) VALUES('$a','$dir_subida','$c' , $sesionEmpresaID, '$username','SI','$FechaMov','$PrimerFolio','$rutEmisor')";



header("location: foliosDisponible.php");


?>