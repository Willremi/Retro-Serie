<?php
namespace App\Models;

class CommentairesModel extends Model
{
    protected $id;
    protected $content;
    protected $idSerie;
    protected $users_id;
    protected $actif;
    protected $created_at;

    public function __construct()
    {
        $this->table = 'commentaires';
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of idSerie
     */ 
    public function getIdSerie()
    {
        return $this->idSerie;
    }

    /**
     * Set the value of idSerie
     *
     * @return  self
     */ 
    public function setIdSerie($idSerie)
    {
        $this->idSerie = $idSerie;

        return $this;
    }

    /**
     * Get the value of users_id
     */ 
    public function getUsers_id()
    {
        return $this->users_id;
    }

    /**
     * Set the value of users_id
     *
     * @return  self
     */ 
    public function setUsers_id($users_id)
    {
        $this->users_id = $users_id;

        return $this;
    }

    /**
     * Get the value of actif
     */ 
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * Set the value of actif
     *
     * @return  self
     */ 
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }
}