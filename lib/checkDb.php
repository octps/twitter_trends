<?php
require_once(dirname(__FILE__) . '/db.php');

//引数で指定された分より前に値があるか確認
class checkDB {
    public static function check($pastMinute) {
        $dbh = Db::getInstance();
        $stmt = $dbh -> prepare("SELECT * from trends where updated_at > CURRENT_TIMESTAMP + INTERVAL - :pastMinute MINUTE");
        $stmt->bindParam(':pastMinute', $pastMinute, PDO::PARAM_INT);
        $result = $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_NUM);
        return $result;
    }
}
