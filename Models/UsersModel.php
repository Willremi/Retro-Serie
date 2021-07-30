<?php
namespace App\Models;

class UsersModel extends Model
{
    protected $id;
    protected $email;
    protected $pseudo;
    protected $password;
    protected $roles;
    protected $actif;

    public function __construct()
    {
        $class = str_replace(__NAMESPACE__.'\\', '', __CLASS__);
        $this->table = strtolower(str_replace('Model', '', $class));
    }

    /**
     * Récupération d'un user à partir de son e-mail
     *
     * @param string $email
     * @return mixed
     */
    public function findOneByEmail(string $email)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE email = ?", [$email])->fetch();
    }

    /**
     * Récupération d'un user à partir de son pseudo
     *
     * @param string $pseudo
     * @return mixed
     */
    public function findOneByPseudo(string $pseudo)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE pseudo = ?", [$pseudo])->fetch();
    }

    /**
     * Création de session de l'utilisateur
     * @return void
     */
    public function setSession()
    {
        $_SESSION['user'] = [
            'id' => $this->id, 
            'email' => $this->email, 
            'pseudo' => $this->pseudo, 
            'roles' => $this->roles, 
            'actif' => $this->actif
        ];
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
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of pseudo
     */ 
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @return  self
     */ 
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of roles
     */ 
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    /**
     * Set the value of roles
     *
     * @return  self
     */ 
    public function setRoles($roles)
    {
        $this->roles = json_decode($roles);
        // $this->roles = $roles;

        return $this;
    }

    /**
     * Get the value of actif
     */ 
    public function getActif(): int
    {
        return $this->actif;
    }

    /**
     * Set the value of actif
     *
     * @return  self
     */ 
    public function setActif(int $actif)
    {
        $this->actif = $actif;

        return $this;
    }
}