const writeMessageButton = document.getElementById('write-message');
const messageForm = document.getElementById('message-form');
const postMessageButton = document.getElementById('post-message');
const addAddresseeCheckbox = document.getElementById('add-addressee');
const addresseeForm = document.getElementById('addressee-form');
const successAlert = document.getElementById('message-post-success');

writeMessageButton.onclick = function() {
    if (messageForm.style.display === 'none') {
        messageForm.style.display = 'block';
        this.innerHTML = 'Hide editor';
        this.classList.remove('primary');
        postMessageButton.classList.add('primary');
        successAlert.parentNode.removeChild(successAlert);
    } else {
        messageForm.style.display = 'none';
        this.innerHTML = 'Write a message';
        this.classList.add('primary');
        postMessageButton.classList.remove('primary');
    }
};

addAddresseeCheckbox.onchange = function() {
    if (this.checked) {
        addresseeForm.style.display = 'block';
    } else {
        addresseeForm.style.display = 'none';
    }
};

