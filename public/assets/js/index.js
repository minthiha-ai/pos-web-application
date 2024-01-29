function closeMsg(){
    let msg = document.querySelector('#msg');
    msg.classList.remove('animate__slideIn');
    msg.classList.add('animate__slideOut');
}

let mode = localStorage.getItem('layout-mode');
document.children[0].dataset.layoutMode = mode;
let modeBtn = document.querySelector('.light-dark-mode');
modeBtn.addEventListener('click', ()=>{
    let mode = document.children[0].dataset.layoutMode;
    localStorage.setItem('layout-mode', mode);
})
