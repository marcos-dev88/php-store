<?php

namespace DB\Connection;

use PDO;
use PDOException;
use Throwable;

require __DIR__ . '../global.php';


class Connection
{
    /** @var PDO */
    private PDO $connection;

    /** @param array $connection */
    public function __construct(array $connection = [])
    {
        $db = getenv('SQL_DRIVER');
        $host = getenv('DB_HOST');
        $dbName = getenv('MYSQL_DATABASE');
        $dbUser = getenv('DB_USERNAME');
        $dbPassword = getenv('DB_PASSWORD');


        try {
            $this->connection = new PDO(
                $db . ':host=' . $host . ';dbname=' . $dbName,
                $dbUser,
                $dbPassword,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]
            );
        } catch (PDOException $e) {
            die(json_encode(['PDO connection Error ->' => $e->getMessage()]));
        } catch (Throwable $t) {
            die(json_encode(['Connection Error ->' => $t->getMessage()]));
        }
    }

    /** @return PDO */
    public function getConnection(): PDO {
        return $this->connection;
    }
}