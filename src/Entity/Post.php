<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $postTime;

    #[ORM\Column(type: 'text')]
    private $postText;

    #[ORM\Column(type: 'integer')]
    private $creatorId;

    #[ORM\Column(type: 'string', length: 255)]
    private $postImg;

    // #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'postsCreated')]
    // private $creatorNick;

    #[ORM\Column(type: 'string', length: 255)]
    private $cretor_nickname;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'posts')]
    private $user;

    #[ORM\OneToMany(mappedBy: 'Post', targetEntity: Comments::class)]
    private $comments;

    // #[ORM\OneToMany(mappedBy: 'post', targetEntity: Comments::class)]
    // private $Comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->Comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostTime(): ?\DateTimeInterface
    {
        return $this->postTime;
    }

    public function setPostTime(\DateTimeInterface $postTime): self
    {
        $this->postTime = $postTime;

        return $this;
    }

    public function getPostText(): ?string
    {
        return $this->postText;
    }

    public function setPostText(string $postText): self
    {
        $this->postText = $postText;

        return $this;
    }

    public function getCreatorId(): ?int
    {
        return $this->creatorId;
    }

    public function setCreatorId(int $creatorId): self
    {
        $this->creatorId = $creatorId;

        return $this;
    }

    public function getPostImg(): ?string
    {
        return $this->postImg;
    }

    public function setPostImg(string $postImg): self
    {
        $this->postImg = $postImg;

        return $this;
    }

    // public function getCreatorNick(): ?User
    // {
    //     return $this->creatorNick;
    // }

    // public function setCreatorNick(?User $creatorNick): self
    // {
    //     $this->creatorNick = $creatorNick;

    //     return $this;
    // }

    public function getCretorNickname(): ?string
    {
        return $this->cretor_nickname;
    }

    public function setCretorNickname(string $cretor_nickname): self
    {
        $this->cretor_nickname = $cretor_nickname;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Comments>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setPost($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPost() === $this) {
                $comment->setPost(null);
            }
        }

        return $this;
    }
}
