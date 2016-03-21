<?php

class TeamsCollection extends Collection
{
    protected $entity='TeamsEntity';
    protected $table='teams';

    public function save(Entity $entity)
    {
        $dataInput = array(
            'team_name' => $entity->getTeamName(),
            'id' => $entity->getId(),
            'country_id'   => $entity->getCountryId(),
            'address'=>$entity->getAddress(),
            'image'=>$entity->getImage()
        );

        if ($entity->getId() > 0) {
            $this->update($entity->getId(), $dataInput);
        } else {
            $this->create($dataInput);
        }
    }
    public function getAll($where = array(), $limit = -1, $offset = 0,$order="team_name ASC",$like=null)
    {
        $sql = " SELECT t.id,t.team_name,t.address,t.image,c.country_name,t.country_id FROM {$this->table} as t ";

        $sql.=" LEFT JOIN country as c ON c.id=t.country_id ";

        $sql.= " WHERE 1=1 ";

        foreach ($where as $key => $value) {
            $sql.= "AND t.{$key} = '{$value}' ";
        }
        if($like!=null){
            $sql.=" AND t.team_name LIKE '{$like}%' ";
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
    public function getAllExp($where = array(), $limit = -1, $offset = 0,$order="team_name ASC",$like=null)
    {
        $sql = " SELECT t.id,t.team_name,t.address,t.image,c.country_name,t.country_id FROM {$this->table} as t ";

        $sql.=" LEFT JOIN country as c ON c.id=t.country_id ";

        $sql.= " WHERE 1=1 ";

        foreach ($where as $key => $value) {
            $sql.= "AND t.id != '{$value}' ";
        }
        if($like!=null){
            $sql.=" AND t.team_name LIKE '{$like}%' ";
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
        $sql = " SELECT * FROM {$this->table} as t ";

        $sql.=" LEFT JOIN country as c ON c.id=t.country_id ";

        $sql.= "WHERE t.id = '{$where}'";

        $result = $this->db->query($sql);

        $row = $this->db->translate($result);

        $entity = new $this->entity;
        $oEntity = $entity->init($row);

        return $oEntity;
    }
    public function updateTeams($where=array(), $dataInput)
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
            $sql.= "AND t.{$key} = '{$value}' ";
        }

        $result = $this->db->query($sql);

        if($result === null) {
            $this->db->error();
        }

        return true;
    }

}