<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthDashboardController extends Controller
{


    /**
     *
     *
     *
     *
     */
    public function index()
    {
        //ユーザ情報取得
        $user = Auth::user();


        /*サブスク周りの処理*/

        //5日前になったらサブスクの終了アナウンス
        $trial_end = $user->trialEndsAt()->format('Y年m月d日');
        $announce_date = date('Y-m-d', strtotime($trial_end.'-5 days'));

        if ($announce_date >= date("Y-m-d")) {
            $announce_trial_end = "無料期間が".$trial_end."に終了します。自動更新されますので解約される方は手続きをしてください";
            array_push($args, ["announce_trial_end => $announce_trial_end"]);
        }

        //支払いが不完全・延滞の場合アラーと表示で1週間後に契約自体取り消す
        if ($user->subscription('default')->hasIncompletePayment()) {
            $payment_alert = "お支払い状況をご確認ください";
            if (!empty($payment_alert_date)) {
                $payment_alert_date = date("Y-m-d");
            }
            array_push($args, ["payment_alert => $payment_alert"]);
        }

        $args = [
            'user'      => $user,
            'trial_end' => $trial_end,
        ];



        return view('dashboard', compact('args'));
    }
}
