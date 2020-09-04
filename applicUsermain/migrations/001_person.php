<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Person extends CI_Migration {

        public function up()
        {
				$this->dbforge->add_field('id');
                $this->dbforge->add_field(array(
                        'fio' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 200,
                        ),
                        'id_tip' => array(
                                'type' => 'INT',
                                'constraint' => 9,
                        ),
                        'dost' => array(
                                'type' => 'INT',
                                'constraint' => 9,
                        ),
						'id_class' => array(
                                'type' => 'INT',
                                'constraint' => 9,
                        ),
						'pass' => array(
                                 'type' => 'VARCHAR',
                                'constraint' => 50,
                        ),
                ));
                $this->dbforge->create_table('person');
				
				$data = array(
						array(
								'fio' => 'Добрый Гость',
								'id_tip' => 2,
								'dost' => 1,
								'id_class' => 1,
								'pass' => 'admit',
						)
				);

				$this->db->insert_batch('person', $data);

        }
		
        public function down()
        {
                $this->dbforge->drop_table('person');
        }
}