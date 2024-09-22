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
CREATE OR REPLACE FUNCTION storage.update_stock()
RETURNS TRIGGER AS $$
DECLARE
    max_existences INTEGER;
BEGIN
    SELECT existences INTO max_existences 
    FROM storage.stock 
    WHERE id_sucursal = NEW.id_sucursal AND id_product = NEW.id_product;

    IF max_existences IS NULL THEN
        RAISE EXCEPTION 'El producto no existe en la sucursal';
    ELSIF max_existences < NEW.existences THEN
        RAISE EXCEPTION 'No hay suficientes existencias';
    END IF;

    UPDATE storage.stock
    SET existences = existences - NEW.existences
    WHERE id_sucursal = NEW.id_sucursal AND id_product = NEW.id_product;

    IF NOT FOUND THEN 
        RAISE EXCEPTION 'No se pudo actualizar el stock';
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE TRIGGER transfer_products
BEFORE UPDATE ON storage.on_sale
FOR EACH ROW
EXECUTE FUNCTION storage.update_stock();
