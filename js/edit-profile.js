const changeAvatarCheckbox = document.getElementById('change-avatar');
const deleteAvatarCheckbox = document.getElementById('delete-avatar');
const avatarFileInput = document.getElementById('edit-avatar');

changeAvatarCheckbox.onchange = function () {
    if (this.checked) {
        deleteAvatarCheckbox.checked = false;
        avatarFileInput.style.display = 'block';
        fileInput('file-input');
    } else {
        avatarFileInput.style.display = 'none';
    }
};

deleteAvatarCheckbox.onchange = function() {
    if (this.checked) {
        changeAvatarCheckbox.checked = false;
        avatarFileInput.style.display = 'none';
    }
};