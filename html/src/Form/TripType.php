<?php

namespace App\Form;

use App\Entity\Driver;
use App\Entity\Trip;
use App\Entity\Vehicle;
use App\Repository\DriverRepository;
use App\Repository\VehicleRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfonycasts\DynamicForms\DependentField;
use Symfonycasts\DynamicForms\DynamicFormBuilder;

class TripType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder = new DynamicFormBuilder($builder);
        $builder
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->addDependent('vehicle', 'date', function(DependentField $field, ?\DateTimeInterface $date) {
                if (null === $date) {
                    $date = new \DateTime();
                }
                $field->add(EntityType::class, [
                    'class' => Vehicle::class,
                    'choice_label' => 'model',
                    'query_builder' =>function (VehicleRepository $userRepository) use ($date) {
                        return $userRepository->createQueryBuilder('q')
                            ->leftJoin('q.trips', 't')
                            ->where('t.id is null')
                            ->orWhere('t.date != :date')
                            ->setParameter('date', $date->format('Y-m-d'))
                        ;
                    },
                ]);
            })
            ->addDependent('driver', ['date', 'vehicle'], function(DependentField $field, ?\DateTimeInterface $date, ?Vehicle $vehicle) {
                if (null === $vehicle) {
                    $date = new \DateTime();
                    $license = "A";
                } else {
                    $license = $vehicle->getLicenseRequired();
                }

                $field->add(EntityType::class, [
                    'class' => Driver::class,
                    'choice_label' => 'name',
                    'query_builder' =>function (DriverRepository $userRepository) use ($date,  $license) {
                        return $userRepository->createQueryBuilder('q')
                            ->leftJoin('q.trips', 't')
                            ->where('t.id is null')
                            ->orWhere('t.date != :date')
                            ->andWhere('q.license = :license')
                            ->setParameter('date', $date->format('Y-m-d'))
                            ->setParameter('license', $license)
                        ;
                    },
                ]);
            })
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trip::class,
        ]);
    }
}
