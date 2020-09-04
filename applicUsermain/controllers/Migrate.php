<?php

class Migrate extends CI_Controller
{

        public function index()
        {
                $this->load->library('migration');

                if ($this->migration->version(17) === FALSE)
                {
                        show_error($this->migration->error_string());
                }
				else 
				{
					echo"таблицы созданы!<br> <a href='/'>на исходную</a>";
				}
        }

}