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