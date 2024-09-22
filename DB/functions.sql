/********************************************************
*********************** ADMINISTRATIVE*******************
*********************************************************/
--creacion de un cajero
CREATE OR REPLACE FUNCTION administrative.create_salesperson(
    username TEXT,
    pass TEXT,
    id_sucursal INTEGER,
    no_checkout INTEGER
) RETURNS VOID AS $$
DECLARE
    last_id INTEGER; 
BEGIN
    INSERT INTO administrative.worker(rol, username, password) 
        VALUES ('cajero', username, pass)
        RETURNING id INTO last_id;

    INSERT INTO administrative.cajero(id_worker, id_sucursal, no_checkout) 
        VALUES (last_id, id_sucursal, no_checkout);
END;
$$ LANGUAGE plpgsql;


--creacion de un encargado de inventario/stock  
CREATE OR REPLACE FUNCTION administrative.create_assigned(
    username TEXT,
    pass TEXT,
    rol TEXT,
    id_sucursal INTEGER
) RETURNS VOID AS $$
DECLARE
    last_id INTEGER; 
BEGIN
    INSERT INTO administrative.worker(rol, username, password) 
        VALUES (rol::administrative.user_rol, username, pass) --casteo de rol
        RETURNING id INTO last_id;

    INSERT INTO administrative.assigned(id_worker, id_sucursal) VALUES
        (last_id, id_sucursal);
END;
$$ LANGUAGE plpgsql;


/********************************************************
*********************** STOCK ***************************
*********************************************************/
--insertar en stock
CREATE OR REPLACE FUNCTION storage.add_product_stock(
    id_sucursal_param INTEGER,
    id_product_param INTEGER,
    hall_param INTEGER,
    existences_param INTEGER
) RETURNS VOID AS $$
BEGIN
    UPDATE storage.stock
    SET existences = existences + existences_param
    WHERE id_sucursal = id_sucursal_param AND id_product = id_product_param AND hall = hall_param;

    IF NOT FOUND THEN --si no se realizo el update
        INSERT INTO storage.stock(id_sucursal, id_product, hall, existences) 
        VALUES (id_sucursal_param,id_product_param,hall_param,existences_param);
    END IF;
END;
$$ LANGUAGE plpgsql;
