<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Class_room extends CI_Migration {

        public function up()
        {
				$this->dbforge->add_field('id');
                $this->dbforge->add_field(array(
                        'income_year' => array(
                                'type' => 'year',
                                'constraint' => 4,
                        ),
						'teacher' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 100,
                        ),
                ));
                $this->dbforge->create_table('class_room');
				
				$data = array(
						array(
								'income_year' => 2020,
								'teacher' => 'Шестокова Вера',
						)
				);

				$this->db->insert_batch('class_room', $data);

        }
		
        public function down()
        {
                $this->dbforge->drop_table('class_room');
        }
}