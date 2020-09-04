<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_History extends CI_Migration {

        public function up()
        {
				$this->dbforge->add_field('id');
                $this->dbforge->add_field(array(
                        'd' => array(
                                'type' => 'datetime',
                        ),
						'sp' => array(
                                'type' => 'INT',
                                'constraint' => 9,
                        ),
                        'sr' => array(
                                'type' => 'INT',
                                'constraint' => 9,
                        ),
						'id_boy' => array(
                                'type' => 'INT',
                                'constraint' => 9,
                        ),
						'id_inv' => array(
                                'type' => 'INT',
                                'constraint' => 9,
                        ),
						'period' => array(
                                'type' => 'date',
                        ),
						'id_class' => array(
                                'type' => 'INT',
                                'constraint' => 9,
                        ),
						
                ));
                $this->dbforge->create_table('history');
        }
		
        public function down()
        {
                $this->dbforge->drop_table('history');
        }
}