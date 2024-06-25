document.getElementById('upload-button').addEventListener('click', function() {
    document.getElementById('file-input').click();
});

document.getElementById('file-input').addEventListener('change', function() {
    if (this.files.length > 0) {
        const file = this.files[0];
        displayFileInfo(file);
    }
});

document.getElementById('delete-button').addEventListener('click', function() {
    document.getElementById('file-input').value = '';
    document.getElementById('document-form').reset();
    document.getElementById('upload-section').style.display = 'block';
    document.getElementById('form-section').style.display = 'none';
});

document.getElementById('document-form').addEventListener('submit', function(event) {
    event.preventDefault();
    alert('Document Uploaded Successfully!');
    document.getElementById('file-input').value = '';
    this.reset();
    document.getElementById('upload-section').style.display = 'block';
    document.getElementById('form-section').style.display = 'none';
});

function displayFileInfo(file) {
    document.getElementById('file-name').textContent = file.name;
    document.getElementById('file-size').textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
    document.getElementById('upload-section').style.display = 'none';
    document.getElementById('form-section').style.display = 'block';
}

// Drag and Drop functionality
const dropArea = document.getElementById('drag-drop-area');

dropArea.addEventListener('dragover', (event) => {
    event.preventDefault();
    dropArea.classList.add('dragover');
});

dropArea.addEventListener('dragleave', () => {
    dropArea.classList.remove('dragover');
});

dropArea.addEventListener('drop', (event) => {
    event.preventDefault();
    dropArea.classList.remove('dragover');

    if (event.dataTransfer.files.length > 0) {
        const file = event.dataTransfer.files[0];
        displayFileInfo(file);
    }
});
