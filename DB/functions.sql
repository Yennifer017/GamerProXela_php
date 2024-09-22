--creacion de un cajero
CREATE OR REPLACE FUNCTION create_salesperson(
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
CREATE OR REPLACE FUNCTION create_assigned(
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
