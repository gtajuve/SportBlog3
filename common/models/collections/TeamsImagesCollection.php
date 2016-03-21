<?php


class TeamsImagesCollection extends Collection
{
    protected $entity='TeamsImagesEntity';
    protected $table='teams_images';

    public function save(Entity $entity)
    {
        $dataInput = array(
            'team_id' => $entity->getTeamId(),
            'id' => $entity->getId(),
            'image_name'   => $entity->getImageName(),
            'title'=>$entity->getTitle(),

        );

        if ($entity->getId() > 0) {
            $this->update($entity->getId(), $dataInput);
        } else {
            $this->create($dataInput);
        }
    }
}