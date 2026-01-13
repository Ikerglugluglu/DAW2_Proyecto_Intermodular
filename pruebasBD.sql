USE restaurante_durums;

-- ========================================
-- 1️⃣ LIMPIAR DATOS DE PRUEBA
-- ========================================
DELETE FROM order_items;
DELETE FROM orders;
DELETE FROM cart_items;
DELETE FROM cart;
DELETE FROM reservations;
DELETE FROM addresses;
DELETE FROM products;
DELETE FROM categories;
DELETE FROM users;
DELETE FROM restaurant_tables;

-- ========================================
-- 2️⃣ INSERT VALIDOS
-- ========================================

-- Usuario
INSERT INTO users (nombre,email,password,rol)
VALUES ('Test User','test@user.com','1234','cliente');

-- Categorías y Productos
INSERT INTO categories (nombre, descripcion) VALUES ('Test Cat','Categoría de prueba');
INSERT INTO products (category_id, nombre, precio) VALUES (1,'Producto Test',10.50);

-- Mesas
INSERT INTO restaurant_tables (numero, capacidad) VALUES (1,4);

-- Direcciones
INSERT INTO addresses (user_id,direccion,ciudad,cp,telefono)
VALUES (1,'Calle Test 123','Ciudad Test','00000','123456789');

-- Carrito y items
INSERT INTO cart (user_id) VALUES (1);
INSERT INTO cart_items (cart_id, product_id, cantidad) VALUES (1,1,2);

-- Pedidos y items
INSERT INTO orders (user_id,tipo_pedido,total,mesa_id,direccion_id)
VALUES (1,'domicilio',21.00,NULL,1);

INSERT INTO order_items (order_id, product_id, cantidad, precio_unitario)
VALUES (1,1,2,10.50);

-- Reservas
INSERT INTO reservations (user_id, table_id, fecha, hora, personas)
VALUES (1,1,'2026-01-07','12:00:00',2);

-- ========================================
-- 3️⃣ INSERT INVALIDOS (deben fallar)
-- ========================================

-- Cart con usuario inexistente
INSERT INTO cart (user_id) VALUES (999); -- ERROR esperado

-- Cart item con producto inexistente
INSERT INTO cart_items (cart_id, product_id, cantidad) VALUES (1,999,1); -- ERROR esperado

-- Order con usuario inexistente
INSERT INTO orders (user_id,tipo_pedido,total) VALUES (999,'domicilio',0); -- ERROR esperado

-- Order item con producto inexistente
INSERT INTO order_items (order_id, product_id, cantidad, precio_unitario)
VALUES (1,999,1,10.5); -- ERROR esperado

-- Reserva con mesa inexistente
INSERT INTO reservations (user_id, table_id, fecha, hora, personas)
VALUES (1,999,'2026-01-07','12:00:00',2); -- ERROR esperado

-- Address con usuario inexistente
INSERT INTO addresses (user_id,direccion,ciudad,cp,telefono)
VALUES (999,'Calle Fantasma','Ciudad','00000','000000000'); -- ERROR esperado

-- ========================================
-- 4️⃣ DELETE y prueba de ON DELETE
-- ========================================

-- DELETE CASCADE: borrar usuario debe borrar carrito y direcciones
DELETE FROM users WHERE id = 1;

SELECT * FROM cart; -- Debe estar vacío
SELECT * FROM addresses; -- Debe estar vacío

-- DELETE RESTRICT: producto con pedido no se puede borrar
DELETE FROM products WHERE id = 1; -- Debe fallar

-- DELETE CASCADE: borrar pedido debe borrar order_items
DELETE FROM orders WHERE id = 1;
SELECT * FROM order_items; -- Debe estar vacío

-- ========================================
-- 5️⃣ UPDATE y prueba de ON UPDATE CASCADE
-- ========================================

-- Cambiar id de categoría (si tu FK usa ON UPDATE CASCADE)
UPDATE categories SET id = 1 WHERE id = 1;
SELECT * FROM products; -- Debe reflejar el nuevo category_id

-- ========================================
-- 6️⃣ Mensaje final
-- ========================================
SELECT 'Pruebas de FK completadas. Revise errores esperados para INSERT inválidos y restricción RESTRICT' AS mensaje;

