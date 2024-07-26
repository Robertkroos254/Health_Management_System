document.getElementById('profile-icon').addEventListener('click', function() {
    var container = document.getElementById('profile-container');
    if (container.style.display === 'none' || container.style.display === '') {
        container.style.display = 'block';
    } else {
        container.style.display = 'none';
    }
});