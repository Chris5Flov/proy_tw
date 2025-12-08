
<?php
session_start();
if (!isset($_SESSION["id_rol"]) || $_SESSION["id_rol"] !== 1) {
    header("Location: ../login/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Vault - Administrador</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body>

    <nav class="navbar">
        <div class="brand">
            <img src="../../assets/logo.png" alt="Logo" style="height: 30px;">
            Track Vault Admin
        </div>
        <div class="user-menu">
            <span>Hola, Admin</span>
            <a href="../login/login.php" class="btn btn-outline btn-sm">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
    </nav>

    <div class="container">
        
        <div class="card text-center">
            <h3>Bienvenido administrador</h3>
            <p class="text-muted">Gestiona los recursos y archivos de soporte para programadores.</p>
        </div>

        <div class="row">
            
            <div class="col-left">
                <div class="card">
                    <h5>Gestionar Recurso</h5>
                    
                    <form id="resource-form">
                        <input type="hidden" id="resourceId">
                        
                        <div class="form-group">
                            <label>Nombre del Recurso</label>
                            <input type="text" id="nombre" class="form-control" placeholder="Ej. Manual Java" required>
                        </div>

                        <div class="form-group">
                            <label>Autor o Empresa</label>
                            <input type="text" id="autor_o_empresa" class="form-control" placeholder="Ej. Oracle" required>
                        </div>

                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea id="descripcion" class="form-control" rows="3" placeholder="Detalles..."></textarea>
                        </div>

                        <div class="form-group">
                            <label>Tipo</label>
                            <select id="tipo" class="form-control">
                                <option value="PDF">PDF</option>
                                <option value="XML">XML</option>
                                <option value="JSON">JSON</option>
                                <option value="EXE">EXE</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Ruta del Archivo</label>
                            <input type="text" id="ruta_archivo" class="form-control" placeholder="uploads/archivo.pdf">
                        </div>

                        <button type="submit" class="btn btn-success btn-block">Agregar</button>
                        <button type="button" id="btn-cancel" class="btn btn-warning btn-block" style="display:none;">Cancelar</button>
                    </form>
                </div>
            </div>

            <div class="col-right">
                <div class="card">
                    <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="search" class="form-control search-input" placeholder="Buscar elemento...">
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Autor</th>
                                    <th>Tipo</th>
                                    <th style="text-align: center;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="resources-list">
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card dashboard-card">
            <h3>Dashboard de Recursos en Track Vault</h3>
                <div class="metric-card metric-total-card">
                    <h4>Total de Recursos</h4>
                    <p id="metric-total" class="metric-value">No hay archivos actualmente</p>
                </div>
            <div class="dashboard-charts">
                <div class="metric-card">
                    <h4>Tipos Más Comunes</h4>
                    <canvas id="chartTipos"></canvas>
                </div>

                <div class="metric-card">
                    <h4>Autores Principales</h4>
                    <canvas id="chartAutores"></canvas>
                </div>
             </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="admin-app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
