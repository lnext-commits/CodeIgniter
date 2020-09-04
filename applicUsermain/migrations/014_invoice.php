<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Invoice extends CI_Migration {

        public function up()
        {
				$this->dbforge->add_field('id');
                $this->dbforge->add_field(array(
                        'namei' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 180,
                        ),
                        'disclosure' => array(
                                 'type' => 'VARCHAR',
                                'constraint' => 255,
                        ),
						 'summ' => array(
                                'type' => 'INT',
                                'constraint' => 9,
                        ),
                        'id_catinv' => array(
                                'type' => 'INT',
                                'constraint' => 9,
                        ),
                ));
                $this->dbforge->create_table('invoice');
				
				$data = array(
						array(
								'namei' => 'в общ.бюджет на творческие встречи',
								'disclosure' => '',
								'summ' =>1500,
								'id_catinv' =>1,
						),
						array(
								'namei' => 'в общ. бюджет на развитие',
								'disclosure' => '(30*21 повышение квалификации)',
								'summ' =>630,
								'id_catinv' =>1,
						),
						array(
								'namei' => 'на хоз нужды школы',
								'disclosure' => '(50*21 чел-4 по 25грн льготника)',
								'summ' =>950,
								'id_catinv' =>2,
						),
						array(
								'namei' => 'ремонт школы',
								'disclosure' => '25грн/чел.мес, чтобы выйти на 200грн с чел в год',
								'summ' =>550,
								'id_catinv' =>3,
						),
						array(
								'namei' => 'ставка учителя',
								'disclosure' => '',
								'summ' =>4500,
								'id_catinv' =>4,
						),
						array(
								'namei' => 'нужды класса',
								'disclosure' => '',
								'summ' =>0,
								'id_catinv' =>5,
						)
				);

				$this->db->insert_batch('invoice', $data);

        }
		
        public function down()
        {
                $this->dbforge->drop_table('invoice');
        }
}