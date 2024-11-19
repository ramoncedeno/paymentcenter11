https://laravel.com/docs/11.x/releases
- composer create-project laravel/laravel:^11.0 NameProject
- config bdd DB_CONNECTION=mysql .env

https://laravel.com/docs/11.x/starter-kits
- composer require laravel/breeze --dev / Livewire / Pest
- php artisan breeze:install
- php artisan migrate
- npm install
- npm run build



https://laravel-auditing.com/
- composer require owen-it/laravel-auditing
- php artisan vendor:publish --provider "OwenIt\Auditing\AuditingServiceProvider" --tag="config"
- php artisan vendor:publish --provider "OwenIt\Auditing\AuditingServiceProvider" --tag="migrations"
- php artisan migrate


https://laravel.com/docs/11.x/telescope
- composer require laravel/telescope
- php artisan telescope:install
- php artisan migrate


https://docs.laravel-excel.com/3.1/getting-started/
- composer require maatwebsite/excel
- php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config


- Export:
    - php artisan make:export UsersExport --model=User
    - php artisan make:controller UsersController 

 
- Import:
    - php artisan make:import UsersImport --model=User
     - Maatwebsite\Excel\Concerns\WithHeadingRow; // use WithHeadingRow at  UsersImport  ; https://docs.laravel-excel.com/3.1/imports/heading-row.html

Form Import:  

    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit">Importar</button>
    </form>


![alt text](image-3.png)

Command clear queue: php artisan optimize:clear


// Import Users

flowchart TD
    A[Archivo Excel/CSV] -->|Upload| B[Request HTTP]
    B -->|Validación| C[Controller]
    C -->|Inicia importación| D[Import Class]
    
    subgraph Proceso de Importación
        D -->|Lee filas| E[Chunk de datos]
        E -->|Por cada fila| F[Model/Collection]
        F -->|Validación| G{¿Datos válidos?}
        G -->|Sí| H[Inserción en DB]
        G -->|No| I[Log de errores]
    end
    
    H -->|Transacción completada| J[Base de datos]
    I -->|Registro de errores| K[Reporte de errores]
