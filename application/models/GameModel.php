<?php

class GameModel extends CI_Model
{
    public function create($cover)
    {
        $this->db->insert('game',$data);
    }
}
