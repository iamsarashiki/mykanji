function closePopup() {
    document.getElementById('popup-miku').style.display = 'none';
}
function closePopupToday() {
    localStorage.setItem('mikuPopupClosed', Date.now());
    closePopup();
}
window.onload = function() {
    let lastClosed = localStorage.getItem('mikuPopupClosed');
    if (!lastClosed || (Date.now() - lastClosed) > 24*60*60*1000) {
        document.getElementById('popup-miku').style.display = 'block';
    }
}
