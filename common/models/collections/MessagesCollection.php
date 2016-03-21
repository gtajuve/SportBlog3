<?php

class MessagesCollection extends Collection
{
    protected $entity = 'MessagesEntity';
    protected $table  = 'messages';


    public function save(Entity $entity)
    {
        $dataInput = array(
            'user_id' => $entity->getUserId(),
            'id' => $entity->getId(),
            'reg_time'   => $entity->getRegTime(),
            'message'=>$entity->getMessage(),
            'title'=>$entity->getTitle(),
            'team_id'=>$entity->getTeamId()
        );

        if ($entity->getId() > 0) {
            $this->update($entity->getId(), $dataInput);
        } else {

            $this->create($dataInput);
        }
    }
    public function getAll($where = array(), $limit = -1, $offset = 0,$order='m.reg_time DESC',$like=null)
    {
        $sql = " SELECT m.id,m.message,m.title,m.reg_time,t.team_name,u.username,m.user_id  FROM {$this->table} as m ";

        $sql.=" JOIN teams as t ON t.id=m.team_id ";
        $sql.=" JOIN users as u ON u.id=m.user_id ";

        $sql.= " WHERE 1=1 ";

        foreach ($where as $key => $value) {
            $sql.= "AND {$key} = '{$value}' ";
        }
        if($like!=null){
            $sql.=" AND m.title LIKE '%{$like}%' ";
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
    public function getAllByTeams($where = array(), $limit = -1, $offset = 0,$order='m.reg_time ASC',$like=null)
    {
        $sql = " SELECT m.id,m.message,m.title,m.reg_time,t.team_name,u.username,m.user_id FROM {$this->table} as m ";

        $sql.=" JOIN teams as t ON t.id=m.team_id ";
        $sql.=" JOIN users as u ON u.id=m.user_id ";

        $sql.= " WHERE 1=0 ";

        foreach ($where as $key => $value) {
            $sql.= "OR m.team_id = '{$value}' ";
        }
        if($like!=null){
            $sql.=" AND m.title LIKE '%{$like}%' ";
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