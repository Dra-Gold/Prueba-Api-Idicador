<?php 
namespace App\Models;
use CodeIgniter\Model;

class UfModel extends Model
{
    protected $table = 'INDICADOR_UF';

    protected $primaryKey = 'UF_ID';
    
    protected $allowedFields = ['UF_ID','UF_FECHA', 'UF_VALOR'];
}