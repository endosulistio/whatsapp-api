<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

    public function __construct()
    {
        // $this->load does not exist until after you call this
        parent::__construct(); // Construct CI's core so that you can use it

        $this->load->dbforge();
    }

	public function index()
	{
		if ($this->db->table_exists('settings') == FALSE) {
			$fields = array(
				'id' => array(
						'type' => 'INT',
						'constraint' => 5,
						'unsigned' => TRUE,
						'auto_increment' => TRUE
				),
				'account' => array(
						'type' => 'VARCHAR',
						'constraint' => '20',
						'unique' => TRUE,
				),
				'callback' => array(
						'type' =>'VARCHAR',
						'constraint' => '100',
						'default' => '',
				),
				'api_key' => array(
						'type' => 'VARCHAR',
						'constraint' => '20',
						'unique' => TRUE,
				),
			);
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->add_field($fields);
			$this->dbforge->create_table('settings');
		}
		$this->load->view('welcome_message');
	}
}
