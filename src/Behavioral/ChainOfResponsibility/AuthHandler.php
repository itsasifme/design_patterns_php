<?php

namespace DesignPatterns\Behavioral\ChainOfResponsibility;

/**
 * Concrete handler: authenticates the user and sets request flags.
 */
class AuthHandler extends AbstractHandler
{
    /**
     * @param array<string, array{password: string, is_admin: bool}> $users Known users map.
     */
    public function __construct(
        private readonly array $users,
    ) {
    }

    /**
     * Reject the request if credentials are invalid; otherwise enrich the request object.
     *
     * @param OrderRequest $request The incoming order request.
     *
     * @return bool False if authentication fails, true otherwise.
     */
    protected function check(OrderRequest $request): bool
    {
        if (
            !isset($this->users[$request->username]) ||
            $this->users[$request->username]['password'] !== $request->password
        ) {
            echo "Request rejected: Invalid username or password.\n";

            return false;
        }

        $request->isAuthenticated = true;
        $request->isAdmin = $this->users[$request->username]['is_admin'];

        echo "Authentication passed.\n";

        return true;
    }
}
