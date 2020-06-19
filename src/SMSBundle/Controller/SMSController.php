<?php

namespace SMSBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class SMSController extends Controller
{

    /**
     * @Route("/message",name="message_route")
     */
    public function indexAction()
    {
        return $this->render('@SMS/sms/index.html.twig');
    }
    /**
     * @Route("/sendsms",name="sendsms_route")
     */
    public function sendsmsAction(Request $request)
    {
        $mobile=$request->get('mobile');
        $message=$request->get('message');
        $encodedMessage =urlencode($message);
        $authKey='4497020231dbd6628671288a9b962ad8';
        $senderId='AC6d0111938a93428bb65ca8dfc65783dd';
        $route=4;
        $postData=array(
            '$authKey'=>$authKey,
            '$senderId'=>$senderId,
            '$route'=>$route,
            '$mobile'=>$mobile,
            '$encodedMessage'=>$encodedMessage,
            'body' => $message,



        );



        $url ='https://AC6d0111938a93428bb65ca8dfc65783dd:4497020231dbd6628671288a9b962ad8@api.twilio.com/2010-04-01/Accounts/AC6d0111938a93428bb65ca8dfc65783dd/';

        $ch=curl_init();
        curl_setopt_array($ch , array(
            CURLOPT_URL=>$url,
            CURLOPT_RETURNTRANSFER=>True,
            CURLOPT_POST=>True,
            CURLOPT_POSTFIELDS=>$postData


        ));

        curl_setopt($ch ,CURLOPT_SSL_VERIFYHOST,0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);

        $response= curl_exec($ch);
        if(curl_errno($ch)){
            echo'error' .curl_error($ch);

        }
        curl_close($ch);
        return $this->render('@SMS/sms/success.html.twig',['response'=>$response]);


    }


}

