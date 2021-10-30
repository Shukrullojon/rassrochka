<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Get;
use App\Services\Eskiz;

class SendMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:message';

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
        $day_number = $arrayDay[date("D")];

        $getMonth = Get::select(
            'gets.id',
            'gets.product_name',
            'gets.phone',
            'gets.month_pay',
            'gets.money_type',
        )->where('status',1)
            ->where('lifetime_type',1)
            ->where('notification',1)
            ->where('day',date('d'))
            ->where('created_at','<',date("Y-m-d", strtotime("-10 days")))
            ->get();

        //dd($getMonth);

        $getWeek = Get::select(
            'gets.id',
            'gets.product_name',
            'gets.phone',
            'gets.month_pay',
            'gets.money_type',
        )->where('status',1)
            ->where('lifetime_type',2)
            ->where('day',$day_number)
            ->where('created_at','<',date("Y-m-d", strtotime("-1 days")))
            ->get();

        $eskiz = Eskiz::getToken();
        //dd($eskiz);
        if($eskiz['status']){
            $token = $eskiz['token'];
            foreach($getMonth as $g){
                $product = $g->product_name;
                $price = number_format($g->month_pay);
                if($g->money_type == 1){
                    $price .= " $!";
                }else{
                    $price .= " so'm!";
                }
                $text = "Bugun $product uchun to'lov kuningiz ekan, eslatish maqsadida xabar jo’natvommiza! Bugungi to’lovingiz: $price";
                $sendSms = Eskiz::sendSms(str_replace("+","",$g->phone),$text,$token);
            }

            foreach($getWeek as $g){
                $product = $g->product_name;
                $price = number_format($g->month_pay);
                if($g->money_type == 1){
                    $price .= " $!";
                }else{
                    $price .= " so'm!";
                }
                $text = "Bugun $product uchun to'lov kuningiz ekan, eslatish maqsadida xabar jo’natvommiza! Bugungi to’lovingiz: $price";
                Eskiz::sendSms(str_replace("+","",$g->phone),$text,$token);
            }
        }
    }
}
