<?php
/**
 * Created by PhpStorm.
 * User: marevo
 * Date: 28.06.2017
 * Time: 13:04
 */

namespace App\Models;
//require '../../autoload.php';
use App\Db;
use App\ModelLikeTable;
use App\FastViewTable;
use App\Models\Payment;

class Order extends ModelLikeTable
{
    public $id;
    public $nameOrder;
    public $descriptionOrder;
    public $source;
    public $idClient;
    public $orderPrice;
    public $manufacturingPrice;
    public $isCompleted;
    public $isReady;
    public $isInstall;
    public $dateOfOrdering;
    public $dateOfComplation;
    public $isAllowCalculateCost;
    public $isTrash;
//    private $nameClient;
    private $sumAllPayments;// количество проплаченных денег за заказ не входит в таблицу, а получаем из другой таблицы через запрос
    const TABLE = 'orders';
    const NAME_ID ='id';

    public function isNew()
    {
        // TODO: Implement isNew() method.
        if(empty($this->id) || is_null($this->id)){
            return true;
        }
        else{
            return false;
        }
    }
//функция выборки 1)id заказа,2) названия заказа,3) названия клиента, 4)цена заказа, 5)степень готовности-0-новый, 1-завершен-успешно, 2-завершен неуспешно,
//6) sum(select sumPayment from payments) 7) можно ли менять стоимость комплектующих, если удален (isTrash=1) - то не показываем, а если не удален isTrash=0 тогда показываем
        public static function selectForView( ){
            //запрос заказов, клиентов, суммы оплаты с группировкой заказам
            $queryNew= "SELECT  o.id AS idOrder ,o.dateOfOrdering AS dateBegin, o.dateOfComplation AS dateEnd, o.name, c.name AS nameClient , o.orderPrice,o.isReady, o.isCompleted, SUM( p.sumPayment) AS payment
                  FROM orders o, clients c, payments p
                  WHERE o.idClient = c.id AND o.id = p.idOrder AND o.isTrash = 0
                  GROUP BY idOrder
                  ORDER BY dateBegin DESC ;
                  ";

            $db = new Db();
        $queryOld= "SELECT orders.id AS idOrder , `name`, clients.name AS nameClient , orderPrice,isReady, isCompleted,  
                  FROM orders, clients, payments
                  WHERE idClient = clients.id ";
        $sth = $db->get_dbh()->prepare($queryNew);
        $res = $sth->execute();
        if(false != $res) {
//            var_dump('<br>должен быть результат вызова в  function query in Db.php<br>');
            return $sth->fetchAll();
        }
        else{
//            var_dump('<br>последняя строка в результата нет !!! function query in Db.php<br>');
            return false;
        }

    }
   public static function getTrashedOrders()
    {
        $queryFindTrashedOrders= "SELECT  o.id AS idOrder ,o.dateOfOrdering AS dateBegin, o.dateOfComplation AS dateEnd, o.name, c.name AS nameClient , o.orderPrice,o.isReady, o.isCompleted, SUM( p.sumPayment) AS payment
                  FROM orders o, clients c, payments p
                  WHERE o.idClient = c.id AND o.id = p.idOrder AND o.isTrash = 1
                  GROUP BY idOrder
                  ORDER BY dateBegin DESC ;
                  ";
        $db = new Db();
        $sth = $db->get_dbh()->prepare($queryFindTrashedOrders);
        $res = $sth->execute();
        if(false != $res) {
//            var_dump('<br>должен быть результат вызова в  function query in Db.php<br>');
            return $sth->fetchAll();
        }
        else{
//            var_dump('<br>последняя строка в результата нет !!! function query in Db.php<br>');
            return false;
        }
    }

//**найти заказы по подобию названия
public static function getOrdersLikeNameClient(string $likeName){
    $queryFindOrderLikeName= "SELECT  o.id AS idOrder ,o.dateOfOrdering AS dateBegin, o.dateOfComplation AS dateEnd, o.name, c.name AS nameClient , o.orderPrice,o.isReady, o.isCompleted, SUM( p.sumPayment) AS payment
                  FROM orders o, clients c, payments p
                  WHERE o.idClient = c.id AND o.id = p.idOrder AND o.isTrash = 0 AND c.name  LIKE '%$likeName%'
                  GROUP BY idOrder
                  ORDER BY dateBegin DESC ;
                  ";
//    echo $queryFindOrderLikeName;
//    die();
    $db = new Db();
    $sth = $db->get_dbh()->prepare($queryFindOrderLikeName);
    $res = $sth->execute();
    if(false != $res) {
//            var_dump('<br>должен быть результат вызова в  function query in Db.php<br>');
        return $sth->fetchAll();
    }
    else{
//            var_dump('<br>последняя строка в результата нет !!! function query in Db.php<br>');
        return false;
    }
}
    public static function getOrdersLikeName(string $likeName){
        $queryFindOrderLikeName= "SELECT  o.id AS idOrder ,o.dateOfOrdering AS dateBegin, o.dateOfComplation AS dateEnd, o.name, c.name AS nameClient , o.orderPrice,o.isReady, o.isCompleted, SUM( p.sumPayment) AS payment
                  FROM orders o, clients c, payments p
                  WHERE o.idClient = c.id AND o.id = p.idOrder AND o.isTrash = 0 AND o.name  LIKE '%$likeName%'
                  GROUP BY idOrder
                  ORDER BY dateBegin DESC ;
                  ";
//    echo $queryFindOrderLikeName;
//    die();
        $db = new Db();
        $sth = $db->get_dbh()->prepare($queryFindOrderLikeName);
        $res = $sth->execute();
        if(false != $res) {
//            var_dump('<br>должен быть результат вызова в  function query in Db.php<br>');
            return $sth->fetchAll();
        }
        else{
//            var_dump('<br>последняя строка в результата нет !!! function query in Db.php<br>');
            return false;
        }
    }

//найти все поля закза по переданному id
    public static function findObjByIdForViewOneOrder(int $id){
//        echo '<br>вызов из класса Order  функция findObjByIdForViewOneOrder получили результат не false<br>';
        $res = self::findObjByIdStatic($id);
//        var_dump($res);
        return $res;
    }
    public function getNameClient(){
        $cl = Client::findObjByIdStatic($this->idClient);
//        var_dump("в классе заказ по idClent нашли клиента ".$cl->name);
        return $cl->name;
    }
    public  function getSumAllPayments(){
        return Payment::showSumAllPayments($this->id);
    }
	//метод найдет заказ по названию если он есть такой
    //*если есть заказ с таким именем вернет obj Order заказа
    //*если нет то вернет false
    public static function isAllowNameOrder (string $name){
        $query = "SELECT * FROM orders WHERE orders.name = '$name';";
//        echo 'пришел запрос на проверку названия заказа '.$query;
        $db = new  Db();
        $res = $db ->query($query,static::class);
        if($res != false)    
           return $res[0];
        else return false;
    }
    //запрос стоимости всех комплектующих по расчету к заказу
    public function getManufacturingPriceCount(){
        $query = "SELECT SUM(priceCountNeed) FROM materialsToOrder WHERE idOrder = $this->id ;";
        $db = new Db();
        $sth = $db->get_dbh() -> prepare($query);
        $res = $sth->execute();
        if($res != false){
            return $sth->fetchAll()[0][0];
        }
        return 0;
    }

    //запрос стоимости всех комплектующих по рекомендации системы( должен быть больше чем по расчету) к заказу
    public function getManufacturingPriceRecom(){
        $query = "SELECT SUM(priceRecomNeed) FROM materialsToOrder WHERE idOrder = $this->id ;";
        $db = new Db();
        $sth = $db->get_dbh() -> prepare($query);
        $res = $sth->execute();
        if($res != false){
            return $sth->fetchAll()[0][0];
        }
        return 0;
    }
    
}