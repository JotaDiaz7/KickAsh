<?php
class HistModel
{
    function checkRegister($con, $user, $date)
    {
        $sql = "SELECT 1 FROM historical WHERE user = :user AND date = :date LIMIT 1";

        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':user' => $user, ':date' => $date]);

            return (bool) $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    function insertRegister($con, $user, $money, $rachas)
    {
        $date = date('Y-m-d');
        $sql = "INSERT INTO historical (user, date, money, rachas) VALUES (:user, :date, :money, :rachas)";

        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':user' => $user, ':date' => $date, ':money' => $money, ':rachas' => $rachas]);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    function getRegister($con, $user)
    {
        $date = date('Y-m-d');
        $sql = "SELECT num_cig, money, rachas FROM historical WHERE user = :user AND date = :date ";

        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':user' => $user, ':date' => $date]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }
    function getLastRegister($con, $user)
    {
        $sql = "SELECT num_cig, date, rachas FROM historical WHERE user = :user order by date desc limit 1";

        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':user' => $user]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    function plusCig($con, $user, $money_cig)
    {
        $date = date('Y-m-d');
        $sql = "UPDATE historical SET num_cig = num_cig + 1,  money = ROUND(money - :money_cig, 2) WHERE user = :id AND date = :date";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':money_cig' => $money_cig, ':id' => $user, ':date' => $date]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    function minusCig($con, $user, $money_cig)
    {
        $date = date('Y-m-d');
        $sql = "UPDATE historical SET num_cig = num_cig - 1,  money = ROUND(money + :money_cig, 2) WHERE user = :id AND date = :date";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':money_cig' => $money_cig, ':id' => $user, ':date' => $date]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }
    
    function getRegistersUser($con, $user, $dateS, $dateE, $inicio, $num)
    {
        $sql = "SELECT date, num_cig, money, rachas 
            FROM historical 
            WHERE user = :user AND date BETWEEN :dateS AND :dateE 
            ORDER BY date DESC LIMIT $inicio, $num";

        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':user' => $user,':dateS' => $dateS,':dateE' => $dateE]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    function countRegistersUser($con, $user, $dateS, $dateE)
    {
        $sql = "SELECT COUNT(*) FROM historical WHERE user = :user AND date BETWEEN :dateS AND :dateE";

        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':user' => $user, ':dateS' => $dateS, ':dateE' => $dateE]);

            return (int) $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }
}
