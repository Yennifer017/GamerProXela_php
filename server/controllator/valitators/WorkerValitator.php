<?php
class WorkerValitator {
  
    public function isSalespersonValid(Salesperson $salesperson) {
        return is_int($salesperson->getNoCheckout())
            && is_int($salesperson->getIdSucursal())
            && !empty($salesperson->getUsername())
            && !empty($salesperson->getPassword());
    }

    public function isAssignedValid(Assigned $assigned){
        return is_int($assigned->getIdSucursal())
            && !empty($assigned->getUsername())
            && !empty($assigned->getPassword());
    }

}