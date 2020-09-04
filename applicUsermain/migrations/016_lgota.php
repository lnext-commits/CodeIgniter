<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Lgota extends CI_Migration {

        public function up()
        {
				$this->dbforge->add_field('id');
                $this->dbforge->add_field(array(
                        'stake' => array(
                                'type' => 'INT',
                                'constraint' => 9,
                        ),
						'namel' => array(
                                 'type' => 'VARCHAR',
                                'constraint' => 50,
                        ),
                ));
                $this->dbforge->create_table('lgota');
				
				$data = array(
						array(
								'stake' => 1500,
								'namel' => 'полный',
						),
						array(
								'stake' => 1200,
								'namel' => 'скидка',
						),
						array(
								'stake' => 1050,
								'namel' => 'льгота',
						)
				);

				$this->db->insert_batch('lgota', $data);

        }
		
        public function down()
        {
                $this->dbforge->drop_table('lgota');
        }
}