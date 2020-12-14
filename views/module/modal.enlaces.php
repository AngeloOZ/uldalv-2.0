<h2>Gestor de Enlaces</h2>
<form action="" class="form_enlaces" id="form_enlaces">
    <div class="form_group">
        <label for="ingresarNombreEnlace">Nombre enlace</label>
        <input type="text" name="ingresarNombreEnlace" id="ingresarNombreEnlace" placeholder="Github" require>
    </div>
    <div class="form_group">
        <label for="ingresarUrl">Url</label>
        <input type="url" name="ingresarUrl" placeholder="https://github.com/" id="ingresarUrl" autocomplete="off" require>
    </div>
    <input type="hidden" value="" name="hiddenIdLink" id="hiddenIdLink">
    <input type="submit" value="Guardar Enlace">
</form>