<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migrate extends Base_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->config->load('migration', TRUE);

		$this->load->helper('url');
		$this->load->library('migration');

		$db_version  = (int)$this->_get_database_version();
		$cnf_version = (int)$this->_get_config_version();
		$lst_version = (int)$this->_get_last_version();
		$migrations  = $this->_get_migrations_list();

		self::data(array(
			'database'   => $db_version,
			'config'     => $cnf_version,
			'latest'     => $lst_version,
			'migrations' => $migrations
		));
	}

	/**
	 * Index Page for this controller.
	 *
	 * @return void
	 */
	public function index()
	{
		$this->load->view('migrate/index', self::data());
	}

	/**
	 * Calls the migration.
	 *
	 * @return void
	 */
	public function to($version = FALSE)
	{
		self::data('version', $version);

		if ($version !== FALSE)
		{
			if (strtolower($version) == 'current')
			{
				$version = self::data('config');
			}
			elseif (strtolower($version) == 'latest')
			{
				$version = self::data('latest');
			}
			elseif ($version > self::data('latest'))
			{
				$version = self::data('latest');
			}

			$this->migration->version($version);
		}
		
		redirect('migrate');
	} 	

	/**
	 * Get the version to be run from the config file
	 *
	 * @return version to be run
	 */
	private function _get_config_version()
	{
		return $this->config->item('migration_version', 'migration');
	}

	/**
	 * Get the version of the last migration run
	 *
	 * @return last version run
	 */
	private function _get_database_version()
	{
		$row = $this->db->get('migrations')->row();
		return $row ? $row->version : 0;
	}

	/**
	 * Get the list of migrations
	 *
	 * @return all migrations name
	 */
	private function _get_migrations_list()
	{
		$files = glob(APPPATH . 'migrations/*_*.php');
		$file_count = count($files);

		for ($i = 0; $i < $file_count; $i++)
		{
			$name = basename($files[$i], '.php');
			if ( ! preg_match('/^\d{3}_(\w+)$/', $name))
			{
				$files[$i] = FALSE;
			}
		}

		sort($files);
		return $files;
	}

	/**
	 * Get the version of the latest migration avaiable
	 *
	 * @return latest migration avaiable
	 */
	private function _get_last_version()
	{
		$files = $this->_get_migrations_list();
		$last_migration = basename(end($files));
		return ((int) substr($last_migration, 0, 3));
	}
}

/* End of file migrate.php */
/* Location: ./application/controllers/migrate.php */