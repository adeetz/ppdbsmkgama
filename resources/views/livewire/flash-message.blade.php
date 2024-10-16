<div>
    @if (session()->has('success'))
        <div id="flash-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Menghilangkan pesan flash setelah 5 detik (5000 ms)
        setTimeout(function() {
            var flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                flashMessage.style.transition = 'opacity 0.5s ease';
                flashMessage.style.opacity = '0'; // Mengatur opacity menjadi 0 untuk efek menghilang
                setTimeout(function() {
                    flashMessage.remove(); // Menghapus elemen setelah animasi selesai
                }, 500); // Waktu untuk menghapus elemen setelah transisi selesai
            }
        }, 5000); // 5000 ms = 5 detik
    });
</script>
