<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Bibliographicrecord
 *
 * @property $id
 * @property $record
 * @property $workPage
 * @property $countOf
 * @property $purrentID
 * @property $fileName
 * @property $fileSiize
 * @property $creator
 * @property $status
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Bibliographicrecord extends Model
{

  static $rules = [
    'record' => 'required',
    'workPage' => 'required',
    'countOf' => 'required',
    'fileName' => 'required',
    'fileSiize' => 'required',
    'creator' => 'required',
  ];


  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['record', 'workPage', 'countOf', 'purrentID', 'fileName', 'fileSiize', 'creator', 'status'];
}
