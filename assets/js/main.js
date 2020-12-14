const btnCloseModal = document.querySelector('.close_modal');

btnCloseModal.addEventListener('click', ()=>{
    const modal = document.getElementById('modal');
    modal.classList.toggle('active_modal');
    const form = btnCloseModal.nextElementSibling.nextElementSibling;
    form.reset();
})

