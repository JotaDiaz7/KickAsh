<?php
class UsersModel
{
    //Función para el loginpublic function login($con, $user, $password)
    public function login($con, $user, $password)
    {
        $sql = "SELECT id, email, rol, `password` FROM users WHERE (email = :user OR id = :user) AND activo = 1";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':user' => $user]);
            $resp = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($resp && password_verify($password, $resp['password'])) {
                $_SESSION['user'] = ["id" => $resp['id'], "rol" => $resp['rol'], "email" => $resp['email']];
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function registro($con, $id, $email, $password)
    {
        $fechaReg = date('Y-m-d');
        $sql = "INSERT INTO users (id, email, `password`, date_r) VALUES (:id, :email, :password, :date)";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':id' => $id, ':email' => $email, ':password' => $password, ':date' => $fechaReg]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    //Para comprobar el id 
    public function comprobarId($con, $id)
    {
        $sql = "SELECT id FROM users WHERE id = :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':id' => $id]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    //Para comprobar el email
    public function comprobarEmail($con, $email)
    {
        $sql = "SELECT email FROM users WHERE email = :email";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':email' => $email]);

            return $stmt->fetch(PDO::FETCH_ASSOC); 
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }


    //Para obtener los datos del usuario del header
    public function getImg($con, $id)
    {
        $sql = "SELECT img FROM info WHERE user = :id";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function getUsers($con, $inicio, $num)
    {
        $sql = "SELECT users.id, users.name, users.rol, users.activo, info.img
        FROM users
        LEFT JOIN info ON users.id = info.user WHERE users.rol != 2
        ORDER BY users.date_r DESC
        LIMIT $inicio, $num";

        try {
            $stmt = $con->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function countUsers($con)
    {
        $sql = "SELECT COUNT(*) as total FROM users WHERE rol != 2";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function getUser($con, $id, $rolUser)
    {
        $activo = $rolUser == 0 ? "AND users.activo = 1 AND users.rol = 0" : "";
        $sql = "SELECT users.name, users.rol, users.date_r, users.email, info.img, users.activo, 
        info.num_cig_day, info.price_cig, info.num_cig, info.smoke_time
        FROM users
        LEFT JOIN info ON users.id = info.user WHERE users.id = :id $activo";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function checkName($con, $id)
    {
        $sql = "SELECT name
        FROM users WHERE id = :id ";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function checkInfo($con, $id)
    {
        $sql = "SELECT price_cig
        FROM info WHERE user = :id ";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function checkInfo2($con, $id)
    {
        $sql = "SELECT num_cig_day
        FROM info WHERE user = :id ";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function updateName($con, $id, $name)
    {
        $sql = "UPDATE users SET name = :name WHERE id = :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':name',  $name);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    public function updateEmail($con, $id, $email)
    {
        $sql = "UPDATE users SET email = :email WHERE id = :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':email',  $email);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    public function updatePassword($con, $id, $pass)
    {
        $sql = "UPDATE users SET password = :pass WHERE id = :id or email = :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':pass' => $pass, ':id' => $id]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    public function updateImg($con, $id, $img)
    {
        $sql = "UPDATE info SET img = :img WHERE user = :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':img',  $img);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    public function insertInfoCigs($con, $id, $price, $num)
    {
        $sql = "INSERT INTO info (user, price_cig, num_cig) VALUES (:id, :price, :num)";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':num', $num);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    public function updateInfoCigs($con, $id, $price, $num)
    {
        $sql = "UPDATE info SET price_cig = :price, num_cig = :num WHERE user = :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':num', $num);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    public function updateInfoCigs2($con, $id, $num, $smoke)
    {
        $sql = "UPDATE info SET num_cig_day = :num, smoke_time = :smoke WHERE user = :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':num', $num);
            $stmt->bindParam(':smoke', $smoke);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    public function getCalc($con, $id)
    {
        $sql = "SELECT 
            i.user,
            i.num_cig_day,
            i.smoke_time,
            COUNT(h.date) AS total,
            AVG(h.num_cig) AS avg_cig
        FROM 
            info i
        LEFT JOIN 
            historical h ON i.user = h.user
        WHERE 
            i.user = :id
        GROUP BY 
            i.user, i.num_cig_day, i.smoke_time;";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function changeState($con, $id, $activo)
    {
        $sql = "UPDATE users SET activo = :activo WHERE id = :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':activo' => $activo, ':id' => $id]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    public function getUserPodiumPosition($con, $user)
    {
        $sql = "SELECT * FROM (
                    SELECT 
                        u.id,
                        u.name,
                        COALESCE(h.racha, 0) + COALESCE(l.total_score, 0) AS total_score,
                        ROW_NUMBER() OVER (
                            ORDER BY COALESCE(h.racha, 0) + COALESCE(l.total_score, 0) DESC
                        ) AS posicion
                    FROM users u
                    LEFT JOIN (
                        SELECT user, rachas AS racha
                        FROM historical h1
                        WHERE date = (
                            SELECT MAX(date) FROM historical h2 WHERE h2.user = h1.user
                        )
                    ) h ON u.id = h.user
                    LEFT JOIN (
                        SELECT l.user, SUM(r.score) AS total_score
                        FROM logros l
                        JOIN retos r ON l.reto = r.id
                        GROUP BY l.user
                    ) l ON u.id = l.user
                    WHERE u.activo = 1
                ) AS ranking
                WHERE id = :user";

        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':user' => $user]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? (int)$result['posicion'] : null;
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function changeRol($con, $id, $rol)
    {
        $sql = "UPDATE users SET rol = :rol WHERE id = :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':rol' => $rol, ':id' => $id]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    public function getPodium($con)
    {
        $sql = "SELECT 
            u.id, u.name,
            COALESCE(h.racha, 0) + COALESCE(l.total_score, 0) AS total_score,
            COALESCE(h.racha, 0) AS ultima_racha,
            COALESCE(l.total_score, 0) AS score_logros,
            i.img
        FROM users u
        LEFT JOIN (
            SELECT user, rachas AS racha
            FROM historical h1
            WHERE date = CURDATE()
        ) h ON u.id = h.user
        LEFT JOIN (
            SELECT l.user, SUM(r.score) AS total_score
            FROM logros l
            JOIN retos r ON l.reto = r.id
            GROUP BY l.user
        ) l ON u.id = l.user
        LEFT JOIN info i ON u.id = i.user
        WHERE u.activo = 1 AND u.rol = 0
        ORDER BY total_score DESC
        LIMIT 5";

        try {
            $stmt = $con->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    //Buscador para el admin
    public function search($con, $search)
    {
        $sql = "SELECT users.id, users.name, users.rol, users.activo, info.img
        FROM users
        LEFT JOIN info ON users.id = info.user
        WHERE users.rol != 2 AND users.rol IN (0, 1) 
        AND (users.name LIKE :search OR users.id LIKE :search OR users.email LIKE :search)
        ORDER BY users.date_r DESC LIMIT 20";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':search', '%' . $search . '%');
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }
}
