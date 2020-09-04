<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Period extends CI_Migration {

        public function up()
        {
				$this->dbforge->add_field('id');
                $this->dbforge->add_field(array(
                        'id_class' => array(
                                'type' => 'INT',
                                'constraint' => 9,
                        ),
                        'mont' => array(
                                 'type' => 'date',
                        )
                ));
                $this->dbforge->create_table('period');
        }
		
        public function down()
        {
                $this->dbforge->drop_table('period');
        }
}