<?php


namespace App\Form;

use App\Entity\Retour;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RetourType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder,array $options)
    {
        $builder
            ->add('entreeAppreciated')
            ->add('entreeToImprove')
            ->add('moyensAppreciated')
            ->add('moyensToImprove')
            ->add('interventionBonnePratiqu')
            ->add('interventionDifficultes')
            ->add('interventionCommentaires');
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Retour::class
        ]);
    }
}
