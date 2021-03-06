<?php


namespace App\EventListener;

use App\Entity\Utilisateur;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;


class AuthenticationSuccessListener
{
    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        /**
         * @var Utilisateur $user
         */
        $user = $event->getUser();


        $data['data'] = array(
            'id' => $user->getId(),
        );

        $event->setData($data);
    }
}