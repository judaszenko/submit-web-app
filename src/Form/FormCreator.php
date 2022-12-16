<?php

namespace App\Form;

use App\Entity\UserProfile;
use Psr\Container\ContainerInterface;
// use Symfony\Component\DependencyInjection\Container;
// use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
// use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Type;

class FormCreator
{

    protected FormBuilder $builder;
    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->builder = $this->container->get("form.factory")->createBuilder();
    }


    public function postForm(): FormInterface
    {
        return $this->builder
            ->add('postText', TextareaType::class, ["attr" => ["placeholder" => 'create post', 'resize' => "none"], "label" => false])
            ->add("post_img", FileType::class, ["label" => false])
            ->add('submit', SubmitType::class)
            ->getForm();
    }

    public function profileForm(UserProfile $usr)
    {
        return $this->builder
            ->add("name", TextType::class, ['required' => false, 'attr' => ['placeholder' => $usr->getName()]])
            ->add("surname", TextType::class, ['required' => false, 'attr' => ['placeholder' => $usr->getSurname()]])
            ->add("age", NumberType::class, ['required' => false, 'attr' => ['placeholder' => $usr->getAge()]])
            ->add("phone_number", NumberType::class, [
                'required' => false, 'attr' => ['placeholder' => $usr->getPhoneNumber()]
                // 'constraints' => [
                //     new Type(IntegerType::class)
                // ]
            ])
            ->add("photo", FileType::class, ['data_class' => null, 'required' => false, 'empty_data' => $usr->getPhoto()])
            ->add("submit", SubmitType::class)
            ->getForm();
    }

    public function userForm(): FormInterface
    {
        return $this->builder
            ->add('username', TextType::class, ['label' => false, 'attr' => [
                "placeholder" => "username"
            ]])
            ->add('mail', EmailType::class, ['label' => false, 'attr' => [
                "placeholder" => "email"
            ]])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password', 'placeholder' => "password"],
                'label' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'attr' => [
                    'style' => 'width: 2em; height: 2em'
                ],
                'label' => "Accept Submit policy",
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add("submit", SubmitType::class)
            ->getForm();
    }
    public function commentForm()
    {
        return $this->builder->add("commentText", TextareaType::class, ["label" => false, "attr" => ["placeholder" => 'create new comment']])
            ->add("submit", SubmitType::class)
            ->getForm();
    }
}
