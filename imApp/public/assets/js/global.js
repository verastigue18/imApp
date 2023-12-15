function displayFileName() {
    const input = document.getElementById('file');
    const fileName = input.files[0].name;
    const fileNameSpan = document.getElementById('file-name');
    fileNameSpan.textContent = 'Selected file: ' + fileName;
}