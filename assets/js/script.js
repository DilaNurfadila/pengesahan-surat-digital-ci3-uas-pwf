function toggleDropdown() {
    var dropdown = document.getElementById('dropdown');
    dropdown.classList.toggle('hidden');
}

// JavaScript untuk menghilangkan alert setelah 5 detik (5000 ms)
setTimeout(function() {
    var alert = document.getElementById('alert');
    if (alert) {
        alert.style.transition = 'opacity 0.5s ease-out';
        alert.style.opacity = '0';
        setTimeout(function() {
            alert.remove();
        }, 300); // Menghapus elemen setelah transisi selesai
    }
}, 3000); // 5000 ms = 5 detik

$("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();

    $("table tbody tr").each(function() {
        var name = $(this).find("td:nth-child(2)").text().toLowerCase();
        if (name.indexOf(value) === -1) {
            $(this).hide();
        } else {
            $(this).show();
        }
    });
});