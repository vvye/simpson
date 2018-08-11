const writeMessageButton = document.getElementById('write-message');
const messageForm = document.getElementById('message-form');
const postMessageButton = document.getElementById('post-message');
const addAddresseeCheckbox = document.getElementById('add-addressee');
const addresseeForm = document.getElementById('addressee-form');

writeMessageButton.onclick = function() {
    if (messageForm.style.display === 'none') {
        messageForm.style.display = 'block';
        this.innerHTML = 'Hide editor';
        this.classList.remove('primary');
        postMessageButton.classList.add('primary');
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

