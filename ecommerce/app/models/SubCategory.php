<?php
namespace app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class SubCategory extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    public $table = 'sub_categories';

    protected $fillable = [
        'name',
        'slug',
        'category_id'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function transform($data)
    {
        $subcategories = [];
        foreach ($data as $item) {
            $added = new Carbon($item->created_at);
            array_push($subcategories, [
                'id' => $item->id,
                'name' => $item->name,
                'slug' => $item->slug,
                'category_id' => $item->category_id,
                'added' => $added->toFormattedDateString()
            ]);
        }
        return $subcategories;
    }
}

