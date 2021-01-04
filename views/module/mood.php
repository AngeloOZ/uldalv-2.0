<h1 style="text-align: center;">Bienvenido a Mood Tracker</h1>
<form id="insertarMood">
    <h2 class="Titulito"> ¿Cómo te sientes hoy?
    </h2>
    <div class="contenedor_opciones">
        <div class="form-group-radios">
            <input type="radio" name="estadoAnimo" value="Muy Bien" id="estadoMuyBien">
            <label class="label" for="estadoMuyBien"><span>Muy Bien</span><img src="<?php echo IMG ?>Emoji_svg/1_muyBueno_(2).svg" alt=""></label>
        </div>
        <div class="form-group-radios">
            <input type="radio" name="estadoAnimo" value="Bien" id="estadoBien">
            <label class="label" for="estadoBien"><span>Bien</span><img src="<?php echo IMG ?>/Emoji_svg/2 bueno (2).svg" alt=""></label>
        </div>
        <div class="form-group-radios">
            <input type="radio" name="estadoAnimo" value="Regular" id="estadoRegular">
            <label class="label" for="estadoRegular"><span>Regular</span><img src="<?php echo IMG ?>/Emoji_svg/3 regular (2).svg" alt=""></label>
        </div>
        <div class="form-group-radios">
            <input type="radio" name="estadoAnimo" value="Mal" id="estadoMalo">
            <label class="label" for="estadoMalo"><span>Mal</span><img src="<?php echo IMG ?>/Emoji_svg/4 malo (2).svg" alt=""></label>
        </div>
        <div class="form-group-radios">
            <input type="radio" name="estadoAnimo" value="Muy Mal" id="estadoMuyMalo">
            <label class="label" for="estadoMuyMalo"><span>Muy Mal</span><img src="<?php echo IMG ?>/Emoji_svg/5 muyMaloV2 (2).svg" alt=""></label>
        </div>
    </div>
    <input type="submit" value="Guardar">
</form>