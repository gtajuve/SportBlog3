<?php

class UserTeamsCollection extends Collection
{
    protected $entity='UserTeamsEntity';
    protected $table='user_teams';

    public function save(Entity $entity)
    {
        $dataInput = array(
            'team_id' => $entity->getTeamId(),
            'user_id' => $entity->getUserId(),

        );

        if ($entity->getId() > 0) {
            $this->update($entity->getId(), $dataInput);
        } else {
            $this->create($dataInput);
        }
    }
    public function getAll($where = array(), $limit = -1, $offset = 0,$order="team_name ASC",$like=null)
    {
        $sql = " SELECT ut.user_id,ut.team_id,t.team_name FROM {$this->table} as ut ";

        $sql.="  JOIN teams as t ON ut.team_id=t.id ";

        $sql.= " WHERE 1=1 ";

        foreach ($where as $key => $value) {
            $sql.= "AND ut.{$key} = '{$value}' ";
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


}