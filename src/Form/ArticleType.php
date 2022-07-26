<?php

namespace App\Form;

use App\Entity\Tag;
use App\Entity\Writer;
use App\Entity\Article;
use App\Entity\Category;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label_attr' => [
                    'class' => 'test-class-label',
                ],
                'attr' => [
                    'class' => 'test-class-input',
                ],
                'row_attr' => [
                    'class' => 'test-class-div',
                ],
            ])
            ->add('body')
            ->add('published_at')
            ->add('tags', EntityType::class, [
                // looks for choices from this entity
                'class' => Tag::class,
            
                // uses the Tag.name property as the visible option string
                'choice_label' => function (Tag $object) {
                    return "{$object->getName()} ({$object->getId()})";
                },
            
                // used to render a select box, check boxes or radios
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,

                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('t')
                        ->orderBy('t.name', 'ASC');
                },

                'attr' => [
                    'class' => 'checkboxes-with-scroll',
                ],
            ])
            ->add('category', EntityType::class, [
                // looks for choices from this entity
                'class' => Category::class,
            
                // uses the Category.name property as the visible option string
                'choice_label' => function (Category $object) {
                    return "{$object->getName()} ({$object->getId()})";
                },
            
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,

                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
            ])
            ->add('writer', EntityType::class, [
                // looks for choices from this entity
                'class' => Writer::class,
            
                // uses the Writer.id property as the visible option string
                'choice_label' => function (Writer $object) {
                    return "{$object->getUser()->getEmail()} ({$object->getUser()->getId()})";
                },
            
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,

                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('w')
                        ->join('w.user', 'u')
                        ->orderBy('u.email', 'ASC');
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
