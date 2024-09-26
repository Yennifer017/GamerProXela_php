<?php
class DiscountDB {
    
    public function create(Discount $discount, $conn){
        $sql = "INSERT INTO administrative.discount(id_product, percentaje, date_init, date_end)
            VALUES (:id_product, :percentaje, :date_init, :date_end)";
        $decimalPercentaje = $discount->getPercentaje() / 100;
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":id_product", $discount->getIdProduct());
        $stmt->bindValue(":percentaje", $decimalPercentaje);
        $stmt->bindValue(":date_init", $discount->getDateInit());
        $stmt->bindValue(":date_end", $discount->getDateEnd());
        if (!$stmt->execute()) {
            throw new InvalidDataEx("Datos invalidos");
        } 
    }
}