<?php

namespace AmoCRM\OAuth;

use League\OAuth2\Client\Token\AccessTokenInterface;

/**
 * Interface OAuthTokenPersistenceHandlerInterface
 *
 * @package AmoCRM\OAuth
 */
interface OAuthTokenPersistenceHandlerInterface
{
    /**
     * getToken
     *
     * @param string $clientId
     * @return AccessTokenInterface
     */
    public function getToken(string $clientId): AccessTokenInterface;

    /**
     * saveToken
     *
     * @param string $clientId
     * @param AccessTokenInterface $accessToken
     * @return mixed
     */
    public function saveToken(string $clientId, AccessTokenInterface $accessToken);
}
