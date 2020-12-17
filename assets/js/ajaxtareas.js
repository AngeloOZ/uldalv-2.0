const ctnTareas = document.getElementById('ctn_tareas');
const formAddTask = document.getElementById('form_tareas');
const btnAddTask = document.getElementById('btn_add_task');
let editarTask = false;


if (ctnTareas) {
    initTask();
}

function initTask() {
    ListarTask();

    btnAddTask.addEventListener('click', _ => {
        modal.classList.toggle('active_modal');
        editarTask = false;
    })

    ctnTareas.addEventListener('click', e => {
        if (e.target.classList.contains('task_finish')) {
            e.target.classList.toggle('finished');
            const id = e.target.nextElementSibling.getAttribute("idtask");
            if (e.target.classList.contains('finished')) {
                updateState(id, 1);
            } else {
                updateState(id, 0);
            }
        } else if (e.target.className == 'editar') {
            CargarDatos(e.target);
            modal.classList.toggle('active_modal');
            editarTask = true;
        } else if (e.target.className == 'eliminar') {
            const id = e.target.parentElement.getAttribute('idtask');
            Swal.fire({
                title: 'Está Seguro?',
                text: "Una vez borrado no puede revertir la acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, Borralo!'
            }).then((result) => {
                if (result.value) {
                    EliminarTask(id)
                }
            })
        }
    })

    formAddTask.addEventListener('submit', e => {
        e.preventDefault();
        AgregarTask();
    })
}

async function ListarTask() {
    const fragment = document.createDocumentFragment();
    const operacion = 'read';
    const datos = new FormData();
    datos.append("operacionEnlace", operacion);

    const data = await fetch('controllers/tareas.controlador.php', {
        method: 'POST',
        body: datos
    });

    const response = await data.json();
    ctnTareas.innerHTML = '';
    response.forEach(task => {
        const div = document.createElement('DIV');
        div.classList.add('task', 'tasknew');
        div.innerHTML = `
            <h2>${task.name_task}</h2>
            <p>${(task.description == null) ? "" : task.description}</p>
            <button class="task_finish ${(task.state_task == "0") ? "" : "finished"}"></button>
            <div class="btn_acciones" idTask ="${task.id}">
                <button class="editar">Editar</button>
                <button class="eliminar">Eliminar</button>
            </div>
        `;
        fragment.appendChild(div);
    });
    ctnTareas.appendChild(fragment);
}

async function updateState(id, state) {
    const operacion = 'update_state';
    const datos = new FormData();

    datos.append("operacionEnlace", operacion);
    datos.append("id_task", id);
    datos.append("state_task", state);

    const data = await fetch('controllers/tareas.controlador.php', {
        method: 'POST',
        body: datos
    });

    const response = await data.text();
    if (response == "error") {
        alert("Hubo un error intentalo mas tarde");
    }
}

async function AgregarTask() {
    let operacion;
    if (editarTask) operacion = 'update'; else operacion = 'create';

    const datos = new FormData(formAddTask);
    datos.append("operacionEnlace", operacion);

    const data = await fetch('controllers/tareas.controlador.php', {
        method: 'POST',
        body: datos
    });

    const resultado = await data.json();

    Swal.fire({
        icon: resultado["RespType"],
        title: resultado["sms2"],
        text: resultado["sms"],
        showConfirmButton: false,
        timer: 2000,
    })
    modal.classList.toggle('active_modal');
    formAddTask.reset();
    ListarTask();

    if (editarTask) editarTask = false;
}

async function EliminarTask(id) {
    let operacion = 'delete';
    let datos = new FormData();
    datos.append("operacionEnlace", operacion);
    datos.append("idTask", id);

    const data = await fetch('controllers/tareas.controlador.php', {
        method: 'POST',
        body: datos
    });

    const resultado = await data.json();
    Swal.fire({
        icon: resultado["RespType"],
        title: resultado["sms2"],
        text: resultado["sms"],
        showConfirmButton: false,
        timer: 2000,
    })
    ListarTask();

}

function CargarDatos(target) {
    const tarea = target.parentElement.parentElement;
    formAddTask.nombreTarea.value = tarea.querySelector('h2').textContent;
    formAddTask.descripcionTarea.value = tarea.querySelector('p').textContent;
    //!Pendiente fecha
    // formAddTask.fecha.value = tarea.querySelector('p').textContent;
    formAddTask.inputIdTareas.value = target.parentElement.getAttribute('idtask');
}