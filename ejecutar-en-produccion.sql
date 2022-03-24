update items set unidad = 1 where unidad = 'Unidades' or unidad = 'unidades';
update items set unidad = 2 where unidad = 'Cajas' or unidad = 'cajas';
update items set unidad = 3 where unidad = 'Litros' or unidad = 'litros';
update items set unidad = 4 where unidad = 'Kilogramos' or unidad = 'kilogramos';
update items set unidad = 5 where unidad = 'Gramos' or unidad = 'gramos';
update items set unidad = 6 where unidad = 'Metros' or unidad = 'metros';
update items set unidad = 7 where unidad = 'Centimetros' or unidad = 'centimetros';
update items set unidad = 8 where unidad = 'm2' or unidad = 'M2';
update items set unidad = 9 where unidad = 'm3' or unidad = 'M3';
update procesos set preferencia_pago = '1' where preferencia_pago = 'Efectivo';
update procesos set preferencia_pago = '2' where preferencia_pago = 'Transferencia';
update procesos set preferencia_pago = '3' where preferencia_pago = 'Tarjeta Crédito';
update procesos set preferencia_pago = '4' where preferencia_pago = 'Cheque al Día';
update procesos set preferencia_pago = '5' where preferencia_pago = 'Cheque Pago Diferido';

