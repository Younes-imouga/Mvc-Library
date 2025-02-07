<?php 
namespace App\Core;
require '../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

class database {
    private $driver;
    private $host;
    private $db;
    private $user;
    private $password;

    public function __construct()
    {
        $this->driver = getenv('DRIVER') ?: 'mysql';
        $this->host = getenv('HOST')?: '127.0.0.1';
        $this->db = getenv('DATABASE')?: 'mvc_library';
        $this->user = getenv('USER')?: 'root';
        $this->password = getenv('PASSWORD')?: "";
    }

    public function connect(){
        $capsule = new Capsule;
        
        $capsule->addConnection([
            'driver'    => $this->driver,        
            'host'      => $this->host,    
            'database'  => $this->db,  
            'username'  => $this->user,         
            'password'  => $this->password
        ]);
        
        
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}