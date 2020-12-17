<h2>Gestor de Tareas</h2>
<form action="" class="form_tareas" id="form_tareas">
    <div class="form_group">
        <label for="nombreTarea">Nombre</label>
        <input type="text" name="nombreTarea" id="nombreTarea" placeholder="Comprar Pan" require>
    </div>
    <div class="form_group">
        <label for="descripcionTarea">Descripción</label>
        <input type="text" name="descripcionTarea" id="descripcionTarea" placeholder="Pan de dulce">
    </div>
    <div class="form_group">
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" value="<?php echo date("Y-m-d");?>" id="fecha">
    </div>
    <input type="hidden" name="inputIdTareas" id="inputIdTareas" value="">
    <input type="submit" value="Guardar Enlace">
</form>