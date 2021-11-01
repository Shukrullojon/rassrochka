<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Give;
use App\Models\User;
use App\Services\Eskiz;

class SendMessageGive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:messagegive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $arrayDay = [
            "Mon"=>'1',
            "Tue"=>'2',
            "Wed"=>'3',
            "Thu"=>'4',
            "Fri"=>'5',
            "Sat"=>'6',
            "Sun"=>'7',
        ];
        $day_number = $arrayDay[date("D",strtotime("+1 day"))];

        $giveMonth = Give::select(
            'gives.id',
            'gives.give_name',
            'gives.phone',
            'gives.product_name',
            'gives.phone',
            'gives.month_pay',
            'gives.money_type',
        )->where('status',1)
            ->where('lifetime_type',1)
            ->where('notification',1)
            ->where('day',date('d',strtotime("+1 days")))
            ->where('created_at','<',date("Y-m-d", strtotime("-10 days")))
            ->get();

        $giveWeek = Give::select(
            'gives.id',
            'gives.give_name',
            'gives.phone',
            'gives.product_name',
            'gives.phone',
            'gives.month_pay',
            'gives.money_type',
        )->where('status',1)
            ->where('lifetime_type',2)
            ->where('day',$day_number)
            ->where('created_at','<',date("Y-m-d", strtotime("-1 days")))
            ->get();

        $eskiz = Eskiz::getToken();
        if($eskiz['status']){
            $user = User::where('sms',1)->get();
            foreach ($user as $u){
                $token = $eskiz['token'];
                $phone = str_replace('+','',$u->phone);
                foreach($giveMonth as $g){
                    $product = $g->product_name;
                    $price = number_format($g->month_pay);
                    if($g->money_type == 1){
                        $price .= " $!";
                    }else{
                        $price .= " so'm!";
                    }
                    $text = "Ertaga $product uchun to'lov kuningiz ekan! Ertangi to’lovingiz: $price
    ".$g->give_name." ".$g->phone;
                    Eskiz::sendSms($phone,$text,$token);
                }

                foreach($giveWeek as $g){
                    $product = $g->product_name;
                    $price = number_format($g->month_pay);
                    if($g->money_type == 1){
                        $price .= " $!";
                    }else{
                        $price .= " so'm!";
                    }
                    $text = "Ertaga $product uchun to'lov kuningiz ekan! Ertangi to’lovingiz: $price
    ".$g->give_name." ".$g->phone;
                    Eskiz::sendSms($phone,$text,$token);
                }
            }
        }
    }
}
