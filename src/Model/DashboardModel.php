<?php

namespace App\Model;

use App\Entity\Comments;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Post;
use App\Entity\User;
use Throwable;
use App\Entity\UserProfile;
use Symfony\Component\String\Slugger\SluggerInterface;
use DateTime;
use Doctrine\DBAL\Exception;
use Doctrine\Persistence\ObjectManager;
use PhpParser\Node\Expr\Throw_;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class DashboardModel
{
    private ManagerRegistry $doctrine;
    private ObjectManager $man;
    private SluggerInterface $slugger;
    private UserPasswordHasherInterface $userPasswordHasher;
    private $connection;

    public function __construct(ManagerRegistry $doctrine, SluggerInterface $slugger, UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->doctrine = $doctrine;
        $this->man = $doctrine->getManager();
        $this->slugger = $slugger;
        $this->userPasswordHasher = $userPasswordHasher;
        $this->connection = $doctrine->getConnection();
    }

    public function fetchUserProfile(User|int $id): UserProfile|null
    {
        return $this->man->getRepository(UserProfile::class)->findOneBy(['User' => $id]);
    }

    public function fetchUserPosts(User|int $user): array
    {
        $posts = $this->man->getRepository(Post::class)->findBy(['user' => $user]);
        $posts = array_reverse($posts);
        return $posts;
    }

    public function fetchPosts(): array
    {
        $posts = $this->man->getRepository(Post::class)->findAll();
        $posts = array_reverse($posts);
        return $posts;
    }

    public function fetchPost(int $id): Post
    {
        return $this->man->getRepository(Post::class)->findOneBy(['id' => $id]);
    }

    public function fetchComments($id, $rows = false)
    {
        $result = $this->man->getRepository(Comments::class)->findBy(['Post' => $id]);
        $returning = [];
        if ($rows) {
            for ($i = 0; $rows > $i; $i = $i + 1) {
                $returning[] =  array_pop($result);
            }
        } else {
            $returning = $result;
        }
        return $returning;
    }
    public function fetchComment($id)
    {
        return $this->man->getRepository(Comments::class)->findBy(['id' => $id]);
    }

    public function createProfile(UserInterface $user)
    {
        // $this->connection->beginTransaction();
        // try{
            $profile = new UserProfile();
            $profile->setUser($user)->setName($user->getUsername())->setPhoto('/profile_images/default.jpg');
            $this->man->persist($profile);
            $this->man->flush();
            return $profile;
        // }catch(Throwable $e){
        //     $this->connection->rollBack();
        //     throw new Exception("An error occured creating User Profile");
        // }
        
    }

    public function insertUser(FormInterface $form)
    {
        $user = new User();
        $user->setMail($form->get("mail")->getData())
            ->setPassword($this->userPasswordHasher->hashPassword($user, $form->get('plainPassword')->getData()))
            ->setUsername($form->get("username")->getData())
            ->setUserProfile($this->createProfile($user));
        try{
            $this->man->persist($user);
            $this->man->flush();
        }catch(Throwable $e){
            Throw new Exception($e->getMessage());
        }
        
        return $user;
    }

    public function submitPost(User $user, FormInterface $form)
    {
        try{
            $post = new Post();
            $file = $form->get("post_img")->getData();
            $post->setPostTime(new DateTime("now"))
                ->setCreatorId($user->getId())
                ->setCretorNickname($user->getUsername());
            // ->setCreatorNickname($user);
    
            if (!is_string($file)) {
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = $this->slugger->slug($originalFileName);
                $newFilename = $safeFileName . '-' . uniqid() . '.' . $file->guessExtension();
                try {
                    $file->move('/var/www/public/uploads', $newFilename);
                } catch (Throwable $e) {
                    // dd($e);T
                    throw new Exception("Unable to move file");
                }
            }
            $post->setPostText($form->get("postText")->getData());
            $post->setPostImg($newFilename);
            $this->man->persist($post);
            $user->addPost($post);
            $this->man->persist($user);
            $this->man->flush();
        }catch(Throwable $e){
            throw new Exception('An error occured while creating post: "'.$e->getMessage().'"');
        }
        
    }

    public function submitComment(FormInterface $form, UserInterface $user, int $id)
    {
        $comment = new Comments();
        $post = $this->man->getRepository(Post::class)->findOneBy(['id' => $id]);
        $comment->setCommentTime(new DateTime());
        $comment->setOwner($user);
        $comment->setPost($post);
        $comment->setCommentText($form->get("commentText")->getData());
        $post->addComment($comment);
        $this->man->persist($comment);
        $this->man->flush();
    }

    public function updateProfile(UserInterface $user, FormInterface $form)
    {
        $profile = $this->fetchUserProfile($user->getId());
        $file = $form->get('photo')->getData();
        if (!is_string($file)) {
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFileName = $this->slugger->slug($originalFileName);
            $newFilename = $safeFileName . '-' . uniqid() . '.' . $file->guessExtension();
            try {
                $file->move('/sites/submit/public/profile_images', $newFilename);
            } catch (Throwable $e) {
                return;
            }
            $profile->setPhoto('/profile_images/' . $newFilename);
        }
        $profile->setAge($form->get("age")->getData());
        $profile->setName($form->get("name")->getData());
        $profile->setPhoneNumber($form->get("phone_number")->getData());
        $profile->setSurname($form->get('surname')->getData());
        $this->man->persist($profile);
        $this->man->flush();
    }

    public function deletePost($id)
    {
        $post = $this->man->getRepository(Post::class)->findOneBy(['id' => $id]);
        $this->man->remove($post);
        $this->man->flush();
    }
    public function deleteComment($id)
    {
        $comment = $this->man->getRepository(Comments::class)->findOneBy(['id' => $id]);
        $this->man->remove($comment);
        $this->man->flush();
    }
}
