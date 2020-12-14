const ctnEnlaces = document.getElementById('ctn_enlaces');
const inputSearch = document.getElementById('searchLink');
const btnAddEnlace = document.getElementById('btnAddEnlace');
const formAddUrl = document.getElementById('form_enlaces');
const modal = document.getElementById('modal');
let bandEditar = false;
ListarEnlaces();


/* -------------------------------------------------------------------------- */
/*                                   eventos                                  */
/* -------------------------------------------------------------------------- */

ctnEnlaces.addEventListener('click', e =>{
    if(e.target.className == 'editar'){
        cargarEnlace(e.target)
        modal.classList.toggle('active_modal');
        bandEditar = true;
    }else if(e.target.className == 'eliminar'){
        EliminarEnlace(e.target.parentElement.getAttribute('id_enlace'))
    }
})

btnAddEnlace.addEventListener('click', ()=>{
    modal.classList.toggle('active_modal');
    bandEditar = false;
})

inputSearch.parentElement.addEventListener('submit',e => e.preventDefault());

inputSearch.addEventListener('keyup',e=>{
    if(inputSearch.value != ""){
        ListarEnlacesFiltrados(inputSearch.value);
    }else{
        ListarEnlaces();
    }
});
formAddUrl.addEventListener('submit', e =>{
    e.preventDefault();
    if(formAddUrl.ingresarNombreEnlace.value.length > 0 && formAddUrl.ingresarUrl.value.length > 0){
        AgregarEditarEnlace();
    }
})

/* -------------------------------------------------------------------------- */
/*                            funciones programadas                           */
/* -------------------------------------------------------------------------- */

async function ListarEnlaces(){
    const fragment = document.createDocumentFragment();
    const operacion = 'read';
    let datos = new FormData();
    datos.append("operacionEnlace",operacion);

    const data = await fetch('controllers/enlace.controlador.php',{
        method: 'POST',
        body: datos
    })
    const resp = await data.json(); 
    ctnEnlaces.innerHTML = '';
    resp.forEach(enlace => {
        const div = document.createElement('DIV');
        div.classList.add('task','enlace')
        div.innerHTML = `
            <p>${enlace.name}</p>
            <a href="${enlace.link}"><p>${enlace.link}</p></a>
            <div class="btn_acciones" id_enlace="${enlace.id}">
                <button class="editar">Editar</button>
                <button class="eliminar">Eliminar</button>
            </div>
        `;
        fragment.appendChild(div);
    });
    ctnEnlaces.appendChild(fragment);
}

async function ListarEnlacesFiltrados(valor){
    const fragment = document.createDocumentFragment();
    const operacion = 'read';
    let datos = new FormData();
    datos.append("operacionEnlace",operacion);
    datos.append("FilterSearch",valor);

    const data = await fetch('controllers/enlace.controlador.php',{
        method: 'POST',
        body: datos
    })
    const resp = await data.json(); 
    ctnEnlaces.innerHTML = '';
    if(resp.length > 0){
        resp.forEach(enlace => {
            const div = document.createElement('DIV');
            div.classList.add('task','enlace')
            div.innerHTML = `
                <p>${enlace.name}</p>
                <a href="${enlace.link}"><p>${enlace.link}</p></a>
                <div class="btn_acciones" id_enlace="${enlace.id}">
                    <button class="editar">Editar</button>
                    <button class="eliminar">Eliminar</button>
                </div>
            `;
            fragment.appendChild(div);
        });
    }else{
        const p = document.createElement('P');
        p.textContent = "Upss... parece que no hay enlaces";
        fragment.appendChild(p);
    }
    ctnEnlaces.appendChild(fragment);
}

async function AgregarEditarEnlace(){
    let operacion;
    if(bandEditar) operacion = 'update';
    else operacion = 'create';
    const datos = new FormData(formAddUrl);
    datos.append("operacionEnlace",operacion);
    const data = await fetch('controllers/enlace.controlador.php',{
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
    })
    formAddUrl.reset();
    modal.classList.toggle('active_modal');  
    ListarEnlaces(); 
    if(bandEditar) bandEditar = false;
}

async function EliminarEnlace(idEnlace){
    let operacion = "delete";
    let datos = new FormData();
    datos.append("idEnlaceDelete",idEnlace);
    datos.append("operacionEnlace",operacion);

    const data = await fetch('controllers/enlace.controlador.php',{
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

function cargarEnlace(target){
    const enlace = target.parentElement.parentElement; 
    const idEnlace = Number.parseInt(target.parentElement.getAttribute('id_enlace'));
    console.log(idEnlace);
    const nombreEnlace = enlace.querySelector('p').textContent;
    const urlEnlace = enlace.querySelector('a').href;

    formAddUrl.ingresarNombreEnlace.value = nombreEnlace;
    formAddUrl.ingresarUrl.value = urlEnlace;
    formAddUrl.hiddenIdLink.value = idEnlace;
}

