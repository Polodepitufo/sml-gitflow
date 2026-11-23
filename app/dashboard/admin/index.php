<?php
require_once __DIR__ . '/../../session.php';
require_once __DIR__ . '/../../router.php';

// ERROR INTENCIONADO PARA PRACTICAR UN HOTFIX:
// Esta excepción detiene la página antes de generar el HTML y deja el dashboard inaccesible.
// HOTFIX: eliminar o comentar la siguiente línea para recuperar el panel.
throw new RuntimeException('Error intencionado de demostración: dashboard fuera de servicio.');
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SML · Panel de administración</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
    :root { --sml-primary: #3346a8; }
    body { background: #f4f6fb; color: #202b43; }
    .sidebar { background: #172342; }
    .brand { letter-spacing: .12em; }
    .sidebar .nav-link { color: #c5cde1; border-radius: .65rem; padding: .85rem 1rem; }
    .sidebar .nav-link:hover, .sidebar .nav-link.active { background: #33446a; color: white; }
    .card { border: 1px solid #e6eaf2; border-radius: 1rem; box-shadow: 0 3px 12px #17234205; }
    .stat-icon { display: grid; place-items: center; width: 2.8rem; height: 2.8rem; border-radius: .8rem; background: #eef0ff; color: var(--sml-primary); font-size: 1.3rem; }
    .btn-primary { --bs-btn-bg: #3346a8; --bs-btn-border-color: #3346a8; --bs-btn-hover-bg: #293986; --bs-btn-hover-border-color: #293986; }
    .table > :not(caption) > * > * { padding: 1rem; }
    .table th { background: #f8f9fc; color: #606c82; font-size: .8rem; font-weight: 600; }
    .avatar { display: inline-grid; place-items: center; width: 2.4rem; height: 2.4rem; border-radius: 50%; background: #eef0ff; color: #3346a8; font-size: .8rem; font-weight: 600; }
    .upload-box { background: #f8f9fe; border: 2px dashed #cbd2e8; border-radius: .8rem; padding: 1.5rem; }
    .text-muted { color: #667085 !important; }
    @media (min-width: 992px) { .sidebar { position: sticky; top: 0; min-height: 100vh; } }
  </style>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <aside class="sidebar col-lg-2 p-3 p-xl-4">
      <a class="brand h3 text-white text-decoration-none d-block mb-1" href="#resumen">SML<span class="text-info">.</span></a>
      <p class="small text-white-50 mb-4">Administración académica</p>
      <nav class="nav flex-row flex-lg-column gap-2" aria-label="Navegación principal">
        <a class="nav-link active" href="#resumen" aria-current="page">Resumen</a>
        <a class="nav-link" href="#subir-tema">Subir tema</a>
        <a class="nav-link" href="#apuntes">Ver apuntes</a>
        <a class="nav-link" href="#alumnos">Ver alumnos</a>
      </nav>
      <div class="mt-4 pt-4 border-top border-secondary small text-white-50">Espacio de gestión<br><span class="text-white">Curso 2026 / 2027</span></div>
    </aside>
    <main class="col-lg-10 px-3 px-md-4 px-xl-5 py-4" id="resumen">
      <header class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div><p class="small text-muted mb-1">SML / Administración</p><h1 class="h3 mb-1">Panel de administración</h1><p class="text-muted mb-0">Gestiona el contenido y acompaña a tus alumnos.</p></div>
        <form method="post" action="/app/logout.php" class="m-0">
          <button type="submit" class="btn btn-outline-danger">Salir</button>
        </form>
      </header>
      <div class="alert alert-primary d-flex align-items-center gap-2" role="note"><span><strong>Vista de demostración.</strong> Los datos son de ejemplo y los cambios no se guardan.</span></div>
      <section class="row g-3 mb-4" aria-label="Resumen del curso">
        <div class="col-sm-6 col-xl-3"><div class="card h-100"><div class="card-body d-flex justify-content-between"><div><p class="small text-muted mb-2">Temas publicados</p><p class="h3 mb-1">12</p><span class="small text-muted">En 3 asignaturas</span></div><span class="stat-icon" aria-hidden="true">▤</span></div></div></div>
        <div class="col-sm-6 col-xl-3"><div class="card h-100"><div class="card-body d-flex justify-content-between"><div><p class="small text-muted mb-2">Apuntes disponibles</p><p class="h3 mb-1">4</p><span class="small text-muted">Material para el alumnado</span></div><span class="stat-icon" aria-hidden="true">▧</span></div></div></div>
        <div class="col-sm-6 col-xl-3"><div class="card h-100"><div class="card-body d-flex justify-content-between"><div><p class="small text-muted mb-2">Alumnos inscritos</p><p class="h3 mb-1">4</p><span class="small text-muted">En dos grupos</span></div><span class="stat-icon" aria-hidden="true">♙</span></div></div></div>
        <div class="col-sm-6 col-xl-3"><div class="card h-100"><div class="card-body d-flex justify-content-between"><div><p class="small text-muted mb-2">Pendientes de revisión</p><p class="h3 mb-1">1</p><span class="small text-muted">Apunte en borrador</span></div><span class="stat-icon" aria-hidden="true">◷</span></div></div></div>
      </section>
      <section class="card mb-4" id="subir-tema" aria-labelledby="titulo-subir">
        <div class="card-body p-4">
          <h2 class="h5" id="titulo-subir">Subir un nuevo tema</h2><p class="text-muted small mb-4">Prepara el material de la próxima clase.</p>
          <form id="topic-form">
            <div class="row g-3">
              <div class="col-md-7"><label for="topic-title" class="form-label">Título del tema</label><input id="topic-title" class="form-control" placeholder="Ej.: Introducción a las bases de datos" maxlength="150" required></div>
              <div class="col-md-5"><label for="subject" class="form-label">Asignatura</label><select class="form-select" id="subject" required><option value="">Selecciona una asignatura</option><option>Programación</option><option>Bases de datos</option><option>Lenguajes de marcas</option></select></div>
              <div class="col-md-7"><label for="description" class="form-label">Descripción</label><textarea class="form-control" id="description" rows="4" placeholder="Describe los objetivos y el contenido del tema…" maxlength="2000"></textarea></div>
              <div class="col-md-5"><div class="upload-box h-100"><label for="topic-file" class="form-label fw-semibold">Archivo del tema</label><input class="form-control form-control-sm" type="file" id="topic-file" accept=".pdf,.doc,.docx,.ppt,.pptx" required aria-describedby="file-help"><div class="form-text" id="file-help">PDF, Word o PowerPoint. Máximo 20 MB.</div></div></div>
              <div class="col-12 d-flex flex-wrap justify-content-between align-items-center gap-3"><div class="form-check"><input class="form-check-input" type="checkbox" id="publish" checked><label class="form-check-label small" for="publish">Publicar para los alumnos</label></div><div class="d-flex gap-2"><button class="btn btn-light" type="reset">Limpiar</button><button class="btn btn-primary" type="submit">Subir tema</button></div></div>
            </div>
          </form>
        </div>
      </section>
      <section class="card mb-4" id="apuntes" aria-labelledby="titulo-apuntes">
        <div class="card-body p-4 pb-3"><div class="d-flex flex-wrap justify-content-between align-items-center gap-3"><div><h2 class="h5 mb-1" id="titulo-apuntes">Apuntes</h2><p class="small text-muted mb-0">Consulta y organiza el material del curso.</p></div><div class="d-flex flex-wrap gap-2"><input class="form-control w-auto" id="notes-search" type="search" placeholder="Buscar apuntes…" aria-label="Buscar apuntes"><select class="form-select w-auto" id="notes-filter" aria-label="Filtrar apuntes por asignatura"><option value="">Todas las asignaturas</option><option>Programación</option><option>Bases de datos</option><option>Lenguajes de marcas</option></select></div></div></div>
        <div class="table-responsive"><table class="table align-middle mb-0"><caption class="visually-hidden">Apuntes de ejemplo del curso</caption><thead><tr><th scope="col">Documento</th><th scope="col">Asignatura</th><th scope="col">Fecha</th><th scope="col">Estado</th><th scope="col" class="text-end">Acciones</th></tr></thead><tbody id="notes-body">
          <tr data-subject="Programación"><td><strong class="d-block">Introducción a PHP</strong><small class="text-muted">PDF · 1,2 MB</small></td><td>Programación</td><td>12 nov. 2026</td><td><span class="badge text-bg-success">Publicado</span></td><td class="text-end"><button class="btn btn-sm btn-outline-primary demo-action" data-action="Vista previa: Introducción a PHP">Ver apunte</button></td></tr>
          <tr data-subject="Bases de datos"><td><strong class="d-block">Modelo entidad-relación</strong><small class="text-muted">PDF · 2,4 MB</small></td><td>Bases de datos</td><td>10 nov. 2026</td><td><span class="badge text-bg-success">Publicado</span></td><td class="text-end"><button class="btn btn-sm btn-outline-primary demo-action" data-action="Vista previa: Modelo entidad-relación">Ver apunte</button></td></tr>
          <tr data-subject="Lenguajes de marcas"><td><strong class="d-block">HTML y formularios</strong><small class="text-muted">PDF · 850 KB</small></td><td>Lenguajes de marcas</td><td>9 nov. 2026</td><td><span class="badge text-bg-success">Publicado</span></td><td class="text-end"><button class="btn btn-sm btn-outline-primary demo-action" data-action="Vista previa: HTML y formularios">Ver apunte</button></td></tr>
          <tr data-subject="Programación"><td><strong class="d-block">Ejercicios de funciones</strong><small class="text-muted">DOCX · 320 KB</small></td><td>Programación</td><td>8 nov. 2026</td><td><span class="badge text-bg-warning">Borrador</span></td><td class="text-end"><button class="btn btn-sm btn-outline-primary demo-action" data-action="Vista previa: Ejercicios de funciones">Ver apunte</button></td></tr>
        </tbody></table></div><p id="notes-empty" class="text-muted text-center p-4 mb-0" hidden>No hay apuntes que coincidan con la búsqueda.</p>
      </section>
      <section class="card mb-4" id="alumnos" aria-labelledby="titulo-alumnos">
        <div class="card-body p-4 pb-3 d-flex flex-wrap justify-content-between align-items-center gap-3"><div><h2 class="h5 mb-1" id="titulo-alumnos">Alumnos</h2><p class="small text-muted mb-0">Listado de alumnos inscritos.</p></div><input class="form-control w-auto" type="search" id="students-search" placeholder="Buscar alumno…" aria-label="Buscar alumno por nombre, correo o grupo"></div>
        <div class="table-responsive"><table class="table align-middle mb-0"><caption class="visually-hidden">Alumnos ficticios de demostración</caption><thead><tr><th scope="col">Alumno</th><th scope="col">Correo electrónico</th><th scope="col">Grupo</th><th scope="col">Estado</th><th scope="col" class="text-end">Acciones</th></tr></thead><tbody id="students-body">
          <tr><td><span class="avatar me-2" aria-hidden="true">AM</span>Ana Martín</td><td>ana.martin@example.com</td><td>1.º DAW A</td><td><span class="badge text-bg-success">Activo</span></td><td class="text-end"><button class="btn btn-sm btn-outline-secondary demo-action" data-action="Ficha de Ana Martín">Ver ficha</button></td></tr>
          <tr><td><span class="avatar me-2" aria-hidden="true">DL</span>Diego López</td><td>diego.lopez@example.com</td><td>1.º DAW B</td><td><span class="badge text-bg-success">Activo</span></td><td class="text-end"><button class="btn btn-sm btn-outline-secondary demo-action" data-action="Ficha de Diego López">Ver ficha</button></td></tr>
          <tr><td><span class="avatar me-2" aria-hidden="true">LS</span>Lucía Sánchez</td><td>lucia.sanchez@example.com</td><td>1.º DAW A</td><td><span class="badge text-bg-success">Activo</span></td><td class="text-end"><button class="btn btn-sm btn-outline-secondary demo-action" data-action="Ficha de Lucía Sánchez">Ver ficha</button></td></tr>
          <tr><td><span class="avatar me-2" aria-hidden="true">PR</span>Pablo Ruiz</td><td>pablo.ruiz@example.com</td><td>1.º DAW B</td><td><span class="badge text-bg-secondary">Inactivo</span></td><td class="text-end"><button class="btn btn-sm btn-outline-secondary demo-action" data-action="Ficha de Pablo Ruiz">Ver ficha</button></td></tr>
        </tbody></table></div><p id="students-empty" class="text-muted text-center p-4 mb-0" hidden>No hay alumnos que coincidan con la búsqueda.</p>
      </section>
      <footer class="text-muted small pb-2">SML · Panel de administración · Datos de demostración</footer>
    </main>
  </div>
</div>
<div class="modal fade" id="demo-modal" tabindex="-1" aria-labelledby="demo-title" aria-hidden="true"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header"><h2 class="modal-title fs-5" id="demo-title">Demostración</h2><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button></div><div class="modal-body" id="demo-message"></div><div class="modal-footer"><button type="button" class="btn btn-primary" data-bs-dismiss="modal">Entendido</button></div></div></div></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const normalize = value => value.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
  function filterRows(bodyId, emptyId, query, subject = '') {
    const rows = [...document.getElementById(bodyId).rows];
    rows.forEach(row => { row.hidden = !normalize(row.textContent).includes(normalize(query)) || Boolean(subject && row.dataset.subject !== subject); });
    document.getElementById(emptyId).hidden = rows.some(row => !row.hidden);
  }
  const notesSearch = document.getElementById('notes-search');
  const notesFilter = document.getElementById('notes-filter');
  function filterNotes() { filterRows('notes-body', 'notes-empty', notesSearch.value, notesFilter.value); }
  notesSearch.addEventListener('input', filterNotes);
  notesFilter.addEventListener('change', filterNotes);
  document.getElementById('students-search').addEventListener('input', event => filterRows('students-body', 'students-empty', event.target.value));
  function showDemo(title, message) {
    document.getElementById('demo-title').textContent = title;
    document.getElementById('demo-message').textContent = message;
    bootstrap.Modal.getOrCreateInstance(document.getElementById('demo-modal')).show();
  }
  document.querySelectorAll('.demo-action').forEach(button => button.addEventListener('click', () => showDemo(button.dataset.action, 'Esta acción es de demostración. Podrás conectar aquí el documento o la ficha del alumno cuando implementes el backend.')));
  const topicFile = document.getElementById('topic-file');
  topicFile.addEventListener('change', () => {
    const file = topicFile.files[0];
    topicFile.setCustomValidity(file && (file.size > 20 * 1024 * 1024 || !/\.(pdf|docx?|pptx?)$/i.test(file.name)) ? 'Selecciona un PDF, Word o PowerPoint de hasta 20 MB.' : '');
  });
  document.getElementById('topic-form').addEventListener('reset', () => topicFile.setCustomValidity(''));
  document.getElementById('topic-form').addEventListener('submit', event => {
    event.preventDefault();
    showDemo('Tema preparado', 'El tema «' + document.getElementById('topic-title').value.trim() + '» se ha validado en esta demostración. No se ha enviado ni guardado ningún archivo.');
  });
  document.querySelectorAll('.sidebar .nav-link').forEach(link => link.addEventListener('click', () => {
    document.querySelectorAll('.sidebar .nav-link').forEach(item => { item.classList.remove('active'); item.removeAttribute('aria-current'); });
    link.classList.add('active'); link.setAttribute('aria-current', 'location');
  }));
</script>
</body>
</html>
