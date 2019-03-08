<?php
namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Passenger;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class CheckPassengerBaggage implements EventSubscriberInterface
{
    const MAX_BAGGAGE = 5;

    private $manager;


    public function __construct(ObjectManager $manager) {
        $this->manager = $manager;
    }

    public static function getSubscribedEvents() {
        return [
            KernelEvents::VIEW => ['verify', EventPriorities::PRE_WRITE],
        ];
    }

    public function verify(GetResponseForControllerResultEvent $event) {
        $passenger = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$passenger instanceof Passenger || Request::METHOD_POST !== $method) {
            return;
        }

        if ($passenger->getBaggage() > CheckPassengerBaggage::MAX_BAGGAGE) {
            $event->setResponse(new JsonResponse("Max luggages for ticket reached (max " . CheckPassengerBaggage::MAX_BAGGAGE . ")", 400));
        }
    }
}
