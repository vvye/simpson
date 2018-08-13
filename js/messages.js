const writeMessageButton = document.getElementById('write-message');
const messageForm = document.getElementById('message-form');
const postMessageButton = document.getElementById('post-message');
const addAddresseeCheckbox = document.getElementById('add-addressee');
const addresseeForm = document.getElementById('addressee-form');
const successAlert = document.getElementById('message-post-success');
const replyButtons = document.querySelectorAll('.reply-form .button');
const replyToggleButtons = document.querySelectorAll('.reply-toggle');

writeMessageButton.onclick = function () {
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

addAddresseeCheckbox.onchange = function () {
    if (this.checked) {
        addresseeForm.style.display = 'block';
    } else {
        addresseeForm.style.display = 'none';
    }
};

for (let button of replyButtons) {
    button.onclick = function () {
        let messageId = this.getAttribute('data-message');
        let replyForm = document.querySelectorAll('form[data-message="' + messageId + '"]')[0];
        if (!replyForm) {
            return;
        }
        if (replyForm.style.display === 'none') {
            replyForm.style.display = 'block';
            this.innerHTML = 'Hide editor';
        } else {
            replyForm.style.display = 'none';
            this.innerHTML = 'Reply';
        }
    }
}

for (let button of replyToggleButtons) {
    button.onclick = function () {
        let replyList = this.nextElementSibling;
        if (replyList.style.display === 'none') {
            replyList.style.display = 'block';
            this.innerHTML = '▲';
        } else {
            replyList.style.display = 'none';
            this.innerHTML = '▼';
        }
    }
}

