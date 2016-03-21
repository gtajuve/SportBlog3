<?php


class GamesEntity extends Entity
{
    protected $id;
    protected $homeTeamId;
    protected $awayTeamId;
    protected $score;
    protected $datePlay;
    protected $homeTeam;
    protected $awayTeam;
    protected $homeImage;
    protected $awayImage;

    /**
     * @return mixed
     */
    public function getHomeImage()
    {
        return $this->homeImage;
    }

    /**
     * @param mixed $homeImage
     */
    public function setHomeImage($homeImage)
    {
        $this->homeImage = $homeImage;
    }

    /**
     * @return mixed
     */
    public function getAwayImage()
    {
        return $this->awayImage;
    }

    /**
     * @param mixed $awayImage
     */
    public function setAwayImage($awayImage)
    {
        $this->awayImage = $awayImage;
    }

    /**
     * @return mixed
     */
    public function getHomeTeam()
    {
        return $this->homeTeam;
    }

    /**
     * @param mixed $homeTeam
     */
    public function setHomeTeam($homeTeam)
    {
        $this->homeTeam = $homeTeam;
    }

    /**
     * @return mixed
     */
    public function getAwayTeam()
    {
        return $this->awayTeam;
    }

    /**
     * @param mixed $awayTeam
     */
    public function setAwayTeam($awayTeam)
    {
        $this->awayTeam = $awayTeam;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getHomeTeamId()
    {
        return $this->homeTeamId;
    }

    /**
     * @param mixed $homeTeamId
     */
    public function setHomeTeamId($homeTeamId)
    {
        $this->homeTeamId = $homeTeamId;
    }

    /**
     * @return mixed
     */
    public function getAwayTeamId()
    {
        return $this->awayTeamId;
    }

    /**
     * @param mixed $awayTeamId
     */
    public function setAwayTeamId($awayTeamId)
    {
        $this->awayTeamId = $awayTeamId;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param mixed $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * @return mixed
     */
    public function getDatePlay()
    {
        return $this->datePlay;
    }

    /**
     * @param mixed $datePlay
     */
    public function setDatePlay($datePlay)
    {
        $this->datePlay = $datePlay;
    }



}