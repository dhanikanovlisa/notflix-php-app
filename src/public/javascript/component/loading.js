function initializeLoading(showLoading) {
    if (showLoading) {
        document.querySelector('.loader-container').style.display = 'block';
    } else {
        document.querySelector('.loader-container').style.display = 'none';
    }
}