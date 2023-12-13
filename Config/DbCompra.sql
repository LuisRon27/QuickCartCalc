CREATE DATABASE IF NOT EXISTS QuickCartCalc;

USE QuickCartCalc;

CREATE TABLE Compras (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Producto TEXT NOT NULL,
    Cantidad INT NOT NULL CHECK (Cantidad > 0),
    Precio DECIMAL(18,2) NOT NULL CHECK (Precio > 0),
    Subtotal DECIMAL(18,2),
    Fecha DATE
);
