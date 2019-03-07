<?php
namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class UserEncodeSubscriber implements EventSubscriberInterface
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->passwordEncoder = $encoder;
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $user = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$user instanceof User || Request::METHOD_POST !== $method || Request::METHOD_PUT !== $method) {
            return;
        }
    }

    public function encodeUserPassword(GetResponseForControllerResultEvent $event)
    {
        $user = $event->getControllerResult();

        if (!$user instanceof User){
            return;
        }
        $password = $user->getPassword();
        $encoded = $this->passwordEncoder->encodePassword($user, $password);
        $user->setPassword($encoded);
        $user->eraseCredentials();
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['encodeUserPassword', EventPriorities::POST_VALIDATE],
        ];
    }
}
