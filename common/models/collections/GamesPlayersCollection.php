<?php

/**
 * Created by PhpStorm.
 * User: joro
 * Date: 3/4/16
 * Time: 9:55 PM
 */
class GamesPlayersCollection extends Collection
{
    protected $entity="GamesPlayersEntity";
    protected $table="games_players";

    public function save(Entity $entity)
    {
        $dataInput = array(
            'game_id' => $entity->getGameId(),
            'player_id' => $entity->getPlayerId(),
            'goals_ongame'   => $entity->getGoalsOngame(),

        );

        if ($entity->getGameId() > 0) {
            $this->update($entity->getGameId(), $dataInput);
        } else {
            $this->create($dataInput);
        }
    }
    public function getAll($where = array(), $limit = -1, $offset = 0)
    {
        $sql = " SELECT gp.game_id,gp.player_id,gp.goals_ongame,p.first_name,p.last_name,p.team_id FROM {$this->table} as gp ";

        $sql.=" JOIN players as p ON p.id=gp.player_id ";

        $sql.= " WHERE 1=1 ";

        foreach ($where as $key => $value) {
            $sql.= "AND gp.{$key} = '{$value}' ";
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
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE game_id = {$id}";

        $result = $this->db->query($sql);

        if($result === null) {
            $this->db->error();
        }

        return true;
    }
    public function deletePlayer($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE player_id = {$id}";

        $result = $this->db->query($sql);

        if($result === null) {
            $this->db->error();
        }

        return true;
    }
}