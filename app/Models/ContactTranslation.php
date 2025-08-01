<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class ContactTranslation
 *
 * @property $id
 * @property $locale
 * @property $contact_id
 * @property $title
 * @property $slug
 * @property $site_name
 * @property $site_name2
 * @property $footer_menu
 * @property $footer_info
 * @property $contacts_info
 * @property $home_description
 * @property $footer_description
 * @property $address_locality
 * @property $street_address
 * @property $street_address2
 * @property $description
 * @property $body
 * @property $extra1
 * @property $extra2
 *
 * @property Contact $contact
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ContactTranslation extends Model
{
  use Sluggable;

    static $rules = [
		'locale' => 'required',
		'contact_id' => 'required',
		'title' => 'required',
		'slug' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['locale','contact_id','title','slug','site_name','site_name2','footer_menu','footer_info','contacts_info','home_description','footer_description','address_locality','street_address','street_address2','description','body','extra1','extra2'];
    public $timestamps = false;
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
      return [
        'slug' => [
          'source' => 'title'
        ]
      ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function contact()
    {
        return $this->hasOne('App\Models\Contact', 'id', 'contact_id');
    }
    


}
