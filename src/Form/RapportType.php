<?php


namespace App\Form;


use App\Entity\Rapport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class RapportType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm (FormBuilderInterface $builder,array $options)
    {

        $builder
            ->add('note')
            ->add('interventions',CollectionType::class, [
            'entry_type'=> InterventionType::class,
    ])
            ->add('retours', CollectionType::class,[
            'entry_type'=> RetourType::class,
        ]);

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rapport::class
        ]);
    }
}
