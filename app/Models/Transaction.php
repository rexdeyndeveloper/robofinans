<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property integer source_wallet_id
 * @property integer destination_wallet_id
 * @property float amount
 * @property string created_at
 * @property string updated_at
 * @property-read Wallet sourceWallet;
 * @property-read Wallet destinationWallet;
 */
class Transaction extends Model
{
    use HasFactory;

    public function sourceWallet(){
        return $this->belongsTo(Wallet::class,'source_wallet_id','id');
    }

    public function destinationWallet(){
        return $this->belongsTo(Wallet::class,'destination_wallet_id','id');
    }
}
