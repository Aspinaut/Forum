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
    * @ORM\Column(type="string", length=255, options={"default": "anon"})
    */
   private $author;

   /**
    * @ORM\Column(type="text")
    */
   private $title;

   /**
    * @ORM\Column(type="integer", options={"default": 0})
    */
   private $likes;

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
}
