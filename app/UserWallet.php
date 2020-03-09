<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    //
	protected $table="user_wallet";
	protected $primaryKey = 'user_id'; 
}
