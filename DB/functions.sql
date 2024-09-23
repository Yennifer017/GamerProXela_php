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
CREATE OR REPLACE FUNCTION storage.transfer_to_inventary(
    id_sucursal_param INTEGER,
    id_product_param INTEGER,
    existences_param INTEGER
) RETURNS VOID AS $$
BEGIN
    UPDATE storage.on_sale
    SET existences = existences_param
    WHERE id_sucursal = id_sucursal_param AND id_product = id_product_param;

    IF NOT FOUND THEN 
        INSERT INTO storage.on_sale(id_sucursal, id_product, existences) 
        VALUES (id_sucursal_param, id_product_param, existences_param);
    END IF;
END;
$$ LANGUAGE plpgsql;


--busqueda de productos en stock
CREATE OR REPLACE FUNCTION storage.find_stock_product(
    id_product_param INTEGER,
    id_sucursal_param INTEGER
) 
RETURNS TABLE(
    product_name VARCHAR(70),
    hall INTEGER,
    existences INTEGER
) AS $$
BEGIN
    RETURN QUERY 
    SELECT business.product.name, storage.stock.hall, storage.stock.existences
    FROM storage.stock
    JOIN business.product ON business.product.id = storage.stock.id_product
    WHERE storage.stock.id_product = id_product_param
    AND storage.stock.id_sucursal = id_sucursal_param;
END;
$$ LANGUAGE plpgsql;


/********************************************************
*********************** CLIENTS *************************
*********************************************************/

--obtener todas las modificaciones de clientes pendientes 
CREATE OR REPLACE FUNCTION users.get_pending_modifications_users(
) 
RETURNS TABLE(
    id INTEGER,
    id_client INTEGER,
    new_firstname VARCHAR(25),
    new_lastname VARCHAR(25),
    new_email VARCHAR(60),
    old_firstname VARCHAR(25),
    old_lastname VARCHAR(25),
    old_email VARCHAR(60)
) AS $$
BEGIN
    RETURN QUERY 
    SELECT 
        users.modification.id AS id, 
        users.modification.id_cliente AS id_client, 
        users.modification.firstname AS new_firstname, 
        users.modification.lastname AS new_lastname,
        users.modification.email AS new_email,

        users.client.firstname AS old_firstname,
        users.client.lastname AS old_lastname,
        users.client.email AS old_email
    FROM users.modification
    JOIN users.client ON users.client.id = users.modification.id_cliente
    WHERE users.modification.status = 'pendiente';
END;
$$ LANGUAGE plpgsql;