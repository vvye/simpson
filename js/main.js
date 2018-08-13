document.body.onload = function () {

    let visibleElements = document.querySelectorAll('.visible-with-js');
    for (let elem of visibleElements) {
        elem.classList.remove('visible-with-js');
    }

    let hiddenElements = document.querySelectorAll('.hidden-with-js');
    for (let elem of hiddenElements) {
        elem.style.display = 'none';
    }

    // rescroll after hiding elements
    if (window.location.hash) {
        window.location.hash = window.location.hash;
    }

};