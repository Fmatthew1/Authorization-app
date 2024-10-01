<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'created_by', 
        'confirmed_by',
        'status_id',
        'creator_id',
        'confirmer_id',
        'project_manager_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function confirmedBy()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    public function projectManager()
    {
        return $this->belongsTo(User::class, 'project_manager_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            // Set default status as Pending (assuming Pending has ID 1)
            $product->status_id = 1; // Pending status ID from the statuses table
        });
    }

    public function forward()
    {

        $this->status_id === 2;   
             $this->save();
    }

    public function confirm()
    {
        $this->status_id === 3;
        $this->save();

    }

}
