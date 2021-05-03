<?php 

declare(strict_types=1);

namespace App\Events;

use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpKernel\KernelEvents;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use DateTime;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class CurrentShopForUsersSubscriber implements EventSubscriberInterface
{
    private Security $security;
    
    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [ 'currentShopForUsers', EventPriorities::PRE_VALIDATE]
        ];
    }
    
    public function currentShopForUsers(ViewEvent $viewEvent): void
    {
        $user = $viewEvent->getControllerResult();
        $method = $viewEvent->getRequest()->getMethod();
        
        if ($user instanceof User && Request::METHOD_POST === $method) {
            $user->setCreatedAt(new DateTimeImmutable());
            $user->setShop($this->security->getUser());
        }
    }
}