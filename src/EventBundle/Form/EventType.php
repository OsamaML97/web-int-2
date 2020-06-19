<?php

namespace EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceListInterface;

class EventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('evName',null ,['attr'=>['placeholder'=>'enter the event name'],])
            ->add('evMonth',null ,['attr'=>['placeholder'=>'enter the event month'],])
            ->add('evStart',null ,['attr'=>['placeholder'=>'enter the event start date'],])
            ->add('evEnd',null ,['attr'=>['placeholder'=>'enter the event end date'],])
            ->add('evPur',null ,['attr'=>['placeholder'=>'enter the event purpose'],])
            ->add('evDesc',null ,['attr'=>['placeholder'=>'enter the event description'],])
            ->add('Valider',SubmitType::class);

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EventBundle\Entity\Event'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'eventbundle_event';
    }


}
