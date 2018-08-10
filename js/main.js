document.body.onload = function () {
    let hiddenElements = document.querySelectorAll('.hidden');
    for (let elem of hiddenElements) {
        elem.style.display = 'none';
    }
};