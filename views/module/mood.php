<div class="contenedor-task">
    <nav class="nav-filter">
        <h1 style="text-align: center;">Bienvenido a Mood Tracker</h1>
    </nav>
    <form id="insertarMood">
        <h2 class="Titulito"> ¿Cómo te sientes hoy?
        </h2>
        <div class="contenedor_opciones">
            <div class="form-group-radios">
                <input type="radio" name="estadoAnimo" value="Muy Bien" id="estadoMuyBien">
                <label class="label" for="estadoMuyBien"><span>Muy Bien</span><img src="<?php echo IMG ?>emojis/1_muyBueno_(2).svg" alt=""></label>
            </div>
            <div class="form-group-radios">
                <input type="radio" name="estadoAnimo" value="Bien" id="estadoBien">
                <label class="label" for="estadoBien"><span>Bien</span><img src="<?php echo IMG ?>emojis/2_bueno_(2).svg" alt=""></label>
            </div>
            <div class="form-group-radios">
                <input type="radio" name="estadoAnimo" value="Regular" id="estadoRegular">
                <label class="label" for="estadoRegular"><span>Regular</span><img src="<?php echo IMG ?>emojis/3 _regular_(2).svg" alt=""></label>
            </div>
            <div class="form-group-radios">
                <input type="radio" name="estadoAnimo" value="Mal" id="estadoMalo">
                <label class="label" for="estadoMalo"><span>Mal</span><img src="<?php echo IMG ?>emojis/4_malo_(2).svg" alt=""></label>
            </div>
            <div class="form-group-radios">
                <input type="radio" name="estadoAnimo" value="Muy Mal" id="estadoMuyMalo">
                <label class="label" for="estadoMuyMalo"><span>Muy Mal</span><img src="<?php echo IMG ?>emojis/5_muyMaloV2_(2).svg" alt=""></label>
            </div>
        </div>
        <input type="submit" value="Guardar">
    </form>
    <div class="container-task" id="ctn_mood">
    </div>
</div>