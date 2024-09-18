INSERT INTO administrative.worker(id, rol, username, password) VALUES
(34, 'cajero', 'cajero_1', 'd6817717e805ae7ff2b5bbf3d8c490c49d408295'),
(2, 'cajero', 'cajero_2', '7c82b1c5c5058dd0a5b6eecdd17f08bc6ca9ade3'),
(3, 'cajero', 'cajero_3', '99368b49c2a9541327c84211d479086420923e32'),
(4, 'cajero', 'cajero_4', '53255882ff7bf647d65330aaa3e714969c0eaee2'),
(5, 'cajero', 'cajero_5', '10c85e750ed0dfcdac09b2d11c9b9e30290ff36a'),
(6, 'cajero', 'cajero_6', 'edb0f62d8cf5990e0887619176910f6f18a4a005');
INSERT INTO administrative.cajero(id_worker, id_sucursal, no_checkout) VALUES
(34, 1, 1),
(2, 1, 1),
(3, 1, 4),
(4, 1, 3),
(5, 1, 3),
(6, 1, 4);


INSERT INTO administrative.worker(id, rol, username, password) VALUES
(7, 'inventario', 'inventario_7', '68fe00d4b0fdba626f7e183fc4c747d33b5f9c78'),
(8, 'inventario', 'inventario_8', 'ad9e7da03ea6569d87326e191bc3c93366ccc0fc'),
(9, 'inventario', 'inventario_9', 'eac8bd5c552f16edf60aad4366e8b2d76b0e9fe1'),
(10, 'inventario', 'inventario_10', 'ac124ae6845dbb072833a02510aad8e66ccbc80c');
INSERT INTO administrative.assigned(id_worker, id_sucursal) VALUES
(7, 1),
(8, 1),
(9, 1),
(10, 1);


INSERT INTO administrative.worker(id, rol, username, password) VALUES
(11, 'bodega', 'bodega_11', '603958ca620bac3decc22faf8b52c456c65c5579');
INSERT INTO administrative.assigned(id_worker, id_sucursal) VALUES
(11, 1);


INSERT INTO administrative.worker(id, rol, username, password) VALUES
(12, 'cajero', 'cajero_12', '7c82b1c5c5058dd0a5b6eecdd17f08bc6ca9ade3'),
(13, 'cajero', 'cajero_13', '99368b49c2a9541327c84211d479086420923e32'),
(14, 'cajero', 'cajero_14', '53255882ff7bf647d65330aaa3e714969c0eaee2'),
(15, 'cajero', 'cajero_15', '10c85e750ed0dfcdac09b2d11c9b9e30290ff36a'),
(16, 'cajero', 'cajero_16', 'edb0f62d8cf5990e0887619176910f6f18a4a005'),
(17, 'cajero', 'cajero_17', '0efe8d2e50858f7f91ed1b5794a112af5feeb817');
INSERT INTO administrative.cajero(id_worker, id_sucursal, no_checkout) VALUES
(12, 2, 4),
(13, 2, 2),
(14, 2, 4),
(15, 2, 4),
(16, 2, 2),
(17, 2, 2);


INSERT INTO administrative.worker(id, rol, username, password) VALUES
(18, 'inventario', 'inventario_18', 'ad9e7da03ea6569d87326e191bc3c93366ccc0fc'),
(19, 'inventario', 'inventario_19', 'eac8bd5c552f16edf60aad4366e8b2d76b0e9fe1'),
(20, 'inventario', 'inventario_20', 'ac124ae6845dbb072833a02510aad8e66ccbc80c'),
(21, 'inventario', 'inventario_21', 'ed47640210070e76525ecedcb7e3927d462945fa');
INSERT INTO administrative.assigned(id_worker, id_sucursal) VALUES
(18, 2),
(19, 2),
(20, 2),
(21, 2);


INSERT INTO administrative.worker(id, rol, username, password) VALUES
(22, 'bodega', 'bodega_22', '2e0de29aed3100acc5a4919a8cdbb273fdfc7033');
INSERT INTO administrative.assigned(id_worker, id_sucursal) VALUES
(22, 2);


INSERT INTO administrative.worker(id, rol, username, password) VALUES
(23, 'cajero', 'cajero_23', '99368b49c2a9541327c84211d479086420923e32'),
(24, 'cajero', 'cajero_24', '53255882ff7bf647d65330aaa3e714969c0eaee2'),
(25, 'cajero', 'cajero_25', '10c85e750ed0dfcdac09b2d11c9b9e30290ff36a'),
(26, 'cajero', 'cajero_26', 'edb0f62d8cf5990e0887619176910f6f18a4a005'),
(27, 'cajero', 'cajero_27', '0efe8d2e50858f7f91ed1b5794a112af5feeb817'),
(28, 'cajero', 'cajero_28', '188850b19cb5fc8a4da29724346f6ec7902ac7ad');
INSERT INTO administrative.cajero(id_worker, id_sucursal, no_checkout) VALUES
(23, 3, 4),
(24, 3, 4),
(25, 3, 2),
(26, 3, 5),
(27, 3, 1),
(28, 3, 1);


INSERT INTO administrative.worker(id, rol, username, password) VALUES
(29, 'inventario', 'inventario_29', 'eac8bd5c552f16edf60aad4366e8b2d76b0e9fe1'),
(30, 'inventario', 'inventario_30', 'ac124ae6845dbb072833a02510aad8e66ccbc80c'),
(31, 'inventario', 'inventario_31', 'ed47640210070e76525ecedcb7e3927d462945fa'),
(32, 'inventario', 'inventario_32', '55b74fcaef116619f0833d8e5adddaf49451bfca');
INSERT INTO administrative.assigned(id_worker, id_sucursal) VALUES
(29, 3),
(30, 3),
(31, 3),
(32, 3);


INSERT INTO administrative.worker(id, rol, username, password) VALUES
(33, 'bodega', 'bodega_33', '764ad51495499ef10daa2d7f3efa422533d89f61');
INSERT INTO administrative.assigned(id_worker, id_sucursal) VALUES
(33, 3);


