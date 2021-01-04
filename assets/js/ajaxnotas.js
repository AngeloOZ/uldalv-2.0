const ctnNote = document.getElementById('ctn_notas');
const btnAddNote = document.getElementById('btn_add_note');
const formNote = document.getElementById('form_notas');
let bandEditarNotas = false;

if(ctnNote){
    initEvents();
    ListarNote();
}

function initEvents(){
    ctnNote.addEventListener('click', e=>{
        if(e.target.className == 'editar'){
            bandEditarNotas = true;
            modal.classList.toggle('active_modal');
            modal.firstElementChild.classList.add('style_note');
            cargarDatosNotas(e.target.parentElement.parentElement, e.target.parentElement.getAttribute('idTask'));
        }else if(e.target.className == 'eliminar'){
            eliminarNote(e.target.parentElement.getAttribute('idTask'));
        }
    })

    btnAddNote.addEventListener('click', _ =>{
        const modal = document.getElementById('modal');
        modal.classList.toggle('active_modal');
        modal.firstElementChild.classList.add('style_note');
    })

    formNote.addEventListener('submit', e=>{
        e.preventDefault();
        AgregarNote();
        ListarNote();
        modal.firstElementChild.classList.remove('style_note');
        modal.classList.toggle('active_modal');
        formNote.reset()
    })
}

async function AgregarNote(){
    let operacion;
    if(bandEditarNotas)
        operacion = 'update';
    else
        operacion = 'create';

    const datos = new FormData(formNote);
    datos.append("operacionEnlace",operacion);

    const data = await fetch('controllers/nota.controlador.php',{method:'POST', body: datos});
    const resultado = await data.json();

    Swal.fire({
        icon: resultado["RespType"],
        title: resultado["sms2"],
        text: resultado["sms"],
        showConfirmButton: false,
        timer: 2000,
    })

    formNote.noteText.value = '';
    formNote.querySelector('.note-editable').innerHTML = '';
    formNote.reset();
    bandEditarNotas = false;
}

async function ListarNote(){
    const fragment = document.createDocumentFragment();
    ctnNote.innerHTML = '';
    const operacion = 'read';
    const datos = new FormData();
    datos.append("operacionEnlace",operacion);

    const data = await fetch('controllers/nota.controlador.php',{method:'POST',body: datos});
    const respuesta = await data.json();

    respuesta.forEach(nota => {
        const div = document.createElement('DIV');
        div.classList.add('task','note');
        div.innerHTML =
        `
            <div class="cont_note">${nota.text}</div>
            <div class="btn_acciones" idTask ="${nota.id}">
                <button class="editar">Editar</button>
                <button class="eliminar">Eliminar</button>
            </div>
        `;
        fragment.appendChild(div);
    });
    ctnNote.appendChild(fragment);
}

async function eliminarNote(id){
    let operacion = "delete";
    let datos = new FormData();
    datos.append("idNota", id);
    datos.append("operacionEnlace", operacion);

    const data = await fetch('controllers/nota.controlador.php', {
        method: 'POST',
        body: datos
    })
    const resultado = await data.json();
    Swal.fire({
        icon: resultado["RespType"],
        title: resultado["sms2"],
        text: resultado["sms"],
        showConfirmButton: false,
        timer: 2500,
    });
    ListarEnlaces();
}

function cargarDatosNotas(element, id){
    const texto = element.querySelector('.cont_note').innerHTML;
    formNote.querySelector('.note-editable').innerHTML = texto;
    formNote.idNote.value = id;
}