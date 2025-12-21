function pageScrolled() {
    const body = document.body;
    const className = 'page-scrolled';
    if (window.scrollY > 80) {
        body.classList.add(className);
    } else {
        body.classList.remove(className);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener( 'wpcf7mailsent', function() {
        location = '/merci/';
    }, false );
    window.addEventListener( 'scroll', pageScrolled );
});
