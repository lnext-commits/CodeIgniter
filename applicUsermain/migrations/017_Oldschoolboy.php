<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Oldschoolboy extends CI_Migration {

        public function up()
        {
				$this->dbforge->add_field('id');
                $this->dbforge->add_field(array(
                        'id_boy' => array(
                                'type' => 'INT',
                                'constraint' => 9,
                        ),
						'fio' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 200,
                        ),
                        'id_lgota' => array(
                                'type' => 'INT',
                                'constraint' => 9,
                        ),
						'id_class' => array(
                                'type' => 'INT',
                                'constraint' => 9,
                        ),
						'plan' => array(
                                'type' => 'INT',
                                'constraint' => 9,
                        ),
						'fact' => array(
                                'type' => 'INT',
                                'constraint' => 9,
                        ),	
                ));
                $this->dbforge->create_table('Oldschoolboy');
        }
		
        public function down()
        {
                $this->dbforge->drop_table('Oldschoolboy');
        }
}