/*
 *	Init the program with necesary data
 */
INSERT INTO administrative.card_category (id, type, points, to_upgrade) VALUES
	(1, 'Comun', 5, 0),
	(2, 'Oro', 10, 10000.00),
	(3, 'Platino', 20, 20000.00),
	(4, 'Diamante', 30, 30000.00)
;
INSERT INTO administrative.worker(rol, username, password) VALUES (
	'admin', 'admin', '958d58b12081fa933ecad6d41742736237604f4e' --password: admin
);
INSERT INTO administrative.sucursal(id, name, total_checkouts, total_halls) VALUES
	(1, 'Parque', 20, 20),
	(2, 'Centro1', 18, 20),
	(3, 'Centro2', 15, 15)
;

