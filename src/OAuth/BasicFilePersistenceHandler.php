<?php

namespace AmoCRM\OAuth;

use League\OAuth2\Client\Token\AccessTokenInterface;
use OutOfBoundsException;

final class BasicFilePersistenceHandler implements OAuthTokenPersistenceHandlerInterface
{
    /**
     * @var array
     */
    private $tokens = [];

    /**
     * @var string
     */
    private $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;

        $dirname = dirname($filePath);

        if (!file_exists($dirname)) {
            mkdir($dirname, 0700, true);
        }
    }

    /**
     * @inheritDoc
     */
    public function getToken(string $state): AccessTokenInterface
    {
        if (!$this->hasToken($state)) {
            throw new OutOfBoundsException(sprintf('Token with state "%s" not found', $state));
        }

        return $this->tokens[$state];
    }

    public function hasToken(string $state): bool
    {
        if (!isset($this->tokens[$state]) && is_file($this->filePath)) {
            $loadedData = file_get_contents($this->filePath);

            if ($loadedData !== false) {
                $this->tokens = array_merge($this->tokens, unserialize($loadedData));
            }
        }

        return isset($this->tokens[$state]);
    }

    /**
     * @inheritDoc
     */
    public function saveToken(string $state, AccessTokenInterface $accessToken)
    {
        $this->tokens[$state] = $accessToken;
        file_put_contents($this->filePath, serialize($this->tokens), LOCK_SH);
    }
}
