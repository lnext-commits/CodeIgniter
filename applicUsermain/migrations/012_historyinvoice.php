<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Historyinvoice extends CI_Migration {

        public function up()
        {
				$this->dbforge->add_field('id');
                $this->dbforge->add_field(array(
						'id_class' => array(
                                'type' => 'INT',
                                'constraint' => 9,
                        ),
						'id_inv' => array(
                                'type' => 'INT',
                                'constraint' => 9,
                        ),
                        'writeoff' => array(
                                'type' => 'INT',
                                'constraint' => 9,
                        ), 
						'd' => array(
                                'type' => 'datetime',
                        ),
						'id_boy' => array(
                                'type' => 'INT',
                                'constraint' => 9,
                        ),
						'comment' => array(
                                'type' => 'varchar',
                                'constraint' => 255,
                        ),
						
                ));
                $this->dbforge->create_table('historyinvoice');
        }
		
        public function down()
        {
                $this->dbforge->drop_table('historyinvoice');
        }
}