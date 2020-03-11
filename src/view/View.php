<?php

namespace Src\View;

use Exception;

/**
 * Class View
 * 	Called by controller to generates views associated to one view file and one template and provided variables
 */
class View
{
	private $file;

	/**
	 * 	Generate view from template and provided variables generated by renderFile
	 * @param  string $app      [frontend or backend]
	 * @param  string $template [name of view file]
	 * @param  array  $data     [optional variables required by the view]
	 * @return void
	 */
	public function render($app, $template, $data = [])
	{
		$this->file = 'src/view/' . $app . '/' . $template . '.php';
		$this->renderFile($this->file, $data);
		$view = $this->renderFile('src/view/' . $app . '/' . $app . '_template.php', $data);
		echo $view;
	}

	/**
	 * Get datas from file view
	 * @param  string $file [file path]
	 * @param  array $data [optional variables required by the view]
	 * @return view
	 */
	private function renderFile($file, $data)
	{
		if (file_exists($file)) {
			extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
		}
		throw new Exception ('Vue non trouvée');
	}
}