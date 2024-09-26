sudo -u postgres psql -f creation.sql
sudo -u postgres psql -d gamer_pro_xela -f database.sql
sudo -u postgres psql -d gamer_pro_xela -f functions.sql
sudo -u postgres psql -d gamer_pro_xela -f triggers.sql
sudo -u postgres psql -d gamer_pro_xela -f initial-data.sql
sudo -u postgres psql -d gamer_pro_xela -f workers.sql
sudo -u postgres psql -d gamer_pro_xela -f products.sql
sudo -u postgres psql -d gamer_pro_xela -f inventory.sql
sudo -u postgres psql -d gamer_pro_xela -f clients.sql 
sudo -u postgres psql -d gamer_pro_xela -f functionsReports.sql
sudo -u postgres psql -d gamer_pro_xela -f permissions.sql







