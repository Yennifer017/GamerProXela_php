--This document creates some sales in the diferents sucursals

--sucursal 1
SELECT business.save_sale(111111111, 1, 2, ARRAY[1,2,10], ARRAY[2, 1, 1]);
SELECT business.save_sale(111111111, 1, 3, ARRAY[1, 10], ARRAY[1, 2]);
SELECT business.save_sale(111111113, 1, 4, ARRAY[8], ARRAY[3]);
SELECT business.save_sale(111111117, 1, 5, ARRAY[15], ARRAY[1]);
SELECT business.save_sale(111111118, 1, 6, ARRAY[1,2], ARRAY[1, 1]);


--sucursal 2
SELECT business.save_sale(111111112, 2, 12, ARRAY[118,170], ARRAY[2, 1]);
SELECT business.save_sale(111111117, 2, 13, ARRAY[140,105], ARRAY[2, 3]);
SELECT business.save_sale(111111111, 2, 14, ARRAY[150,151,152], ARRAY[1, 1, 1]);
SELECT business.save_sale(111111113, 2, 15, ARRAY[147], ARRAY[5]);
SELECT business.save_sale(NULL, 2, 16, ARRAY[147], ARRAY[2]);

--sucursal 3
SELECT business.save_sale(111111113, 3, 23, ARRAY[198], ARRAY[3]);
SELECT business.save_sale(111111113, 3, 23, ARRAY[202], ARRAY[1]);
SELECT business.save_sale(111111117, 3, 24, ARRAY[202], ARRAY[1]);
SELECT business.save_sale(111111111, 3, 24, ARRAY[205], ARRAY[1]);
SELECT business.save_sale(111111112, 3, 24, ARRAY[205], ARRAY[1]);