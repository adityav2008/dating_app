<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use App\Http\Requests;
use Validator;
use App\car_calendar;
use App\car_images;
use App\destination;
use App\trip_availability;
use App\trips;
use App\User;
use App\countries;
use App\cities;
use App\states;
use App\reservations;
use App\paypal_transactions;
use App\cars;
use App\partner_amount;
use App\partners;
use App\partner_payment_transfer;
use URL;
use DB;
use Session;

class paypalController extends Controller {

    var $apiUrl = 'https://svcs.sandbox.paypal.com/AdaptivePayments/';
    var $paypalUrl = 'https://sandbox.paypal.com/webscr?cmd=_ap-payment&paykey=';

    function __construct() {


        $this->headers = array(
            "X-PAYPAL-SECURITY-USERID: casual_seduction_merchant_api1.gmail.com",
            "X-PAYPAL-SECURITY-PASSWORD: XJEW9BM4YQBHJGQG",
            "X-PAYPAL-SECURITY-SIGNATURE: AFcWxV21C7fd0v3bYYYRCpSSRl31ACfcQDCYj.DtXfE7pooYeCR0xJmr",
            "X-PAYPAL-REQUEST-DATA-FORMAT: JSON",
            "X-PAYPAL-RESPONSE-DATA-FORMAT: JSON",
            "X-PAYPAL-APPLICATION-ID: APP-80W284485P519543T"
        );
    }

    public function index(){
      return view('payment.paypal_payment');
    }

