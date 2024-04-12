<?php

namespace App\Twig\Components;

use App\Entity\Trip;
use App\Form\TripType;
use Symfony\Component\Form\FormInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;

#[AsLiveComponent]
class TripForm extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    protected function instantiateForm(): FormInterface
    {
        $trip = $trip ?? new Trip();
        return $this->createForm(TripType::class, $trip, [
            'action' => $trip->getId() ? $this->generateUrl('app_trip_edit', ['id' => $trip->getId()]) : $this->generateUrl('app_trip_new'),
        ]);
    }
}