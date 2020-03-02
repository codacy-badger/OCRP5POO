<?php

namespace src\view;

use config\Request;
use config\Session;
use Exception;

class View

{
	private $_file;

	/*public function __contruct()
	{
		$this->_request = new Request();
		$this->_session = $this->request->getSession();
	}*/

	public function render($app, $template, $data = [])
	{
		$this->_file = 'src/view/' . $app . '/' . $template . '.php';
		$this->renderFile($this->_file, $data);
		$view = $this->renderFile('src/view/' . $app . '/' . $app . '_template.php', $data);
		echo $view;
	}

	private function renderFile($_file, $data)
	{
		if (file_exists($_file))
		{
			extract($data);
            ob_start();
            require $_file;
            return ob_get_clean();
		}
		throw new Exception ('Vue non trouvée');
		
	}
}