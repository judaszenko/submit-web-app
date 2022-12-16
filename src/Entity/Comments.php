<?php

namespace App\Entity;

use App\Repository\CommentsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentsRepository::class)]
class Comments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $comment_time;

    #[ORM\Column(type: 'text')]
    private $comment_text;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'comments')]
    private $owner;

    #[ORM\ManyToOne(targetEntity: Post::class, inversedBy: 'comments')]
    private $Post;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentTime(): ?\DateTimeInterface
    {
        return $this->comment_time;
    }

    public function setCommentTime(\DateTimeInterface $comment_time): self
    {
        $this->comment_time = $comment_time;

        return $this;
    }

    public function getCommentText(): ?string
    {
        return $this->comment_text;
    }

    public function setCommentText(string $comment_text): self
    {
        $this->comment_text = $comment_text;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->Post;
    }

    public function setPost(?Post $Post): self
    {
        $this->Post = $Post;

        return $this;
    }
}
