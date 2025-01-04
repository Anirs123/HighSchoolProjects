const omenu = document.querySelectorAll('.menu');
omenu.forEach(el => el.addEventListener('click', function() {
    //alert('OK')
    fetch(`fetch.php?op=${this.id}`)
        .then(res => {
            res.text().then(odpPHP => {
                tresc.innerHTML = odpPHP;
                tresc.scrollIntoView({behavior: 'smooth'});
            });
        })
}));