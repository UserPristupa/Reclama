<?php
/**
 * Created by PhpStorm.
 * User: marevo
 * Date: 26.06.2017
 * Time: 17:00
 */

namespace App\Models;
use App\Db;
use App\FastViewTable;
use App\ModelLikeTable;


class Reports extends ModelLikeTable
{
    public $pure;
    public $income;//название Клиента
    public $date;
    

    use FastViewTable;
    
    const TABLE = 'orders';
    const NAME_ID ='id';
//    static $table = 'clients';
    public function isNew()
    {
        // TODO: Implement isNew() method.
        if(empty($this->id) || is_null($this->id) ){
            return true;
        }
        else{
            return false;
        }
    }

    public static function getPreviousDay(){
        $db = new Db();
		//$query="SELECT SUM(p.sumPayment) AS 'Доходы',p.date AS 'Дата' FROM payments p WHERE p.date=DATE_ADD(CURDATE(),INTERVAL -1 DAY);";
        $query = "SELECT SUM(p.sumPayment)-SUM(o.manufacturingPrice) AS pure, SUM(p.sumPayment) AS income, DATE_ADD(CURDATE(),INTERVAL -1 DAY) AS date FROM orders o JOIN payments p ON p.idOrder=o.id WHERE o.dateOfComplation=DATE_ADD(CURDATE(),INTERVAL -1 DAY) OR p.date=DATE_ADD(CURDATE(),INTERVAL -1 DAY); ";
//        var_dump('<br>обработаем запрос : '.$query.' в функции getAllSuppliers of class '.self.'<br>');

        $res = $db->query($query, self::class );
        return $res;
    }
	public static function getPreviousWeek(){
        $db = new Db();
		$query = "SELECT SUM(p.sumPayment)-SUM(o.manufacturingPrice) AS pure, SUM(p.sumPayment) AS income, date FROM orders o JOIN payments p ON p.idOrder=o.id JOIN (SELECT date WHERE WEEKOFYEAR(CURDATE())-1=WEEKOFYEAR(date)) WHERE o.dateOfComplation=DATE_ADD(CURDATE(),INTERVAL -1 DAY) OR p.date=DATE_ADD(CURDATE(),INTERVAL -1 DAY); ";
        //$query = "SELECT SUM(p.sumPayment)-SUM(o.manufacturingPrice) AS 'Чистая прибыль', SUM(p.sumPayment) AS 'Доходы', IFNULL(p.date,o.dateOfComplation) AS 'Дата' FROM orders o JOIN payments p ON p.idOrder=o.id WHERE o.dateOfComplation=DATE_ADD(CURDATE(),INTERVAL -1 DAY) OR p.date=; ";
//        var_dump('<br>обработаем запрос : '.$query.' в функции getAllSuppliers of class '.self.'<br>');

        $res = $db->query($query, self::class );
        return $res;
    }
   
}