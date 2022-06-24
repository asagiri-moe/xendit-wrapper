<?php

namespace AsagiriMoe\XenditWrapper;

use Xendit\Xendit;
use Xendit\EWallets;
use Xendit\QRCode;
use Xendit\Exceptions\ApiException;

class XenditWrapper
{
    // Build your next great package.
    private $xendit;

    private function secretKey()
    {
        return config('xendit-wrapper.secretKey');
    }

    private function redirectUrl()
    {
        return config('xendit-wrapper.redirectUrl');
    }

    private function currency()
    {
        return config('xendit-wrapper.currency');
    }

    public function __construct()
    {
        $this->xendit = Xendit::setApiKey($this->secretKey());
    }

    public function createEWalletCharge($idPayment, $typeEWallet, int $amount, $phoneNumber = NULL, $metadata = NULL)
    {
        //dd($amount);
        $currency = $this->currency();
        $channelProperties = [];

        $metadata['mobile_number'] = $phoneNumber;

        switch($typeEWallet)
        {
            case "ID_OVO": 
                $channelProperties['mobile_number'] = $phoneNumber;
                break;
            case "ID_DANA":
            case "ID_LINKAJA":
            case "ID_SHOPEEPAY":
            case "PH_SHOPEEPAY":
            case "ID_SAKUKU":
                $channelProperties['success_redirect_url'] = $this->redirectUrl() . '/' . $idPayment;
                break;
            case "PH_PAYMAYA":
                $channelProperties['success_redirect_url'] = $this->redirectUrl() . '/' . $idPayment;
                $channelProperties['failure_redirect_url'] = $this->redirectUrl() . '/' . $idPayment;
                $channelProperties['cancel_redirect_url'] = $this->redirectUrl() . '/' . $idPayment;
                break;
            case "ID_ASTRAPAY":
            case "PH_GCASH":
            case "PH_GRABPAY":
                $channelProperties['success_redirect_url'] = $this->redirectUrl() . '/' . $idPayment;
                $channelProperties['failure_redirect_url'] = $this->redirectUrl() . '/' . $idPayment;
                break;
            default:
                return $error = "NOT FOUND!";
        }   

        $ewalletChargeParams = [
            'reference_id' => $idPayment,
            'currency' => $currency,
            'amount' => (int)$amount,
            'checkout_method' => 'ONE_TIME_PAYMENT',
            'channel_code' => $typeEWallet,
            'channel_properties' => $channelProperties,
            'metadata' => $metadata,
        ];

        try
        {
            $eWallet = EWallets::createEWalletCharge($ewalletChargeParams);
        }
        catch(ApiException $ex)
        {
            $eWallet["error"]["errorCode"] = $ex->getErrorCode();
            $eWallet["error"]["message"] = $ex->getMessage();
            $eWallet["error"]["code"] = $ex->getCode();
            $eWallet["error"]["trace"] = $ex->getTrace();
        }

        return $eWallet;
        
    }

    public function getEWalletChargeStatus($chargeId)
    {
        try
        {
            $eWallet = EWallets::getEWalletChargeStatus($chargeId);
        }
        catch(ApiException $ex)
        {
            $eWallet["error"]["errorCode"] = $ex->getErrorCode();
            $eWallet["error"]["message"] = $ex->getMessage();
            $eWallet["error"]["code"] = $ex->getCode();
            $eWallet["error"]["trace"] = $ex->getTrace();
        }

        return $eWallet;
    }

    public function voidEWalletCharge($chargeId)
    {
        try
        {
            $eWallet = EWallets::voidEwalletCharge($chargeId);

        }
        catch(ApiException $ex)
        {
            $eWallet["error"]["errorCode"] = $ex->getErrorCode();
            $eWallet["error"]["message"] = $ex->getMessage();
            $eWallet["error"]["code"] = $ex->getCode();
            $eWallet["error"]["trace"] = $ex->getTrace();
        }

        return $eWallet;
    }

    //Refund Method will coming soon

    public function createQRCode($idPayment, $amount, $callbackUrl)
    {
        $params = [
            'external_id' => $idPayment,
            'type' => 'DYNAMIC',
            'callback_url' => $callbackUrl,
            'amount' => (int)$amount,
          ];
          
        try
        {
            $QRCode = QRCode::create($params);
        }
          catch(ApiException $ex)
        {
            $QRCode["error"]["errorCode"] = $ex->getErrorCode();
            $QRCode["error"]["message"] = $ex->getMessage();
            $QRCode["error"]["code"] = $ex->getCode();
            $QRCode["error"]["trace"] = $ex->getTrace();
        }

        return $QRCode;
    }

    public function getQRCode($idPayment)
    {
        try
        {
            $QRCode = QRCode::get($idPayment);
        }
          catch(ApiException $ex)
        {
            $QRCode["error"]["errorCode"] = $ex->getErrorCode();
            $QRCode["error"]["message"] = $ex->getMessage();
            $QRCode["error"]["code"] = $ex->getCode();
            $QRCode["error"]["trace"] = $ex->getTrace();
        }

        return $QRCode; 
    }
}
