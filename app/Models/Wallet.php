<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property integer id
 * @property integer user_id
 * @property float balance
 * @property string created_at
 * @property string updated_at
 * @property-read User user;
 * @property-read Transaction[] | Collection sourceTransactions;
 * @property-read Transaction[] | Collection destinationTransactions;
 * @mixin Builder
 */
class Wallet extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function sourceTransactions(){
        return $this->hasMany(Transaction::class,'source_wallet_id','id');
    }

    public function destinationTransactions(){
        return $this->hasMany(Transaction::class,'destination_wallet_id','id');
    }
}
