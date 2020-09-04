<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Invoiceclass extends CI_Migration {

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
                ));
                $this->dbforge->create_table('invoiceclass');
        }
		
        public function down()
        {
                $this->dbforge->drop_table('invoiceclass');
        }
}