<?php
class RetosModel
{
    //Para registrar 
    public function registro($con, $id, $name, $img, $score, $ncigs, $follow, $rachas, $podium)
    {
        $date = date("Y-m-d H:i:s");
        $sql = "INSERT INTO retos (id, name, img, score, num_cig, followers, rachas, podium, date_r) 
            VALUES (:id, :name, :img, :score, :ncigs, :follow, :rachas, :podium, :date)";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':id' => $id, ':name' => $name, ':img' => $img, ':score' => $score, ':ncigs' => $ncigs, ':follow' => $follow, ':rachas' => $rachas, ':podium' => $podium, ':date' => $date]);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function comprobarId($con, $id)
    {
        $sql = "SELECT id FROM retos WHERE id = :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function getRetos($con, $inicio, $num)
    {
        $sql = "SELECT * FROM retos ORDER BY date_r DESC LIMIT $inicio, $num";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function getReto($con, $id)
    {
        $sql = "SELECT * FROM retos WHERE id = :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function updateReto($con, $id, $img, $score, $ncigs, $follow, $rachas, $podium)
    {
        $sql = "UPDATE retos SET img = :img, score = :score, num_cig = :ncigs, followers = :follow, rachas = :rachas, podium = :podium WHERE id = :id";
        try {
            $stmt = $con->prepare($sql);
            return $stmt->execute([':id' => $id, ':img' => $img, ':score' => $score, ':ncigs' => $ncigs, ':follow' => $follow, ':rachas' => $rachas, ':podium' => $podium]);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function changeState($con, $id, $activo)
    {
        $sql = "UPDATE retos SET activo = :activo WHERE id = :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':activo' => $activo, ':id' => $id]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    public function delete($con, $id)
    {
        $sql = "DELETE FROM retos WHERE id = :id";
        try {
            $stmt = $con->prepare($sql);
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function getRetosByRachaUser($con, $user, $racha)
    {
        $sql = "SELECT * FROM retos 
            WHERE rachas <= :racha 
            AND activo = 1 
            AND id NOT IN (
                SELECT reto FROM logros WHERE user = :user
            ) LIMIT 1";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':racha' => $racha, ':user' => $user]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("Exceptdion: " . $e->getMessage());
            exit;
        }
    }

    public function checkCigsInRacha($con, $user, $rachas, $cigs)
    {//Me devuelve true si no se ha fumado más cigarrillos de los permitidos en el reto
        $sql = "SELECT COUNT(*) as total 
            FROM (
                SELECT num_cig 
                FROM historical 
                WHERE user = :user 
                ORDER BY date DESC 
                LIMIT :rachas
            ) AS ultimos
            WHERE num_cig > :cigs";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':user', $user);
            $stmt->bindValue(':rachas', (int)$rachas, PDO::PARAM_INT);
            $stmt->bindValue(':cigs', (int)$cigs, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo $result['total'] . " cigarrillos:".$cigs;
            return $result['total'] == 0;
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function getTotalScoreByUser($con, $user)
    {
        $sql = "SELECT COALESCE(SUM(r.score), 0) AS total 
            FROM logros l 
            JOIN retos r ON l.reto = r.id 
            WHERE l.user = :user";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':user' => $user]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int)$result['total'];
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function registrarLogro($con, $user, $reto)
    {
        $sql = "INSERT INTO logros (user, reto) VALUES (:user, :reto)";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':user' => $user, ':reto' => $reto]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function getLogros($con, $user)
    {
        $sql = "SELECT *
            FROM  retos r
            JOIN logros l ON l.reto = r.id 
            WHERE l.user = :user";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':user' => $user]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function getRetoUser($con, $id, $user)
    {
        $sql = "SELECT 
                r.*, 
                CASE WHEN l.user IS NOT NULL THEN 1 ELSE 0 END AS es_logro
            FROM retos r
            LEFT JOIN logros l ON r.id = l.reto AND l.user = :user
            WHERE r.id = :reto_id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':reto_id' => $id, ':user' => $user]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function deleteLogro($con, $reto)
    {
        $sql = "DELETE FROM logros WHERE reto = :reto";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':reto' => $reto]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function countRetos($con)
    {
        $sql = "SELECT COUNT(*) as total FROM retos";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }
}