    public function getCardInfo(Request $request){

        $validator = Validator::make($request->all(), [
            'first-name' => 'required',
            'card_no' => 'required',
            'card_type' => 'required',
            'expiry_date' => 'required',
            'expiry_year' => 'required',
            'security_code' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('payment-details')
                        ->withErrors($validator)
                        ->withInput();
        }else {
          $data = array();
          $data['name']   =  $request->input('first-name');
          
          print_r($data);
        }

    }

    function getPaymentOptions($payKey) {


        $packet = array(
            "requestEnvelope" => array(
                "errorLanguage" => "en_US",
                "detailLevel" => "ReturnAll",
            ),
            "payKey" => $payKey
        );



        return $this->_paypalSend($packet, "GetPaymentOptions");
    }

    function _paypalSend($data, $call) {


        $ch = curl_init();


        curl_setopt($ch, CURLOPT_URL, $this->apiUrl . $call);


        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);


        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);


        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);


        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));


        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);



        return json_decode(curl_exec($ch), TRUE);
    }

    function splitPayTrip() {



        if (!empty(Session::get('one_way'))) {


            $amount = (Session::get('one_way')['trip_price'] * Session::get('one_way')['people']);
        }



        if (!empty(Session::get('trip_other'))) {


            $amount = (Session::get('trip_other')['trip_price'] * Session::get('trip_other')['people']);
        }



        if (!empty(Session::get('return_dep')) && !empty(Session::get('return_ret'))) {


            $amount = (Session::get('return_dep')['dep_trip_price'] * Session::get('return_dep')['dep_people']) + (Session::get('return_ret')['ret_trip_price'] * Session::get('return_ret')['ret_people']);
        }



        $createPacket = array(
            "actionType" => "PAY",
            "currencyCode" => "USD",
            "receiverList" => array(
                "receiver" => array(
                    array(
                        "amount" => 20,
                        "email" => "casual_seduction@gmail.com"
                    ),
                )
            ),
            "returnUrl" => URL::to('/') . '/paypal/status',
            "cancelUrl" => URL::to('/') . '/paypal/status',
            "requestEnvelope" => array(
                "errorLanguage" => "en_US",
                "detailLevel" => "ReturnAll",
            )
        );



        $response = $this->_paypalSend($createPacket, "Pay");



        $payKey = $response['payKey'];



        $detailsPacket = array(
            "requestEnvelope" => array(
                "errorLanguage" => "en_US",
                "detailLevel" => "ReturnAll",
            ),
            "payKey" => $payKey,
            "receiverOptions" => array(
                array(
                    "receiver" => array("email" => "casual_seduction@gmail.com"),
                    "invoiceData" => array(
                        "item" => array(
                            array(
                                "name" => Session::get('trip_title'),
                                "price" => 12000,
                                "identifier" => "trip",
                            ),
                        )
                    )
                ),
            )
        );



        $response = $this->_paypalSend($detailsPacket, "SetPaymentOptions");



        $dets = $this->getPaymentOptions($payKey);



        Session::put('paykey', $payKey);


        Session::save();



        //e		cho session('paykey');
        //e		xit;



        return redirect($this->paypalUrl . $payKey);


        //h		eader("Location: ".$this->paypalUrl.$payKey);


        exit();
    }

    function viewreportTrip() {

        $pkey = session('paykey');
        $id = session('swap_id');

        Session::forget('payKey');

        $data = array("payKey" => $pkey, "requestEnvelope" => array(
                "errorLanguage" => "en_US",
                "detailLevel" => "ReturnAll",
        ));


        $payment = $this->_paypalSend($data, "PaymentDetails");
        $transaction_id = '';

        if (ISSET($payment['status']) && $payment['status'] == 'COMPLETED') {

            if (!empty(Session::get('one_way'))) {
                $seller_paypal_id = $payment['paymentInfoList']['paymentInfo'][0]['receiver']['email'];
                $seller_transaction_id = $payment['paymentInfoList']['paymentInfo'][0]['transactionId'];
                $buyer_seller_transaction_id = $payment['paymentInfoList']['paymentInfo'][0]['senderTransactionId'];
                $seller_amount_paid = $payment['paymentInfoList']['paymentInfo'][0]['receiver']['amount'];
                $key = $payment['payKey'];

                $reservations = new reservations;
                $reservations->user_id = Session::get('user')->id;
                $reservations->trip_id = Session::get('one_way')['selected_trip_id'];
                $reservations->car_id = Session::get('car_id');
                $reservations->departure_date = date('Y-m-d', strtotime(str_replace('/', '-', Session::get('one_way')['dep-date'])));
                $reservations->departure_time = Session::get('one_way')['start_time'];
                $reservations->amount = Session::get('one_way')['people'] * Session::get('one_way')['trip_price'];
                $reservations->passengers = Session::get('one_way')['people'];
                $reservations->save();

                $trip_detail = trips::where('id', Session::get('one_way')['selected_trip_id'])->first();
                $car_detail = cars::where('id', Session::get('car_id'))->first();

                $partner_amount = new partner_amount;
                $partner_amount->partner_id = $car_detail->partner_id;
                $partner_amount->pending_amount = $trip_detail->internal_price * Session::get('one_way')['people'];
                $partner_amount->trip_id = $trip_detail->id;
                $partner_amount->car_id = Session::get('car_id');
                $partner_amount->booking_date = date('Y-m-d', strtotime(str_replace('/', '-', Session::get('one_way')['dep-date'])));
                $partner_amount->save();

                $reservation_id = $reservations->id;

                $payments = new paypal_transactions;
                $payments->transaction_id = $buyer_seller_transaction_id;
                $payments->payment_id = $key;
                $payments->amount = Session::get('one_way')['trip_price'] * Session::get('one_way')['people'];
                $payments->reservation_id = $reservation_id;
                $payments->save();

                $payment_detail = paypal_transactions::where('id', $payments->id)->first();
                $transaction_id = $payment_detail->transaction_id;

                $calendar = new car_calendar;
                $calendar->car_id = Session::get('car_id');
                $calendar->start_date_time = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', Session::get('one_way')['dep-date']) . Session::get('one_way')['start_time']));
                $calendar->save();

                cars::where('id', Session::get('car_id'))->update(['status' => 0]);
                Session::forget('one_way');
            }




            if (!empty(Session::get('return_dep')) && !empty(Session::get('return_ret'))) {

                $seller_paypal_id = $payment['paymentInfoList']['paymentInfo'][0]['receiver']['email'];
                $seller_transaction_id = $payment['paymentInfoList']['paymentInfo'][0]['transactionId'];
                $buyer_seller_transaction_id = $payment['paymentInfoList']['paymentInfo'][0]['senderTransactionId'];
                $seller_amount_paid = $payment['paymentInfoList']['paymentInfo'][0]['receiver']['amount'];
                $key = $payment['payKey'];
                $return_id = 0;
                if (Session::get('return_dep')) {

                    $reservations = new reservations;
                    $reservations->user_id = Session::get('user')->id;
                  	$reservations->trip_id = Session::get('return_dep')['selected_dep_trip_id'];
                    $reservations->car_id = Session::get('dep_car_id');
                    $reservations->departure_date = date('Y-m-d', strtotime(str_replace('/', '-', Session::get('return_dep')['dep-date'])));
                    $reservations->departure_time = Session::get('return_dep')['dep_start_time'];
                    $reservations->passengers = Session::get('return_dep')['dep_people'];
                    $reservations->amount = Session::get('return_dep')['dep_people'] * Session::get('return_dep')['dep_trip_price'];
                    $reservations->save();

                    $reservation_id = $reservations->id;
                    $return_id = $reservations->id;
                    $trip_detail = trips::where('id', Session::get('return_dep')['selected_dep_trip_id'])->first();
                    $car_detail = cars::where('id', Session::get('dep_car_id'))->first();

										$partner_amount = new partner_amount;
                  	$partner_amount->partner_id = $car_detail->partner_id;
                    $partner_amount->pending_amount = $trip_detail->internal_price * Session::get('return_dep')['dep_people'];
                    $partner_amount->trip_id = $trip_detail->id;
                    $partner_amount->car_id = Session::get('dep_car_id');
                    $partner_amount->booking_date = date('Y-m-d', strtotime(str_replace('/', '-', Session::get('return_dep')['dep-date'])));
                    $partner_amount->save();

                    Session::put(['ret_amt' => Session::get('return_dep')['dep_people'] * Session::get('return_dep')['dep_trip_price']]);

                    $calendar = new car_calendar;
                    $calendar->car_id = Session::get('dep_car_id');
                    $calendar->start_date_time = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', Session::get('return_dep')['dep-date']) . Session::get('return_dep')['dep_start_time']));
                    $calendar->save();
                    cars::where('id', Session::get('dep_car_id'))->update(['status' => 0]);
                }



                if (Session::get('return_ret')) {


                    $reservations = new reservations;
                    $reservations->user_id = Session::get('user')->id;
                    $reservations->trip_id = Session::get('return_ret')['selected_ret_trip_id'];
                    $reservations->car_id = Session::get('ret_car_id');
                    $reservations->departure_date = date('Y-m-d', strtotime(str_replace('/', '-', Session::get('return_ret')['ret-date'])));
                    $reservations->departure_time = Session::get('return_ret')['ret_start_time'];
                    $reservations->passengers = Session::get('return_ret')['ret_people'];
                    $reservations->amount = Session::get('return_ret')['ret_people'] * Session::get('return_ret')['ret_trip_price'];
                    $reservations->return_id = $return_id;
                    $reservations->save();
                    $reservation_id = $reservations->id;

                    $trip_detail = trips::where('id', Session::get('return_ret')['selected_ret_trip_id'])->first();
                    $car_detail = cars::where('id', Session::get('ret_car_id'))->first();

                    $partner_amount = new partner_amount;
                    $partner_amount->partner_id = $car_detail->partner_id;
                    $partner_amount->pending_amount = $trip_detail->internal_price * Session::get('return_ret')['ret_people'];
                    $partner_amount->trip_id = $trip_detail->id;
                  	$partner_amount->car_id = Session::get('ret_car_id');
                    $partner_amount->booking_date = date('Y-m-d', strtotime(str_replace('/', '-', Session::get('return_ret')['ret-date'])));
                    $partner_amount->save();

                    $payments = new paypal_transactions;
                    $payments->transaction_id = $buyer_seller_transaction_id;
                    $payments->payment_id = $key;
                    $payments->amount = (Session::get('return_dep')['dep_people'] * Session::get('return_dep')['dep_trip_price']) + Session::get('ret_amt');
                    $payments->reservation_id = $return_id;
                    $payments->save();

                    $payment_detail = paypal_transactions::where('id', $payments->id)->first();
                    $transaction_id = $payment_detail->transaction_id;
                    $calendar = new car_calendar;
                    $calendar->car_id = Session::get('ret_car_id');
                    $calendar->start_date_time = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', Session::get('return_ret')['ret-date']) . Session::get('return_ret')['ret_start_time']));
                    $calendar->save();

                    cars::where('id', Session::get('ret_car_id'))->update(['status' => 0]);

                    Session::forget('return_ret');
                    Session::forget('return_dep');
                    Session::forget('ret_car_id');
                    Session::forget('dep_car_id');
                    Session::forget('ret_amt');
                }
            }



            if (!empty(Session::get('trip_other'))) {


                $seller_paypal_id = $payment['paymentInfoList']['paymentInfo'][0]['receiver']['email'];
                $seller_transaction_id = $payment['paymentInfoList']['paymentInfo'][0]['transactionId'];
              	$buyer_seller_transaction_id = $payment['paymentInfoList']['paymentInfo'][0]['senderTransactionId'];
                $seller_amount_paid = $payment['paymentInfoList']['paymentInfo'][0]['receiver']['amount'];
                $key = $payment['payKey'];

                $reservations = new reservations;
                $reservations->user_id = Session::get('user')->id;
                $reservations->trip_id = Session::get('trip_other')['selected_dep_trip_id'];
                $reservations->car_id = Session::get('car_id');
                $reservations->departure_date = date('Y-m-d', strtotime(str_replace('/', '-', Session::get('trip_other')['dep-date'])));
                $reservations->departure_time = Session::get('trip_other')['start_time'];
                $reservations->amount = Session::get('trip_other')['people'] * Session::get('trip_other')['trip_price'];
                $reservations->passengers = Session::get('trip_other')['people'];
                $reservations->save();

                $trip_detail = trips::where('id', Session::get('trip_other')['selected_dep_trip_id'])->first();
                $car_detail = cars::where('id', Session::get('car_id'))->first();

                $partner_amount = new partner_amount;
                $partner_amount->partner_id = $car_detail->partner_id;
                $partner_amount->pending_amount = $trip_detail->internal_price * Session::get('trip_other')['people'];
                $partner_amount->trip_id = $trip_detail->id;
                $partner_amount->car_id = Session::get('car_id');
                $partner_amount->booking_date = date('Y-m-d', strtotime(str_replace('/', '-', Session::get('trip_other')['dep-date'])));
                $partner_amount->save();

                $reservation_id = $reservations->id;
                $payments = new paypal_transactions;
              	$payments->transaction_id = $buyer_seller_transaction_id;
                $payments->payment_id = $key;
                $payments->amount = Session::get('trip_other')['people'] * Session::get('trip_other')['trip_price'];
              	$payments->reservation_id = $reservation_id;
                $payments->save();

                $payment_detail = paypal_transactions::where('id', $payments->id)->first();
                $transaction_id = $payment_detail->transaction_id;

                $calendar = new car_calendar;
                $calendar->car_id = Session::get('car_id');
                $calendar->start_date_time = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', Session::get('trip_other')['dep-date']) . Session::get('trip_other')['start_time']));
                $calendar->save();

                cars::where('id', Session::get('car_id'))->update(['status' => 0]);
              	Session::forget('trip_other');
            }

            Session::put(['txn_id' => $payment['payKey']]);
            Session::save();
						//echo Session::get('txn_id');
						//exit;
            return Redirect('/booking_step3')
                            ->with('success', 'Payment success. Your transaction Id is:' . $transaction_id)->with('txn_id', $payment['payKey']);
        } else {

            return Redirect('/booking_step2/' . Session::get('car_id'))
                            ->with('error', 'Payment failed');
        }
    }

    public function splitPayPayment($partner_id) {

        $partner_detail = partners::where('id', $partner_id)->first();
        $partner_payment = partner_amount::select(DB::raw('* , sum(pending_amount) as total_amount'))
                ->groupBy('partner_id')
                ->first();
        if ($partner_payment->total_amount > 0) {
            $createPacket = array(
                "actionType" => "PAY",
                "currencyCode" => "USD",
                "receiverList" => array(
                    "receiver" => array(
                        array(
                            "amount" => $partner_payment->total_amount,
                            "email" => $partner_detail->paypal_acc
                        ),
                    )
                ),
                "returnUrl" => URL::to('/') . '/admin/paypal/status',
                "cancelUrl" => URL::to('/') . '/admin/paypal/status',
                "requestEnvelope" => array(
                    "errorLanguage" => "en_US",
                    "detailLevel" => "ReturnAll",
                )
            );



            $response = $this->_paypalSend($createPacket, "Pay");
            $payKey = $response['payKey'];
            $detailsPacket = array(
                "requestEnvelope" => array(
                    "errorLanguage" => "en_US",
                    "detailLevel" => "ReturnAll",
                ),
                "payKey" => $payKey,
                "receiverOptions" => array(
                    array(
                        "receiver" => array("email" => $partner_detail->paypal_acc),
                        "invoiceData" => array(
                            "item" => array(
                                array(
                                    "name" => $partner_detail->partner_name,
                                    "price" => $partner_payment->total_amount,
                                    "identifier" => "Partner Payment",
                                ),
                            )
                        )
                    ),
                )
            );



            $response = $this->_paypalSend($detailsPacket, "SetPaymentOptions");
            $dets = $this->getPaymentOptions($payKey);
            Session::put('paykey', $payKey);
            Session::put('partner_id', $partner_id);
            Session::save();
            return redirect($this->paypalUrl . $payKey);
            exit();
        } else {
            return redirect('/admin/amount_booked')->with('error', 'Please Check Selected Partner Pending Amount');
        }
    }

    function viewReportPartner() {


        $pkey = session('paykey');
        $id = session('swap_id');
        $partner_id = Session::get('partner_id');
        Session::forget('payKey');
        Session::forget('partner_id');
        $data = array("payKey" => $pkey,
            "requestEnvelope" => array(
                "errorLanguage" => "en_US",
                "detailLevel" => "ReturnAll",
            )
        );


        $payment = $this->_paypalSend($data, "PaymentDetails");
        $transaction_id = '';
        if (ISSET($payment['status']) && $payment['status'] == 'COMPLETED') {
            $receiver_paypal_id = $payment['paymentInfoList']['paymentInfo'][0]['receiver']['email'];
            $receiver_transaction_id = $payment['paymentInfoList']['paymentInfo'][0]['transactionId'];
            $buyer_seller_transaction_id = $payment['paymentInfoList']['paymentInfo'][0]['senderTransactionId'];
            $receiver_amount_paid = $payment['paymentInfoList']['paymentInfo'][0]['receiver']['amount'];
            $key = $payment['payKey'];

            $partner_payment_transfer = new partner_payment_transfer;
            $partner_payment_transfer->transaction_id = $receiver_transaction_id;
            $partner_payment_transfer->payment_id = $key;
            $partner_payment_transfer->partner_id = $partner_id;
            $partner_payment_transfer->amount = $receiver_amount_paid;
            $partner_payment_transfer->payment_date = Carbon::today()->format('Y-m-d');
            $partner_payment_transfer->save();

            $last_record = partner_payment_transfer::where('id', $partner_payment_transfer->id)->first();

            $partner = partner_amount::where('partner_id', $partner_id)->update(['pending_amount' => 0]);

            return Redirect('/admin/amount_booked')
                            ->with('success', 'Payment success. Your transaction Id is:' . $receiver_transaction_id)->with('txn_id', $receiver_transaction_id);
        } else {
            return Redirect('/admin/amount_booked')
                            ->with('error', 'Payment Failed');
        }
    }

}
