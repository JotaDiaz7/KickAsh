<?php
class MoneyModel
{
    function costCig($con, $user){
        $sql = "SELECT price_cig, num_cig FROM info WHERE user = :user";

        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':user' => $user]);

            $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $data['price_cig']/$data['num_cig'];
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    function saveDay($con, $user){
        $sql = "SELECT price_cig, num_cig, num_cig_day FROM info WHERE user = :user";

        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':user' => $user]);

            $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return round(($data['price_cig']/$data['num_cig'])*$data['num_cig_day'], 2);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }

    
    function getMoney($con, $user){
        $sql = "SELECT u.date_r, round(sum(h.money),2) as total, round(avg(h.money), 2) as avg 
        FROM historical h join users u on h.user = u.id
        WHERE h.user = :user";

        try {
            $stmt = $con->prepare($sql);
            $stmt->execute([':user' => $user]);
    
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode("Exception: " . $e->getMessage());
            exit;
        }
    }
}