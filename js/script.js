function pageScrolled() {
    const body = document.body;
    const className = 'page-scrolled';
    if (window.scrollY > 80) {
        body.classList.add(className);
    } else {
        body.classList.remove(className);
    }
}

function replaceBodyClass(oldClass, newClass) {
    const body = document.body;
    if (body.classList.contains(oldClass)) {
        body.classList.remove(oldClass);
        body.classList.add(newClass);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener( 'wpcf7mailsent', function() {
        location = '/merci/';
    }, false );
    window.addEventListener( 'scroll', pageScrolled );
    replaceBodyClass('nojs', 'js-enabled');
});
