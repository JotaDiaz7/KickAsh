<?php
class UsersModel
{
    //Función para el login
    public function login($con, $user, $password)
    {
        $sql = "SELECT id, rol, `password` FROM users WHERE (email = :user OR id = :user) AND activo = 1";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':user', $user);
            $stmt->execute();

            $resp = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resp && (password_verify($password, $resp['password']))) {
                $user = [
                    "id" => $resp['id'],
                    "rol" => $resp['rol']
                ];

                $_SESSION['user'] = $user;

                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    //Para registrar Usuarios
    public function registro($con, $id, $email, $password)
    {
        $sql = "INSERT INTO users (id, email, `password`) VALUES (:id, :email, :password)";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password', $password);

            $stmt->execute();
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
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    //Para comprobar el email
    public function comprobarEmail($con, $email, $id)
    {
        $sql = "SELECT email FROM users WHERE email = :email AND id != :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC); // El email ya existe y pertenece a otro usuario

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

    //------------------------------------
    //Para actualizar los datos del usuario
    public function updateUsuario($con, $id, $nombre, $apellidos, $email, $movil, $direccion, $ciudad, $provincia)
    {
        $sql = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, email = :email, movil = :movil, direccion = :direccion, ciudad = :ciudad, provincia = :provincia WHERE id = :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':nombre',  $nombre);
            $stmt->bindParam(':apellidos',  $apellidos);
            $stmt->bindParam(':email',  $email);
            $stmt->bindParam(':movil', $movil);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':ciudad', $ciudad);
            $stmt->bindParam(':provincia', $provincia);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    //Para cambiar la contraseña
    public function cambiarPassword($con, $id, $password)
    {
        $sql = "UPDATE usuarios SET `password` = :password WHERE id = :id";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }

    //Buscamos el cliente
    public function buscarUsuario($con, $busqueda)
    {
        $sql = "SELECT id, nombre, apellidos, email, movil, rol, activo 
                FROM usuarios 
                WHERE id LIKE :busqueda OR nombre LIKE :busqueda";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':busqueda', "%$busqueda%");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Vamos a obtener el número total de usuarios
    public function contar($con)
    {
        $sql = "SELECT count(*) as count FROM usuarios";
        try {
            $stmt = $con->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['count'];
        } catch (PDOException $e) {
            header("Location: /error?error=Error en la consulta: " . $e->getMessage());
            exit;
        }
    }

    //Para recuperar la contraseña
    public function recuperarPassword($con, $email, $nombre, $apellidos)
    {
        $sql = "SELECT id FROM usuarios WHERE email = :email AND nombre = :nombre AND apellidos = :apellidos";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellidos', $apellidos);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result["id"] ?? false;
        } catch (PDOException $e) {
            echo json_encode("ErrorConsulta: " . $e->getMessage());
            exit;
        }
    }
}
