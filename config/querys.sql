-- Crear la tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,                                                      -- ID único y autoincremental
    rol_usuario VARCHAR(255),                                                                       -- Rol del usuario
    foto_usuario VARCHAR(255),                                                                      -- URL de la foto del usuario
    nombre_usuario VARCHAR(255),                                                                    -- Nombre del usuario
    username_usuario VARCHAR(255),                                                                  -- Nombre de usuario único
    password_usuario VARCHAR(255),                                                                  -- Contraseña del usuario
    email_usuario VARCHAR(255),                                                                     -- Correo electrónico del usuario
    pais_usuario VARCHAR(255),                                                                      -- País del usuario
    ciudad_usuario VARCHAR(255),                                                                    -- Ciudad del usuario
    telefono_usuario VARCHAR(15),                                                                   -- Número de teléfono del usuario
    direccion_usuario VARCHAR(255),                                                                 -- Dirección del usuario
    departamento_usuario VARCHAR(255),                                                              -- Departamento del usuario
    puesto_usuario VARCHAR(255),                                                                    -- Puesto del usuario
    token_usuario VARCHAR(255),                                                                     -- Token de autenticación
    token_exp_usuario DATETIME,                                                                     -- Fecha de expiración del token
    password_temporal_usuario VARCHAR(255),                                                         -- Contraseña temporal para restablecimiento
    metodo_usuario VARCHAR(255),                                                                    -- Método de autenticación
    verificacion_usuario BOOLEAN,                                                                   -- Estado de verificación del usuario
    essuper_usuario BOOLEAN,                                                                        -- Indicador de superusuario
    direccion_area_usuario VARCHAR(255),                                                            -- Dirección del área del usuario
    fecha_creacion_usuario DATETIME DEFAULT CURRENT_TIMESTAMP,                                      -- Fecha y hora de creación
    fecha_actualizacion_usuario TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP     -- Fecha y hora de última actualización
);

-- Crear la tabla de paginas
CREATE TABLE IF NOT EXISTS paginas (
    id_pagina INT AUTO_INCREMENT PRIMARY KEY,   -- Identificador único de la página, autoincremental
    orden_pagina INT,                           -- Orden de la página
    nombre_pagina VARCHAR(255),                 -- Nombre de la página
    urlpagina_pagina VARCHAR(255),              -- URL de la página
    clase_pagina VARCHAR(255),                  -- Clase asociada a la página (puede ser útil para estilos)
    id_parent_pagina INT,                       -- Identificador de la página padre (si tiene)
    catalogo_pagina INT                         -- Identificador del catálogo al que pertenece la página
);

-- Crear tabla documentos
CREATE TABLE IF NOT EXISTS documents (
    id_document INT AUTO_INCREMENT PRIMARY KEY,                 -- Identificador único y autoincrementable para cada documento.
    name_document VARCHAR(255),                                 -- Nombre del documento.
    route_document VARCHAR(255),                                -- Ruta del documento.
    archive_document VARCHAR(255),                              -- Archivo del documento (puede ser el nombre del archivo o la ruta relativa/absoluta).
    creationdate_document TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Fecha de creación del documento, con un valor predeterminado que se establece automáticamente al insertar un nuevo registro.
    usercreation_document VARCHAR(255)                          -- Usuario que creó el documento (puede ser el nombre del usuario o el ID del usuario).
);

