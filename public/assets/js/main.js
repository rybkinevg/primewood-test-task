const modal = document.querySelector('.modal');
const modalOpenTrigger = document.querySelector('.modal-open-trigger');
const modalCloseTriggers = document.getElementsByClassName('modal-close-trigger');

modalOpenTrigger.onclick = function () {
    modal.style.display = "flex";
}

for (let i = 0; i < modalCloseTriggers.length; i++) {
    modalCloseTriggers.item(i).onclick = function () {
        modal.style.display = "none";
    }
}

window.onclick = function (event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
}

