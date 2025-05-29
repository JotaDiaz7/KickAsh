<?php
class FollowModel
{
    public function countFollows($con, $user)
    {
        $sql = "SELECT COUNT(*) as total
        FROM followers f
        JOIN users u ON f.user_f = u.id
        WHERE f.user = :user AND u.activo = 1";

        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':user' => $user]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? (int)$result['total'] : 0;
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function countFollowers($con, $user)
    {
        $sql = "SELECT COUNT(*) as total
            FROM followers f
            JOIN users u ON f.user = u.id
            WHERE f.user_f = :user AND u.activo = 1";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':user' => $user]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? (int)$result['total'] : 0;
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function getFollows($con, $user, $inicio, $num)
    {
        $sql = "
        SELECT u.id, u.name, i.img
        FROM followers f
        JOIN users u ON f.user_f = u.id
        LEFT JOIN info i ON u.id = i.user
        WHERE f.user = :user AND u.activo = 1
        LIMIT $inicio, $num
    ";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':user' => $user]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);;
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function getFollowers($con, $user, $inicio, $num)
    {
        $sql = "
            SELECT u.id, u.name, i.img
            FROM followers f
            JOIN users u ON f.user = u.id
            LEFT JOIN info i ON u.id = i.user
            WHERE f.user_f = :user AND u.activo = 1
            LIMIT $inicio, $num
        ";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':user' => $user]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);;
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function setFollower($con, $user, $id_f)
    {
        $sql = "INSERT INTO followers (user, user_f) VALUES (:user, :follow)";
        try {
            $stmt = $con->prepare($sql);
            return $stmt->execute([':user' => $user, ':follow' => $id_f]);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function deleteFollower($con, $user, $id_f)
    {
        $sql = "DELETE FROM followers WHERE user = :user AND user_f = :follow";
        try {
            $stmt = $con->prepare($sql);
            return $stmt->execute([':user' => $user, ':follow' => $id_f]);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function checkFollow($con, $user, $id_f)
    {
        $sql = "SELECT COUNT(*) as total FROM followers WHERE user = :user AND user_f = :follow";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':user' => $user, ':follow' => $id_f]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] > 0 ? true : false;
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function searchFollows($con, $search, $userId)
    {

        $sql = "
            SELECT 
                users.id, 
                users.name, 
                users.rol, 
                users.activo, 
                info.img,
                CASE 
                    WHEN f.user IS NOT NULL THEN 1 
                    ELSE 0 
                END AS is_following
            FROM users
            LEFT JOIN info ON users.id = info.user
            LEFT JOIN followers f ON f.user = :userId AND f.user_f = users.id
            WHERE users.rol != 2 
                AND users.rol = 0 
                AND users.activo = 1
                AND users.id != :userId
                AND users.name IS NOT NULL
                AND (users.name LIKE :search OR users.id LIKE :search OR users.email LIKE :search)
            ORDER BY users.date_r DESC
            LIMIT 20
        ";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':userId', $userId);
            if (!empty($search)) {
                $stmt->bindValue(':search', '%' . $search . '%');
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    public function searchFollowers($con, $search, $userId)
    {
        $sql = "
        SELECT 
            users.id, 
            users.name, 
            users.rol, 
            users.activo, 
            info.img,
            CASE 
                WHEN f.user_f IS NOT NULL THEN 1 
                ELSE 0 
            END AS is_follower
        FROM users
        LEFT JOIN info ON users.id = info.user
        LEFT JOIN followers f ON f.user = users.id AND f.user_f = :userId
        WHERE users.rol != 2 
            AND users.rol = 0 
            AND users.activo = 1
            AND users.id != :userId
            AND users.name IS NOT NULL
            AND (users.name LIKE :search OR users.id LIKE :search OR users.email LIKE :search)
        ORDER BY users.date_r DESC
        LIMIT 20
    ";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':userId', $userId);
            $stmt->bindValue(':search', '%' . $search . '%');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }
}
