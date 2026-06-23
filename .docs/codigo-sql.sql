CREATE DATABASE IF NOT EXISTS nomina_ve
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE nomina_ve;

-- =========================
-- EMPRESAS
-- =========================
CREATE TABLE empresas (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    razon_social VARCHAR(255),
    rif VARCHAR(50) UNIQUE,
    telefono VARCHAR(50),
    email VARCHAR(150),
    direccion TEXT,
    activo BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- =========================
-- USUARIOS
-- =========================
CREATE TABLE usuarios (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    empresa_id BIGINT UNSIGNED NULL,
    nombre VARCHAR(150),
    email VARCHAR(150) UNIQUE,
    password VARCHAR(255),
    activo BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
);

-- =========================
-- ROLES
-- =========================
CREATE TABLE roles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100)
);

CREATE TABLE role_usuario (
    usuario_id BIGINT UNSIGNED,
    role_id BIGINT UNSIGNED,
    PRIMARY KEY (usuario_id, role_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);

-- =========================
-- DEPARTAMENTOS
-- =========================
CREATE TABLE departamentos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    empresa_id BIGINT UNSIGNED,
    nombre VARCHAR(150),
    FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
);

-- =========================
-- CARGOS
-- =========================
CREATE TABLE cargos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    empresa_id BIGINT UNSIGNED,
    nombre VARCHAR(150),
    descripcion TEXT NULL,
    FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
);

-- =========================
-- EMPLEADOS
-- =========================
CREATE TABLE empleados (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    empresa_id BIGINT UNSIGNED,
    departamento_id BIGINT UNSIGNED NULL,
    cargo_id BIGINT UNSIGNED NULL,

    cedula VARCHAR(20),
    nombres VARCHAR(150),
    apellidos VARCHAR(150),

    fecha_ingreso DATE,
    fecha_retiro DATE NULL,

    salario_base DECIMAL(12,2) DEFAULT 0,
    estado ENUM('activo','suspendido','egresado') DEFAULT 'activo',

    FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE,
    FOREIGN KEY (departamento_id) REFERENCES departamentos(id),
    FOREIGN KEY (cargo_id) REFERENCES cargos(id)
);

-- =========================
-- CICLOS DE PAGO (NUEVO)
-- =========================
CREATE TABLE ciclos_pago (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    empresa_id BIGINT UNSIGNED,
    nombre VARCHAR(50),
    dias INT,
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE
);

-- =========================
-- NOMINAS
-- =========================
CREATE TABLE nominas (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    empresa_id BIGINT UNSIGNED,
    ciclo_pago_id BIGINT UNSIGNED NULL,

    desde DATE,
    hasta DATE,

    tipo ENUM('regular','vacaciones','utilidades','liquidacion'),
    estado ENUM('borrador','cerrada','pagada') DEFAULT 'borrador',

    FOREIGN KEY (empresa_id) REFERENCES empresas(id) ON DELETE CASCADE,
    FOREIGN KEY (ciclo_pago_id) REFERENCES ciclos_pago(id)
);

-- =========================
-- DETALLE NOMINA
-- =========================
CREATE TABLE nomina_detalles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nomina_id BIGINT UNSIGNED,
    empleado_id BIGINT UNSIGNED,
    total_asignaciones DECIMAL(12,2),
    total_deducciones DECIMAL(12,2),
    neto DECIMAL(12,2),

    FOREIGN KEY (nomina_id) REFERENCES nominas(id) ON DELETE CASCADE,
    FOREIGN KEY (empleado_id) REFERENCES empleados(id) ON DELETE CASCADE
);

-- =========================
-- CONCEPTOS
-- =========================
CREATE TABLE conceptos_nomina (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150),
    tipo ENUM('asignacion','deduccion'),
    formula TEXT NULL
);

CREATE TABLE detalle_conceptos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nomina_detalle_id BIGINT UNSIGNED,
    concepto_nomina_id BIGINT UNSIGNED,
    monto DECIMAL(12,2),

    FOREIGN KEY (nomina_detalle_id) REFERENCES nomina_detalles(id) ON DELETE CASCADE,
    FOREIGN KEY (concepto_nomina_id) REFERENCES conceptos_nomina(id)
);

-- =========================
-- VACACIONES
-- =========================
CREATE TABLE vacaciones (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    empleado_id BIGINT UNSIGNED,
    inicio DATE,
    fin DATE,
    dias INT,
    FOREIGN KEY (empleado_id) REFERENCES empleados(id) ON DELETE CASCADE
);

-- =========================
-- PERMISOS
-- =========================
CREATE TABLE permisos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    empleado_id BIGINT UNSIGNED,
    fecha DATE,
    tipo VARCHAR(100),
    FOREIGN KEY (empleado_id) REFERENCES empleados(id) ON DELETE CASCADE
);

-- =========================
-- PRESTAMOS
-- =========================
CREATE TABLE prestamos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    empleado_id BIGINT UNSIGNED,
    monto DECIMAL(12,2),
    saldo DECIMAL(12,2),
    FOREIGN KEY (empleado_id) REFERENCES empleados(id) ON DELETE CASCADE
);

-- =========================
-- PRESTACIONES
-- =========================
CREATE TABLE prestaciones (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    empleado_id BIGINT UNSIGNED,
    acumulado DECIMAL(12,2),
    intereses DECIMAL(12,2),
    FOREIGN KEY (empleado_id) REFERENCES empleados(id) ON DELETE CASCADE
);

-- =========================
-- LIQUIDACIONES
-- =========================
CREATE TABLE liquidaciones (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    empleado_id BIGINT UNSIGNED,
    motivo VARCHAR(150),
    total_pago DECIMAL(12,2),
    fecha DATE,
    FOREIGN KEY (empleado_id) REFERENCES empleados(id) ON DELETE CASCADE
);

-- =========================
-- BITACORA
-- =========================
CREATE TABLE bitacora (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id BIGINT UNSIGNED,
    accion TEXT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- INDEXES
CREATE INDEX idx_emp_empresa ON empleados(empresa_id);
CREATE INDEX idx_nom_empresa ON nominas(empresa_id);