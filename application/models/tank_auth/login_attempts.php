<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * IDSlot
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Open Software License version 3.0
 *
 * This source file is subject to the Open Software License (OSL 3.0) that is
 * bundled with this package in the files license.txt / license.rst.  It is
 * also available through the world wide web at this URL:
 * http://opensource.org/licenses/OSL-3.0
 *
 * @package	IDSlot
 * @author	IDSlot Development Team
 * @copyright	Copyright (c) 2012, IDSlot Development Team
 * @license	http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * @link	http://idslot.org
 */
/**
 * Login_attempts
 *
 * This model serves to watch on all attempts to login on the site
 * (to protect the site from brute-force attack to user database)
 *
 * @package	Tank_auth
 * @author	Ilya Konyukhov (http://konyukhov.com/soft/)
 */
class Login_attempts extends CI_Model
{
	private $table_name = 'login_attempts';

	public function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this->table_name = $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
	}

	/**
	 * Get number of attempts to login occured from given IP-address or login
	 *
	 * @param	string
	 * @param	string
	 * @return	int
	 */
	public function get_attempts_num($ip_address, $login)
	{
		$this->db->select('1', FALSE);
		$this->db->where('ip_address', $ip_address);
		if (strlen($login) > 0) $this->db->or_where('login', $login);

		$qres = $this->db->get($this->table_name);
		return $qres->num_rows();
	}

	/**
	 * Increase number of attempts for given IP-address and login
	 *
	 * @param	string
	 * @param	string
	 * @return	void
	 */
	public function increase_attempt($ip_address, $login)
	{
		$this->db->insert($this->table_name, array('ip_address' => $ip_address, 'login' => $login));
	}

	/**
	 * Clear all attempt records for given IP-address and login.
	 * Also purge obsolete login attempts (to keep DB clear).
	 *
	 * @param	string
	 * @param	string
	 * @param	int
	 * @return	void
	 */
	public function clear_attempts($ip_address, $login, $expire_period = 86400)
	{
		$this->db->where(array('ip_address' => $ip_address, 'login' => $login));

		// Purge obsolete login attempts
		$this->db->or_where('UNIX_TIMESTAMP(time) <', time() - $expire_period);

		$this->db->delete($this->table_name);
	}
}

/* End of file login_attempts.php */
/* Location: ./application/models/auth/login_attempts.php */
