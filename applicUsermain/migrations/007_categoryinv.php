<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Categoryinv extends CI_Migration {

        public function up()
        {
				$this->dbforge->add_field('id');
                $this->dbforge->add_field(array(
                        'namecat' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 255,
                        ),
                        'color' => array(
                                 'type' => 'VARCHAR',
                                'constraint' => 50,
                        )
                ));
                $this->dbforge->create_table('categoryinv');
				
				$data = array(
						array(
								'namecat' => 'общий бюджет параллели',
								'color' => '218,150,148',
						),
						array(
								'namecat' => 'школьные обязательные платы',
								'color' => '149,179,215',
						),
						array(
								'namecat' => 'накопительные счета класса',
								'color' => '196,215,155',
						),
						array(
								'namecat' => 'доплаты пед.состав',
								'color' => '250,191,143',
						),
						array(
								'namecat' => 'на нужны класса',
								'color' => '255,255,0',
						)
				);

				$this->db->insert_batch('categoryinv', $data);

        }
		
        public function down()
        {
                $this->dbforge->drop_table('categoryinv');
        }
}