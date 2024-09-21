GRANT USAGE, CREATE ON SCHEMA administrative TO adminGX;
GRANT USAGE, CREATE ON SCHEMA users TO adminGX;
GRANT USAGE, CREATE ON SCHEMA business TO adminGX;
GRANT USAGE ON SCHEMA storage TO adminGX;

GRANT USAGE, CREATE ON SCHEMA administrative TO cajeroGX;
GRANT USAGE ON SCHEMA users TO cajeroGX;
GRANT UPDATE ON users.card TO cajeroGX;
GRANT INSERT ON users.modification TO cajeroGX;
GRANT USAGE, CREATE ON SCHEMA business TO cajeroGX;
GRANT INSERT, UPDATE ON storage.on_sale TO cajeroGX;

GRANT SELECT ON administrative.worker TO bodegaGX;
GRANT SELECT ON administrative.assigned TO bodegaGX;
GRANT SELECT, INSERT, UPDATE ON business.product TO bodegaGX;
GRANT INSERT, SELECT, CREATE ON storage.stock TO bodegaGX;

GRANT SELECT ON administrative.worker TO inventarioGX;
GRANT SELECT ON administrative.assigned TO inventarioGX;
GRANT SELECT ON business.product TO inventarioGX;
GRANT USAGE, CREATE ON SCHEMA storage TO inventarioGX;

GRANT SELECT ON administrative.worker TO guestGX;
GRANT SELECT ON administrative.assigned TO guestGX;
GRANT SELECT ON administrative.cajero TO guestGX;

GRANT USAGE ON SCHEMA administrative TO guestgx;
--GRANT USAGE ON SCHEMA administrative TO inventariogx;
--GRANT USAGE ON SCHEMA administrative TO bodegagx;

