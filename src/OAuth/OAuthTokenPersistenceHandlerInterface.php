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
     * @param string $state
     * @return AccessTokenInterface
     */
    public function getToken(string $state): AccessTokenInterface;

    /**
     * saveToken
     *
     * @param string $state
     * @param AccessTokenInterface $accessToken
     * @return mixed
     */
    public function saveToken(string $state, AccessTokenInterface $accessToken);
}
