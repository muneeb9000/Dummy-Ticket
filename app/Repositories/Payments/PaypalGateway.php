<?php

namespace App\Repositories\Payments;

use App\Contracts\PaymentGatewayInterface;
use Illuminate\Support\Facades\Http;

class PaypalGateway implements PaymentGatewayInterface
{
    protected $clientId;
    protected $secret;
    protected $baseUrl;

    public function __construct()
    {
        $this->clientId = setting('paypal_client_id');
        $this->secret = setting('paypal_key');
        $this->baseUrl = setting('paypal_mode') === 'live'
            ? 'https://api.paypal.com'
            : 'https://api.sandbox.paypal.com';
    }

    protected function getAccessToken()
    {

        $response = Http::withBasicAuth($this->clientId, $this->secret)
            ->asForm()
            ->post("{$this->baseUrl}/v1/oauth2/token", [
                'grant_type' => 'client_credentials',
            ]);
        return $response->json()['access_token'];
    }

    public function charge(array $data)
    {
        $accessToken = $this->getAccessToken();

        $response = Http::withToken($accessToken)
            ->post("{$this->baseUrl}/v2/checkout/orders", [
                'intent' => 'CAPTURE',
                'purchase_units' => [[
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => $data['amount'],
                    ],
                ]],
                'application_context' => [
                    'return_url' => route('website.thankyou'),
                    'cancel_url' => route('website.cancelpayment'),
                     'user_action' => 'PAY_NOW',
                ]
            ]);

        $order = $response->json();

        $approvalUrl = collect($order['links'])->firstWhere('rel', 'approve')['href'] ?? null;

        return [
            'order_id' => $order['id'],
            'url' => $approvalUrl,
            'amount' => $data['amount']
        ];
    }

    public function refund(array $data)
    {
        abort(404);
        return "Refunding via PayPal: " . json_encode($data);
    }
}
