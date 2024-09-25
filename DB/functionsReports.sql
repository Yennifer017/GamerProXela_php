--top 10 articulos mas vendidos
CREATE OR REPLACE VIEW administrative.top_products AS 
SELECT
    business.sold_product.id_product,
    business.product.name,
    SUM(business.sold_product.quantity) AS total_vendido 
FROM business.sold_product
JOIN business.product ON business.sold_product.id_product = business.product.id
GROUP BY business.sold_product.id_product, business.product.name 
ORDER BY total_vendido DESC
LIMIT 10;

--top 10 clientes que mas dinero han gastado
CREATE OR REPLACE VIEW administrative.top_clients AS
SELECT 
    users.client.id,
    SUM(business.sold_product.price_with_discount * business.sold_product.quantity) AS total_gastado,
    users.client.firstname, 
    users.client.lastname,
    users.client.email
FROM business.sold_product
JOIN business.sale ON business.sold_product.id_sale = business.sale.number
JOIN users.client ON business.sale.id_client = users.client.id
GROUP BY users.client.id
ORDER BY total_gastado DESC
LIMIT 10;

--top 2 sucursales que mas dinero han ingresado
CREATE OR REPLACE VIEW administrative.top_sucursales AS
SELECT 
    administrative.sucursal.id,
    administrative.sucursal.name,
    SUM(business.sold_product.price_with_discount * business.sold_product.quantity) AS total_ingresado
FROM business.sold_product
JOIN business.sale ON business.sold_product.id_sale = business.sale.number
JOIN administrative.sucursal ON business.sale.id_sucursal = administrative.sucursal.id
GROUP BY sucursal.id
ORDER BY total_ingresado DESC
LIMIT 2;


--top 10 ventas mas grandes en un intervalo de tiempo
CREATE OR REPLACE FUNCTION administrative.top_sales(
    init_param TIMESTAMP,
    end_param TIMESTAMP
) 
RETURNS TABLE(
    numero_factura INTEGER,
    client_name VARCHAR(25),
    client_lastname VARCHAR(25),
    cajero_username VARCHAR(16),
    total MONEY,
    date_extended TIMESTAMP
) AS $$
BEGIN
    RETURN QUERY 
    SELECT 
        business.sale.number AS numero_factura,
        users.client.firstname AS client_name,
        users.client.lastname AS client_lastname,
        administrative.worker.username AS cajero_username,
        SUM(business.sold_product.price_with_discount * business.sold_product.quantity) AS total,
        business.sale.date AS date_extended
    FROM business.sold_product
    JOIN business.sale ON business.sold_product.id_sale = business.sale.number
    LEFT JOIN users.client ON business.sale.id_client = users.client.id
    JOIN administrative.worker ON business.sale.id_cajero = administrative.worker.id
    WHERE business.sale.date BETWEEN init_param AND end_param
    GROUP BY 
        numero_factura, 
        users.client.firstname, 
        users.client.lastname, 
        administrative.worker.username
    ORDER BY total DESC
    LIMIT 10;
END;
$$ LANGUAGE plpgsql;