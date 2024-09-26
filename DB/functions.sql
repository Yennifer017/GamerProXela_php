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


CREATE OR REPLACE FUNCTION storage.update_stock(
    id_sucursal_param INTEGER,
    id_product_param INTEGER,
    existences_param INTEGER
) RETURNS VOID AS $$
DECLARE
    max_existences INTEGER;
BEGIN
    -- Verificar las existencias
    SELECT existences INTO max_existences FROM storage.stock 
    WHERE id_sucursal = id_sucursal_param AND id_product = id_product_param;

    IF max_existences IS NULL THEN
        RAISE EXCEPTION 'El producto no existe en la sucursal';
    ELSIF max_existences < existences_param THEN
        RAISE EXCEPTION 'No hay suficientes existencias';
    END IF;

    -- Actualizar las existencias
    UPDATE storage.stock
    SET existences = existences - existences_param
    WHERE id_sucursal = id_sucursal_param AND id_product = id_product_param;

    IF NOT FOUND THEN 
        RAISE EXCEPTION 'No se pudo actualizar el stock';
    END IF;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION storage.transfer_to_inventary(
    id_sucursal_param INTEGER,
    id_product_param INTEGER,
    existences_param INTEGER
) RETURNS VOID AS $$
BEGIN
    PERFORM storage.update_stock(id_sucursal_param, id_product_param, existences_param);
    UPDATE storage.on_sale
    SET existences = existences + existences_param
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


/********************************************************
*********************** PRODUCTS *************************
*********************************************************/
--buscar un producto a la venta
CREATE OR REPLACE FUNCTION storage.find_on_sale_product(
    id_product_param INTEGER,
    id_sucursal_param INTEGER
) 
RETURNS TABLE(
    name VARCHAR(70),
    price MONEY,
    existences INTEGER, 
    discount FLOAT
) AS $$
BEGIN
    RETURN QUERY 
    SELECT 
        business.product.name AS name,
        business.product.price AS price,
        storage.on_sale.existences AS existences,
        (
            SELECT administrative.discount.percentaje
            FROM administrative.discount
            WHERE administrative.discount.id_product = business.product.id
            AND administrative.discount.date_end >= CURRENT_DATE
            ORDER BY administrative.discount.date_end ASC
            LIMIT 1
        ) AS discount
    FROM storage.on_sale
    JOIN business.product ON storage.on_sale.id_product = business.product.id
    WHERE storage.on_sale.id_sucursal = id_sucursal_param 
        AND storage.on_sale.id_product = id_product_param;
END;
$$ LANGUAGE plpgsql;


--buscar todos los productos con una coincidencia
CREATE OR REPLACE FUNCTION business.find_product(
    coincidence TEXT
) 
RETURNS TABLE(
    id INTEGER,
    name VARCHAR(70),
    price MONEY,
    existences INTEGER,
    sucursal INTEGER
) AS $$
BEGIN
    RETURN QUERY 
    SELECT 
        business.product.id AS id,
        business.product.name AS name,
        business.product.price AS price, 
        storage.on_sale.existences AS existences, 
        storage.on_sale.id_sucursal AS sucursal
    FROM storage.on_sale
    JOIN business.product ON storage.on_sale.id_product = business.product.id
    WHERE business.product.name ILIKE '%' || coincidence || '%';
END;
$$ LANGUAGE plpgsql;



/********************************************************
************************** SALES *************************
*********************************************************/
CREATE OR REPLACE FUNCTION business.update_on_sale_products(
    id_sucursal_param INTEGER,
    id_product_param INTEGER,
    quantity INTEGER
) RETURNS VOID AS $$
DECLARE
    max_existences INTEGER;
BEGIN
    -- Verificar las existencias
    SELECT existences INTO max_existences FROM storage.on_sale 
    WHERE id_sucursal = id_sucursal_param AND id_product = id_product_param;

    IF max_existences IS NULL THEN
        RAISE EXCEPTION 'El producto no existe en la sucursal';
    ELSIF quantity < 0 THEN
        RAISE EXCEPTION 'Las existencias no deben ser negativas';    
    ELSIF max_existences < quantity THEN
        RAISE EXCEPTION 'No hay suficientes existencias';
    END IF;

    -- Actualizar las existencias
    UPDATE storage.on_sale
    SET existences = existences - quantity
    WHERE id_sucursal = id_sucursal_param AND id_product = id_product_param;

    IF NOT FOUND THEN 
        RAISE EXCEPTION 'No se pudo actualizar el stock de productos a la venta';
    END IF;
END;
$$ LANGUAGE plpgsql;



