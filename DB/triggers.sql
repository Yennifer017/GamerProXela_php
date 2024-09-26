--validar los numeros de los checkouts de los cajeros
CREATE OR REPLACE FUNCTION administrative.validate_checkout_in_range()
RETURNS TRIGGER AS $$
DECLARE
    max_value INTEGER;
BEGIN
    SELECT total_checkouts INTO max_value FROM administrative.sucursal WHERE id = NEW.id_sucursal;
    IF NEW.no_checkout < 0 OR NEW.no_checkout > max_value THEN
        RAISE EXCEPTION 'El numero de caja % está fuera del rango permitido (0 - %)', NEW.no_checkout, max_value;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE TRIGGER validate_checkout
BEFORE INSERT OR UPDATE ON administrative.cajero
FOR EACH ROW
EXECUTE FUNCTION administrative.validate_checkout_in_range();


--validar el numero de los halls de los productos
CREATE OR REPLACE FUNCTION storage.validate_hall_in_range()
RETURNS TRIGGER AS $$
DECLARE
    max_value INTEGER;
BEGIN
    SELECT total_halls INTO max_value FROM administrative.sucursal WHERE id = NEW.id_sucursal;
    IF NEW.hall < 0 OR NEW.hall > max_value THEN
        RAISE EXCEPTION 'El pasillo % está fuera del rango permitido (0 - %)', NEW.hall, max_value;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE TRIGGER validate_hall
BEFORE INSERT OR UPDATE ON storage.stock
FOR EACH ROW
EXECUTE FUNCTION storage.validate_hall_in_range();


--validar que no exista un descuento antes
CREATE OR REPLACE FUNCTION administrative.validate_non_exist_discount()
RETURNS TRIGGER AS $$
DECLARE
    max_value INTEGER;
BEGIN
    PERFORM 1 --consulta sin guardar nada
    FROM administrative.discount
    WHERE administrative.discount.id_product = NEW.id_product
    AND administrative.discount.date_end >= CURRENT_DATE;
    IF FOUND THEN
        RAISE EXCEPTION 'Ya hay un descuento activo para este producto.';
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE TRIGGER validate_discount
BEFORE INSERT ON administrative.discount
FOR EACH ROW
EXECUTE FUNCTION administrative.validate_non_exist_discount();