const btnCloseModal = document.querySelector('.close_modal');
const body = document.querySelector('body');
const btnDark = document.getElementById("dark-mode");

btnCloseModal.addEventListener('click', ()=>{
    const modal = document.getElementById('modal');
    modal.classList.toggle('active_modal');
    const form = btnCloseModal.nextElementSibling.nextElementSibling;
    form.reset();
})


window.addEventListener('load', _ =>{
    if(localStorage.getItem('status-dark-mode') === 'true'){
        body.classList.add('active-dark')
    }else{
        body.classList.remove('active-dark')
    } 
    btnDark.addEventListener('click', ()=>{
        body.classList.toggle('active-dark')
        if(body.classList.contains('active-dark')){
            localStorage.setItem('status-dark-mode','true')
        }else{
            localStorage.setItem('status-dark-mode','false')
        }
    })
})

