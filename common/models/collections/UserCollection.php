<?php

class UserCollection extends Collection {

    protected $entity = 'UsersEntity';
    protected $table  = 'users';


   public function save(Entity $entity)
   {
       $dataInput = array(
           'username' => $entity->getUsername(),
           'id' => $entity->getId(),
           'email'   => $entity->getEmail(),
           'password'=>$entity->getPassword(),
           'gender'=>$entity->getGender(),
           'reg_time'=>$entity->getRegTime(),
           'permition'=>$entity->getPermition()
       );

       if ($entity->getId() > 0) {
            $this->update($entity->getId(), $dataInput);
       } else {
             $lastId= $this->create($dataInput);
           return $lastId;
       }
   }
    public function getOnebyUsername($username)
    {
        $sql = " SELECT * FROM {$this->table} ";
        $sql.= "WHERE username = '{$username}'";

        $result = $this->db->query($sql);


        $row = $this->db->translate($result);
        if($row==null){
            return null;
        }

        $entity = new $this->entity;
        $oEntity = $entity->init($row);

        return $oEntity;
    }
    public function getAll($where = array(), $limit = -1, $offset = 0,$like=null)
    {
        $sql = " SELECT * FROM {$this->table} ";

        $sql.= " WHERE 1=1 ";

        foreach ($where as $key => $value) {
            $sql.= "AND {$key} = '{$value}' ";
        }
        if($like!=null){
            $sql.=" AND username LIKE '{$like}%' ";
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