CREATE OR REPLACE FUNCTION business.save_sale(
    id_client_param INTEGER,
    id_sucursal_param INTEGER,
    id_cajero_param INTEGER,
    ids_products INTEGER[],
    quantities INTEGER[]
) 
RETURNS TABLE(
    new_sale_id INTEGER
) AS $$
DECLARE
    i INTEGER := 1;
    new_sale_id INTEGER;
    current_price_var MONEY;
    current_discount_var FLOAT;
    current_price_with_discount MONEY;
    current_id_product INTEGER;
BEGIN
    --agregar la venta
    INSERT INTO business.sale(id_client, id_sucursal, id_cajero) 
    VALUES (id_client_param, id_sucursal_param, id_cajero_param)
    RETURNING business.sale.number INTO new_sale_id;
    --para cada producto agregar en detalles
    FOREACH current_id_product IN ARRAY ids_products
    LOOP
        SELECT price INTO current_price_var FROM business.product WHERE id = current_id_product;
        IF NOT FOUND THEN
            RAISE EXCEPTION 'no se encontro el producto';
        END IF;
        current_price_with_discount := current_price_var;

        SELECT administrative.discount.percentaje INTO current_discount_var
        FROM administrative.discount
        WHERE administrative.discount.id_product = current_id_product
        AND administrative.discount.date_end >= CURRENT_DATE
        ORDER BY administrative.discount.date_end ASC
        LIMIT 1;
        
        IF current_discount_var IS NOT NULL THEN
            current_price_with_discount = current_price_var - current_price_var * current_discount_var;
        END IF;

        PERFORM business.update_on_sale_products(id_sucursal_param, current_id_product, quantities[i]);

        INSERT INTO business.sold_product(
            id_product, 
            id_sale, 
            quantity, 
            current_price, 
            price_with_discount
        ) VALUES (
            current_id_product, 
            new_sale_id,
            quantities[i], 
            current_price_var, 
            current_price_with_discount
        );
        i := i + 1;
    END LOOP;

    RETURN QUERY SELECT new_sale_id;
END;
$$ LANGUAGE plpgsql;

-------------------------mostrar factura--------------------------
--datos generales
CREATE OR REPLACE FUNCTION business.get_general_factura(
    id_factura INTEGER
) 
RETURNS TABLE(
    numero_factura INTEGER,
    client_name VARCHAR(25),
    client_lastname VARCHAR(25),
    cajero_username VARCHAR(16),
    subtotal MONEY,
    total MONEY
) AS $$
BEGIN
    RETURN QUERY 
    SELECT
        business.sale.number AS numero_factura,
        users.client.firstname AS client_name,
        users.client.lastname AS client_lastname,
        administrative.worker.username AS cajero_username,
        SUM(business.sold_product.current_price * business.sold_product.quantity) AS subtotal,
        SUM(business.sold_product.price_with_discount * business.sold_product.quantity) AS total
    FROM business.sold_product
    JOIN business.sale ON business.sold_product.id_sale = business.sale.number
    LEFT JOIN users.client ON business.sale.id_client = users.client.id
    JOIN administrative.worker ON business.sale.id_cajero = administrative.worker.id
    WHERE business.sold_product.id_sale = id_factura
    GROUP BY 
        business.sold_product.id_sale, 
        business.sale.number,
        users.client.firstname, 
        users.client.lastname,
        administrative.worker.username;
END;
$$ LANGUAGE plpgsql;


--datos extendidos de factura
CREATE OR REPLACE FUNCTION business.get_details_factura(
    id_factura INTEGER
) 
RETURNS TABLE(
    id_product INTEGER,
    product_name VARCHAR(70),
    current_price MONEY,
    price_with_discount MONEY,
    quantity INTEGER,
    total_without_discount MONEY,
    total_with_discount MONEY
) AS $$
BEGIN
    RETURN QUERY 
    SELECT 
        business.sold_product.id_product AS id_product,
        business.product.name AS product_name,
        business.sold_product.current_price AS current_price,
        business.sold_product.price_with_discount AS price_with_discount,
        business.sold_product.quantity AS quantity,
        (business.sold_product.quantity * business.sold_product.current_price) AS total_without_discount,
        (business.sold_product.quantity * business.sold_product.price_with_discount) AS total_with_discount
    FROM business.sold_product
    JOIN business.sale ON business.sold_product.id_sale = business.sale.number
    JOIN business.product ON business.sold_product.id_product = business.product.id
    WHERE business.sold_product.id_sale = id_factura;
END;
$$ LANGUAGE plpgsql;






