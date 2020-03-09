<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\UserWallet;
use App\Transaction;
class TestPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $user_id;
	protected $sum;
    protected $commision;
	protected $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_id,$sum,$commision,$id)
    {
        $this->sum = $sum;
		$this->user_id = $user_id;
		$this->commision=$commision;
		$this->id=$id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		
		$uw=UserWallet::find($this->user_id);
		$new_summa=round($this->sum-$this->sum*$this->commision /100,2);
		$transaction=new Transaction();
		$transaction->id=$this->id;
		$transaction->user_id=$this->user_id;
		$transaction->sum=$new_summa;
		$transaction->save();
		$this->sum;
		if(!$uw){
			$uw=new UserWallet();
		    $uw->user_id=$this->user_id;
			$uw->sum=$new_summa;
			
		}else{
			$uw->sum+=$new_summa;
		}
		$uw->save();
		//info($this->user_id);
    }
}
