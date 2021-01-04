const formMood = document.getElementById('insertarMood');
const ctnMood = document.getElementById('ctn_mood')

if(ctnMood){
    initEventsMood();
}

function initEventsMood(){
    console.log(formMood);
    formMood.addEventListener('submit', e => {
        e.preventDefault();
        agregarMood();
    })
}

async function agregarMood(){
    let operacion="insert";
    let datos=new FormData(formMood);
    datos.append("operacionMood",operacion);

    const data = await fetch('controllers/mood.controlador.php', {
        method: 'POST',
        body: datos
    })

    const resultado = data.json();

    console.log('resultado', resultado)

    return;

    resultado= JSON.parse(xhr.response);
        console.log(resultado);
        Swal.fire({
        icon: resultado["RespType"],
        title: resultado["sms2"],
        text: resultado["sms"],
        showConfirmButton: false,
        timer: 2000,
    })

}