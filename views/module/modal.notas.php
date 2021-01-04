<h2>Gestor de Notas</h2>
<form action="" class="form_notas" id="form_notas">
    <textarea name="noteText" id="noteText"></textarea>
    <input type="hidden" name="idNote" id="idNote" value="">
    <input type="submit" value="Guardar Nota">
</form>
<script>
    $(document).ready(function() {
        $('#noteText').summernote({
            height: 300,
            minHeight: null,
            maxHeight: null,   
            focus: true 
        });
    });
</script>