<?php

namespace App\Http\Services;

use Srmklive\PayPal\Services\PayPal;

class PayPalService
{

    /**
     * @throws \Throwable
     */
    public function __construct(private PayPal $payPal)
    {
        $this->payPal->getAccessToken();
    }

    /**
     * @throws \Throwable
     */
    public function createOrder(float $amountValue, int $orderId): \Psr\Http\Message\StreamInterface|array|string
    {
        $data = json_decode('{
            "intent": "CAPTURE",
            "application_context": {
                "return_url": "' . route('orders.checkout.success', $orderId) . '",
                "cancel_url": "' . route('orders.checkout.fail', $orderId) . '",
                "payment_method_preference": "IMMEDIATE_PAYMENT_REQUIRED",
                "landing_page": "LOGIN",
                "shipping_preference": "GET_FROM_FILE",
                "user_action": "PAY_NOW"
            },
            "purchase_units": [
                {
                "amount":
                    {
                    "currency_code": "USD",
                    "value": "' . $amountValue . '"
                    }
                }
            ]
        }
', true);

        $response = $this->payPal->createOrder($data);
        if (isset($response['error'])) {
            return [
                'status' => false,
                'message' => $response['error']['name']
            ];
        }
        $response['status'] = true;
        return $response;
    }


    /**
     * @throws \Throwable
     */
    public function getOrderDetails(string $payment_id): \Psr\Http\Message\StreamInterface|array|string
    {
        $response = $this->payPal->showOrderDetails($payment_id);
        if (isset($response['error'])) {
            return [
                'status' => false,
                'message' => $response['error']['name']
            ];
        }
        $response['status'] = true;
        return $response;
    }

    /**
     * @throws \Throwable
     */
    public function captureOrder(string $payment_id): \Psr\Http\Message\StreamInterface|array|string
    {
        $response = $this->payPal->capturePaymentOrder($payment_id);
        if (isset($response['error'])) {
            return [
                'status' => false,
                'message' => $response['error']['name']
            ];
        }
        $response['status'] = true;
        return $response;

    }


}
