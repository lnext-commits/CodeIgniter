<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Access extends CI_Migration {

        public function up()
        {
				$this->dbforge->add_field('id');
                $this->dbforge->add_field(array(
                        'name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 50,
                        ),
                ));
                $this->dbforge->create_table('access');
				
				$data = array(
						array(
								'name' => 'полный',
								
						),
						array(
								'name' => 'ограниченый',
								
						),
						array(
								'name' => 'гость',
						)
				);

				$this->db->insert_batch('access', $data);

        }
		
        public function down()
        {
                $this->dbforge->drop_table('access');
        }
}