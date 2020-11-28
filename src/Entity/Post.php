<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
   private $id;

   /**
    * @ORM\Column(type="string", length=255, nullable=true, options={"default": "anon"})
    */
   private $author;

   /**
    * @ORM\Column(type="text")
    */
   private $title;

   /**
    * @ORM\Column(type="integer", nullable=true, options={"default": 0})
    */
   private $likes;

   /**
    * @ORM\Column(type="datetime", nullable=true)
    */
   private $created_at;

   public function __construct()
   {
      $this->created_at = new \DateTime();
   }

   public function getId(): ?int
   {
      return $this->id;
   }

   public function getAuthor(): ?string
   {
       return $this->author;
   }

   public function setAuthor(string $author): self
   {
       $this->author = $author;

       return $this;
   }

   public function getTitle(): ?string
   {
       return $this->title;
   }

   public function setTitle(string $title): self
   {
       $this->title = $title;

       return $this;
   }

   public function getLikes(): ?int
   {
       return $this->likes;
   }

   public function setLikes(int $likes): self
   {
       $this->likes = $likes;

       return $this;
   }

   public function getCreatedAt(): ?\DateTimeInterface
   {
       return $this->created_at;
   }

   public function setCreatedAt(?\DateTimeInterface $created_at): self
   {
       $this->created_at = $created_at;

       return $this;
   }
}
