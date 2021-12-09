<?php

namespace Loopcraft\MsgOwl;

use GuzzleHttp\Exception\GuzzleException;
use Loopcraft\MsgOwl\Clients\OTPClient;
use Loopcraft\MsgOwl\Clients\RestClient;
use Loopcraft\MsgOwl\Exceptions\InvalidBalanceException;

class MsgOwl
{
    protected bool $balanceNotification;
    protected bool $notificationSent = false;
    protected string $message;
    protected string $contactNumber;
    protected int $threshold = 50;

    /**
     * @param RestClient $restClient
     * @param OTPClient $otpAPICall
     */
    public function __construct(protected RestClient $restClient, protected OTPClient $otpAPICall)
    {
        $this->balanceNotification = config('msgowl.notification.active');
        $this->message = config('msgowl.notification.message');
        $this->threshold = config('msgowl.notification.threshold');
        $this->contactNumber = config('msgowl.notification.contact_number') ?? '';
    }

    /**
     * @param string $body
     * @param string|array $contactNumbers
     * @throws GuzzleException
     * @throws InvalidBalanceException
     */
    public function sendMessage(string $body, string|array $contactNumbers)
    {
        if (is_string($contactNumbers)) {
            $contactNumbers = explode(',', $contactNumbers);
        }

        $this->checkForExceptions();

        $this->apiCall($body, $contactNumbers);

        if ($this->canSendNotification()) {
            $this->balanceNotification();
        }
    }

    /**
     * @throws InvalidBalanceException|GuzzleException
     */
    protected function checkForExceptions(): static
    {
        if (! $this->checkBalance()) {
            throw new InvalidBalanceException('You dont have enough balance to send the sms');
        }

        return $this;
    }

    /**
     * @return array|float
     * @throws GuzzleException|InvalidBalanceException
     */
    protected function checkBalance(): float|array
    {
        $response = $this->restClient->get('/balance');

        if ($response->getStatusCode() != '200') {
            throw new InvalidBalanceException('Please try again');
        }

        return (float)json_decode($response->getBody(), true)['balance'];
    }

    /**
     * @param string $body
     * @param array $contactNumbers
     * @throws GuzzleException
     */
    protected function apiCall(string $body, array $contactNumbers)
    {
        $this->restClient->post('/messages', [
            'json' => [
                "recipients" => $contactNumbers,
                "body" => $body,
                "sender_id" => config('msgowl.sender'),
            ],
        ]);
    }

    /**
     * check if the notification is ready to send
     * @return bool
     */
    protected function canSendNotification(): bool
    {
        return $this->balanceNotification && $this->contactNumber && ! $this->notificationSent;
    }

    /**
     * @throws GuzzleException
     * @throws InvalidBalanceException
     */
    protected function balanceNotification()
    {
        if ($this->checkBalance() < $this->threshold) {
            $this->sendMessage($this->message, $this->contactNumber);
        }
    }
}
