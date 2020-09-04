<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_TipPerson extends CI_Migration {

        public function up()
        {
				$this->dbforge->add_field('id');
                $this->dbforge->add_field(array(
                        'namet' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 100,
                        ),
                        'tip' => array(
                                 'type' => 'VARCHAR',
                                'constraint' => 50,
                        )
                ));
                $this->dbforge->create_table('tipPerson');
				
				$data = array(
						array(
								'namet' => 'Фин Админ',
								'tip' => 'finadmin',
						),
						array(
								'namet' => 'Финансист',
								'tip' => 'financier',
						),
						array(
								'namet' => 'Фея',
								'tip' => 'fairy',
						),
						array(
								'namet' => 'Перподователь',
								'tip' => 'teacher',
						),
						array(
								'namet' => 'Финансовая группа',
								'tip' => 'financial group',
						)
				);

				$this->db->insert_batch('tipPerson', $data);

        }
		
        public function down()
        {
                $this->dbforge->drop_table('tipPerson');
        }
}