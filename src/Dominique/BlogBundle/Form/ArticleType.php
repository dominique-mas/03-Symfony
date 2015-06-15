<?php

namespace Dominique\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content', 'textarea')
            ->add('dateCreat', 'date', array('widget'=>'single_text'))
            ->add('author', 'text')
            ->add('pub', 'checkbox', array("required"=>false))
            /*->add('image')*/
            ->add('categories', 'entity',
                    array("class" => "DominiqueBlogBundle:Category",
                        "property" => "name",
                        "multiple" => true,
                        "expanded" => true))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dominique\BlogBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dominique_blogbundle_article';
    }
}
