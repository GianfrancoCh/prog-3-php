-- 1. Obtener los detalles completos de todos los usuarios, ordenados alfabéticamente.
SELECT * FROM usuarios ORDER BY nombre ASC

-- 2. Obtener los detalles completos de todos los productos líquidos.

SELECT * FROM productos WHERE tipo = 'liquido';

--3. Obtener todas las compras en los cuales la cantidad esté entre 6 y 10 inclusive.

SELECT * FROM ventas WHERE cantidad >= 6 && cantidad <= 10

--4. Obtener la cantidad total de todos los productos vendidos.

SELECT SUM(cantidad) FROM ventas;

--5. Mostrar los primeros 3 números de productos que se han enviado.

SELECT id FROM productos ORDER BY fecha_de_creacion LIMIT 3

--6. Mostrar los nombres del usuario y los nombres de los productos de cada venta.

SELECT usuarios.nombre AS nombre_usuario, productos.nombre AS nombre_producto 
FROM ventas 
JOIN usuarios ON ventas.id_usuario = usuarios.id 
JOIN productos ON ventas.id_producto = productos.id;

--7. Indicar el monto (cantidad * precio) por cada una de las ventas.

SELECT productos.nombre AS nombre_producto, ventas.cantidad, productos.precio, (ventas.cantidad * productos.precio) AS monto 
FROM ventas JOIN productos ON ventas.id_producto = productos.id;

--8 Obtener la cantidad total del producto 1003 vendido por el usuario 104.

SELECT SUM(cantidad), usuarios.id, productos.id, ventas.cantidad, productos.precio, (ventas.cantidad * productos.precio) AS monto 
FROM ventas 
JOIN productos ON ventas.id_producto = productos.id 
JOIN usuarios ON ventas.id_usuario = usuarios.id 
WHERE id_usuario = '104' && id_producto = '1003';


--9 Obtener todos los números de los productos vendidos por algún usuario de ‘Avellaneda’.

SELECT usuarios.id as id_usuario, usuarios.localidad as localidad, productos.id as id_producto, ventas.cantidad, productos.precio 
FROM ventas 
JOIN productos ON ventas.id_producto = productos.id 
JOIN usuarios ON ventas.id_usuario = usuarios.id 
WHERE localidad = 'Avellaneda';

--10. Obtener los datos completos de los usuarios cuyos nombres contengan la letra ‘u’.

SELECT * FROM usuarios
WHERE nombre LIKE '%u%';

--11. Traer las ventas entre junio del 2020 y febrero 2021.

SELECT * FROM ventas WHERE fecha_de_venta BETWEEN '2020-06-01' AND '2021-02-31';

--12. Obtener los usuarios registrados antes del 2021.

SELECT * FROM usuarios WHERE fecha_de_registro < '2021-01-01';

--13.Agregar el producto llamado ‘Chocolate’, de tipo Sólido y con un precio de 25,35.

INSERT INTO productos (id, codigo_de_barra, nombre, tipo, stock, precio, fecha_de_creacion, fecha_de_modificacion)
VALUES (1011,77922332,"Chocolate","solido",20,25.35,"2024-05-26","2024-05-26");

--14.Insertar un nuevo usuario.

INSERT INTO usuarios (id, nombre, apellido, clave, mail, fecha_de_registro, localidad) 
VALUES (107,"Gianfranco","Chiarizia",1234,"gian@test.com","2024-05-26","Lanus");

--15.Cambiar los precios de los productos de tipo sólido a 66,60.

UPDATE productos SET precio = 66.60 WHERE tipo = "solido";

--16.Cambiar el stock a 0 de todos los productos cuyas cantidades de stock sean menores a 20 inclusive.

UPDATE productos SET stock = 0 WHERE stock <= 20;

--17.Eliminar el producto número 1010.


DELETE FROM productos WHERE id = 1010;

--18.Eliminar a todos los usuarios que no han vendido productos.

DELETE FROM usuarios WHERE id NOT IN (SELECT DISTINCT id_usuario FROM ventas);
