erDiagram

    EMPRESA ||--o{ USUARIO : tiene
    EMPRESA ||--o{ DEPARTAMENTO : organiza
    EMPRESA ||--o{ EMPLEADO : contrata
    EMPRESA ||--o{ PARAMETRO_EMPRESA : configura
    EMPRESA ||--o{ CICLO_PAGO : define
    EMPRESA ||--o{ NOMINA : genera

    USUARIO ||--o{ BITACORA : registra
    USUARIO }o--o{ ROLES : asignado

    DEPARTAMENTO ||--o{ EMPLEADO : agrupa
    CARGO ||--o{ EMPLEADO : define

    EMPLEADO ||--|| CONTRATO : tiene
    EMPLEADO ||--o{ NOMINA_DETALLE : recibe
    EMPLEADO ||--o{ VACACION : solicita
    EMPLEADO ||--o{ PERMISO : solicita
    EMPLEADO ||--o{ PRESTAMO : solicita
    EMPLEADO ||--o{ PRESTACION : acumula
    EMPLEADO ||--o{ LIQUIDACION : finaliza

    CONTRATO ||--o{ HISTORICO_SALARIO : registra

    CICLO_PAGO ||--o{ NOMINA : define

    NOMINA ||--|{ NOMINA_DETALLE : contiene

    NOMINA_DETALLE ||--o{ DETALLE_CONCEPTO : desglosa

    DETALLE_CONCEPTO }o--|| CONCEPTO_NOMINA : define

    CONCEPTO_NOMINA {
        int id PK
        string nombre
        string tipo
        string formula
    }

    CICLO_PAGO {
        int id PK
        int empresa_id FK
        string nombre "semanal/quincenal/mensual"
        int dias
        boolean activo
    }

    EMPLEADO {
        int id PK
        int empresa_id FK
        int departamento_id FK
        int cargo_id FK
        string cedula
        string nombres
        string apellidos
        date fecha_ingreso
        date fecha_retiro
        decimal salario_base
        string estado
    }

    PARAMETRO_EMPRESA {
        int id PK
        int empresa_id FK
        decimal salario_minimo
        decimal ivss_porcentaje
        decimal faov_porcentaje
        decimal rpe_porcentaje
        decimal ut_valor
        date vigencia
    }

    CONTRATO {
        int id PK
        int empleado_id FK
        date inicio
        date fin
    }

    NOMINA {
        int id PK
        int empresa_id FK
        int ciclo_pago_id FK
        date desde
        date hasta
        string tipo
        string estado
    }

    NOMINA_DETALLE {
        int id PK
        int nomina_id FK
        int empleado_id FK
        decimal total_asignaciones
        decimal total_deducciones
        decimal neto
    }

    VACACION {
        int id PK
        int empleado_id FK
        date inicio
        date fin
        int dias
    }

    PERMISO {
        int id PK
        int empleado_id FK
        date fecha
        string tipo
    }

    PRESTAMO {
        int id PK
        int empleado_id FK
        decimal monto
        decimal saldo
    }

    PRESTACION {
        int id PK
        int empleado_id FK
        decimal acumulado
        decimal intereses
    }

    LIQUIDACION {
        int id PK
        int empleado_id FK
        decimal total_pago
        string motivo
        date fecha
    }

    BITACORA {
        int id PK
        int usuario_id FK
        string accion
        datetime fecha
    }