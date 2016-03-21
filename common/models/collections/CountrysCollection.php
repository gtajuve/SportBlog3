<?php

class CountrysCollection extends Collection
{
    protected $entity = 'CountrysEntity';
    protected $table  = 'country';


    public function save(Entity $entity)
    {
        $dataInput = array(

            'id' => $entity->getId(),
            'country_name'=>$entity->getCountryName()
        );

        if ($entity->getId() > 0) {
            $this->update($entity->getId(), $dataInput);
        } else {
            $this->create($dataInput);
        }
    }
    public function getAll($where = array(), $limit = -1, $offset = 0,$order="country_name ASC",$like=null)
    {
        $sql = " SELECT * FROM {$this->table} ";

        $sql.= " WHERE 1=1 ";

        foreach ($where as $key => $value) {
            $sql.= "AND {$key} = '{$value}' ";
        }
        if($like!=null){
            $sql.=" AND country_name LIKE '{$like}%' ";
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
    public function getCount($where = array(), $limit = -1, $offset = 0,$order="country_name ASC",$like=null)
    {
        $sql = " SELECT count(id) as cnt FROM {$this->table} ";

        $sql.= " WHERE 1=1 ";

        foreach ($where as $key => $value) {
            $sql.= "AND {$key} = '{$value}' ";
        }
        if($like!=null){
            $sql.=" AND country_name LIKE '{$like}%' ";
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


       $row = $this->db->translate($result);


        return $row['cnt'];
    }

}


