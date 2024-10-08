--admin permissons
GRANT USAGE, CREATE ON SCHEMA administrative TO adminGX;
GRANT USAGE, CREATE ON SCHEMA users TO adminGX;
GRANT USAGE, CREATE ON SCHEMA business TO adminGX;
GRANT USAGE ON SCHEMA storage TO adminGX;
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA administrative TO admingx;
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA users TO admingx;
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA business TO admingx;
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA administrative TO admingx;
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA users TO admingx;
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA business TO admingx;

GRANT SELECT ON administrative.top_products TO admingx;
GRANT SELECT ON administrative.top_clients TO admingx;
GRANT SELECT ON administrative.top_sucursales TO admingx;


--cajero permissons
GRANT USAGE, CREATE ON SCHEMA administrative TO cajeroGX;
GRANT SELECT, INSERT, UPDATE, REFERENCES, TRIGGER ON ALL TABLES IN SCHEMA administrative TO cajerogx;

GRANT USAGE ON SCHEMA users TO cajeroGX;
GRANT SELECT, INSERT, TRIGGER ON ALL TABLES IN SCHEMA users TO cajerogx;
GRANT USAGE, SELECT, UPDATE ON SEQUENCE users.modification_id_seq TO cajerogx;

GRANT UPDATE ON users.card TO cajeroGX;
GRANT INSERT ON users.modification TO cajeroGX;
GRANT USAGE, CREATE ON SCHEMA business TO cajeroGX;
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA business TO cajerogx;
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA business TO cajerogx;
GRANT SELECT ON business.product TO cajerogx;
GRANT USAGE, CREATE ON SCHEMA storage TO cajerogx;
GRANT ALL PRIVILEGES ON storage.on_sale TO cajerogx;

--bodega permissons
GRANT USAGE ON SCHEMA storage TO bodegagx;
GRANT USAGE ON SCHEMA administrative TO bodegagx;
GRANT USAGE ON SCHEMA business TO bodegagx;
GRANT SELECT ON business.product TO bodegagx;
GRANT SELECT ON administrative.worker TO bodegagX;
GRANT SELECT ON administrative.assigned TO bodegagX;
GRANT SELECT ON administrative.sucursal TO bodegagX;
GRANT SELECT, INSERT, UPDATE ON business.product TO bodegaGX;
GRANT INSERT, SELECT, UPDATE ON storage.stock TO bodegaGX;

--inventary permissons
GRANT USAGE ON SCHEMA administrative TO inventarioGX;
GRANT USAGE ON SCHEMA business TO inventarioGX;
GRANT SELECT ON administrative.sucursal TO inventariogx;
GRANT SELECT ON administrative.worker TO inventarioGX;
GRANT SELECT ON administrative.assigned TO inventarioGX;
GRANT SELECT ON business.product TO inventarioGX;
GRANT USAGE, CREATE ON SCHEMA storage TO inventarioGX;
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA storage TO inventariogx;

--guest permissons
GRANT SELECT ON administrative.worker TO guestGX;
GRANT SELECT ON administrative.assigned TO guestGX;
GRANT SELECT ON administrative.cajero TO guestGX;

GRANT USAGE ON SCHEMA administrative TO guestgx;
--GRANT USAGE ON SCHEMA administrative TO inventariogx;
--GRANT USAGE ON SCHEMA administrative TO bodegagx;

