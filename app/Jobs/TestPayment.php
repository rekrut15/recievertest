<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\UserWallet;

class TestPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $user_id;
	protected $sum;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_id,$sum)
    {
        $this->sum = $sum;
		$this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		
		$uw=UserWallet::find($this->user_id);
		if(!$uw){
			$uw=new UserWallet();
		    $uw->user_id=$this->user_id;
			$uw->sum=$this->sum;
			
		}else{
			$uw->sum+=$this->sum;
		}
		$uw->save();
		info($this->user_id);
    }
}
