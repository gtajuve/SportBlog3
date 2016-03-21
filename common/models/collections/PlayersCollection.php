<?php


class PlayersCollection extends Collection
{
    protected $entity='PlayersEntity';
    protected $table='players';

    public function save(Entity $entity)
    {
        $dataInput = array(
            'first_name' => $entity->getFirstName(),
            'last_name' => $entity->getLastName(),
            'id' => $entity->getId(),
            'country'   => $entity->getCountry(),
            'position_player'=>$entity->getPositionPlayer(),
            'image'=>$entity->getImage(),
            'team_id'=>$entity->getTeamId(),
            'games'=>$entity->getGames(),
            'goals'=>$entity->getGoals(),
        );

        if ($entity->getId() > 0) {
            $this->update($entity->getId(), $dataInput);
        } else {
            $this->create($dataInput);
        }
    }
    public function getOne($where = null) {
        $sql = " SELECT p.id,p.first_name,p.last_name,p.position_player,p.country,p.games,p.goals,p.image,t.team_name FROM {$this->table} as p ";
        $sql.=" LEFT JOIN teams as t ON t.id=p.team_id ";
        $sql.= "WHERE p.id = '{$where}'";

        $result = $this->db->query($sql);

        $row = $this->db->translate($result);

        $entity = new $this->entity;
        $oEntity = $entity->init($row);

        return $oEntity;
    }

    public function getAll($where = array(), $limit = -1, $offset = 0,$order=null,$like=null)
    {
        $sql = " SELECT p.id,p.first_name,p.last_name,p.position_player,p.country,p.games,p.goals,p.image,t.team_name FROM {$this->table} as p ";

        $sql.=" LEFT JOIN teams as t ON t.id=p.team_id ";


        $sql.= " WHERE 1=1 ";

        foreach ($where as $key => $value) {
            $sql.= "AND {$key} = '{$value}' ";
        }
        if($like!=null){
            $sql.=" AND p.last_name LIKE '{$like}%' ";
        }
        if($order!=null){
            $sql.=" ORDER BY {$order} ";
        }


        if ($limit > -1) {
            $sql.= "Limit {$limit}";

            if ($offset > 0) {
                $sql.= " , {$offset}";
            }
        }

        $result = $this->db->query($sql);

        if ($result  === false) {
            $this->db->error();
        }

        $collection = array();
        while ($row = $this->db->translate($result)) {
            $entity = new $this->entity;
            $entityRow = $entity->init($row);

            $collection[] = $entityRow;
        }

        return $collection;
    }
    public function getAllForGame($where = array(), $limit = -1, $offset = 0,$order=null,$like=null)
    {
        $sql = " SELECT p.id,p.first_name,p.last_name,p.position_player,p.country,p.games,p.goals,p.image,gp.game_id,gp.goals_ongame FROM {$this->table} as p ";

        $sql.=" JOIN games as g ON p.team_id=g.home_team_id OR p.team_id=g.away_team_id ";
        $sql.=" LEFT JOIN games_players as gp ON gp.game_id=g.id AND p.id=gp.player_id ";

        $sql.= " WHERE 1=1 ";

        foreach ($where as $key => $value) {
            $sql.= "AND {$key} = '{$value}' ";
        }
        if($like!=null){
            $sql.=" AND p.last_name LIKE '{$like}%' ";
        }
        if($order!=null){
            $sql.=" ORDER BY {$order} ";
        }


        if ($limit > -1) {
            $sql.= "Limit {$limit}";

            if ($offset > 0) {
                $sql.= " , {$offset}";
            }
        }

        $result = $this->db->query($sql);

        if ($result  === false) {
            $this->db->error();
        }

        $collection = array();
        while ($row = $this->db->translate($result)) {
            $entity = new $this->entity;
            $entityRow = $entity->init($row);

            $collection[] = $entityRow;
        }

        return $collection;
    }
    public function updatePlayer($where, $dataInput)
    {
        $sql =  "UPDATE {$this->table} SET ";
        $numItems = count($dataInput);
        $i = 0;
        foreach ($dataInput as $key => $value) {
            if (++$i == $numItems) {
                $sql.="{$key}='{$value}' ";
            } else {
                $sql.="{$key}='{$value}', ";
            }
        }
        $sql.= " WHERE 1=1 ";

        foreach ($where as $key => $value) {
            $sql.= "AND {$key} = '{$value}' ";
        }

        $result = $this->db->query($sql);

        if($result === null) {
            $this->db->error();
        }

        return true;
    }


}