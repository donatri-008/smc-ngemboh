<<<<<<< HEAD
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LambangMeaning extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'isi', 'icon', 'posisi', 'urutan'];
=======
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LambangMeaning extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'isi', 'posisi', 'urutan'];
>>>>>>> 7c2b0c38c7cbb0458913dc97ac2a87842c5a8228
}