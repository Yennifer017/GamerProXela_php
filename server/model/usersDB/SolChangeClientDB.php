<?php
class SolChangeClientDB{
    public function getSolicitudes($conn) {
        $sql = "SELECT * FROM users.get_pending_modifications_users();";
        $stmt = $conn->prepare($sql);
        $stmt->execute(); 
        $solicitudes = [];
    
        // Iterar sobre los resultados
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $newClient = new Client(
                (int) $row['id_client'], 
                $row['new_firstname'], 
                $row['new_lastname'], 
                $row['new_email']
            );
            $oldClient = new Client(
                (int) $row['id_client'], 
                $row['old_firstname'], 
                $row['old_lastname'], 
                $row['old_email']
            );
            $solicitud = new ClientModification(
                (int) $row['id'], $oldClient, $newClient
            );
            $solicitudes[] = $solicitud;
        }
        return $solicitudes;
    }
    

}
    