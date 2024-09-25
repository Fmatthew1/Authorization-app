<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $table = 'statuses';

    static $values = [
        ['id' => 1, 'name' => 'Pending', 'enabled' => true], 
        ['id' => 2, 'name' => 'Forwarded', 'enabled' => true], 
        ['id' => 3, 'name' => 'Confirmed', 'enabled' => true], 

    ];

    protected $guarded = [];

    public const PENDING                = 1;
    public const FORWARDED              = 2;
    public const CONFIRMED               = 3;



    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
