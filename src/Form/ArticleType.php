<?php

namespace App\Form;

use App\Entity\Article;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre',TextType::class,[
                'attr' =>['class'=>'form-control','placeholder'=>"titre de l'article"] ])      
            ->add('categorie',ChoiceType::class,[
                'attr' =>['class'=>'form-control'],
                'choices'  => [
                    'informatique'=>'Informatique' ,
                    'mathématique' =>'Mathématique',
                    'médecine' =>'Médecine',
                    'culture générale' =>'Culture générale',
                    'autre' =>'Autre',
                ],
            ])
            ->add('contenu',CKEditorType::class,[
                'attr' =>['class'=>'form-control','placeholder'=>"contenu de l'article"] ])
            ->add('image',TextareaType::class,[
                'attr' =>['class'=>'form-control','placeholder'=>"mettez votre URL ici",'rows'=>3] ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }

}
