<?php

namespace App\Entity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User Implements UserInterface, \Serializable 
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    
    public function getRoles(){
        return ['ROLE_ADMIN'];
    }
    
    public function eraseCredentials(){
        
    }
    
    public function getSalt(){
        return null;
        
    }
    
    public function serialize(): string {
        return serialize($this->id, $this->username, $this->password);
    }

    public function unserialize(string $serialized): void {
        list($this->id,$this->username, $this->password) = unserialize($serialized);
        
    }

}
