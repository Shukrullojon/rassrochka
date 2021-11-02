<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GetComment;
use App\Models\GiveComment;
use App\Services\Eskiz;

class SendCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:command';

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
        $getComment = GetComment::where('send_date',date("Y-m-d"))->get();
        $eskiz = Eskiz::getToken();
        if($eskiz['status']){
            $token = $eskiz['token'];
            foreach($getComment as $g){
                $product = $g->get->product_name;
                $price = number_format($g->price);
                if($g->get->money_type == 1){
                    $price .= " $!";
                }else{
                    $price .= " so'm!";
                }
                $text = "Bugun $product uchun to'lov kuningiz ekan, eslatish maqsadida xabar jo’natvommiza! Bugungi to’lovingiz: $price";
                $sendSms = Eskiz::sendSms(str_replace("+","",$g->get->phone),$text,$token);
            }
        }

        

    }
}
