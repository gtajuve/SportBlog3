<?php

class GamesCollection extends Collection {

    protected $entity = 'GamesEntity';
    protected $table  = 'games';


    public function save(Entity $entity)
    {
        $dataInput = array(
            'home_team_id' => $entity->getHomeTeamId(),
            'id' => $entity->getId(),
            'away_team_id'   => $entity->getAwayTeamId(),
            'score'=>$entity->getScore(),
            'date_play'=>$entity->getDatePlay(),

        );

        if ($entity->getId() > 0) {
            $this->update($entity->getId(), $dataInput);
        } else {
            $this->create($dataInput);
        }
    }
    public function getAll($where = array(), $limit = -1, $offset = 0,$order=null)
    {
        $sql = " SELECT g.score,g.id,g.date_play,t1.team_name as home_team,t2.team_name as away_team,t1.image as home_image,t2.image as away_image FROM {$this->table} as g ";

        $sql.=" JOIN teams as t1 ON t1.id=g.home_team_id ";
        $sql.=" JOIN teams as t2 ON t2.id=g.away_team_id ";

        $sql.= " WHERE 1=1 ";

        foreach ($where as $key => $value) {
            $sql.= "AND {$key} = '{$value}' ";
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
    public function getAllManyTeams($where = array(), $limit = -1, $offset = 0,$order="date_play DESC")
    {
        $sql = " SELECT g.score,g.id,g.date_play,t1.team_name as home_team,t2.team_name as away_team,t1.image as home_image,t2.image as away_image FROM {$this->table} as g ";

        $sql.=" JOIN teams as t1 ON t1.id=g.home_team_id ";
        $sql.=" JOIN teams as t2 ON t2.id=g.away_team_id ";

        $sql.= " WHERE 1=0 ";

        foreach ($where as $value) {
            $sql.= "OR ( g.home_team_id = '{$value}' OR g.away_team_id= '{$value}' ) ";
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
    public function getAllByTeam($where1 = array(),$where2 = array(), $limit = -1, $offset = 0,$order=null)
    {
        $sql = " SELECT g.score,g.id,g.date_play,t1.team_name as home_team,t2.team_name as away_team,t1.image as home_image,t2.image as away_image  FROM {$this->table} as g ";

        $sql.=" JOIN teams as t1 ON t1.id=g.home_team_id ";
        $sql.=" JOIN teams as t2 ON t2.id=g.away_team_id ";

//        $sql.= " WHERE 1=0 ";
        if(!empty($where1)&&!empty($where2)){
            $sql.= " WHERE ( 1=0 ";
            foreach ($where1 as $key => $value) {
                $sql.= "OR {$key} = '{$value}' ";
            }
            $sql.="  ) AND ( 1=0 ";
            foreach ($where2 as $key => $value) {
                $sql.= " OR {$key} = '{$value}' ";
            }
            $sql.=' ) ';
        }elseif(!empty($where1)){
            $sql.= " WHERE 1=0 ";
            foreach ($where1 as $key => $value) {
                $sql.= "OR {$key} = '{$value}' ";
            }

        }elseif(!empty($where2)) {
            $sql.= " WHERE 1=0 ";
            foreach ($where2 as $key => $value) {
            $sql.= "AND 1=0 OR {$key} = '{$value}' ";
            }
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

    public function getOne($where = null) {
        $sql = "SELECT g.score,g.id,g.date_play,g.home_team_id,g.away_team_id,t1.team_name as home_team,t2.team_name as away_team FROM {$this->table} as g ";
        $sql.=" JOIN teams as t1 ON t1.id=g.home_team_id ";
        $sql.=" JOIN teams as t2 ON t2.id=g.away_team_id ";
        $sql.= "WHERE g.id = '{$where}'";

        $result = $this->db->query($sql);

        $row = $this->db->translate($result);

        $entity = new $this->entity;
        $oEntity = $entity->init($row);

        return $oEntity;
    }

}